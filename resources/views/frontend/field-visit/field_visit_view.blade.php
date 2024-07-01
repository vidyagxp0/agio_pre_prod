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
            / W FIELD VISIT SURVEY
        </div>
    </div>

    <style>
        .progress-bars div {
            flex: 1 1 auto;
            border: 1px solid grey;
            padding: 5px;
            text-align: center;
            position: relative;
            /* border-right: none; */
            background: white;
        }

        .state-block {
            padding: 20px;
            margin-bottom: 20px;
        }

        .progress-bars div.active {
            background: green;
            font-weight: bold;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(3) {
            border-radius: 0px 20px 20px 0px;

        }
    </style>

    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>
                    @php
                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_code])->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp
                    <div class="d-flex" style="gap:20px;">
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('rcms/audit_trailNew' , $data->id) }}"> Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Submit
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                            Cancel
                        </button>

                        @elseif($data->stage == 2 && (in_array(10, $userRoleIds) || in_array(18, $userRoleIds) || in_array(13, $userRoleIds)))
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Review Completed
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Info Required
                        </button>
                        @endif
                         <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"><button class="button_theme1"> Exit
                        </button>  </a>
                    </div>
                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By nilesh-------------------------------- --}}
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif
                            @if ($data->stage >= 2)
                                <div class="active">Pending Review</div>
                            @else
                                <div class="">Pending Review</div>
                            @endif
                            @if ($data->stage >= 3)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                        </div>
                    @endif
                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>


            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">AMBIENCE</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">STAFF OBSERVATION</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">CFT</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">SALE / MARKETING STRATEGY</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">PRODUCT OBSERVATION </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">VM & SPACE MANAGEMENT</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">BRANDING</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">TRIAL ROOMS</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">ACTIVITY LOG</button>
            </div>

            <form action="{{ route('field_visit_update',$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div id="step-form">
                    {{-- @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif --}}
                    <!-- -----------Tab-1------------ -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Parent Record Information</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Record Number</label>
                                        <input disabled type="text" name="record">
                                        {{-- value="{{ Helpers::getDivisionName(session()->get('division')) }}/CAPA/{{ date('Y') }}/{{ $record_number }}"> --}}
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Site/Location Code</label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator">Initiator</label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="initiator" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date">Date</label>
                                        <input type="text" value="{{ date('d-M-Y') }}" name="date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="date">
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Time">Time</label>
                                        <input type="time" value="{{ $data->time }}" name="time">
                                        {{-- <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date"> --}}
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Brand Name">
                                            Brand Name<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="brand_name">
                                            <option value="">Select a value</option>
                                            <option value="W "{{ $data->brand_name == 'W' ? 'selected' : '' }}>W</option>
                                            <option value="AURELIA "{{ $data->brand_name == 'AURELIA' ? 'selected' : '' }}>AURELIA</option>
                                            <option value="JAYPORE "{{ $data->brand_name == 'JAYPORE' ? 'selected' : '' }}>JAYPORE</option>
                                            <option value="GLOBAL DESI "{{ $data->brand_name == 'GLOBAL DESI' ? 'selected' : '' }}>GLOBAL DESI</option>
                                            <option value="FAB INDIA "{{ $data->brand_name == 'FAB INDIA' ? 'selected' : '' }}>FAB INDIA</option>
                                            <option value="BIBA "{{ $data->brand_name == 'BIBA' ? 'selected' : '' }}>BIBA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="NAME OF FIELD VISITOR">
                                            NAME OF FIELD VISITOR<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="field_visitor">
                                            <option value="">Select a value</option>
                                            <option value="CHAITANYA "{{ $data->field_visitor == 'CHAITANYA' ? 'selected' : '' }}>CHAITANYA</option>
                                            <option value="REKHA "{{ $data->field_visitor == 'REKHA' ? 'selected' : '' }}>REKHA</option>
                                            <option value="SACHIN "{{ $data->field_visitor == 'SACHIN' ? 'selected' : '' }}>SACHIN</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="REGION">
                                            REGION<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="region">
                                            <option value="">Select a value</option>
                                            <option value="EXTENSION OF SOUTH MUMBAI - PRABHADEVI TO MAHIM "{{ $data->region == 'EXTENSION OF SOUTH MUMBAI - PRABHADEVI TO MAHIM' ? 'selected' : '' }}>EXTENSION OF SOUTH MUMBAI - PRABHADEVI TO MAHIM</option>
                                            <option value="WESTERN SUBURBS (A) -BANDRA TO SANTACRUZ "{{ $data->region == 'WESTERN SUBURBS (A) -BANDRA TO SANTACRUZ' ? 'selected' : '' }}>WESTERN SUBURBS (A) -BANDRA TO SANTACRUZ</option>
                                            <option value="WESTERN SUBURBS (B)- VILLE PARLE TO ANDHERI "{{ $data->region == 'WESTERN SUBURBS (B)- VILLE PARLE TO ANDHERI' ? 'selected' : '' }}>WESTERN SUBURBS (B)- VILLE PARLE TO ANDHERI</option>
                                            <option value="WESTERN SUBURBS (C) - JOGESHWARI TO GOREGOAN "{{ $data->region == 'WESTERN SUBURBS (C) - JOGESHWARI TO GOREGOAN' ? 'selected' : '' }}>WESTERN SUBURBS (C) - JOGESHWARI TO GOREGOAN</option>
                                            <option value="WESTERN SUBURBS (D) - MALAD TO BORIVALI "{{ $data->region == 'WESTERN SUBURBS (D) - MALAD TO BORIVALI' ? 'selected' : '' }}>WESTERN SUBURBS (D) - MALAD TO BORIVALI</option>
                                            <option value="NORTH MUMBAI - BEYOND BORIVALI UP TO VIRAR "{{ $data->region == 'NORTH MUMBAI - BEYOND BORIVALI UP TO VIRAR' ? 'selected' : '' }}>NORTH MUMBAI - BEYOND BORIVALI UP TO VIRAR</option>
                                            <option value="EASTERN SUBURBS - CENTRAL MUMBAI "{{ $data->region == 'EASTERN SUBURBS - CENTRAL MUMBAI' ? 'selected' : '' }}>EASTERN SUBURBS - CENTRAL MUMBAI</option>
                                            <option value="HARBOUR SUBURBS - NAVI MUMBAI "{{ $data->region == 'HARBOUR SUBURBS - NAVI MUMBAI' ? 'selected' : '' }}>HARBOUR SUBURBS - NAVI MUMBAI
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="EXACT LOCATION">
                                            EXACT LOCATION<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="exact_location">
                                            <option value="">Select a value</option>
                                            <option value="CHURCHGATE "{{ $data->exact_location == 'CHURCHGATE' ? 'selected' : '' }}>CHURCHGATE</option>
                                            <option value="MARINE LINES "{{ $data->exact_location == 'MARINE LINES' ? 'selected' : '' }}>MARINE LINES</option>
                                            <option value="CHARNI ROAD "{{ $data->exact_location == 'CHARNI ROAD' ? 'selected' : '' }}>CHARNI ROAD</option>
                                            <option value="GRANT ROAD "{{ $data->exact_location == 'GRANT ROAD' ? 'selected' : '' }}>GRANT ROAD</option>
                                            <option value="MUMBAI CENTRAL "{{ $data->exact_location == 'MUMBAI CENTRAL' ? 'selected' : '' }}>MUMBAI CENTRAL</option>
                                            <option value="WORLI "{{ $data->exact_location == 'WORLI' ? 'selected' : '' }}>WORLI</option>
                                            <option value="LOWER PAREL "{{ $data->exact_location == 'LOWER PAREL' ? 'selected' : '' }}>LOWER PAREL</option>
                                            <option value="DADAR "{{ $data->exact_location == 'DADAR' ? 'selected' : '' }}>DADAR</option>
                                            <option value="BANDRA "{{ $data->exact_location == 'BANDRA' ? 'selected' : '' }}>BANDRA</option>
                                            <option value="SANTACRUZ "{{ $data->exact_location == 'SANTACRUZ' ? 'selected' : '' }}>SANTACRUZ</option>
                                            <option value="KHAR "{{ $data->exact_location == 'KHAR' ? 'selected' : '' }}>KHAR</option>
                                            <option value="VILE PARLE "{{ $data->exact_location == 'VILE PARLE' ? 'selected' : '' }}>VILE PARLE</option>
                                            <option value="ANDHERI "{{ $data->exact_location == 'ANDHERI' ? 'selected' : '' }}>ANDHERI</option>
                                            <option value="GOREGOAN "{{ $data->exact_location == 'GOREGOAN' ? 'selected' : '' }}>GOREGOAN</option>
                                            <option value="MALAD "{{ $data->exact_location == 'MALAD' ? 'selected' : '' }}>MALAD</option>
                                            <option value="KANDIVALI "{{ $data->exact_location == 'KANDIVALI' ? 'selected' : '' }}>KANDIVALI</option>
                                            <option value="BORIVALI "{{ $data->exact_location == 'BORIVALI' ? 'selected' : '' }}>BORIVALI</option>
                                            <option value="BHAYANDER "{{ $data->exact_location == 'BHAYANDER' ? 'selected' : '' }}>BHAYANDER</option>
                                            <option value="SEAWOODS "{{ $data->exact_location == 'SEAWOODS' ? 'selected' : '' }}>SEAWOODS</option>
                                            <option value="VASHI "{{ $data->exact_location == 'VASHI' ? 'selected' : '' }}>VASHI</option>
                                            <option value="GHATKOPAR "{{ $data->exact_location == 'GHATKOPAR' ? 'selected' : '' }}>GHATKOPAR</option>
                                            <option value="THANE "{{ $data->exact_location == 'THANE' ? 'selected' : '' }}>THANE</option>
                                            <option value="KALYAN "{{ $data->exact_location == 'KALYAN' ? 'selected' : '' }}>KALYAN</option>
                                            <option value="Other "{{ $data->exact_location == 'Other' ? 'selected' : '' }}>Other</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="group-input">
                                    <label class="mt-4" for="EXACT STORE ADDRESS">EXACT STORE ADDRESS</label>
                                    <textarea class="summernote" name="exact_address" id="summernote-16">{{ $data->exact_address }}</textarea>
                                </div>
                            </div>


                            {{-- <div class="group-input">
                                <label class="mt-4" for="EXACT STORE ADDRESS">EXACT STORE ADDRESS</label>
                                <textarea class="summernote" name="QA_Feedbacks" id="summernote-16"></textarea>
                            </div>
                        </div> --}}


                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                {{-- <div class="col-12"> --}}
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- -----------Tab-2------------ -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">


                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="PAGE SECTION">
                                                PAGE SECTION <span class="text-danger"></span>
                                            </label>
                                            <select id="select-state" placeholder="Select..." name="page_section">
                                                <option value="">Select a value</option>
                                                <option value="AMBIENCE "{{ $data->page_section == 'AMBIENCE' ? 'selected' : '' }}>AMBIENCE</option>
                                                <option value="STAFF OBSERVATION "{{ $data->page_section == 'STAFF OBSERVATION' ? 'selected' : '' }}>STAFF OBSERVATION</option>
                                                <option value="SALE / MARKETING STRATEGY "{{ $data->page_section == 'SALE / MARKETING STRATEGY' ? 'selected' : '' }}>SALE / MARKETING STRATEGY</option>
                                                <option value="PRODUCT OBSERVATION "{{ $data->page_section == 'PRODUCT OBSERVATION' ? 'selected' : '' }}>PRODUCT OBSERVATION</option>
                                                <option value="VM & SPACE MANAGEMENT "{{ $data->page_section == 'VM & SPACE MANAGEMENT' ? 'selected' : '' }}>VM & SPACE MANAGEMENT</option>
                                                <option value="BRANDING "{{ $data->page_section == 'BRANDING' ? 'selected' : '' }}>BRANDING</option>
                                                <option value="TRIAL ROOMS "{{ $data->page_section == 'TRIAL ROOMS' ? 'selected' : '' }}>TRIAL ROOMS</option>

                                            </select>
                                        </div>
                                    </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA Attachment">PHOTOS (STORE FROM OUTSIDE, RACKS, WINDOW DISPLAY, OVERALL VM)
                                        </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="QA_Attachments" name="photos[]"
                                                    oninput="addMultipleFiles(this, 'QA_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            OVERALL STORE LIGHTING <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="store_lighting">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->store_lighting == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->store_lighting == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->store_lighting == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->store_lighting == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->store_lighting == '5' ? 'selected' : '' }}>5</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            LIGHTING ON PRODUCTS / BROWSER LIGHTING <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="lighting_products">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->lighting_products == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->lighting_products == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->lighting_products == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->lighting_products == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->lighting_products == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            OVERALL STORE VIBE <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="store_vibe">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->store_vibe == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->store_vibe == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->store_vibe == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->store_vibe == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->store_vibe == '5' ? 'selected' : '' }}>5</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            FRAGRANCE IN STORE <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="fragrance_in_store">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->fragrance_in_store == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->fragrance_in_store == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->fragrance_in_store == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->fragrance_in_store == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->fragrance_in_store == '5' ? 'selected' : '' }}>5</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            MUSIC INSIDE STORE? <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="music_inside_store">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->music_inside_store == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->music_inside_store == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->music_inside_store == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->music_inside_store == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->music_inside_store == '5' ? 'selected' : '' }}>5</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            SPACE UTILIZATION <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="space_utilization">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->space_utilization == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->space_utilization == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->space_utilization == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->space_utilization == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->space_utilization == '5' ? 'selected' : '' }}>5</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            STORE LAYOUT <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="store_layout">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->store_layout == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->store_layout == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->store_layout == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->store_layout == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->store_layout == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            THE STORE IS OF HOW MANY FLOORS? <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="floors">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->floors == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->floors == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->floors == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->floors == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->floors == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            AC & VENTILATION <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="ac">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->ac == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->ac == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->ac == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->ac == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->ac == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            MANNEQUIN DISPLAY <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="mannequin_display">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->mannequin_display == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->mannequin_display == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->mannequin_display == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->mannequin_display == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->mannequin_display == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            SEATING AREA (INSIDE STORE) <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="seating_area">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->seating_area == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->seating_area == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->seating_area == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->seating_area == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->seating_area == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            PRODUCT VISIBILITY <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="product_visiblity">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->product_visiblity == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->product_visiblity == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->product_visiblity == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->product_visiblity == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->product_visiblity == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            STORE SIGNAGE AND GRAPHICS <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="store_signage">
                                            <option value="">Select a value</option>
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->store_signage == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->store_signage == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->store_signage == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->store_signage == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->store_signage == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="OVERALL STORE LIGHTING">
                                            DOES THE STORE HAVE INDEPENDENT WASHROOM ? <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="independent_washroom">
                                            <option value="">Select a value</option>
                                            <option value="1 "{{ $data->independent_washroom == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->independent_washroom == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->independent_washroom == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->independent_washroom == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->independent_washroom == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="group-input">
                                    <label class="mt-4" for="ANY REMARKS">ANY REMARKS</label>
                                    <p class="text-primary">Mention the flooring, curtains used, if any specific wallpaper / artistic objects are used to enhance the store vibe. Describe how the articles are kept on basis of the store (For eg., Left wall has kurtis in colour blocking, right wall has bottoms in another colour blocking, centre has accessories, end has trial rooms, cash counter has upselling items etc etc etc). </p>
                                    <textarea class="summernote" name="any_remarks" id="summernote-16">{{ $data->any_remarks }}</textarea>
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






                <!-- -----------Tab-4------------ -->
                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PAGE SECTION <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="page_section1">
                                        <option value="">Select a value</option>
                                        <option value="AMBIENCE "{{ $data->page_section1 == 'AMBIENCE' ? 'selected' : '' }}>AMBIENCE</option>
                                        <option value="STAFF OBSERVATION "{{ $data->page_section1 == 'STAFF OBSERVATION' ? 'selected' : '' }}>STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY "{{ $data->page_section1 == 'SALE / MARKETING STRATEGY' ? 'selected' : '' }}>SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION "{{ $data->page_section1 == 'PRODUCT OBSERVATION' ? 'selected' : '' }}>PRODUCT OBSERVATION</option>
                                        <option value="VM & SPACE MANAGEMENT "{{ $data->page_section1 == 'VM & SPACE MANAGEMENT' ? 'selected' : '' }}>VM & SPACE MANAGEMENT</option>
                                        <option value="BRANDING "{{ $data->page_section1 == 'BRANDING' ? 'selected' : '' }}>BRANDING</option>
                                        <option value="TRIAL ROOMS "{{ $data->page_section1 == 'TRIAL ROOMS' ? 'selected' : '' }}>TRIAL ROOMS</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        STAFF BEHAVIOR ( INITIAL STAFF BEHAVIOUR) <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="staff_behaviour">
                                        <option value="">Select a value</option>
                                            <option value="1 "{{ $data->staff_behaviour == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->staff_behaviour == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->staff_behaviour == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->staff_behaviour == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5 "{{ $data->staff_behaviour == '5' ? 'selected' : '' }}>5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        WELL GROOMED <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="well_groomed">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->well_groomed == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->well_groomed == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->well_groomed == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->well_groomed == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->well_groomed == '5' ? 'selected' : '' }}>5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        STANDARD STAFF UNIFORM <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="standard_staff_uniform">
                                        <option value="">Select a value</option>
                                        <option value="Yes "{{ $data->standard_staff_uniform == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No "{{ $data->standard_staff_uniform == 'No' ? 'selected' : '' }}>No</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        TRIAL ROOM ASSISTANCE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="trial_room_assistance">
                                        <option value="">Select a value</option>
                                        <option value="YES "{{ $data->trial_room_assistance == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO "{{ $data->trial_room_assistance == 'NO' ? 'selected' : '' }}>NO</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        NO. OF CUSTOMER AT THE STORE CURRENTLY ? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="number_customer">
                                        <option value="">Select a value</option>
                                        <option value="0-2 "{{ $data->number_customer == '0-2' ? 'selected' : '' }}>0-2</option>
                                        <option value="2-5 "{{ $data->number_customer == '2-5' ? 'selected' : '' }}>2-5</option>
                                        <option value="5-7 "{{ $data->number_customer == '5-7' ? 'selected' : '' }}>5-7</option>
                                        <option value="ABOVE 7 "{{ $data->number_customer == 'ABOVE 7' ? 'selected' : '' }}>ABOVE 7</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        IS THE STAFF ABLE TO HANDLE THE CUSTOMER ? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="handel_customer">
                                        <option value="">Select a value</option>
                                        <option value="YES "{{ $data->handel_customer == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO "{{ $data->handel_customer == 'NO' ? 'selected' : '' }}>NO</option>
                                        <option value="NO CUSTOMER SEEN "{{ $data->handel_customer == 'NO CUSTOMER SEEN' ? 'selected' : '' }}>NO CUSTOMER SEEN</option>


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        KNOWLEDGE OF MERCHANDISE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="knowledge_of_merchandise">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->knowledge_of_merchandise == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->knowledge_of_merchandise == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->knowledge_of_merchandise == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->knowledge_of_merchandise == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->knowledge_of_merchandise == '5' ? 'selected' : '' }}>5</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        AWARENESS OF BRAND / OFFERS / IN GENERAL <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="awareness_of_brand">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->awareness_of_brand == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->awareness_of_brand == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->awareness_of_brand == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->awareness_of_brand == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->awareness_of_brand == '5' ? 'selected' : '' }}>5</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PROACTIVE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="proactive">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->proactive == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->proactive == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->proactive == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->proactive == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->proactive == '5' ? 'selected' : '' }}>5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        OVERALL CUSTOMER SATISFACTION (STAFF BEHAVIOR TOWARDS CUSTOMER/YOU) <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="customer_satisfaction">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->customer_satisfaction == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->customer_satisfaction == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->customer_satisfaction == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->customer_satisfaction == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->customer_satisfaction == '5' ? 'selected' : '' }}>5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        BILLING COUNTER EXPERIENCE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="billing_counter_experience">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->billing_counter_experience == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->billing_counter_experience == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->billing_counter_experience == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->billing_counter_experience == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->billing_counter_experience == '5' ? 'selected' : '' }}>5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS ON STAFF OBSERVATION?</label>
                                <p class="text-primary">Describe the staff uniform and anything that requires to be noted down related to the store staff. </p>
                                <textarea class="summernote" name="remarks_on_staff_observation" id="summernote-16">{{ $data->remarks_on_staff_observation }}</textarea>
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
                {{-- </div> --}}
                <!-- -----------Tab-4------------ -->

                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PAGE SECTION <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="page_sacetion_2">
                                        <option value="">Select a value</option>
                                        <option value="AMBIENCE "{{ $data->page_sacetion_2 == 'AMBIENCE' ? 'selected' : '' }}>AMBIENCE</option>
                                        <option value="STAFF OBSERVATION "{{ $data->page_sacetion_2 == 'STAFF OBSERVATION' ? 'selected' : '' }}>STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY "{{ $data->page_sacetion_2 == 'SALE / MARKETING STRATEGY' ? 'selected' : '' }}>SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION "{{ $data->page_sacetion_2 == 'PRODUCT OBSERVATION' ? 'selected' : '' }}>PRODUCT OBSERVATION</option>
                                        <option value="VM & SPACE MANAGEMENT "{{ $data->page_sacetion_2 == 'VM & SPACE MANAGEMENT' ? 'selected' : '' }}>VM & SPACE MANAGEMENT</option>
                                        <option value="BRANDING "{{ $data->page_sacetion_2 == 'BRANDING' ? 'selected' : '' }}>BRANDING</option>
                                        <option value="TRIAL ROOMS "{{ $data->page_sacetion_2 == 'TRIAL ROOMS' ? 'selected' : '' }}>TRIAL ROOMS</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        IS THE STORE CURRENTLY RUNNING ANY OFFERS OR DISCOUNTS? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="any_offers">
                                        <option value="">Select a value</option>
                                        <option value="Yes "{{ $data->any_offers == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No "{{ $data->any_offers == 'No' ? 'selected' : '' }}>No</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        CURRENT OFFER IN THE OVERALL STORE? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="current_offer">
                                        <option value="">Select a value</option>
                                        <option value="UPTO 20% - 30% OFF "{{ $data->current_offer == 'UPTO 20% - 30% OFF' ? 'selected' : '' }}>UPTO 20% - 30% OFF</option>
                                        <option value="UPTO 50% - 70% OFF "{{ $data->current_offer == 'UPTO 50% - 70% OFF' ? 'selected' : '' }}>UPTO 50% - 70% OFF</option>
                                        <option value="FLAT 20% - 30% OFF "{{ $data->current_offer == 'FLAT 20% - 30% OFF' ? 'selected' : '' }}>FLAT 20% - 30% OFF</option>
                                        <option value="FLAT 50% - 70% OFF "{{ $data->current_offer == 'FLAT 50% - 70% OFF' ? 'selected' : '' }}>FLAT 50% - 70% OFF</option>
                                        <option value="BUY TO GET "{{ $data->current_offer == 'BUY TO GET' ? 'selected' : '' }}>BUY TO GET</option>
                                        <option value="OTHER "{{ $data->current_offer == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                                        <option value="NONE "{{ $data->current_offer == 'NONE' ? 'selected' : '' }}>NONE</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        RETURN/ EXCHNAGE POLICY <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="exchange_policy">
                                        <option value="">Select a value</option>
                                        <option value="ONLY EXCHANGE "{{ $data->exchange_policy == 'ONLY EXCHANGE' ? 'selected' : '' }}>ONLY EXCHANGE</option>
                                        <option value="EXCHANGE OR RETURN "{{ $data->exchange_policy == 'EXCHANGE OR RETURN' ? 'selected' : '' }}>EXCHANGE OR RETURN</option>
                                        <option value="NO EXCHANGE NO RETURN "{{ $data->exchange_policy == 'NO EXCHANGE NO RETURN' ? 'selected' : '' }}>NO EXCHANGE NO RETURN</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PERSONAL OCCASION DISCOUNT OFFERED? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="discount_offer">
                                        <option value="">Select a value</option>
                                        <option value="BIRTHDAY DISCOUNT "{{ $data->discount_offer == 'BIRTHDAY DISCOUNT' ? 'selected' : '' }}>BIRTHDAY DISCOUNT</option>
                                        <option value="ANNIVERSARY DISCOUNT "{{ $data->discount_offer == 'ANNIVERSARY DISCOUNT' ? 'selected' : '' }}>ANNIVERSARY DISCOUNT</option>
                                        <option value="OTHER OCASSION "{{ $data->discount_offer == 'OTHER OCASSION' ? 'selected' : '' }}>OTHER OCASSION</option>
                                        <option value="PREMIUM MEMBER DISCOUNT "{{ $data->discount_offer == 'PREMIUM MEMBER DISCOUNT' ? 'selected' : '' }}>PREMIUM MEMBER DISCOUNT</option>
                                        <option value="NONE "{{ $data->discount_offer == 'NONE' ? 'selected' : '' }}>NONE</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        REWARD POINT GIVEN? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="reward_point_given">
                                        <option value="">Select a value</option>
                                        <option value="YES "{{ $data->reward_point_given == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO "{{ $data->reward_point_given == 'NO' ? 'selected' : '' }}>NO</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        USE OF INFLUENCER/ BRAND MARKETING <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="use_of_influencer">
                                        <option value="">Select a value</option>
                                        <option value="YES "{{ $data->use_of_influencer == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO "{{ $data->use_of_influencer == 'NO' ? 'selected' : '' }}>NO</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        AGE GROUP OF CUSTOMERS CURRENTLY SEEN AT THE STORE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="age_group_of_customer">
                                        <option value="">Select a value</option>
                                        <option value="20-25 "{{ $data->age_group_of_customer == '20-25' ? 'selected' : '' }}>20-25</option>
                                        <option value="25-35 "{{ $data->age_group_of_customer == '25-35' ? 'selected' : '' }}>25-35</option>
                                        <option value="35-45 "{{ $data->age_group_of_customer == '35-45' ? 'selected' : '' }}>35-45</option>
                                        <option value="Above 45 "{{ $data->age_group_of_customer == 'Above 45' ? 'selected' : '' }}>Above 45</option>
                                        <option value="NO CUSTOMERS SEEN "{{ $data->age_group_of_customer == 'NO CUSTOMERS SEEN' ? 'selected' : '' }}>NO CUSTOMERS SEEN</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        ALTERATION FACILITY IN STORE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="alteration_facility_in_store">
                                        <option value="">Select a value</option>
                                        <option value="AVAILABLE "{{ $data->alteration_facility_in_store == 'AVAILABLE' ? 'selected' : '' }}>AVAILABLE</option>
                                        <option value="NOT AVAILABLE "{{ $data->alteration_facility_in_store == 'NOT AVAILABLE' ? 'selected' : '' }}>NOT AVAILABLE</option>

                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS SALE / MARKETING STRATEGY?</label>
                                <p class="text-primary">Mention the offers if any. Also mention reward points rule. Describe if you feel anything is out of the box about marketing and sales strategy observed in this brand. Mention exchange days/deadline. </p>
                                <textarea class="summernote" name="any_remarks_sale" id="summernote-16">{{ $data->any_remarks_sale }}</textarea>
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

                <!-- -----------Tab-5------------ -->
                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PAGE SECTION <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="page_section_3">
                                        <option value="">Select a value</option>
                                        <option value="AMBIENCE "{{ $data->page_section_3 == 'AMBIENCE' ? 'selected' : '' }}>AMBIENCE</option>
                                        <option value="STAFF OBSERVATION "{{ $data->page_section_3 == 'STAFF OBSERVATION' ? 'selected' : '' }}>STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY "{{ $data->page_section_3 == 'SALE / MARKETING STRATEGY' ? 'selected' : '' }}>SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION "{{ $data->page_section_3 == 'PRODUCT OBSERVATION' ? 'selected' : '' }}>PRODUCT OBSERVATION</option>
                                        <option value="BRANDING "{{ $data->page_section_3 == 'BRANDING' ? 'selected' : '' }}>BRANDING</option>
                                        <option value="TRIAL ROOMS "{{ $data->page_section_3 == 'TRIAL ROOMS' ? 'selected' : '' }}>TRIAL ROOMS</option>
                                        <option value="VM & SPACE MANAGEMENT "{{ $data->page_section_3 == 'VM & SPACE MANAGEMENT' ? 'selected' : '' }}>VM & SPACE MANAGEMENT</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        SUB-BRANDS OFFERED? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="sub_brand_offered">
                                        <option value="">Select a value</option>
                                        <option value="YES "{{ $data->sub_brand_offered == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO "{{ $data->sub_brand_offered == 'NO' ? 'selected' : '' }}>NO</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        COLOUR PALETTE OF THE ENTIRE STORE AT FIRST SIGHT <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="colour_palette">
                                        <option value="">Select a value</option>
                                        <option value="GHT/PASTEL "{{ $data->colour_palette == 'GHT/PASTEL' ? 'selected' : '' }}>LIGHT/PASTEL</option>
                                        <option value="DARK/DULL "{{ $data->colour_palette == 'DARK/DULL' ? 'selected' : '' }}>DARK/DULL</option>
                                        <option value="MIX EQUALLY "{{ $data->colour_palette == 'MIX EQUALLY' ? 'selected' : '' }}>MIX EQUALLY</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        NUMBER OF COLOURWAYS OFFERED IN MOST STYLES <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="number_of_colourways">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->awareness_of_brand == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->awareness_of_brand == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->awareness_of_brand == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->awareness_of_brand == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->awareness_of_brand == '5' ? 'selected' : '' }}>5</option>


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        SIZE AVAILABILITY <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="size_availiblity">
                                        <option value="">Select a value</option>
                                        <option value="XXS "{{ $data->size_availiblity == 'XXS' ? 'selected' : '' }}>XXS</option>
                                        <option value="XS "{{ $data->size_availiblity == 'XS' ? 'selected' : '' }}>XS</option>
                                        <option value="S "{{ $data->size_availiblity == 'S' ? 'selected' : '' }}>S</option>
                                        <option value="M "{{ $data->size_availiblity == 'M' ? 'selected' : '' }}>M</option>
                                        <option value="L "{{ $data->size_availiblity == 'L' ? 'seXLected' : '' }}>L</option>
                                        <option value="XL "{{ $data->size_availiblity == 'XL' ? 'selected' : '' }}>XL</option>
                                        <option value="2XL "{{ $data->size_availiblity == '2XL' ? 'selected' : '' }}>2XL</option>
                                        <option value="3XL "{{ $data->size_availiblity == '3XL' ? 'selected' : '' }}>3XL</option>
                                        <option value="4XL "{{ $data->size_availiblity == '4XL' ? 'selected' : '' }}>4XL</option>
                                        <option value="5XL "{{ $data->size_availiblity == '5XL' ? 'selected' : '' }}>5XL</option>

                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Details
                                    <button type="button" name="details" id="Details1-add">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="Details1-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 2%">Row#</th>
                                                <th style="width: 16%">CATEGORY</th>
                                                <th style="width: 16%">PRICE</th>
                                                <th style="width: 5%">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($grid_Data && is_array($grid_Data->data))
                                            @foreach ($grid_Data->data as $datas)
                                                <tr>
                                                    <td><input disabled type="text" name="details1[{{ $loop->index }}][row]" value="1"></td>
                                                    <td>
                                                        <select name="details1[{{ $loop->index }}][category]">
                                                            <option value="">--Select Category--</option>
                                                            <option value="SINGLE KURTA" {{ isset($datas['category']) && $datas['category'] == 'SINGLE KURTA' ? 'selected' : '' }}>SINGLE KURTA</option>
                                                            <option value="KURTA SETS" {{ isset($datas['category']) && $datas['category'] == 'KURTA SETS' ? 'selected' : '' }}>KURTA SETS</option>
                                                            <option value="SHIRTS / TUNICS" {{ isset($datas['category']) && $datas['category'] == 'SHIRTS / TUNICS' ? 'selected' : '' }}>SHIRTS / TUNICS</option>
                                                            <option value="SHORT DRESSES" {{ isset($datas['category']) && $datas['category'] == 'SHORT DRESSES' ? 'selected' : '' }}>SHORT DRESSES</option>
                                                            <option value="LONG DRESSES" {{ isset($datas['category']) && $datas['category'] == 'LONG DRESSES' ? 'selected' : '' }}>LONG DRESSES</option>
                                                            <option value="BOTTOMS" {{ isset($datas['category']) && $datas['category'] == 'BOTTOMS' ? 'selected' : '' }}>BOTTOMS</option>
                                                            <option value="INDO-WESTERN CO-ORD SET" {{ isset($datas['category']) && $datas['category'] == 'INDO-WESTERN CO-ORD SET' ? 'selected' : '' }}>INDO-WESTERN CO-ORD SET</option>
                                                            <option value="JUMPSUIT" {{ isset($datas['category']) && $datas['category'] == 'JUMPSUIT' ? 'selected' : '' }}>JUMPSUIT</option>
                                                            <option value="DUPATTAS" {{ isset($datas['category']) && $datas['category'] == 'DUPATTAS' ? 'selected' : '' }}>DUPATTAS</option>
                                                            <option value="LEHENGA" {{ isset($datas['category']) && $datas['category'] == 'LEHENGA' ? 'selected' : '' }}>LEHENGA</option>
                                                            <option value="SAREE" {{ isset($datas['category']) && $datas['category'] == 'SAREE' ? 'selected' : '' }}>SAREE</option>
                                                            <option value="JACKETS & SHRUGS" {{ isset($datas['category']) && $datas['category'] == 'JACKETS & SHRUGS' ? 'selected' : '' }}>JACKETS & SHRUGS</option>
                                                            <option value="DRESS MATERIAL" {{ isset($datas['category']) && $datas['category'] == 'DRESS MATERIAL' ? 'selected' : '' }}>DRESS MATERIAL</option>
                                                            <option value="FOOTWEAR" {{ isset($datas['category']) && $datas['category'] == 'FOOTWEAR' ? 'selected' : '' }}>FOOTWEAR</option>
                                                            <option value="JEWELLRY" {{ isset($datas['category']) && $datas['category'] == 'JEWELLRY' ? 'selected' : '' }}>JEWELLRY</option>
                                                            <option value="HANDBAGS" {{ isset($datas['category']) && $datas['category'] == 'HANDBAGS' ? 'selected' : '' }}>HANDBAGS</option>
                                                            <option value="FRAGRANCES" {{ isset($datas['category']) && $datas['category'] == 'FRAGRANCES' ? 'selected' : '' }}>FRAGRANCES</option>
                                                            <option value="SHAWL/ STOLE / SCARVES" {{ isset($datas['category']) && $datas['category'] == 'SHAWL/ STOLE / SCARVES' ? 'selected' : '' }}>SHAWL/ STOLE / SCARVES</option>
                                                            <option value="NIGHT SUITS" {{ isset($datas['category']) && $datas['category'] == 'NIGHT SUITS' ? 'selected' : '' }}>NIGHT SUITS</option>
                                                            <option value="BELTS & WALLETS" {{ isset($datas['category']) && $datas['category'] == 'BELTS & WALLETS' ? 'selected' : '' }}>BELTS & WALLETS</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="details1[{{ $loop->index }}][price]">
                                                            <option value="">--Select Price--</option>
                                                            <option value="BELOW 500" {{ isset($datas['price']) && $datas['price'] == 'BELOW 500' ? 'selected' : '' }}>BELOW 500</option>
                                                            <option value="500-2000" {{ isset($datas['price']) && $datas['price'] == '500-2000' ? 'selected' : '' }}>500-2000</option>
                                                            <option value="2100-5000" {{ isset($datas['price']) && $datas['price'] == '2100-5000' ? 'selected' : '' }}>2100-5000</option>
                                                            <option value="5100-7000" {{ isset($datas['price']) && $datas['price'] == '5100-7000' ? 'selected' : '' }}>5100-7000</option>
                                                            <option value="7100-9000" {{ isset($datas['price']) && $datas['price'] == '7100-9000' ? 'selected' : '' }}>7100-9000</option>
                                                            <option value="9100-15000" {{ isset($datas['price']) && $datas['price'] == '9100-15000' ? 'selected' : '' }}>9100-15000</option>
                                                            <option value="15100 & ABOVE" {{ isset($datas['price']) && $datas['price'] == '15100 & ABOVE' ? 'selected' : '' }}>15100 & ABOVE</option>
                                                            <option value="N/A" {{ isset($datas['price']) && $datas['price'] == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    </td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            @endforeach
                                        @endif


                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        DID YOU FIND ENGAGING PRICED MERCHANDISE AT THE STORE FRONT ?
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="engaging_price">
                                        <option value="">Select a value</option>
                                        <option value="LOWER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT "{{ $data->engaging_price == 'LOWER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT' ? 'selected' : '' }}>LOWER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT</option>
                                        <option value="HIGHER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT "{{ $data->engaging_price == 'HIGHER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT' ? 'selected' : '' }}>HIGHER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT</option>
                                        <option value="MIX PRICE ITEMS WERE DISPLAYED AT THE STORE FRONT "{{ $data->engaging_price == 'MIX PRICE ITEMS WERE DISPLAYED AT THE STORE FRONT' ? 'selected' : '' }}>MIX PRICE ITEMS WERE DISPLAYED AT THE STORE FRONT</option>
                                        <option value="DISCOUNT / SALE ITEMS WERE DISPLAYED AT THE STORE FRONT "{{ $data->engaging_price == 'DISCOUNT / SALE ITEMS WERE DISPLAYED AT THE STORE FRONT' ? 'selected' : '' }}>DISCOUNT / SALE ITEMS WERE DISPLAYED AT THE STORE FRONT</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        MERCHANDISE AVAILBLE IN THE STORE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="merchadise_available">
                                        <option value="">Select a value</option>
                                        <option value="APPAREL "{{ $data->merchadise_available == 'APPAREL' ? 'selected' : '' }}>APPAREL</option>
                                        <option value="HANDBAGS "{{ $data->merchadise_available == 'HANDBAGS' ? 'selected' : '' }}>HANDBAGS</option>
                                        <option value="FOOTWEAR "{{ $data->merchadise_available == 'FOOTWEAR' ? 'selected' : '' }}>FOOTWEAR</option>
                                        <option value="COSMETICS & SKINCARE "{{ $data->merchadise_available == 'COSMETICS & SKINCARE' ? 'selected' : '' }}>COSMETICS & SKINCARE</option>
                                        <option value="HOME DECOR "{{ $data->merchadise_available == 'HOME DECOR' ? 'selected' : '' }}>HOME DECOR</option>
                                        <option value="ACCESSORIES "{{ $data->merchadise_available == 'ACCESSORIES' ? 'selected' : '' }}>ACCESSORIES</option>
                                        <option value="OTHERS"{{ $data->merchadise_available == 'OTHERS' ? 'selected' : '' }}>OTHERS</option>

                                    </select>
                                </div>
                            </div>



                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Details
                                    <button type="button" name="details" id="Details2-add">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="Details2-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 2%">Row#</th>
                                                <th style="width: 16%">STYLES</th>
                                                <th style="width: 16%">CATEGORY</th>
                                                <th style="width: 5%">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($grid_Data2 && is_array($grid_Data2->data))
                                            @foreach ($grid_Data2->data as $names)
                                                <tr>
                                                    <td><input disabled type="text" name="details2[{{ $loop->index }}][row]" value="1"></td>
                                                    <td>
                                                        <select name="details2[{{ $loop->index }}][styles]">
                                                            <option value="">--Select Category--</option>
                                                            <option value="CASUAL WEAR" {{ isset($names['styles']) && $names['styles'] == 'CASUAL WEAR' ? 'selected' : '' }}>CASUAL WEAR</option>
                                                            <option value="TRADITIONAL/CONTEMPORARY WEAR" {{ isset($names['styles']) && $names['styles'] == 'TRADITIONAL/CONTEMPORARY WEAR' ? 'selected' : '' }}>TRADITIONAL/CONTEMPORARY WEAR</option>
                                                            <option value="ETHNIC WEAR" {{ isset($names['styles']) && $names['styles'] == 'ETHNIC WEAR' ? 'selected' : '' }}>ETHNIC WEAR</option>
                                                            <option value="SHORT DRESSES" {{ isset($names['styles']) && $names['styles'] == 'SHORT DRESSES' ? 'selected' : '' }}>SHORT DRESSES</option>
                                                            <option value="INDO-WESTERN WEAR" {{ isset($names['styles']) && $names['styles'] == 'INDO-WESTERN WEAR' ? 'selected' : '' }}>INDO-WESTERN WEAR</option>
                                                            <option value="DESIGNER/OCCASION WEAR" {{ isset($names['styles']) && $names['styles'] == 'DESIGNER/OCCASION WEAR' ? 'selected' : '' }}>DESIGNER/OCCASION WEAR</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="details2[{{ $loop->index }}][category]">
                                                            <option value="">--Select Price--</option>
                                                            <option value="TOP/TUNICS/SHIRTS" {{ isset($names['category']) && $names['category'] == 'TOP/TUNICS/SHIRTS' ? 'selected' : '' }}>TOP/TUNICS/SHIRTS</option>
                                                            <option value="SKIRT/LEHENGA" {{ isset($names['category']) && $names['category'] == 'SKIRT/LEHENGA' ? 'selected' : '' }}>SKIRT/LEHENGA</option>
                                                            <option value="SHIRTS / TUNICS" {{ isset($names['category']) && $names['category'] == 'SHIRTS / TUNICS' ? 'selected' : '' }}>SHIRTS / TUNICS</option>
                                                            <option value="DRESSES/GOWNS" {{ isset($names['category']) && $names['category'] == 'DRESSES/GOWNS' ? 'selected' : '' }}>DRESSES/GOWNS</option>
                                                            <option value="PALAZZO/PANTS/SHARARA/LEGGINGS" {{ isset($names['category']) && $names['category'] == 'PALAZZO/PANTS/SHARARA/LEGGINGS' ? 'selected' : '' }}>PALAZZO/PANTS/SHARARA/LEGGINGS</option>
                                                            <option value="KURTIS/KURTA" {{ isset($names['category']) && $names['category'] == 'KURTIS/KURTA' ? 'selected' : '' }}>KURTIS/KURTA</option>
                                                            <option value="CO-ORD SETS" {{ isset($names['category']) && $names['category'] == 'CO-ORD SETS' ? 'selected' : '' }}>CO-ORD SETS</option>
                                                            <option value="SAREE" {{ isset($names['category']) && $names['category'] == 'SAREE' ? 'selected' : '' }}>SAREE</option>
                                                            <option value="JUMPSUIT" {{ isset($names['category']) && $names['category'] == 'JUMPSUIT' ? 'selected' : '' }}>JUMPSUIT</option>
                                                            <option value="DUPATTA/SCARF/SHAWL" {{ isset($names['category']) && $names['category'] == 'DUPATTA/SCARF/SHAWL' ? 'selected' : '' }}>DUPATTA/SCARF/SHAWL</option>
                                                            <option value="DRESS MATERIAL" {{ isset($names['category']) && $names['category'] == 'DRESS MATERIAL' ? 'selected' : '' }}>DRESS MATERIAL</option>
                                                            <option value="OTHER" {{ isset($names['category']) && $names['category'] == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                                                            <option value="N/A" {{ isset($names['category']) && $names['category'] == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="removeRowBtn">Remove</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        TYPES OF FABRIC AVAILABLE ? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="types_of_fabric">
                                        <option value="">Select a value</option>
                                        <option value="100% COTTON "{{ $data->types_of_fabric == '100% COTTON' ? 'selected' : '' }}>100% COTTON</option>
                                        <option value="100% POLYESTER "{{ $data->types_of_fabric == '100% POLYESTER' ? 'selected' : '' }}>100% POLYESTER</option>
                                        <option value="100% VISCOSE "{{ $data->types_of_fabric == '100% VISCOSE' ? 'selected' : '' }}>100% VISCOSE</option>
                                        <option value="COTTON POLY BLEND "{{ $data->types_of_fabric == 'COTTON POLY BLEND' ? 'selected' : '' }}>COTTON POLY BLEND</option>
                                        <option value="100% LINEN "{{ $data->types_of_fabric == '100% LINEN' ? 'selected' : '' }}>100% LINEN</option>
                                        <option value="VISCOSE BLEND "{{ $data->types_of_fabric == 'VISCOSE BLEND' ? 'selected' : '' }}>VISCOSE BLEND</option>
                                        <option value="SILK "{{ $data->types_of_fabric == 'SILK' ? 'selected' : '' }}>SILK</option>
                                        <option value="POLYESTER BLEND "{{ $data->types_of_fabric == 'POLYESTER BLEND' ? 'selected' : '' }}>POLYESTER BLEND</option>
                                        <option value="CHIFFON / GEORGETTE "{{ $data->types_of_fabric == 'CHIFFON / GEORGETTE' ? 'selected' : '' }}>CHIFFON / GEORGETTE</option>
                                        <option value="LINEN BLEND "{{ $data->types_of_fabric == 'LINEN BLEND' ? 'selected' : '' }}>LINEN BLEND</option>
                                        <option value="OTHERS "{{ $data->types_of_fabric == 'OTHERS' ? 'selected' : '' }}>OTHERS</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PRINTS OBSERVED? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="prints_observed">
                                        <option value="">Select a value</option>
                                        <option value="SMALL FLORAL PRINTS "{{ $data->prints_observed == 'SMALL FLORAL PRINTS' ? 'selected' : '' }}>SMALL FLORAL PRINTS</option>
                                        <option value="BIG FLORAL PRINTS "{{ $data->prints_observed == 'BIG FLORAL PRINTS' ? 'selected' : '' }}>BIG FLORAL PRINTS</option>
                                        <option value="GEOMETRIC PRINTS "{{ $data->prints_observed == 'GEOMETRIC PRINTS' ? 'selected' : '' }}>GEOMETRIC PRINTS</option>
                                        <option value="AZTEC PRINTS "{{ $data->prints_observed == 'AZTEC PRINTS' ? 'selected' : '' }}>AZTEC PRINTS</option>
                                        <option value="TRADITIONAL PRINTS (PAISLEY / ELEPHANT MOTIFS ETC) "{{ $data->prints_observed == 'TRADITIONAL PRINTS (PAISLEY / ELEPHANT MOTIFS ETC)' ? 'selected' : '' }}>TRADITIONAL PRINTS (PAISLEY / ELEPHANT MOTIFS ETC)</option>
                                        <option value="PAINTING PRINTS "{{ $data->prints_observed == 'PAINTING PRINTS' ? 'selected' : '' }}>PAINTING PRINTS</option>
                                        <option value="ANIMAL PRINTS "{{ $data->prints_observed == 'ANIMAL PRINTS' ? 'selected' : '' }}>ANIMAL PRINTS</option>
                                        <option value="ABSTRACT PRINTS "{{ $data->prints_observed == 'ABSTRACT PRINTS' ? 'selected' : '' }}>ABSTRACT PRINTS</option>
                                        <option value="ALL OVER PRINT "{{ $data->prints_observed == 'ALL OVER PRINT' ? 'selected' : '' }}>ALL OVER PRINT</option>
                                        <option value="PLACEMENT PRINT "{{ $data->prints_observed == 'PLACEMENT PRINT' ? 'selected' : '' }}>PLACEMENT PRINT</option>
                                        <option value="OTHERS "{{ $data->prints_observed == 'OTHERS' ? 'selected' : '' }}>OTHERS</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        EMBROIDERIES OBSERVED? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="embroideries_observed">
                                        <option value="">Select a value</option>
                                        <option value="THREAD WORK "{{ $data->embroideries_observed == 'THREAD WORK' ? 'selected' : '' }}>THREAD WORK</option>
                                        <option value="APPLIQUE "{{ $data->embroideries_observed == 'APPLIQUE' ? 'selected' : '' }}>APPLIQUE</option>
                                        <option value="BEAD WORK "{{ $data->embroideries_observed == 'BEAD WORK' ? 'selected' : '' }}>BEAD WORK</option>
                                        <option value="STONE WORK AND ZARDOZI EMBROIDERY "{{ $data->embroideries_observed == 'STONE WORK AND ZARDOZI EMBROIDERY' ? 'selected' : '' }}>STONE WORK AND ZARDOZI EMBROIDERY</option>
                                        <option value="HOME DECOR "{{ $data->embroideries_observed == 'HOME DECOR' ? 'selected' : '' }}>HOME DECOR</option>
                                        <option value="ALL OVER EMBROIDERY "{{ $data->embroideries_observed == 'ALL OVER EMBROIDERY' ? 'selected' : '' }}>ALL OVER EMBROIDERY</option>
                                        <option value="PLACEMENT EMBROIDERY "{{ $data->embroideries_observed == 'PLACEMENT EMBROIDERY' ? 'selected' : '' }}>PLACEMENT EMBROIDERY</option>
                                        <option value="OTHERS "{{ $data->embroideries_observed == 'OTHERS' ? 'selected' : '' }}>OTHERS</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        OVERALL QUALITY OF GARMENTS IN THE STORE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="quality_of_garments">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->quality_of_garments == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->quality_of_garments == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->quality_of_garments == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->quality_of_garments == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->quality_of_garments == '5' ? 'selected' : '' }}>5</option>


                                    </select>
                                </div>
                            </div>


                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS ON PRODUCT OBSERVATION?</label>
                                <p class="text-primary">Mention any sub brands if offered, and anything worth to be noted in this section. </p>
                                <textarea class="summernote" name="remarks_on_product_observation" id="summernote-16">{{ $data->remarks_on_product_observation }}</textarea>
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



                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">


                            <div class="col-12">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PAGE SECTION <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="page_section_4">
                                        <option value="">Select a value</option>
                                        <option value="AMBIENCE "{{ $data->page_section_4 == 'AMBIENCE' ? 'selected' : '' }}>AMBIENCE</option>
                                        <option value="STAFF OBSERVATION "{{ $data->page_section_4 == 'STAFF OBSERVATION' ? 'selected' : '' }}>STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY "{{ $data->page_section_4 == 'SALE / MARKETING STRATEGY' ? 'selected' : '' }}>SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION "{{ $data->page_section_4 == 'PRODUCT OBSERVATION' ? 'selected' : '' }}>PRODUCT OBSERVATION</option>
                                        <option value="VM & SPACE MANAGEMENT "{{ $data->page_section_4 == 'VM & SPACE MANAGEMENT' ? 'selected' : '' }}>VM & SPACE MANAGEMENT</option>
                                        <option value="BRANDING "{{ $data->page_section_4 == 'BRANDING' ? 'selected' : '' }}>BRANDING</option>
                                        <option value="TRIAL ROOMS "{{ $data->page_section_4 == 'TRIAL ROOMS' ? 'selected' : '' }}>TRIAL ROOMS</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        THE ENTRANCE OF THE STORE (DISPLAY OF GARMENTS) <span class="text-danger"></span>
                                    </label>
                                <p class="text-primary">Here, mention how you feel about the store from outside at the first glance. Keep in mind if the store visually invites you in or not through colour blocking or mannequin display or anything else.</p>
                                    <select id="select-state" placeholder="Select..." name="entrance_of_the_store">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->entrance_of_the_store == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->entrance_of_the_store == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->entrance_of_the_store == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->entrance_of_the_store == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->entrance_of_the_store == '5' ? 'selected' : '' }}>5</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        STORY TELLING <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="story_telling">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->story_telling == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->story_telling == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->story_telling == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->story_telling == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->story_telling == '5' ? 'selected' : '' }}>5</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        STOCK DISPLAY IN THE ENTIRE STORE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="stock_display">
                                        <option value="">Select a value</option>
                                        <option value="LIMITED SIZES ARE DISPLAYED ON RACKS "{{ $data->stock_display == 'LIMITED SIZES ARE DISPLAYED ON RACKS' ? 'selected' : '' }}>LIMITED SIZES ARE DISPLAYED ON RACKS</option>
                                        <option value="ALL SIZES ARE DISPLAYED TOGETHER ON THE SAME RACK "{{ $data->stock_display == 'ALL SIZES ARE DISPLAYED TOGETHER ON THE SAME RACK' ? 'selected' : '' }}>ALL SIZES ARE DISPLAYED TOGETHER ON THE SAME RACK</option>
                                        <option value="ALL SIZES ARE DISPLAYED BUT ON DIFFERENT RACKS "{{ $data->stock_display == 'ALL SIZES ARE DISPLAYED BUT ON DIFFERENT RACKS' ? 'selected' : '' }}>ALL SIZES ARE DISPLAYED BUT ON DIFFERENT RACKS</option>
                                        <option value="OTHERS "{{ $data->stock_display == 'OTHERS' ? 'selected' : '' }}>OTHERS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        SPACING OF CLOTHES ON THE RACK<span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="spacing_of_clothes">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->spacing_of_clothes == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->spacing_of_clothes == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->spacing_of_clothes == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->spacing_of_clothes == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->spacing_of_clothes == '5' ? 'selected' : '' }}>5</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        HOW MANY NO. OF CUSTOMERS CAN BROWSE AT ONE TIME IN ONE SECTION?<span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="how_many_no_of_customers">
                                        <option value="">Select a value</option>
                                        <option value="0-2 "{{ $data->how_many_no_of_customers == '0-2' ? 'selected' : '' }}>0-2</option>
                                        <option value="3-4 "{{ $data->how_many_no_of_customers == '3-4' ? 'selected' : '' }}>3-4</option>
                                        <option value="3 "{{ $data->how_many_no_of_customers == '3' ? 'selected' : '' }}>3</option>
                                        <option value="MORE THAN 4 "{{ $data->how_many_no_of_customers == 'MORE THAN 4' ? 'selected' : '' }}>MORE THAN 4</option>

                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS ON VM / SPACE MANAGEMENT</label>
                                <p class="text-primary">Mention the colours/prints/styles displayed at the entrance of the store, describe the alignment of the store (what's kept on the left side of the store, what's on the right side etc). Also mention if you feel the store is well spaced or not, meaning if the space is properly utilized or over utilized or under utilized. Describe anything else that's relevant to this section. </p>
                                <textarea class="summernote" name="any_remarks_on_vm" id="summernote-16">{{ $data->any_remarks_on_vm }}</textarea>
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



                <div id="CCForm7" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PAGE SECTION <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="page_section_5">
                                        <option value="">Select a value</option>
                                        <option value="AMBIENCE "{{ $data->page_section_5 == 'AMBIENCE' ? 'selected' : '' }}>AMBIENCE</option>
                                        <option value="STAFF OBSERVATION "{{ $data->page_section_5 == 'STAFF OBSERVATION' ? 'selected' : '' }}>STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY "{{ $data->page_section_5 == 'SALE / MARKETING STRATEGY' ? 'selected' : '' }}>SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION "{{ $data->page_section_5 == 'PRODUCT OBSERVATION' ? 'selected' : '' }}>PRODUCT OBSERVATION</option>
                                        <option value="BRANDING "{{ $data->page_section_5 == 'BRANDING' ? 'selected' : '' }}>BRANDING</option>
                                        <option value="TRIAL ROOMS "{{ $data->page_section_5 == 'TRIAL ROOMS' ? 'selected' : '' }}>TRIAL ROOMS</option>
                                        <option value="VM & SPACE MANAGEMENT "{{ $data->page_section_5 == 'VM & SPACE MANAGEMENT' ? 'selected' : '' }}>VM & SPACE MANAGEMENT</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        SUITABLE BRAND TAGLINE<span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="brand_tagline">
                                        <option value="">Select a value</option>
                                        <option value="YES "{{ $data->brand_tagline == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO "{{ $data->brand_tagline == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        TYPE OF BILL<span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="type_of_ball">
                                        <option value="">Select a value</option>
                                        <option value="DIGITAL ONLY "{{ $data->initiated_by == 'DIGITAL ONLY' ? 'selected' : '' }}>DIGITAL ONLY</option>
                                        <option value="PAPER PRINTED BILL "{{ $data->initiated_by == 'PAPER PRINTED BILL' ? 'selected' : '' }}>PAPER PRINTED BILL</option>
                                        <option value="DIGITAL AND PAPER PRINTED BOTH "{{ $data->initiated_by == 'DIGITAL AND PAPER PRINTED BOTH' ? 'selected' : '' }}>DIGITAL AND PAPER PRINTED BOTH</option>
                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS ON BRANDING?</label>
                                <p class="text-primary">If you see a tagline then mention it here. Add anything else that you feel is worthy to be noted about Branding here. </p>
                                <textarea class="summernote" name="any_ramrks_on_the_branding" id="summernote-16">{{ $data->any_ramrks_on_the_branding }}</textarea>
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



                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        PAGE SECTION <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="page_section_6">
                                        <option value="">Select a value</option>
                                        <option value="AMBIENCE "{{ $data->initiated_by == 'AMBIENCE' ? 'selected' : '' }}>AMBIENCE</option>
                                        <option value="STAFF OBSERVATION "{{ $data->initiated_by == 'STAFF OBSERVATION' ? 'selected' : '' }}>STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY "{{ $data->initiated_by == 'SALE / MARKETING STRATEGY' ? 'selected' : '' }}>SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION "{{ $data->initiated_by == 'PRODUCT OBSERVATION' ? 'selected' : '' }}>PRODUCT OBSERVATION</option>
                                        <option value="BRANDING "{{ $data->initiated_by == 'BRANDING' ? 'selected' : '' }}>BRANDING</option>
                                        <option value="TRIAL ROOMS "{{ $data->initiated_by == 'TRIAL ROOMS' ? 'selected' : '' }}>TRIAL ROOMS</option>
                                        <option value="VM & SPACE MANAGEMENT "{{ $data->initiated_by == 'VM & SPACE MANAGEMENT' ? 'selected' : '' }}>VM & SPACE MANAGEMENT</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        NUMBER OF TRIAL ROOMS? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="number_of_trial_rooms_">
                                        <option value="">Select a value</option>
                                            <option value="1 "{{ $data->number_of_trial_rooms_ == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2 "{{ $data->number_of_trial_rooms_ == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3 "{{ $data->number_of_trial_rooms_ == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4 "{{ $data->number_of_trial_rooms_ == '4' ? 'selected' : '' }}>4</option>
                                            <option value="MORE THAN 4 "{{ $data->number_of_trial_rooms_ == 'MORE THAN 4' ? 'selected' : '' }}>MORE THAN 4</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        HYGIENE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="hygiene_">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->hygiene_ == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->hygiene_ == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->hygiene_ == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->hygiene_ == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->hygiene_ == '5' ? 'selected' : '' }}>5</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        VENTILATION <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="ventilation_">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->ventilation_ == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->ventilation_ == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->ventilation_ == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->ventilation_ == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->ventilation_ == '5' ? 'selected' : '' }}>5</option>


                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        QUEUE OUTSIDE THE TRIAL ROOM <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="queue_outside_the_trial_room">
                                        <option value="">Select a value</option>
                                        <option value="Recall "{{ $data->queue_outside_the_trial_room == 'Recall' ? 'selected' : '' }}>NO QUEUE</option>
                                        <option value="Recall "{{ $data->queue_outside_the_trial_room == 'Recall' ? 'selected' : '' }}>LESS THAN 2</option>
                                        <option value="Recall "{{ $data->queue_outside_the_trial_room == 'Recall' ? 'selected' : '' }}>2-5 PEOPLE</option>
                                        <option value="Recall "{{ $data->queue_outside_the_trial_room == 'Recall' ? 'selected' : '' }}>5 AND ABOVE</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        MIRROR SIZE <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="mirror_size">
                                        <option value="">Select a value</option>
                                        <option value="FULL LENGTH - 4 SIDES "{{ $data->mirror_size == 'FULL LENGTH - 4 SIDES' ? 'selected' : '' }}>FULL LENGTH - 4 SIDES</option>
                                        <option value="FULL LENGTH - 3 SIDES "{{ $data->mirror_size == 'FULL LENGTH - 3 SIDES' ? 'selected' : '' }}>FULL LENGTH - 3 SIDES</option>
                                        <option value="FULL LENGTH -2 SIDES "{{ $data->mirror_size == 'FULL LENGTH -2 SIDES' ? 'selected' : '' }}>FULL LENGTH -2 SIDES</option>
                                        <option value="FULL LENGTH - 1 SIDE "{{ $data->mirror_size == 'FULL LENGTH - 1 SIDE' ? 'selected' : '' }}>FULL LENGTH - 1 SIDE</option>
                                        <option value="HALF MIRROR "{{ $data->mirror_size == 'HALF MIRROR' ? 'selected' : '' }}>HALF MIRROR</option>

                                    </select>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        TRIAL ROOM LIGHTING  <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="trial_room_lighting">
                                        <option value="">Select a value</option>
                                        <option value="1 "{{ $data->trial_room_lighting == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2 "{{ $data->trial_room_lighting == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3 "{{ $data->trial_room_lighting == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4 "{{ $data->trial_room_lighting == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5 "{{ $data->trial_room_lighting == '5' ? 'selected' : '' }}>5</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        IS SEATING INSIDE THE TRAIL ROOM AVAILABLE? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="trial_room_available">
                                        <option value="">Select a value</option>
                                        <option value="YES "{{ $data->trial_room_available == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO "{{ $data->trial_room_available == 'NO' ? 'selected' : '' }}>NO</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        SEATING AROUND TRIAL ROOM AREA (FOR COMPANIONS) <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="seating_around_trial_room">
                                        <option value="">Select a value</option>
                                        <option value="NOT AVAILABLE "{{ $data->seating_around_trial_room == 'NOT AVAILABLE' ? 'selected' : '' }}>NOT AVAILABLE</option>
                                        <option value="1 SEATER "{{ $data->seating_around_trial_room == '1 SEATER' ? 'selected' : '' }}>1 SEATER</option>
                                        <option value="2 SEATER COUCH "{{ $data->seating_around_trial_room == '2 SEATER COUCH' ? 'selected' : '' }}>2 SEATER COUCH</option>
                                        <option value="3 SEATER COUCH "{{ $data->seating_around_trial_room == '3 SEATER COUCH' ? 'selected' : '' }}>3 SEATER COUCH</option>
                                        <option value="MULTIPLE SEATER COUCH "{{ $data->seating_around_trial_room == 'MULTIPLE SEATER COUCH' ? 'selected' : '' }}>MULTIPLE SEATER COUCH</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="PAGE SECTION">
                                        CLOTH HANGER INSIDE THE TRIAL ROOM AVAILABLE? <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="cloth_hanger">
                                        <option value="">Select a value</option>
                                        <option value="YES "{{ $data->cloth_hanger == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO "{{ $data->cloth_hanger == 'NO' ? 'selected' : '' }}>NO</option>

                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS  ON THE TRIAL ROOM ?</label>
                                <p class="text-primary">Mention the cleanliness and space in the trial room. Also if the trial room has any specific decor like planters or wall displays or anything else.</p>
                                <textarea class="summernote" name="any_remarks_on_the_trail_room" id="summernote-16">{{ $data->any_remarks_on_the_trail_room }}</textarea>
                            </div>
                        </div>


                        <div class="group-input">
                            <label class="mt-4" for="ANY REMARKS">ANY REMARKS / COMMENTS ADD ON THE OVERALL STORE?</label>
                            {{-- <p class="text-primary">If you see a tagline then mention it here. Add anything else that you feel is worthy to be noted about Branding here. </p> --}}
                            <textarea class="summernote" name="comments_on_hte_overall_store" id="summernote-16">{{ $data->comments_on_hte_overall_store }}</textarea>
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
{{--
                <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Cancel BY">Survey By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Cancel BY">Survey On</label>
                                    <div class="static"></div>
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
                </div> --}}

            </form>

        </div>
    </div>



<div class="modal fade" id="signature-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('field_visit_stage', $data->id) }}" method="POST"
                id="signatureModalForm">
                @csrf
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
                        <label for="comment">Comment</label>
                        <input type="comment" name="comment">
                    </div>
                </div>
                <div class="modal-footer">
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

<div class="modal fade" id="more-info-required-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('field_visit_reject', $data->id) }}" method="POST">
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
                    <button type="submit">
                        Submit
                    </button>
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

            <form action="{{ route('field_visit_cancel', $data->id) }}" method="POST">
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
                        // '<td><input type="text" name="details[' + serialNumber + '][PreparedBy]"></td>' +
                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +
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
    $(document).ready(function() {
        $('#Details1-add').click(function(e) {
            e.preventDefault();

            function generateOptions(users) {
                    var options = '<option value="">Select a value</option>';
                    users.forEach(function(user) {
                        options += '<option value="' + user.id + '">' + user.name + '</option>';
                    });
                    return options;
                }


            function generateTableRow(serialNumber) {

                var options = generateOptions(users);

                var html = '';
                html += '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                    '"></td>' +
                    '   <td><select type="text" name="details1[' + serialNumber + '][category]">'+
                                        '<option value="">--Select Category--</option>'+
                                        '<option value="SINGLE KURTA">SINGLE KURTA</option>'+
                                        '<option value="KURTA SETS">KURTA SETS</option>'+
                                        '<option value="SHIRTS / TUNICS">SHIRTS / TUNICS</option>'+
                                        '<option value="SHORT DRESSES">SHORT DRESSES</option>'+
                                        '<option value="LONG DRESSES">LONG DRESSES</option>'+
                                        '<option value="BOTTOMS">BOTTOMS</option>'+
                                        '<option value="INDO-WESTERN CO-ORD SET">INDO-WESTERN CO-ORD SET</option>'+
                                        '<option value="JUMPSUIT">JUMPSUIT</option>'+
                                        '<option value="DUPATTAS">DUPATTAS</option>'+
                                        '<option value="LEHENGA">LEHENGA</option>'+
                                        '<option value="SAREE">SAREE</option>'+
                                        '<option value="JACKETS & SHRUGS">JACKETS & SHRUGS</option>'+
                                        '<option value="DRESS MATERIAL">DRESS MATERIAL</option>'+
                                        '<option value="FOOTWEAR">FOOTWEAR</option>'+
                                        '<option value="JEWELLRY">JEWELLRY</option>'+
                                        '<option value="HANDBAGS">HANDBAGS</option>'+
                                        '<option value="FRAGRANCES">FRAGRANCES</option>'+
                                        '<option value="SHAWL/ STOLE / SCARVES">SHAWL/ STOLE / SCARVES</option>'+
                                        '<option value="NIGHT SUITS">NIGHT SUITS</option>'+
                                        '<option value="BELTS & WALLETS">BELTS & WALLETS</option>'+
                                        '</select></td>' +
                                        '<td><select type="text" name="details1[' + serialNumber + '][price]">'+
                                                '<option value="">--Select Price--</option>'+
                                                '<option value="BELOW 500">BELOW 500</option>'+
                                                '<option value="500-2000">500-2000</option>'+
                                                '<option value="2100-5000">2100-5000</option>'+
                                                '<option value="5100-7000">5100-7000</option>'+
                                                '<option value="7100-9000">7100-9000</option>'+
                                                '<option value="9100-15000">9100-15000</option>'+
                                                '<option value="15100 & ABOVE">15100 & ABOVE</option>'+
                                                '<option value="N/A">N/A</option>'+
                                            '</select></td>' +
                                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +
                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }

                // html += '</select></td>' +


                return html;
            }

            var tableBody = $('#Details1-table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#Details2-add').click(function(e) {
            function generateTableRow(serialNumber) {
                var html = '';
                html += '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                    '"></td>' +
                    '   <td><select type="text" name="details2[' + serialNumber + '][category]">'+
                                        '<option value="">--Select Category--</option>'+
                                        '<option value="CASUAL WEAR">CASUAL WEAR</option>'+
                                        '<option value="TRADITIONAL/CONTEMPORARY WEAR">TRADITIONAL/CONTEMPORARY WEAR</option>'+
                                        '<option value="ETHNIC WEAR">ETHNIC WEAR</option>'+
                                        '<option value="WESTERN WEAR">WESTERN WEAR</option>'+
                                        '<option value="INDO-WESTERN WEAR">INDO-WESTERN WEAR</option>'+
                                        '<option value="BOTTOMS">BOTTOMS</option>'+
                                        '<option value="INDO-WESTERN CO-ORD SET">INDO-WESTERN CO-ORD SET</option>'+
                                        '<option value="DESIGNER/OCCASION WEAR">DESIGNER/OCCASION WEAR</option>'+
                                        '</select></td>' +
                                        '<td><select type="text" name="details2[' + serialNumber + '][price]">'+
                                                '<option value="">--Select Price--</option>'+
                                                '<option value="TOP/TUNICS/SHIRTS">TOP/TUNICS/SHIRTS</option>'+
                                                '<option value="SKIRT/LEHENGA">SKIRT/LEHENGA</option>'+
                                                '<option value="SHIRTS / TUNICS">SHIRTS / TUNICS</option>'+
                                                '<option value="DRESSES/GOWNS">DRESSES/GOWNS</option>'+
                                                '<option value="PALAZZO/PANTS/SHARARA/LEGGINGS">PALAZZO/PANTS/SHARARA/LEGGINGS</option>'+
                                                '<option value="KURTIS/KURTA">KURTIS/KURTA</option>'+
                                                '<option value="CO-ORD SETS">CO-ORD SETS</option>'+
                                                '<option value="SAREE">SAREE</option>'+
                                                '<option value="JUMPSUIT">JUMPSUIT</option>'+
                                                '<option value="DUPATTA/SCARF/SHAWL">DUPATTA/SCARF/SHAWL</option>'+
                                                '<option value="DRESS MATERIAL">DRESS MATERIAL</option>'+
                                                '<option value="OTHER">OTHER</option>'+
                                                '<option value="N/A">N/A</option>'+

                                            '</select></td>' +
                                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +
                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }

                // html += '</select></td>' +

                '</tr>';

                return html;
            }

            var tableBody = $('#Details2-table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>

    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
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
