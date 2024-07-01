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

    @php
    $users = DB::table('users')->get();
@endphp



    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

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

            <form action="{{ route('field_visit_store') }}" method="POST" enctype="multipart/form-data">
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
                                        <input type="time" value="" name="time">
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
                                            <option value="W">W</option>
                                            <option value="AURELIA">AURELIA</option>
                                            <option value="JAYPORE">JAYPORE</option>
                                            <option value="GLOBAL DESI">GLOBAL DESI</option>
                                            <option value="FAB INDIA">FAB INDIA</option>
                                            <option value="BIBA">BIBA</option>
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
                                            <option value="CHAITANYA">CHAITANYA</option>
                                            <option value="REKHA">REKHA</option>
                                            <option value="SACHIN">SACHIN</option>
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
                                            <option value="EXTENSION OF SOUTH MUMBAI - PRABHADEVI TO MAHIM">EXTENSION OF
                                                SOUTH MUMBAI - PRABHADEVI TO MAHIM</option>
                                            <option value="WESTERN SUBURBS (A) - BANDRA TO SANTACRUZ">WESTERN SUBURBS (A) -
                                                BANDRA TO SANTACRUZ</option>
                                            <option value="WESTERN SUBURBS (B)- VILLE PARLE TO ANDHERI">WESTERN SUBURBS
                                                (B)- VILLE PARLE TO ANDHERI</option>
                                            <option value="WESTERN SUBURBS (C) - JOGESHWARI TO GOREGOAN">WESTERN SUBURBS
                                                (C) - JOGESHWARI TO GOREGOAN</option>
                                            <option value="WESTERN SUBURBS (D) - MALAD TO BORIVALI">WESTERN SUBURBS (D) -
                                                MALAD TO BORIVALI</option>
                                            <option value="NORTH MUMBAI - BEYOND BORIVALI UP TO VIRAR">NORTH MUMBAI -
                                                BEYOND BORIVALI UP TO VIRAR</option>
                                            <option value="EASTERN SUBURBS - CENTRAL MUMBAI">EASTERN SUBURBS - CENTRAL
                                                MUMBAI</option>
                                            <option value="HARBOUR SUBURBS - NAVI MUMBAI">HARBOUR SUBURBS - NAVI MUMBAI
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
                                            <option value="CHURCHGATE">CHURCHGATE</option>
                                            <option value="MARINE LINES">MARINE LINES</option>
                                            <option value="CHARNI ROAD">CHARNI ROAD</option>
                                            <option value="GRANT ROAD">GRANT ROAD</option>
                                            <option value="MUMBAI CENTRAL">MUMBAI CENTRAL</option>
                                            <option value="WORLI">WORLI</option>
                                            <option value="LOWER PAREL">LOWER PAREL</option>
                                            <option value="DADAR">DADAR</option>
                                            <option value="BANDRA">BANDRA</option>
                                            <option value="SANTACRUZ">SANTACRUZ</option>
                                            <option value="KHAR">KHAR</option>
                                            <option value="VILE PARLE">VILE PARLE</option>
                                            <option value="ANDHERI">ANDHERI</option>
                                            <option value="GOREGOAN">GOREGOAN</option>
                                            <option value="MALAD">MALAD</option>
                                            <option value="KANDIVALI">KANDIVALI</option>
                                            <option value="BORIVALI">BORIVALI</option>
                                            <option value="BHAYANDER">BHAYANDER</option>
                                            <option value="SEAWOODS">SEAWOODS</option>
                                            <option value="VASHI">VASHI</option>
                                            <option value="GHATKOPAR">GHATKOPAR</option>
                                            <option value="THANE">THANE</option>
                                            <option value="KALYAN">KALYAN</option>
                                            <option value="Other">Other</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="group-input">
                                    <label class="mt-4" for="EXACT STORE ADDRESS">EXACT STORE ADDRESS</label>
                                    <textarea class="summernote" name="exact_address" id="summernote-16"></textarea>
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
                                                <option value="AMBIENCE">AMBIENCE</option>
                                                <option value="STAFF OBSERVATION">STAFF OBSERVATION</option>
                                                <option value="SALE / MARKETING STRATEGY">SALE / MARKETING STRATEGY</option>
                                                <option value="PRODUCT OBSERVATION">PRODUCT OBSERVATION</option>
                                                <option value="VM & SPACE MANAGEMENT">VM & SPACE MANAGEMENT</option>
                                                <option value="BRANDING">BRANDING</option>
                                                <option value="TRIAL ROOMS">TRIAL ROOMS</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="group-input">
                                    <label class="mt-4" for="ANY REMARKS">ANY REMARKS</label>
                                    <p class="text-primary">Mention the flooring, curtains used, if any specific wallpaper / artistic objects are used to enhance the store vibe. Describe how the articles are kept on basis of the store (For eg., Left wall has kurtis in colour blocking, right wall has bottoms in another colour blocking, centre has accessories, end has trial rooms, cash counter has upselling items etc etc etc). </p>
                                    <textarea class="summernote" name="any_remarks" id="summernote-16"></textarea>
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
                                        <option value="AMBIENCE">AMBIENCE</option>
                                        <option value="STAFF OBSERVATION">STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY">SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION">PRODUCT OBSERVATION</option>
                                        <option value="VM & SPACE MANAGEMENT">VM & SPACE MANAGEMENT</option>
                                        <option value="BRANDING">BRANDING</option>
                                        <option value="TRIAL ROOMS">TRIAL ROOMS</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

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
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>

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
                                        <option value="0-2">0-2</option>
                                        <option value="2-5">2-5</option>
                                        <option value="5-7">5-7</option>
                                        <option value="ABOVE 7">ABOVE 7</option>

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
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                        <option value="NO CUSTOMER SEEN">NO CUSTOMER SEEN</option>


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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS ON STAFF OBSERVATION?</label>
                                <p class="text-primary">Describe the staff uniform and anything that requires to be noted down related to the store staff. </p>
                                <textarea class="summernote" name="remarks_on_staff_observation" id="summernote-16"></textarea>
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
                                        <option value="AMBIENCE">AMBIENCE</option>
                                        <option value="STAFF OBSERVATION">STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY">SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION">PRODUCT OBSERVATION</option>
                                        <option value="VM & SPACE MANAGEMENT">VM & SPACE MANAGEMENT</option>
                                        <option value="BRANDING">BRANDING</option>
                                        <option value="TRIAL ROOMS">TRIAL ROOMS</option>

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
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

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
                                        <option value="UPTO 20% - 30% OFF">UPTO 20% - 30% OFF</option>
                                        <option value="UPTO 50% - 70% OFF">UPTO 50% - 70% OFF</option>
                                        <option value="FLAT 20% - 30% OFF">FLAT 20% - 30% OFF</option>
                                        <option value="FLAT 50% - 70% OFF">FLAT 50% - 70% OFF</option>
                                        <option value="BUY TO GET">BUY TO GET</option>
                                        <option value="OTHER">OTHER</option>
                                        <option value="NONE">NONE</option>

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
                                        <option value="ONLY EXCHANGE">ONLY EXCHANGE</option>
                                        <option value="EXCHANGE OR RETURN">EXCHANGE OR RETURN</option>
                                        <option value="NO EXCHANGE NO RETURN">NO EXCHANGE NO RETURN</option>

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
                                        <option value="BIRTHDAY DISCOUNT">BIRTHDAY DISCOUNT</option>
                                        <option value="ANNIVERSARY DISCOUNT">ANNIVERSARY DISCOUNT</option>
                                        <option value="OTHER OCASSION">OTHER OCASSION</option>
                                        <option value="PREMIUM MEMBER DISCOUNT">PREMIUM MEMBER DISCOUNT</option>
                                        <option value="NONE">NONE</option>

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
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

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
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

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
                                        <option value="20-25">20-25</option>
                                        <option value="25-35">25-35</option>
                                        <option value="35-45">35-45</option>
                                        <option value="Above 45">Above 45</option>
                                        <option value="NO CUSTOMERS SEEN">NO CUSTOMERS SEEN</option>

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
                                        <option value="AVAILABLE">AVAILABLE</option>
                                        <option value="NOT AVAILABLE">NOT AVAILABLE</option>

                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS SALE / MARKETING STRATEGY?</label>
                                <p class="text-primary">Mention the offers if any. Also mention reward points rule. Describe if you feel anything is out of the box about marketing and sales strategy observed in this brand. Mention exchange days/deadline. </p>
                                <textarea class="summernote" name="any_remarks_sale" id="summernote-16"></textarea>
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
                                        <option value="AMBIENCE">AMBIENCE</option>
                                        <option value="STAFF OBSERVATION">STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY">SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION">PRODUCT OBSERVATION</option>
                                        <option value="BRANDING">BRANDING</option>
                                        <option value="TRIAL ROOMS">TRIAL ROOMS</option>
                                        <option value="VM & SPACE MANAGEMENT">VM & SPACE MANAGEMENT</option>

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
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

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
                                        <option value="LIGHT/PASTEL">LIGHT/PASTEL</option>
                                        <option value="DARK/DULL">DARK/DULL</option>
                                        <option value="MIX EQUALLY">MIX EQUALLY</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="XXS">XXS</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="2XL">2XL</option>
                                        <option value="3XL">3XL</option>
                                        <option value="4XL">4XL</option>
                                        <option value="5XL">5XL</option>

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
                                        Launch Deviation
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
                                            <td><input disabled type="text" name="details1[0][row]"
                                                    value="1"></td>
                                            <td><select type="text" name="details1[0][category]">
                                            <option value="">--Select Category--</option>
                                            <option value="SINGLE KURTA">SINGLE KURTA</option>
                                            <option value="KURTA SETS">KURTA SETS</option>
                                            <option value="SHIRTS / TUNICS">SHIRTS / TUNICS</option>
                                            <option value="SHORT DRESSES">SHORT DRESSES</option>
                                            <option value="LONG DRESSES">LONG DRESSES</option>
                                            <option value="BOTTOMS">BOTTOMS</option>
                                            <option value="INDO-WESTERN CO-ORD SET">INDO-WESTERN CO-ORD SET</option>
                                            <option value="JUMPSUIT">JUMPSUIT</option>
                                            <option value="DUPATTAS">DUPATTAS</option>
                                            <option value="LEHENGA">LEHENGA</option>
                                            <option value="SAREE">SAREE</option>
                                            <option value="JACKETS & SHRUGS">JACKETS & SHRUGS</option>
                                            <option value="DRESS MATERIAL">DRESS MATERIAL</option>
                                            <option value="FOOTWEAR">FOOTWEAR</option>
                                            <option value="JEWELLRY">JEWELLRY</option>
                                            <option value="HANDBAGS">HANDBAGS</option>
                                            <option value="FRAGRANCES">FRAGRANCES</option>
                                            <option value="SHAWL/ STOLE / SCARVES">SHAWL/ STOLE / SCARVES</option>
                                            <option value="NIGHT SUITS">NIGHT SUITS</option>
                                            <option value="BELTS & WALLETS">BELTS & WALLETS</option>
                                            </select></td>
                                            <td><select type="text" name="details1[0][price]">
                                                    <option value="">--Select Price--</option>
                                                    <option value="BELOW 500">BELOW 500</option>
                                                    <option value="500-2000">500-2000</option>
                                                    <option value="2100-5000">2100-5000</option>
                                                    <option value="5100-7000">5100-7000</option>
                                                    <option value="7100-9000">7100-9000</option>
                                                    <option value="9100-15000">9100-15000</option>
                                                    <option value="15100 & ABOVE">15100 & ABOVE</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tbody>

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
                                        <option value="LOWER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT">LOWER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT</option>
                                        <option value="HIGHER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT">HIGHER PRICED ITEMS WERE DISPLAYED AT THE STORE FRONT</option>
                                        <option value="MIX PRICE ITEMS WERE DISPLAYED AT THE STORE FRONT">MIX PRICE ITEMS WERE DISPLAYED AT THE STORE FRONT</option>
                                        <option value="DISCOUNT / SALE ITEMS WERE DISPLAYED AT THE STORE FRONT">DISCOUNT / SALE ITEMS WERE DISPLAYED AT THE STORE FRONT</option>

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
                                        <option value="APPAREL">APPAREL</option>
                                        <option value="HANDBAGS">HANDBAGS</option>
                                        <option value="FOOTWEAR">FOOTWEAR</option>
                                        <option value="COSMETICS & SKINCARE">COSMETICS & SKINCARE</option>
                                        <option value="HOME DECOR">HOME DECOR</option>
                                        <option value="ACCESSORIES">ACCESSORIES</option>
                                        <option value="OTHERS">OTHERS</option>

                                    </select>
                                </div>
                            </div>



                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Details
                                    <button type="button" name="details2" id="Details2-add">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                        Launch Deviation
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
                                            <td><input disabled type="text" name="details2[0][row]"
                                                    value="1"></td>
                                            <td><select type="text" name="details2[0][styles]">
                                            <option value="">--Select Category--</option>
                                            <option value="CASUAL WEAR">CASUAL WEAR</option>
                                            <option value="TRADITIONAL/CONTEMPORARY WEAR">TRADITIONAL/CONTEMPORARY WEAR</option>
                                            <option value="ETHNIC WEAR">ETHNIC WEAR</option>
                                            <option value="WESTERN WEAR">SHORT DRESSES</option>
                                            <option value="INDO-WESTERN WEAR">INDO-WESTERN WEAR</option>
                                            <option value="DESIGNER/OCCASION WEAR">DESIGNER/OCCASION WEAR</option>
                                            </select></td>
                                            <td><select type="text" name="details2[0][category]">
                                                    <option value="">--Select Price--</option>
                                                    <option value="TOP/TUNICS/SHIRTS">TOP/TUNICS/SHIRTS</option>
                                                    <option value="SKIRT/LEHENGA">SKIRT/LEHENGA</option>
                                                    <option value="SHIRTS / TUNICS">SHIRTS / TUNICS</option>
                                                    <option value="DRESSES/GOWNS">DRESSES/GOWNS</option>
                                                    <option value="PALAZZO/PANTS/SHARARA/LEGGINGS">PALAZZO/PANTS/SHARARA/LEGGINGS</option>
                                                    <option value="KURTIS/KURTA">KURTIS/KURTA</option>
                                                    <option value="CO-ORD SETS">CO-ORD SETS</option>
                                                    <option value="SAREE">SAREE</option>
                                                    <option value="JUMPSUIT">JUMPSUIT</option>
                                                    <option value="DUPATTA/SCARF/SHAWL">DUPATTA/SCARF/SHAWL</option>
                                                    <option value="DRESS MATERIAL">DRESS MATERIAL</option>
                                                    <option value="OTHER">OTHER</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
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
                                        <option value="100% COTTON">100% COTTON</option>
                                        <option value="100% POLYESTER">100% POLYESTER</option>
                                        <option value="100% VISCOSE">100% VISCOSE</option>
                                        <option value="COTTON POLY BLEND">COTTON POLY BLEND</option>
                                        <option value="100% LINEN">100% LINEN</option>
                                        <option value="VISCOSE BLEND">VISCOSE BLEND</option>
                                        <option value="SILK">SILK</option>
                                        <option value="POLYESTER BLEND">POLYESTER BLEND</option>
                                        <option value="CHIFFON / GEORGETTE">CHIFFON / GEORGETTE</option>
                                        <option value="LINEN BLEND">LINEN BLEND</option>
                                        <option value="OTHERS">OTHERS</option>

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
                                        <option value="SMALL FLORAL PRINTS">SMALL FLORAL PRINTS</option>
                                        <option value="BIG FLORAL PRINTS">BIG FLORAL PRINTS</option>
                                        <option value="GEOMETRIC PRINTS">GEOMETRIC PRINTS</option>
                                        <option value="AZTEC PRINTS">AZTEC PRINTS</option>
                                        <option value="TRADITIONAL PRINTS (PAISLEY / ELEPHANT MOTIFS ETC)">TRADITIONAL PRINTS (PAISLEY / ELEPHANT MOTIFS ETC)</option>
                                        <option value="PAINTING PRINTS">PAINTING PRINTS</option>
                                        <option value="ANIMAL PRINTS">ANIMAL PRINTS</option>
                                        <option value="ABSTRACT PRINTS">ABSTRACT PRINTS</option>
                                        <option value="ALL OVER PRINT">ALL OVER PRINT</option>
                                        <option value="PLACEMENT PRINT">PLACEMENT PRINT</option>
                                        <option value="OTHERS">OTHERS</option>

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
                                        <option value="THREAD WORK">THREAD WORK</option>
                                        <option value="APPLIQUE">APPLIQUE</option>
                                        <option value="BEAD WORK">BEAD WORK</option>
                                        <option value="STONE WORK AND ZARDOZI EMBROIDERY">STONE WORK AND ZARDOZI EMBROIDERY</option>
                                        <option value="HOME DECOR">HOME DECOR</option>
                                        <option value="ALL OVER EMBROIDERY">ALL OVER EMBROIDERY</option>
                                        <option value="PLACEMENT EMBROIDERY">PLACEMENT EMBROIDERY</option>
                                        <option value="OTHERS">OTHERS</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

                                    </select>
                                </div>
                            </div>


                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS ON PRODUCT OBSERVATION?</label>
                                <p class="text-primary">Mention any sub brands if offered, and anything worth to be noted in this section. </p>
                                <textarea class="summernote" name="remarks_on_product_observation" id="summernote-16"></textarea>
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
                                        <option value="AMBIENCE">AMBIENCE</option>
                                        <option value="STAFF OBSERVATION">STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY">SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION">PRODUCT OBSERVATION</option>
                                        <option value="VM & SPACE MANAGEMENT">VM & SPACE MANAGEMENT</option>
                                        <option value="BRANDING">BRANDING</option>
                                        <option value="TRIAL ROOMS">TRIAL ROOMS</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="LIMITED SIZES ARE DISPLAYED ON RACKS">LIMITED SIZES ARE DISPLAYED ON RACKS</option>
                                        <option value="ALL SIZES ARE DISPLAYED TOGETHER ON THE SAME RACK">ALL SIZES ARE DISPLAYED TOGETHER ON THE SAME RACK</option>
                                        <option value="ALL SIZES ARE DISPLAYED BUT ON DIFFERENT RACKS">ALL SIZES ARE DISPLAYED BUT ON DIFFERENT RACKS</option>
                                        <option value="OTHERS">OTHERS</option>
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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="0-2">0-2</option>
                                        <option value="3-4">3-4</option>
                                        <option value="3">3</option>
                                        <option value="MORE THAN 4">MORE THAN 4</option>

                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS ON VM / SPACE MANAGEMENT</label>
                                <p class="text-primary">Mention the colours/prints/styles displayed at the entrance of the store, describe the alignment of the store (what's kept on the left side of the store, what's on the right side etc). Also mention if you feel the store is well spaced or not, meaning if the space is properly utilized or over utilized or under utilized. Describe anything else that's relevant to this section. </p>
                                <textarea class="summernote" name="any_remarks_on_vm" id="summernote-16"></textarea>
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
                                        <option value="AMBIENCE">AMBIENCE</option>
                                        <option value="STAFF OBSERVATION">STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY">SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION">PRODUCT OBSERVATION</option>
                                        <option value="BRANDING">BRANDING</option>
                                        <option value="TRIAL ROOMS">TRIAL ROOMS</option>
                                        <option value="VM & SPACE MANAGEMENT">VM & SPACE MANAGEMENT</option>

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
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
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
                                        <option value="DIGITAL ONLY">DIGITAL ONLY</option>
                                        <option value="PAPER PRINTED BILL">PAPER PRINTED BILL</option>
                                        <option value="DIGITAL AND PAPER PRINTED BOTH">DIGITAL AND PAPER PRINTED BOTH</option>
                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS ON BRANDING?</label>
                                <p class="text-primary">If you see a tagline then mention it here. Add anything else that you feel is worthy to be noted about Branding here. </p>
                                <textarea class="summernote" name="any_ramrks_on_the_branding" id="summernote-16"></textarea>
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
                                        <option value="AMBIENCE">AMBIENCE</option>
                                        <option value="STAFF OBSERVATION">STAFF OBSERVATION</option>
                                        <option value="SALE / MARKETING STRATEGY">SALE / MARKETING STRATEGY</option>
                                        <option value="PRODUCT OBSERVATION">PRODUCT OBSERVATION</option>
                                        <option value="BRANDING">BRANDING</option>
                                        <option value="TRIAL ROOMS">TRIAL ROOMS</option>
                                        <option value="VM & SPACE MANAGEMENT">VM & SPACE MANAGEMENT</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="MORE THAN 4">MORE THAN 4</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="NO QUEUE">NO QUEUE</option>
                                        <option value="LESS THAN 2">LESS THAN 2</option>
                                        <option value="2-5 PEOPLE">2-5 PEOPLE</option>
                                        <option value="5 AND ABOVE">5 AND ABOVE</option>

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
                                        <option value="FULL LENGTH - 4 SIDES">FULL LENGTH - 4 SIDES</option>
                                        <option value="FULL LENGTH - 3 SIDES">FULL LENGTH - 3 SIDES</option>
                                        <option value="FULL LENGTH -2 SIDES">FULL LENGTH -2 SIDES</option>
                                        <option value="FULL LENGTH - 1 SIDE">FULL LENGTH - 1 SIDE</option>
                                        <option value="HALF MIRROR">HALF MIRROR</option>

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

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
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>

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
                                        <option value="NOT AVAILABLE">NOT AVAILABLE</option>
                                        <option value="1 SEATER">1 SEATER</option>
                                        <option value="2 SEATER COUCH">2 SEATER COUCH</option>
                                        <option value="3 SEATER COUCH">3 SEATER COUCH</option>
                                        <option value="MULTIPLE SEATER COUCH">MULTIPLE SEATER COUCH</option>

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
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>

                                    </select>
                                </div>
                            </div>

                            <div class="group-input">
                                <label class="mt-4" for="ANY REMARKS">ANY REMARKS  ON THE TRIAL ROOM ?</label>
                                <p class="text-primary">Mention the cleanliness and space in the trial room. Also if the trial room has any specific decor like planters or wall displays or anything else.</p>
                                <textarea class="summernote" name="any_remarks_on_the_trail_room" id="summernote-16"></textarea>
                            </div>
                        </div>


                        <div class="group-input">
                            <label class="mt-4" for="ANY REMARKS">ANY REMARKS / COMMENTS ADD ON THE OVERALL STORE?</label>
                            {{-- <p class="text-primary">If you see a tagline then mention it here. Add anything else that you feel is worthy to be noted about Branding here. </p> --}}
                            <textarea class="summernote" name="comments_on_hte_overall_store" id="summernote-16"></textarea>
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
            $('#Details1-add').click(function(e) {

                e.preventDefault();

                function generateTableRow(serialNumber) {
                    var html = '<tr>' +
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
