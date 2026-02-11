@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->select('id', 'name')->get();

    @endphp
    <style>
          
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }
        
        textarea.note-codable {
            display: none !important;
        }
        .hide-input {
            display: none;
        }
                                    

        /* header {
            display: none;
        } */
        .remove-file  {
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }

        .remove-file :hover {
            color: white;
        }
          header .header_rcms_bottom ,.container-fluid.header-bottom,.search-bar{
            display: none;
        }
         .calenderauditee {
            position: relative;
        }
         .form-control{
            margin-bottom: 20px;
        }

    </style>
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
            let block = document.getElementById(blockID);
            let blockTextarea = block.getElementsByTagName('textarea')[0];
            let blockLabel = block.querySelector('label span.text-danger');

            if (value === checkValue) {
                block.style.display = "block"; // Show field
                blockLabel.classList.remove('d-none');
                blockTextarea.setAttribute('required', 'required');
            } else {
                block.style.display = "none"; // Hide field
                blockLabel.classList.add('d-none');
                blockTextarea.removeAttribute('required');
            }
        }

        // Page load par check kare ki agar "Yes" ya "Others" selected ho to field dikhaye
        document.addEventListener("DOMContentLoaded", function () {
            otherController(document.querySelector("select[name='initiated_through']").value, "others", "initiated_through_req");
            otherController(document.querySelector("select[name='repeat']").value, "Yes", "repeat_nature");
            otherController(document.querySelector("select[name='interim_containnment']").value, "required", "containment_comments");
        });
    </script>

     <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">
                
                <div class="slogan">
                    <strong>Site Division/Project :</strong>
                    {{ Helpers::getDivisionName($data->division_id) }} / CAPA
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Linear Connected Progress Bar */
        .progress-bars {
            display: flex;
            border-radius: 30px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
            background: #f5f5f5;
        }
        
        .progress-bars div {
            padding: 8px 12px;
            font-size: 14px;
            flex-grow: 1;
            text-align: center;
            position: relative;
            transition: all 0.3s ease;
            border-right: 1px solid #fff;
        }
        
        .progress-bars div:last-child {
            border-right: none;
        }
        
        /* Completed Stages - Solid Green */
        .progress-bars div.completed {
            background-color: #4CAF50;
            color: black;
        }
        
        /* CURRENT Stage - Animated Blue (Pending Action) */
        .progress-bars div.current {
            background-color: #de8d0a;
            color: black;
            font-weight: bold;
            animation: pulse-blue 1.5s infinite;
        }
        
        /* Pending Stages - Light Gray */
        .progress-bars div.pending {
            background-color: #f5f5f5;
            color: black;
        }
        
        /* Closed States */
        .progress-bars div.closed {
            background-color: #f44336;
            color: white;
        }
        
        /* Blue Pulse Animation */
    
        @keyframes pulse-blue {
            0% { background-color: #de8d0a; }
            50% { background-color: #dfac54; }
            100% { background-color: #de8d0a; }
        }
    </style>

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
                       @php
                            $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                            $userRoleIdslock = $userRoles->pluck('q_m_s_roles_id')->toArray();
                            $lockdatafileds1 = !($data->stage == 1 &&
                             Helpers::check_roles($data->division_id, 'CAPA', 3));
                            $lockdatafileds2 = !($data->stage == 2 
                            && Helpers::check_roles($data->division_id, 'CAPA', 4));
                            $lockdatafileds3 = !($data->stage == 3 && ( 
                            Helpers::check_roles($data->division_id, 'CAPA', 48)||
                            Helpers::check_roles($data->division_id, 'CAPA', 49)||
                            Helpers::check_roles($data->division_id, 'CAPA', 63)
                            ));
                            $lockdatafileds4 = !($data->stage == 4 && ( 
                            Helpers::check_roles($data->division_id, 'CAPA', 64)||
                            Helpers::check_roles($data->division_id, 'CAPA', 67
                                )));
                            $lockdatafileds5 = !($data->stage == 5 && ( 
                            Helpers::check_roles($data->division_id, 'CAPA', 3)
                            ));
                            $lockdatafileds6 = !($data->stage == 6 && ( 
                            Helpers::check_roles($data->division_id, 'CAPA', 4)
                            ));
                            $lockdatafileds7 = !($data->stage == 7 && ( 
                            Helpers::check_roles($data->division_id, 'CAPA', 7)
                            ||Helpers::check_roles($data->division_id, 'CAPA', 66)
                            ));
                            $lockdatafileds8 = !($data->stage == 8 &&      
                             (Helpers::check_roles($data->division_id, 'CAPA', 9) || Helpers::check_roles($data->division_id, 'CAPA',39 ) || Helpers::check_roles($data->division_id, 'CAPA',42 ) || Helpers::check_roles($data->division_id, 'CAPA',43 ) ||
                             Helpers::check_roles($data->division_id, 'CAPA', 65)))
                        
                       @endphp
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}

                            <a class="button_theme1 text-white" href="{{ url('CapaAuditTrial', $data->id) }}">
                                Audit Trail
                            </a>

                        @if ($data->stage == 1 && ( ($data->initiator_id == Auth::user()->id) || Helpers::check_roles($data->division_id, 'CAPA', 3)))
                            <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Propose Plan
                            </button> </a>

                        @elseif($data->stage == 2 && Helpers::check_roles($data->division_id, 'CAPA', 4))
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

                        @elseif($data->stage == 3  &&( Helpers::check_roles($data->division_id, 'CAPA', 48)||
                            Helpers::check_roles($data->division_id, 'CAPA', 49)||
                            Helpers::check_roles($data->division_id, 'CAPA', 63)))
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

                        @elseif($data->stage == 4 &&  (Helpers::check_roles($data->division_id, 'CAPA', 67) ||
                            Helpers::check_roles($data->division_id, 'CAPA', 64) ))
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

                        @elseif($data->stage == 5  && Helpers::check_roles($data->division_id, 'CAPA', 3))
                           <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                 Complete
                            </button></a>
                            <a href="#child-modal"><button id="major" type="button" class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#child-modal">
                                Child
                            </button></a>

                        @elseif($data->stage == 6 && Helpers::check_roles($data->division_id, 'CAPA', 4))

                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Final Review Complete

                           </button></a>
                           <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                More Info Required
                             </button></a>
                             @if(Helpers::getChildData($data->id, 'CAPA') < 3)
                             <a href="#child-modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button></a>
                             @endif

                             @elseif($data->stage == 7 && (Helpers::check_roles($data->division_id, 'CAPA', 7) ||
                            Helpers::check_roles($data->division_id, 'CAPA', 66)))

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

                            @elseif($data->stage == 8 && (Helpers::check_roles($data->division_id, 'CAPA', 9) || Helpers::check_roles($data->division_id, 'CAPA',39 ) || Helpers::check_roles($data->division_id, 'CAPA',42 ) || Helpers::check_roles($data->division_id, 'CAPA',43 ) ||
                            Helpers::check_roles($data->division_id, 'CAPA', 65)))

                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QAH/CQA Head Approval Complete
                            </button></a>

                            <a href="#modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#modal1">
                                    More Info Required
                            </button></a>
                            @if(Helpers::getChildData($data->id, 'CAPA') < 3)
                            <a href="#child-modal1"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                            Child
                            </button></a>
                            @endif

                           @elseif($data->stage == 9 && (Helpers::check_roles($data->division_id, 'CAPA', 9) || Helpers::check_roles($data->division_id, 'CAPA',39 ) || Helpers::check_roles($data->division_id, 'CAPA',42 ) || Helpers::check_roles($data->division_id, 'CAPA',43 ) ||
                            Helpers::check_roles($data->division_id, 'CAPA', 65) || in_array(18, $userRoleIds)))

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
                    @php
                        $currentStage = $data->stage;
                    @endphp
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">

                            <div class="{{ $currentStage > 1 ? 'active' : ($currentStage == 1 ? 'current' : '') }}">Opened</div>

                            <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">HOD Review</div>

                            <div class="{{ $currentStage > 3 ? 'active' : ($currentStage == 3 ? 'current' : '') }}">QA/CQA Review</div>

                            <div class="{{ $currentStage > 4 ? 'active' : ($currentStage == 4 ? 'current' : '') }}">QA/CQA Approval</div>

                            <div class="{{ $currentStage > 5 ? 'active' : ($currentStage == 5 ? 'current' : '') }}">CAPA In progress</div>

                            <div class="{{ $currentStage > 6 ? 'active' : ($currentStage == 6 ? 'current' : '') }}">HOD Final Review</div>

                            <div class="{{ $currentStage > 7 ? 'active' : ($currentStage == 7 ? 'current' : '') }}">QA/CQA Closure Review</div>
        
                            <div class="{{ $currentStage > 8 ? 'active' : ($currentStage == 8 ? 'current' : '') }}">QAH/CQAH Approval</div>
                            @if ($data->stage >= 9)
                              <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif

                    @endif
                </div>

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
                        <button class="cctablinks" onclick="openCity(event, 'CCForm13')">HOD Final Review</button>
                         <button class="cctablinks" onclick="openCity(event, 'CCForm14')">QA/CQA Closure Review</button>
                         <button class="cctablinks" onclick="openCity(event, 'CCForm5')">CAPA Closure</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
                    </div>

                    <script>
                        function activateTabBasedOnStage(stage) {
                            const tabContents = document.querySelectorAll('.cctabcontent');
                            const tabLinks = document.querySelectorAll('.cctablinks');
                            
                            tabContents.forEach(content => content.style.display = 'none');
                            tabLinks.forEach(link => link.classList.remove('active'));
                            
                            let tabToActivate = '';
                            
                            if (stage == 1) {
                                tabToActivate = 'CCForm1'; 
                            } else if (stage == 2) {
                                tabToActivate = 'CCForm11'; 
                            }  else if (stage == 3) {
                                tabToActivate = 'CCForm12'; 
                            } else if (stage == 4) {
                                tabToActivate = 'CCForm15'; 
                            } else if (stage == 5) {
                                tabToActivate = 'CCForm18'; 
                            } else if (stage == 6) {
                                tabToActivate = 'CCForm13'; 
                            } else if (stage == 7) {
                                tabToActivate = 'CCForm14'; 
                            } else if (stage == 8){
                                tabToActivate = 'CCForm5';
                            } else if (stage == 9){
                                tabToActivate = 'CCForm6';
                            }
                            
                            if (tabToActivate) {
                                const tabContent = document.getElementById(tabToActivate);
                                const tabLink = document.querySelector(`.cctablinks[onclick*="${tabToActivate}"]`);
                                
                                if (tabContent) tabContent.style.display = 'block';
                                if (tabLink) tabLink.classList.add('active');
                            }
                        }

                        function openCity(evt, cityName) {
                            const tabContents = document.querySelectorAll('.cctabcontent');
                            tabContents.forEach(content => content.style.display = 'none');
                            
                            const tabLinks = document.querySelectorAll('.cctablinks');
                            tabLinks.forEach(link => link.classList.remove('active'));
                            
                            document.getElementById(cityName).style.display = 'block';
                            evt.currentTarget.classList.add('active');
                            
                            currentStep = Array.from(tabLinks).findIndex(button => button === evt.currentTarget);
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            const currentStage = <?php echo json_encode($data->stage ?? 1); ?>;
                            
                            activateTabBasedOnStage(currentStage);
                        });
                    </script>

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
                                                    Assigned To <span
                                                    class="text-danger">*</span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"{{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : ''}} required>
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $value)
                                                        <option {{ $data->assign_to == $value->name ? 'selected' : '' }}
                                                            value="{{ $value->name }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                      
                                    
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule Start Date">Due Date<span
                                        class="text-danger">*</span></label>
                                        {{-- <div><small class="text-primary">If revising Due Date, kindly mention revision
                                            reason in "Due Date Extension Justification" data field.</small></div> --}}
                                         <div class="calenderauditee">
                                            <input type="text"  id="due_dateq"  readonly placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}/>
                                            <input type="date" id="due_dateq" name="due_date"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"{{ $data->stage !=1 ? 'readonly' : '' }} value="{{ $data->due_date }}" class="hide-input"
                                            oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')" required/>
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

                                    

                                        {{-- <div class="col-lg-6">
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
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator"><b>Initiator Department</b></label>
                                                <input readonly type="text" name="initiator_Group" id="initiator_group" 
                                                    value="{{ $data->initiator_Group }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiation Group Code">Initiator Department Code</label>
                                                <input type="text" name="initiator_group_code"
                                                    value="{{ $data->initiator_group_code }}" id="initiator_group_code"
                                                    readonly>
                                            </div>
                                        </div>
                                    
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span id="rchars">255</span>
                                                characters remaining

                                                <input name="short_description"   id="docname" type="text" value="{{ $data->short_description }}"    maxlength="255" required  {{$lockdatafileds1 ? "readonly" : "" }} type="text">
                                            </div>
                                            {{-- <p id="docnameError" style="color:red">**Short Description is required</p> --}}

                                        </div>



                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through<span
                                                class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please select related information</small></div>
                                                <select name="initiated_through"{{ $lockdatafileds1 ? 'disabled' : '' }}
                                                    onchange="otherController(this.value, 'others', 'initiated_through_req')" required>
                                                    <option value="">Enter Your Selection Here</option><option @if ($data->initiated_through == 'Internal Audit') selected @endif value="Internal Audit">Internal Audit</option>
                                                    <option @if ($data->initiated_through == 'External Audit') selected @endif value="External Audit">External Audit</option>
                                                    <option @if ($data->initiated_through == 'Recall') selected @endif value="Recall">Recall</option>
                                                    <option @if ($data->initiated_through == 'Return') selected @endif value="Return">Return</option>
                                                    <option @if ($data->initiated_through == 'Deviation') selected @endif value="Deviation">Deviation</option>
                                                    <option @if ($data->initiated_through == 'Complaint') selected @endif value="Complaint">Complaint</option>
                                                    <option @if ($data->initiated_through == 'Regulatory Inspection') selected @endif value="Regulatory Inspection">Regulatory Inspection</option>
                                                    <option @if ($data->initiated_through == 'Lab Incident') selected @endif value="Lab Incident">Lab Incident</option>
                                                    <option @if ($data->initiated_through == 'Improvement') selected @endif value="Improvement">Improvement</option>
                                                    <option @if ($data->initiated_through == 'Process/Product') selected @endif value="Process/Product">Process/Product</option>
                                                    <option @if ($data->initiated_through == 'Supplier') selected @endif value="Supplier">Supplier</option>
                                                    <option @if ($data->initiated_through == 'GMP Investigation') selected @endif value="GMP Investigation">GMP Investigation</option>
                                                    <option @if ($data->initiated_through == 'Discrepancy/NC') selected @endif value="Discrepancy/NC">Discrepancy/NC</option>
                                                    <option @if ($data->initiated_through == 'Change Control') selected @endif value="Change Control">Change Control</option>
                                                    <option @if ($data->initiated_through == 'Utility/Equipment/System') selected @endif value="Utility/Equipment/System">Utility/Equipment/System</option>
                                                    <option @if ($data->initiated_through == 'OOS') selected @endif value="OOS">OOS</option>
                                                    <option @if ($data->initiated_through == 'Product Failure') selected @endif value="Product Failure">Product Failure</option>
                                                    <option @if ($data->initiated_through == 'APQR') selected @endif value="APQR">APQR</option>

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
                                                <label for="repeat">Repeat<span class="text-danger {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 ? 'd-none' : ''}}">*</span></label>
                                                <div><small class="text-primary">Please select yes if it is has recurred in past six months</small></div>
                                                <select name="repeat"{{ $lockdatafileds1 ? 'disabled' : '' }}
                                                    onchange="otherController(this.value, 'Yes', 'repeat_nature')" required>
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
                                                <textarea name="repeat_nature"{{ $lockdatafileds1 ? 'readonly' : '' }}>{{ $data->repeat_nature }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Problem Description">Problem Description<span class="text-danger {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 ? 'd-none' : ''}}">*</span></label>
                                                <textarea name="problem_description"{{$lockdatafileds1 ? 'readonly' : '' }} required>{{ $data->problem_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="CAPA Team">CAPA Team<span class="text-danger {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 ? 'd-none' : ''}}">*</span></label>
                                                <select {{ $lockdatafileds1 ? 'disabled' : '' }}
                                                    multiple id="Audit" placeholder="Select..." name="capa_team[]" required>
                                                    @foreach ($users as $value)
                                                     {{-- <option {{ $data->capa_team == $value->id ? 'selected' : '' }}  value="{{ $value->id }}">{{ $value->name }}</option>  --}}
                                                        <option value="{{ $value->id }}"{{ in_array($value->id, explode(',', $data->capa_team)) ? 'selected' : '' }}>
                                                                   {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Reference Records</b></label>
                                                @if($data->parent_record_number)
                                                <input readonly type="text" name="parent_record_number"
                                                    value="{{ $data->parent_record_number }}" {{$lockdatafileds1 ? 'readonly' : '' }}>
                                                @else
                                                <input type="text" name="parent_record_number_edit"
                                                value="{{ $data->parent_record_number_edit }}" {{$lockdatafileds1 ? 'readonly' : '' }}>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Initial Observation">Initial Observation<span class="text-danger {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 ? 'd-none' : ''}}">*</span></label>
                                                <textarea name="initial_observation" {{ $data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }} required>{{ $data->initial_observation }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Interim Containnment">Interim Containment<span class="text-danger {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 ? 'd-none' : ''}}">*</span></label>
                                                <select name="interim_containnment"
                                                    onchange="otherController(this.value, 'required', 'containment_comments')"
                                                    {{ $data->stage == 0|| $data->stage == 2 ||$data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }} required>
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
                                                <label for="Details">Investigation Summary<span class="text-danger {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 ? 'd-none' : ''}}">*</span></label>
                                                {{-- <input type="text" name="investigation" value="{{ $data->investigation }}"> --}}
                                                <textarea name="investigation" {{ $lockdatafileds1 ? 'readonly' : '' }} required>{{ $data->investigation }}</textarea>
                                            </div>
                                            <div class="group-input">
                                                <label for="Details">Root Cause<span class="text-danger {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 ? 'd-none' : ''}}">*</span></label>
                                                <textarea name="rcadetails" {{ $lockdatafileds1 ? 'readonly' : '' }} required>{{ $data->rcadetails }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Material Details">
                                                    Product / Material Details
                                                    <button type="button" name="ann" id="material"   {{ $lockdatafileds1 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="productmaterial">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40px">Sr. No</th>
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
                                                                            value="{{ $key + 1 }}" {{ $lockdatafileds1 ? 'readonly' : '' }}></td>
                                                                    <td><input type="text" name="material_name[]"
                                                                            value="{{ $material_name }}"
                                                                            {{ $lockdatafileds1 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td><input type="text" name="material_batch_no[]"
                                                                            value="{{ unserialize($data2->material_batch_no)[$key] ?? '' }}"
                                                                            {{ $lockdatafileds1 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td><input type="text" name="material_mfg_date[]"
                                                                            class="material_mfg_date"
                                                                            placeholder="DD-MMM-YYYY"
                                                                            value="{{ unserialize($data2->material_mfg_date)[$key] ?? '' }}"
                                                                            {{ $lockdatafileds1  ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="material_expiry_date[]"
                                                                            class="material_expiry_date"
                                                                            placeholder="DD-MMM-YYYY"
                                                                            value="{{ unserialize($data2->material_expiry_date)[$key] ?? '' }}"
                                                                            {{ $lockdatafileds1 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="material_batch_desposition[]"
                                                                            value="{{ unserialize($data2->material_batch_desposition)[$key] ?? '' }}"
                                                                            {{ $lockdatafileds1 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    <td><input type="text" name="material_remark[]"
                                                                            value="{{ unserialize($data2->material_remark)[$key] ?? '' }}"
                                                                            {{ $lockdatafileds1 ? 'readonly' : '' }}>
                                                                    </td>
                                                                    {{-- <td>
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
                                                                    </td> --}}
                                                                    <td>
                                                                        <select name="material_batch_status[]"
                                                                            class="batch_status"
                                                                            {{ $lockdatafileds1 ? 'disabled ' : '' }}>
                                                                            <option value="">-- Select value --
                                                                            </option>
                                                                            <option value="Hold"
                                                                                {{ (unserialize($data2->material_batch_status)[$key] ?? '') == 'Hold' ? 'selected' : '' }}>
                                                                                Hold</option>
                                                                            <option value="Release"
                                                                                {{ (unserialize($data2->material_batch_status)[$key] ?? '') == 'Release' ? 'selected' : '' }}>
                                                                                Release</option>
                                                                            <option value="quarantine"
                                                                                {{ (unserialize($data2->material_batch_status)[$key] ?? '') == 'quarantine' ? 'selected' : '' }}>
                                                                                Quarantine</option>
                                                                        </select>
                                                                    </td>

                                                                    <td><button type="button" class="removeRowBtn"
                                                                        {{$lockdatafileds1 ? 'disabled' : '' }} >Remove</button>
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
                                                                // Format the date correctly when closed
                                                                const dateObj = $(this).datepicker('getDate');
                                                                $(this).val($.datepicker.formatDate('dd-M-yy', dateObj));
                                                            } else {
                                                                $(this).val(''); // Clear the input if no date is selected
                                                                $(this).attr('placeholder', 'DD-MMM-YYYY'); // Reset the placeholder
                                                            }
                                                        },
                                                        beforeShow: function() {
                                                            $(this).attr('readonly', 'readonly'); // Prevent text input while opening the datepicker
                                                        }
                                                    });

                                                    // Prevent manual text entry
                                                    $('.material_mfg_date, .material_expiry_date').on('keypress', function(e) {
                                                        e.preventDefault(); // Disable text input
                                                    });

                                                    // Optional: To clear the field when clicking outside
                                                    $(document).on('click', function(event) {
                                                        if (!$(event.target).closest('.material_mfg_date, .material_expiry_date').length) {
                                                            $(this).val(''); // Clear input if not clicked
                                                        }
                                                    });
                                                }

                                                // Call the function to initialize the datepicker
                                                $(document).ready(function() {
                                                    initializeDatepicker();
                                                });


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
                                                    {{ $lockdatafileds1 ? 'disabled' : '' }} >+</button>
                                                </label>
                                                <table class="table table-bordered" id="equi_details">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40px">Sr. No.</th>
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
                                                                    <input type="text" name="serial_number[]" {{  $lockdatafileds1 ? 'readonly' : '' }}
                                                                           value="{{ $key + 1 }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment[]" {{  $lockdatafileds1 ? 'readonly' : '' }}
                                                                           value="{{ unserialize($data3->equipment)[$key] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment_instruments[]"{{  $lockdatafileds1 ? 'readonly' : '' }}
                                                                           value="{{ unserialize($data3->equipment_instruments)[$key] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="equipment_comments[]" {{  $lockdatafileds1 ? 'readonly' : '' }}
                                                                           value="{{ unserialize($data3->equipment_comments)[$key] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="removeRowBtn" {{  $lockdatafileds1? 'disabled' : '' }}>Remove</button>
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
                                                <label for="Details">Details<span class="text-danger {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 || $data->stage == 8 || $data->stage == 9 ? 'd-none' : ''}}">*</span></label>    
                                                    <textarea name="details_new" {{ $lockdatafileds1 ? 'readonly' : '' }} required>{{ $data->details_new }}</textarea>

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
                                                    CAPA Type<span class="text-danger">*</span>
                                                </label>
                                                <select id="capa_type" placeholder="Select..." name="capa_type" {{ $lockdatafileds1 ? 'disabled' : ''}} required>
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
                                        <div class="col-12 corrective-action-field">
                                            <div class="group-input">
                                                <label for="Corrective Action">Corrective Action <span class="required-star">*</span></label>
                                                <textarea name="corrective_action" {{ $lockdatafileds1 ? 'readonly' : '' }}>{{ $data->corrective_action }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 preventive-action-field">
                                            <div class="group-input">
                                                <label for="Preventive Action">Preventive Action<span class="required-star">*</span></label>
                                                <textarea name="preventive_action" {{$lockdatafileds1 ? 'readonly' : '' }}>{{ $data->preventive_action }}</textarea>
                                            </div>
                                        </div>

                                        {{-- <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                let capaTypeSelect = document.getElementById("capa_type");
                                                let correctiveActionField = document.querySelector(".corrective-action-field");
                                                let preventiveActionField = document.querySelector(".preventive-action-field");

                                                function toggleFields(selectedValue) {
                                                    if (selectedValue === "Corrective Action") {
                                                        correctiveActionField.style.display = "block";
                                                        preventiveActionField.style.display = "none";
                                                    } else if (selectedValue === "Preventive Action") {
                                                        correctiveActionField.style.display = "none";
                                                        preventiveActionField.style.display = "block";
                                                    } else if (selectedValue === "Corrective & Preventive Action") {
                                                        correctiveActionField.style.display = "block";
                                                        preventiveActionField.style.display = "block";
                                                    } else {
                                                        correctiveActionField.style.display = "none";
                                                        preventiveActionField.style.display = "none";
                                                    }
                                                }

                                                // Initialize fields based on the selected option on page load
                                                toggleFields(capaTypeSelect.value);

                                                // Listen for changes to update visibility dynamically
                                                capaTypeSelect.addEventListener("change", function () {
                                                    toggleFields(this.value);
                                                });
                                            });
                                        </script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let capaTypeSelect = document.getElementById("capa_type");
        let correctiveActionField = document.querySelector(".corrective-action-field");
        let preventiveActionField = document.querySelector(".preventive-action-field");

        function toggleFields(selectedValue) {
            // Hide all fields initially
            correctiveActionField.style.display = "none";
            preventiveActionField.style.display = "none";

            // Remove text-danger from all asterisks
            document.querySelectorAll(".required-star").forEach(star => {
                star.classList.remove("text-danger");
            });

            // Show fields and add text-danger to * if they are selected
            if (selectedValue === "Corrective Action") {
                correctiveActionField.style.display = "block";
                correctiveActionField.querySelector(".required-star").classList.add("text-danger");
            } else if (selectedValue === "Preventive Action") {
                preventiveActionField.style.display = "block";
                preventiveActionField.querySelector(".required-star").classList.add("text-danger");
            } else if (selectedValue === "Corrective & Preventive Action") {
                correctiveActionField.style.display = "block";
                preventiveActionField.style.display = "block";
                correctiveActionField.querySelector(".required-star").classList.add("text-danger");
                preventiveActionField.querySelector(".required-star").classList.add("text-danger");
            }
        }

        // Initialize fields based on the selected option on page load
        toggleFields(capaTypeSelect.value);

        // Listen for changes to update visibility dynamically
        capaTypeSelect.addEventListener("change", function () {
            toggleFields(this.value);
        });
    });
</script>


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
                                                            oninput="addMultipleFiles(this, 'capafileattachement')" multiple {{$lockdatafileds1 ? 'disabled' : '' }}>
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
                    <textarea name="hod_remarks"  @if ($lockdatafileds2)
                                                        style="pointer-events: none; background-color: #e9ecef;"
                                                    @endif >{{ $data->hod_remarks}}</textarea>
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
                                oninput="addMultipleFiles(this, 'hod_attachment')" multiple {{ $lockdatafileds2 ? 'disabled' : '' }}>
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
                    <label for="Comments"> QA/CQA Review Comment  @if($data->stage == 3)<span class="text-danger">*</span>@endif</label>
                    <textarea name="capa_qa_comments"  @if ($lockdatafileds3)
                                                        style="pointer-events: none; background-color: #e9ecef;"
                                                    @endif>{{ $data->capa_qa_comments }}</textarea>
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
                                oninput="addMultipleFiles(this, 'qa_attachment')" multiple {{ $lockdatafileds3 ? 'disabled' : '' }}>
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
                                                <label for="Interim Containnment">Effectiveness check required<span
                                                class="text-danger">*</span></label>
                                                <select name="effectivness_check" @if ($lockdatafileds8)
                                                        style="pointer-events: none; background-color: #e9ecef;"
                                                    @endif>
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
                                                <textarea name="qa_review" {{ $lockdatafileds8 ? 'readonly' : '' }}>{{ $data->qa_review }}</textarea>
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
                                                            type="file" id="myfile" name="closure_attachment[]" {{ $lockdatafileds8 ? 'disabled' : '' }}
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
                                        {{-- <div class="col-12 sub-head">
                                            Extension Justification
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="due_date_extension">Due Date Extension Justification</label>
                                                <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                                <textarea name="due_date_extension"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->due_date_extension }}</textarea>
                                            </div>
                                        </div>
                                    </div> --}}
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
                    <textarea name="hod_final_review"@if ($lockdatafileds6)
                                                        style="pointer-events: none; background-color: #e9ecef;"
                                                    @endif >{{ $data->hod_final_review }}</textarea>
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
                                                        {{ $data->stage == 0|| $data->stage == 1 || $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'readonly' : '' }}
                                                            type="file" id="myfile" name="hod_final_attachment[]" {{ $data->stage == 0|| $data->stage == 1 || $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 7|| $data->stage == 8|| $data->stage == 9 ? 'disabled' : '' }}
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
                    <textarea name="initiator_comment" @if ($lockdatafileds5)
                                                        style="pointer-events: none; background-color: #e9ecef;"
                                                    @endif>{{ $data->initiator_comment }}</textarea>
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
                                oninput="addMultipleFiles(this, 'initiator_capa_attachment')" multiple {{ $lockdatafileds5 ? 'disabled' : '' }}>
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
                    <textarea name="qa_cqa_qa_comments" {{ $lockdatafileds7 ? 'readonly' : '' }}>{{ $data->qa_cqa_qa_comments }}</textarea>
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
                                oninput="addMultipleFiles(this, 'qa_closure_attachment')" multiple {{ $lockdatafileds7 ? 'disabled' : '' }}>
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
                    <textarea name="qah_cq_comments"  @if ($lockdatafileds4)
                                                        style="pointer-events: none; background-color: #e9ecef;"
                                                    @endif   >{{ $data->qah_cq_comments }}</textarea>
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
                                                        {{ $lockdatafileds4 ? 'disabled' : '' }}
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
                                         <div class="col-12">
                                            <div class="sub-head">Submit</div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Proposed By">Propose Plan By</label>
                                                <input type="hidden" name="plan_proposed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_proposed_by ? $data->plan_proposed_by :" Not Applicable"}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Propose Plan  On">Propose Plan On</label>
                                                <input type="hidden" name="plan_proposed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->plan_proposed_on ?  $data->plan_proposed_on:" Not Applicable" }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Propose Plan Comment</label>
                                                <input type="hidden" name="comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->comment ? $data->comment:" Not Applicable" }}</div>
                                            </div>
                                        </div>
                                         <div class="col-12">
                                            <div class="sub-head">Cancel</div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancel By</label>
                                                <input type="hidden" name="cancelled_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_by ? $data->cancelled_by:" Not Applicable" }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancel On</label>
                                                <input type="hidden" name="cancelled_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancelled_on  ? $data->cancelled_on:" Not Applicable"}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Cancel Comment</label>
                                                <input type="hidden" name="cancel_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->cancel_comment ?$data->cancel_comment :" Not Applicable" }} </div>
                                            </div>
                                        </div>

                                         <div class="col-12">
                                            <div class="sub-head">HOD Review</div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">HOD Review Complete By</label>
                                                <input type="hidden" name="hod_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_review_completed_by ?  $data->hod_review_completed_by:" Not Applicable"}}</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved On">HOD Review Complete On</label>
                                                <input type="hidden" name="hod_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_review_completed_on ?  $data->hod_review_completed_on:" Not Applicable" }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">HOD Review Complete Comment</label>
                                                <input type="hidden" name="hod_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_comment ? $data->hod_comment :" Not Applicable" }}</div>
                                            </div>
                                        </div>
                                     {{-- 
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required By"> More Info Required
                                                    By</label>
                                                <input type="hidden" name="more_info_required_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->more_info_required_by }}</div>
                                            </div>
                                        </div>
                                     <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA More Info Required On">More Info Required
                                                    On</label>
                                                <input type="hidden" name="more_info_required_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->more_info_required_on }}</div>
                                            </div>
                                        </div>
                                     <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="hod_comment1"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_comment1 }}</div>
                                            </div>
                                        </div>--}}


                                         <div class="col-12">
                                            <div class="sub-head">QA/CQA Review</div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Completed By">QA/CQA Review Complete By</label>
                                                <input type="hidden" name="qa_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_review_completed_by ? $data->qa_review_completed_by :" Not Applicable"}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Completed On">QA/CQA Review Complete On</label>
                                                <input type="hidden" name="qa_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_review_completed_on ? $data->qa_review_completed_on :" Not Applicable " }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">QA/CQA Review Complete Comment</label>
                                                <input type="hidden" name="qa_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_comment ? $data->qa_comment :" Not Applicable"}}</div>
                                            </div>
                                        </div>
                                        {{--<div class="col-lg-4">
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
                                        </div> 
                                         <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="qa_commenta"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->qa_commenta }}</div>
                                            </div>
                                        </div> --}}


                                         <div class="col-12">
                                            <div class="sub-head">QA/CQA Approval</div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Approved By">Approved By</label>
                                                <input type="hidden" name="approved_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>

                                                <div class="static">{{ $data->approved_by ? $data->approved_by :" Not Applicable" }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Approved On">Approved On</label>
                                                <input type="hidden" name="approved_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->approved_on ?  $data->approved_on:" Not Applicable"}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Approved Comment</label>
                                                <input type="hidden" name="approved_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->approved_comment ? $data->approved_comment :" Not Applicable"}}</div>
                                            </div>
                                        </div>
                                {{--
                                   <div class="col-lg-4">
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
                                        </div> 
                                       <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Comment</label>
                                                <input type="hidden" name="app_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->app_comment }}</div>
                                            </div>
                                        </div> 
                                        --}}
                                         <div class="col-12">
                                            <div class="sub-head">Complete</div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Rejected By">Complete By</label>
                                                <input type="hidden" name="completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->completed_by ?  $data->completed_by:" Not Applicable" }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Rejected On">Complete On</label>
                                                <input type="hidden" name="completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->completed_on ?  $data->completed_on:" Not Applicable" }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Complete Comment</label>
                                                <input type="hidden" name="com_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->com_comment ? $data->com_comment:" Not Applicable"}}</div>
                                            </div>
                                        </div>
                                         <div class="col-12">
                                            <div class="sub-head">HOD Final Review</div>
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
                                                <label for="Rejected By">HOD Final Review Complete By</label>
                                                <input type="hidden" name="hod_final_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="static">{{ $data->hod_final_review_completed_by  ? $data->hod_final_review_completed_by :" Not Applicable"}}</div>
                                            </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Rejected By">HOD Final Review Complete On</label>
                                            <input type="hidden" name="hod_final_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                            <div class="static">{{ $data->hod_final_review_completed_on ? $data->hod_final_review_completed_on:" Not Applicable"}}</div>
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Plan Approved By">HOD Final Review Complete Comment</label>
                                        <input type="hidden" name="final_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                        <div class="static">{{ $data->final_comment ? $data->final_comment :" Not Applicable"}}</div>
                                    </div>
                                </div>
                               {{--  <div class="col-lg-4">
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
                                </div> 
                                 <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Plan Approved By">Comment</label>
                                        <input type="hidden" name="final_hod_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                        <div class="static">{{ $data->final_hod_comment }}</div>
                                    </div>
                                </div> 
                                --}}

                                 <div class="col-12">
                                            <div class="sub-head">QA/CQA Closure Review</div>
                                </div> 
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Rejected By">QA/CQA Closure Review Complete By</label>
                                        <input type="hidden" name="qa_closure_review_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                        <div class="static">{{ $data->qa_closure_review_completed_by ? $data->qa_closure_review_completed_by :" Not Applicable" }}</div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected By">QA/CQA Closure Review Complete On</label>
                                    <input type="hidden" name="qa_closure_review_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->qa_closure_review_completed_on ? $data->qa_closure_review_completed_on :" Not Applicable"}}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Approved By">QA/CQA Closure Review Complete Comment</label>
                                    <input type="hidden" name="qa_closure_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->qa_closure_comment ? $data->qa_closure_comment :" Not Applicable"}}</div>
                                </div>
                            </div>

                            {{--
                            <div class="col-lg-4">
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
                            </div> 
                            --}}
                             <div class="col-12">
                                            <div class="sub-head">QAH/CQAH Approval</div>
                            </div> 
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected By">QAH/CQA Head Approval Complete By</label>
                                    <input type="hidden" name="qah_approval_completed_by"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                    <div class="static">{{ $data->qah_approval_completed_by ?  $data->qah_approval_completed_by:" Not Applicable"}}</div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Rejected By">QAH/CQA Head Approval Complete On</label>
                                <input type="hidden" name="qah_approval_completed_on"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                <div class="static">{{ $data->qah_approval_completed_on ?  $data->qah_approval_completed_on:" Not Applicable"}}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Plan Approved By">QAH/CQA Head Approval Complete Comment</label>
                                <input type="hidden" name="qah_comment"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                <div class="static">{{ $data->qah_comment ?  $data->qah_comment:" Not Applicable"}}</div>
                            </div>
                        </div>
                        
                        {{--<div class="col-lg-4">
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
                        </div> 
                        --}}

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
                        <form action="{{ route('capa_send_stage', $data->id) }}" method="POST" id="signatureModalForm">
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
                              <!-- <button type="submit">Submit</button> -->
                               <button type="submit" class="signatureModalButton">
                                    <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Submit
                                </button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

             <script>
            
        document.addEventListener('DOMContentLoaded', function() {
            var signatureForm = document.getElementById('signatureModalForm');

            signatureForm.addEventListener('submit', function(e) {

                var submitButton = signatureForm.querySelector('.signatureModalButton');
                var spinner = signatureForm.querySelector('.signatureModalSpinner');

                submitButton.disabled = true;

                spinner.style.display = 'inline-block';
            });
        });

    </script>
            <div class="modal fade" id="modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('capa_qa_more_info', $data->id) }}" method="POST" id="signatureModalForm2">
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
                              <!-- <button type="submit">Submit</button> -->
                               <button type="submit" class="signatureModalButton">
                                    <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Submit
                                </button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                    
                document.addEventListener('DOMContentLoaded', function() {
                    var signatureForm = document.getElementById('signatureModalForm2');

                    signatureForm.addEventListener('submit', function(e) {

                        var submitButton = signatureForm.querySelector('.signatureModalButton');
                        var spinner = signatureForm.querySelector('.signatureModalSpinner');

                        submitButton.disabled = true;

                        spinner.style.display = 'inline-block';
                    });
                });

            </script>

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



