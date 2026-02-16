@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header .header_rcms_bottom ,.container-fluid.header-bottom,.search-bar{
                    display: none;
                }

        #change-control-fields>div.container-fluid>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div.bg-danger {
            border-radius: 0px 20px 20px 0px;
        }

        .main-danger-block {
            display: flex;
        }

        .swal-modal {
            scale: 0.7 !important;
        }

        .whyblock-bottom {
            margin-bottom: 10px;
        }

        .swal-icon {
            scale: 0.8 !important;
        }
    </style>


    @php
        $users = DB::table('users')->get();
    @endphp
    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }} / Market Complaint
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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


    {{-- @if (Session::has('swal'))
        <script>
            swal("{{ Session::get('swal')['title'] }}", "{{ Session::get('swal')['message'] }}",
                "{{ Session::get('swal')['type'] }}")
        </script>
    @endif --}}

    @if (Session::has('swal'))
        <script>
            swal("{{ Session::get('swal')['title'] }}", "{{ Session::get('swal')['message'] }}",
                "{{ Session::get('swal')['type'] }}")
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#Monitor_Information').click(function(e) {
                function generateTableRow(serialNumber) {

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="date" name="date[]"></td>' +
                        ' <td><input type="text" name="Responsible[]"></td>' +
                        '<td><input type="text" name="ItemDescription[]"></td>' +
                        '<td><input type="date" name="SentDate[]"></td>' +
                        '<td><input type="date" name="ReturnDate[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +
                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Monitor_Information_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#Product_Material').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="ProductName[]"></td>' +
                        '<td><input type="number" name="ReBatchNumber[]"></td>' +
                        '<td><input type="date" name="ExpiryDate[]"></td>' +
                        '<td><input type="date" name="ManufacturedDate[]"></td>' +
                        '<td><input type="text" name="Disposition[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Product_Material_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#Equipment').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="ProductName[]"></td>' +
                        '<td><input type="number" name="BatchNumber[]"></td>' +
                        '<td><input type="date" name="ExpiryDate[]"></td>' +
                        '<td><input type="date" name="ManufacturedDate[]"></td>' +
                        '<td><input type="number" name="NumberOfItemsNeeded[]"></td>' +
                        '<td><input type="text" name="Exist[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Equipment_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(8) {
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

                    <div class="d-flex" style="gap:20px;">
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        @php
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                                ->get();
                            // dd($userRoles);

                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                            $cftRolesAssignUsers = collect($userRoleIds); //->contains(fn ($roleId) => $roleId >= 22 && $roleId <= 33);
                            $cftUsers = DB::table('market_complaint_cfts')
                                ->where(['mc_id' => $data->id])
                                ->first();

                            // Define the column names
                            $columns = [
                                'Production_Table_Person',
                                'Production_Injection_Person',
                                'ResearchDevelopment_person',
                                'Store_person',
                                'Quality_Control_Person',
                                'QualityAssurance_person',
                                'RegulatoryAffair_person',
                                'ProductionLiquid_person',
                                'Microbiology_person',
                                'Engineering_person',
                                'ContractGiver_person',
                                'Environment_Health_Safety_person',
                                'Human_Resource_person',
                                'CorporateQualityAssurance_person',
                            ];

                            // Initialize an array to store the values
                            $valuesArray = [];

                            // Iterate over the columns and retrieve the values
                            foreach ($columns as $column) {
                                $value = $cftUsers->$column;
                                // Check if the value is not null and not equal to 0
                                if ($value !== null && $value != 0) {
                                    $valuesArray[] = $value;
                                }
                            }
                            $cftCompleteUser = DB::table('market_complaintcft_responces')
                                ->whereIn('status', ['In-progress', 'Completed'])
                                ->where('mc_id', $data->id)
                                ->where('cft_user_id', Auth::user()->id)
                                ->whereNull('deleted_at')
                                ->first();
                        @endphp
                        <a class="text-white"
                            href="{{ route('marketcomplaint.MarketComplaintAuditReport', $data->id) }}"><button
                                class="button_theme1"> Audit Trail
                            </button> </a>
                        @if (
                            $data->stage == 1 &&
                                (Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18)))
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    Submit
                                </button>


                        @elseif(
                            $data->stage == 2 &&
                                (Helpers::check_roles($data->division_id, 'Market Complaint', 9) ||
                                 Helpers::check_roles($data->division_id, 'Market Complaint', 42) ||
                                  Helpers::check_roles($data->division_id, 'Market Complaint', 43) ||
                                  Helpers::check_roles($data->division_id, 'Market Complaint', 39) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 65) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18)))
                            <a href="#rejection-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#rejection-modal">
                                    More Information Required
                                </button></a>
                            <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    Complete Review
                                </button></a>
                            <a href="#cancel-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#cancel-modal">
                                    Cancel
                                </button></a>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                                Child
                            </button>
                        @elseif(
                            $data->stage == 3 &&
                                (Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18)))
                            <a href="#rejection-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#rejection-modal">
                                    More Information Required
                                </button></a>
                            <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    Send To CFT
                                </button></a>
                            {{-- <a href="#signature-modal"></a> --}}
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>


                        @elseif(
                            $data->stage == 4 && (Helpers::check_roles($data->division_id, 'Market Complaint', 5) ||
                                in_array(Auth::user()->id, $valuesArray)))
                               @if (!$cftCompleteUser || $cftCompleteUser->status == 'Pending')


                            <a href="#rejection-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#rejection-modal">
                                    More Information Required
                                </button></a>

                            <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    CFT Review Complete
                                </button></a>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                                Child
                            </button>
                            @endif
                        @elseif(
                            $data->stage == 5 &&
                                (Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18)))
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    QA/CQA Verification complete
                                </button></a>
                            <a href="#rejection-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#rejection-modal">
                                    More Information Required
                                </button></a>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                                Child
                            </button>
                        @elseif(
                            $data->stage == 6 &&
                                (Helpers::check_roles($data->division_id, 'Market Complaint', 9) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 39) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 42) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 43) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 65) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18)))
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    Approval Complete
                                </button></a>
                            <a href="#rejection-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#rejection-modal">
                                    More Information Required
                                </button></a>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                                Child
                            </button>
                        @elseif(
                            $data->stage == 7 &&
                                (Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18)))
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    Send Letter
                                </button></a>
                            {{-- <a href="#rejection-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="">
                                Reopen
                            </button></a> --}}

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal2">
                                Child
                            </button>
                        @elseif(
                            $data->stage == 8 &&
                                (Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18)))
                            {{-- <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send Letter
                            </button></a> --}}
                            <a href="{{ route('marketcomplaint.market_complaint_new') }}"><button class="button_theme1"
                                    data-bs-toggle="modal" data-bs-target="">
                                    Reopen
                                </button></a>


                        @endif

                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                Exit
                            </a> </button>


                    </div>

                </div>

                <!-------------------------- end Modal-------------------->
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

                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars  ">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex" style="font-size: 15px;">
                            @php
                                $currentStage = $data->stage;
                            @endphp
                                                    
                            <div class="{{ $currentStage > 1 ? 'active' : ($currentStage == 1 ? 'current' : '') }}">Opened</div>

                            <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">QA/CQA Head Review</div>

                            <div class="{{ $currentStage > 3 ? 'active' : ($currentStage == 3 ? 'current' : '') }}">Investigation CAPA And Root Cause Analysis</div>

                            <div class="{{ $currentStage > 4 ? 'active' : ($currentStage == 4 ? 'current' : '') }}">CFT Review</div>

                            <div class="{{ $currentStage > 5 ? 'active' : ($currentStage == 5 ? 'current' : '') }}">All Action Completion Verification by QA/CQA </div>

                            <div class="{{ $currentStage > 6 ? 'active' : ($currentStage == 6 ? 'current' : '') }}">QA/CQA Head Approval</div>

                            <div class="{{ $currentStage > 7 ? 'active' : ($currentStage == 7 ? 'current' : '') }}">Pending Response Letter</div>
                            @if ($data->stage >= 8)
                                <div class="bg-danger">Closed-Done</div>
                            @else
                                <div class="">Closed-Done</div>
                            @endif

                    @endif

                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>


        <script>
            console.log('Script working')

            $(document).ready(function() {


                function submitForm() {

                    let auditForm = document.getElementById('auditForm');


                    console.log('sumitting form')

                    document.querySelectorAll('.saveAuditFormBtn').forEach(function(button) {
                        button.disabled = true;
                    })

                    document.querySelectorAll('.auditFormSpinner').forEach(function(spinner) {
                        spinner.style.display = 'flex';
                    })

                    auditForm.submit();
                }

                $('#ChangesaveButton01').click(function() {
                    document.getElementById('formNameField').value = 'general-open';
                    submitForm();
                });

                $('#ChangesaveButton02').click(function() {
                    document.getElementById('formNameField').value = 'qacqa';
                    submitForm();
                });
                $('#ChangesaveButton02221').click(function() {
                    document.getElementById('formNameField').value = 'pending';
                    submitForm();
                });
                $('#ChangesaveButton02222').click(function() {
                    document.getElementById('formNameField').value = 'hod final';
                    submitForm();
                });

                $('#ChangesaveButton03').click(function() {
                    document.getElementById('formNameField').value = 'qa';
                    submitForm();
                });

                $('#ChangesaveButton04').click(function() {
                    document.getElementById('formNameField').value = 'capa';
                    submitForm();
                });
                $('#ChangesaveButton022').click(function() {
                    document.getElementById('formNameField').value = 'qrm';
                    submitForm();
                });
                $('#ChangesaveButton023').click(function() {
                    document.getElementById('formNameField').value = 'inv';
                    submitForm();
                });

                $('#ChangesaveButton05').click(function() {
                    document.getElementById('formNameField').value = 'qa-final';
                    submitForm();
                });

                $('#ChangesaveButton06').click(function() {
                    document.getElementById('formNameField').value = 'qah';
                    submitForm();
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var signatureForm = document.getElementById('signatureModalForm');

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.signatureModalButton');
                    var spinner = signatureForm.querySelector('.signatureModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var signatureForm = document.getElementById('pendingInitiatorForm');

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.pendingInitiatorModalButton');
                    var spinner = signatureForm.querySelector('.pendingInitiatorModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });


            // =========================
            wow = new WOW({
                boxClass: 'wow', // default
                animateClass: 'animated', // default
                offset: 0, // default
                mobile: true, // default
                live: true // default
            })
            wow.init();
        </script>


        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Complaint Acknowledgement</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA/CQA Head Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Investigation CAPA And Root Cause Analysis</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">CFT Review</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Verification by QA/CQA</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">QA/CQA Head Approval</button>

            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Closure</button>

            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Activity Log</button>

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
                    tabToActivate = 'CCForm3'; 
                }  else if (stage == 3) {
                    tabToActivate = 'CCForm4'; 
                } else if (stage == 4) {
                    tabToActivate = 'CCForm5'; 
                } else if (stage == 5) {
                    tabToActivate = 'CCForm6'; 
                } else if (stage == 6) {
                    tabToActivate = 'CCForm7'; 
                } else if (stage == 7) {
                    tabToActivate = 'CCForm8'; 
                } else if (stage == 8) {
                    tabToActivate = 'CCForm9'; 
                } else if (stage == 0) {
                    tabToActivate = 'CCForm9'; 
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

        <form action="{{ route('marketcomplaint.marketcomplaintupdate', $data->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="form_name" id="formNameField" value="">
            @method('put')
            <div id="step-form">
                @if (!empty($parent_id))
                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <!-- Tab content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            General Information
                        </div> <!-- RECORD NUMBER -->
                        <div class="row">

                            @php
                                $getDiv = Helpers::getDivisionName($data->division_id);
                                // $substract = strtoupper(Str::substr($getDiv, 0, 2));

                                $istab1 = (Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18));
                                   
                            @endphp
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number"><b>Record Number</b></label>
                                    <input disabled type="text" name="record" id="record"
                                        value="{{ $getDiv }}/MC/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                    {{-- <input disabled type="text" name="record" id="record" value="MC/{{ $substract }}/{{ date('y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}"> --}}

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Division Code"><b>Site / Location </b></label>
                                    <input disabled type="text" name="division_code"
                                        value="{{ Helpers::getDivisionName($data->division_id) }}">
                                    <input type="hidden" name="division_id" value="{{ $data->division_id }}">

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="originator">Initiator</label>
                                    <input disabled type="text" name="initiator" value="{{ Auth::user()->name }}" />
                                </div>
                            </div>

                            
                            <div class="col-lg-6">
                                    <div class="group-input">
                                    <label for="Date Due">Date of Initiation</label>
                                    <input readonly type="text"
                                        value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                        name="intiation_date"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>

                                </div>
                            </div>

                            
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Short Description">Short Description @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <span id="rchars">255</span> Characters remaining
                                    <input name="description_gi"
                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} id="docname"
                                        required value="{{ $data->description_gi }}" maxlength="255">

                                </div>
                            </div>


                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Audit Schedule Start Date">Due Date<span
                                    class="text-danger">*</span></label>
                                        <div class="calenderauditee">
                                        <input type="text"  id="due_dateq"  placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->due_date_gi) }}"
                                            {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}/>
                                        <input type="date" id="due_dateq" name="due_date_gi"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} value="{{ $data->due_date_gi }}" class="hide-input"
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

                                <style>
                                .hide-input {
                                    display: none;
                                }
                            </style>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator"><b>Initiator Department</b></label>
                                    <input readonly type="text" name="Initiator_Group" id="initiator_group"
                                        value="{{ $data->initiator_group  }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiation Group Code">Initiator Department Code</label>
                                    <input type="text" name="initiator_group_code_gi"
                                        value="{{ $data->initiator_group_code_gi }}" id="initiator_group_code"
                                        readonly>
                                </div>
                            </div>

                            <script>
                                document.getElementById('initiator_group').addEventListener('change', function() {
                                    var selectedValue = this.value;
                                    document.getElementById('initiator_group_code_gi').value = selectedValue;
                                });
                            </script>

                           
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Information Attachment</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_gi">


                                            @if ($data->initial_attachment_gi)
                                                @foreach (json_decode($data->initial_attachment_gi) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file1"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                        <input type="hidden" name="existing_initial_attachments_gi[]"
                                                            value="{{ $file }}">

                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file"
                                                id="initial_attachment_gi" {{ $data->stage == 1 && $istab1 ? '' : 'disabled' }}
                                                name="initial_attachment_gi[]"
                                                oninput="addMultipleFiles(this,'initial_attachment_gi')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="deleted_attachments_gi" name="deleted_attachments_gi"
                                value="">

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const removeButtons = document.querySelectorAll('.remove-file1');

                                    removeButtons.forEach(button => {
                                        button.addEventListener('click', function() {
                                            const fileName = this.getAttribute('data-file-name');
                                            const fileContainer = this.closest('.file-container');

                                            // Hide the file container
                                            if (fileContainer) {
                                                fileContainer.style.display = 'none';
                                                // Remove hidden input associated with this file
                                                const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                if (hiddenInput) {
                                                    hiddenInput.remove();
                                                }

                                                // Add the file name to the deleted files list
                                                const deletedFilesInput = document.getElementById('deleted_attachments_gi');
                                                let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                    ',') : [];
                                                deletedFiles.push(fileName);
                                                deletedFilesInput.value = deletedFiles.join(',');
                                            }
                                        });
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="complainant_gi">Complainant @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <textarea name="complainant_gi" class="form-control" {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required>{{ $data->complainant_gi }}</textarea>
                                </div>
                            </div>




                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Due Date">Complaint Reported On
                                     @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                    </label>

                                    <div class="calenderauditee">
                                        @php
                                            // Set formattedDate to an empty string if due_date is not set
                                            $formattedDate = str_contains(
                                                'NaN-undefined-NaN',
                                                $data->complaint_reported_on_gi,
                                            )
                                                ? ''
                                                : $data->complaint_reported_on_gi;
                                        @endphp

                                        <input
                                            type="text" 
                                            id="complaint_dat" name="complaint_reported_on_gi"
                                            placeholder="Select Due Date"
                                            value="{{ Helpers::getdateFormat($formattedDate) }}" />
                                    </div>
                                    {{-- <script>
                                        $(document).ready(function() {
                                            $("#complaint_dat").datepicker({
                                                dateFormat: "dd-M-yy",
                                                onClose: function(dateText, inst) {
                                                    if (!dateText) {
                                                        $(this).val('');
                                                    }
                                                }
                                            });

                                            $("#complaint_dat").on('keydown', function(e) {
                                                e.preventDefault();
                                            });
                                        });
                                    </script> --}}
                                    <script>
                                        $(document).ready(function () {

                                            // init datepicker
                                            $("#complaint_dat").datepicker({
                                                dateFormat: "dd-M-yy",
                                                onClose: function (dateText) {
                                                    if (!dateText) {
                                                        $(this).val('');
                                                    }
                                                }
                                            });

                                            // 🔐 STAGE + ROLE CHECK
                                            @if(!($data->stage == 1 && $istab1))
                                                // disable datepicker
                                                $("#complaint_dat").datepicker("readonly");

                                                // hard readonly
                                                $("#complaint_dat")
                                                    .prop("readonly", true)
                                                    .addClass("bg-light");
                                            @endif

                                        });
                                    </script>
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Review of Control Sample">Details of Nature of Market Complaint  @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="details_of_nature_market_complaint_gi"  id="summernote-1">{{ trim($data->details_of_nature_market_complaint_gi) }} </textarea>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Product Details
                                         @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                        <button type="button" id="Details"
                                        {{ $data->stage == 1 && $istab1 ? '' : 'disabled' }}>+</button>
                                    </label>
                                    <table class="table table-bordered" id="ProductsDetails" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">Sr. No.</th>
                                        <th>Product Name</th>
                                        <th>Batch No.</th>
                                        <th>Mfg. Date</th>
                                        <th>Exp. Date</th>
                                        <th>Batch Size</th>
                                        <th>Pack Size</th>
                                        <th>Dispatch Quantity</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $productsdetails = 1; @endphp
                                    @if (!empty($productsgi) && is_array($productsgi->data))
                                        @foreach ($productsgi->data as $index => $detail)
                                            <tr>
                                                <td>{{ $productsdetails++ }}</td>
                                                <td><input type="text"
                                                        name="serial_number_gi[{{ $index }}][info_product_name]"
                                                        value="{{ $detail['info_product_name'] ?? '' }}"
                                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required></td>
                                                <td><input type="text"
                                                        name="serial_number_gi[{{ $index }}][info_batch_no]"
                                                        value="{{ $detail['info_batch_no'] ?? '' }}"
                                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required></td>
                                                <td>
                                                    <div class="new-date-data-field">
                                                        <div class="group-input input-date">
                                                            <div class="calenderauditee">
                                                                <input
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}
                                                                    class="click_date"
                                                                    id="text_date_{{ $index }}_info_mfg_date"
                                                                    type="text"
                                                                    name="serial_number_gi[{{ $index }}][info_mfg_date]"
                                                                    placeholder="DD-MMM-YYYY"
                                                                    value="{{ !empty($detail['info_mfg_date']) ? \Carbon\Carbon::parse($detail['info_mfg_date'])->format('d-M-Y') : '' }}"
                                                                    readonly
                                                                    onclick="document.getElementById('date_{{ $index }}_info_mfg_date').click();" />
                                                                <input type="date"
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}
                                                                    name="serial_number_gi[{{ $index }}][info_mfg_date]"
                                                                    value="{{ !empty($detail['info_mfg_date']) ? \Carbon\Carbon::parse($detail['info_mfg_date'])->format('Y-m-d') : '' }}"
                                                                    id="date_{{ $index }}_info_mfg_date"
                                                                    class="hide-input show_date"
                                                                    style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                    onchange="handleDateInput(this, 'text_date_{{ $index }}_info_mfg_date')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="new-date-data-field">
                                                        <div class="group-input input-date">
                                                            <div class="calenderauditee">
                                                                <input
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}
                                                                    class="click_date"
                                                                    id="text_date_{{ $index }}_info_expiry_date"
                                                                    type="text"
                                                                    name="serial_number_gi[{{ $index }}][info_expiry_date]"
                                                                    placeholder="DD-MMM-YYYY"
                                                                    value="{{ !empty($detail['info_expiry_date']) ? \Carbon\Carbon::parse($detail['info_expiry_date'])->format('d-M-Y') : '' }}"
                                                                    readonly
                                                                    onclick="document.getElementById('date_{{ $index }}_info_expiry_date').click();" />
                                                                <input type="date"
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}
                                                                    name="serial_number_gi[{{ $index }}][info_expiry_date]"
                                                                    value="{{ !empty($detail['info_expiry_date']) ? \Carbon\Carbon::parse($detail['info_expiry_date'])->format('Y-m-d') : '' }}"
                                                                    id="date_{{ $index }}_info_expiry_date"
                                                                    class="hide-input show_date"
                                                                    style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                    onchange="handleDateInput(this, 'text_date_{{ $index }}_info_expiry_date')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="text"
                                                        name="serial_number_gi[{{ $index }}][info_batch_size]"
                                                        value="{{ $detail['info_batch_size'] ?? '' }}"
                                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required></td>
                                                <td><input type="text"
                                                        name="serial_number_gi[{{ $index }}][info_pack_size]"
                                                        value="{{ $detail['info_pack_size'] ?? '' }}"
                                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required></td>
                                                <td><input type="text"
                                                        name="serial_number_gi[{{ $index }}][info_dispatch_quantity]"
                                                        value="{{ $detail['info_dispatch_quantity'] ?? '' }}"
                                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required></td>
                                                <td><input type="text"
                                                        name="serial_number_gi[{{ $index }}][info_remarks]"
                                                        value="{{ $detail['info_remarks'] ?? '' }}"
                                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required></td>
                                                <td><button type="button" class="removeRowBtn" {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}>Remove</button></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">No product details found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    let indexDetail = {{ $productsgi && is_array($productsgi->data) ? count($productsgi->data) : 0 }};

                                    $('#Details').click(function (e) {
                                        e.preventDefault();

                                        function generateTableRow(serialNumber) {
                                            let html =
                                                '<tr>' +
                                                '<td>' + (serialNumber + 1) + '</td>' +
                                                '<td><input type="text" name="serial_number_gi[' + indexDetail + '][info_product_name]"></td>' +
                                                '<td><input type="text" name="serial_number_gi[' + indexDetail + '][info_batch_no]"></td>' +
                                                '<td><div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee">' +
                                                '<input id="text_date_' + indexDetail + '_info_mfg_date" type="text" name="serial_number_gi[' + indexDetail +
                                                '][info_mfg_date]" placeholder="DD-MMM-YYYY" readonly onclick="document.getElementById(\'date_' + indexDetail +
                                                '_info_mfg_date\').click();" />' +
                                                '<input type="date" name="serial_number_gi[' + indexDetail + '][info_mfg_date]"' +
                                                    'id="date_' + indexDetail + '_info_mfg_date" class="hide-input show_date"' +
                                                    ' style="position: absolute; top: 0; left: 0; opacity: 0;"' +
                                                    'onchange="handleDateInput(this, \'text_date_' + indexDetail + '_info_mfg_date\'); setExpiryMinDateDynamic(' + indexDetail + ');" />' +
                                                '</div></div></div></td>' +
                                                '<td><div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee">' +
                                                '<input id="text_date_' + indexDetail + '_info_expiry_date" type="text" name="serial_number_gi[' + indexDetail +
                                                '][info_expiry_date]" placeholder="DD-MMM-YYYY" readonly onclick="document.getElementById(\'date_' + indexDetail +
                                                '_info_expiry_date\').click();" />' +
                                                '<input type="date" name="serial_number_gi[' + indexDetail + '][info_expiry_date]"' +
                                                ' id="date_' + indexDetail + '_info_expiry_date" class="hide-input show_date"' +
                                                ' style="position: absolute; top: 0; left: 0; opacity: 0;"' +
                                                ' onchange="handleDateInput(this, \'text_date_' + indexDetail + '_info_expiry_date\')" />' +
                                                '</div></div></div></td>' +
                                                '<td><input type="text" name="serial_number_gi[' + indexDetail + '][info_batch_size]"></td>' +
                                                '<td><input type="text" name="serial_number_gi[' + indexDetail + '][info_pack_size]"></td>' +
                                                '<td><input type="text" name="serial_number_gi[' + indexDetail + '][info_dispatch_quantity]"></td>' +
                                                '<td><input type="text" name="serial_number_gi[' + indexDetail + '][info_remarks]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';

                                            indexDetail++;
                                            return html;
                                        }

                                        const tableBody = $('#ProductsDetails tbody');
                                        const rowCount = tableBody.children('tr').length;
                                        const newRow = generateTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    $(document).on('click', '.removeRowBtn', function () {
                                        $(this).closest('tr').remove();
                                    });
                                });

                                function handleDateInput(dateInput, textInputId) {
                                    const date = new Date(dateInput.value);
                                    const formattedDate = date.toLocaleDateString('en-GB', {
                                        day: '2-digit',
                                        month: 'short',
                                        year: 'numeric'
                                    }).replace(/ /g, '-');
                                    document.getElementById(textInputId).value = formattedDate;
                                }
                            </script>

                            <script>
                                function handleStartDateChange(startDateInput, endDateInputId) {
                                    const selectedStartDate = new Date(startDateInput.value); // Get the selected start date
                                    const endDateInput = document.getElementById(endDateInputId);

                                    // Set the minimum date of end date to be one day after the start date
                                    if (startDateInput.value) {
                                        selectedStartDate.setDate(selectedStartDate.getDate() + 1); // Increment the date by one day
                                        const minDate = selectedStartDate.toISOString().split('T')[0]; // Format date as YYYY-MM-DD
                                        endDateInput.min = minDate; // Set min attribute of end date input

                                        // If end date is before the new min date, reset it
                                        if (endDateInput.value && new Date(endDateInput.value) < selectedStartDate) {
                                            endDateInput.value = '';
                                        }
                                    } else {
                                        endDateInput.min = ""; // Reset the min value if no start date is selected
                                    }
                                }

                                // Attach the event to existing start date inputs (optional depending on your initialization)
                                document.querySelectorAll('input[name*="[info_mfg_date]"]').forEach(startDateInput => {
                                    const index = startDateInput.id.split('_')[1]; // Extract index from the ID
                                    const endDateInputId = `date_${index}_info_expiry_date`;
                                    startDateInput.addEventListener('change', () => handleStartDateChange(startDateInput, endDateInputId));
                                });
                            </script>
                            <script>
                                function setExpiryMinDateDynamic(index) {
                                    const mfgDateInput = document.getElementById('date_' + index + '_info_mfg_date');
                                    const expiryDateInput = document.getElementById('date_' + index + '_info_expiry_date');

                                    if (mfgDateInput && expiryDateInput) {
                                        const mfgDate = mfgDateInput.value;
                                        if (mfgDate) {
                                            expiryDateInput.min = mfgDate;

                                            // Optional: reset expiry if it's before MFG
                                            if (expiryDateInput.value && expiryDateInput.value < mfgDate) {
                                                expiryDateInput.value = '';
                                                const visibleExpiryInput = document.getElementById('text_date_' + index + '_info_expiry_date');
                                                if (visibleExpiryInput) visibleExpiryInput.value = '';
                                            }
                                        }
                                    }
                                }

                            </script>


                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Traceability
                                         @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                        <button type="button" id="traceblity_add"
                                            {{ $data->stage == 1 && $istab1 ? '' : 'disabled' }}>+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="traceblity" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Product Name</th>
                                                    <th>Batch No.</th>
                                                    <th>Manufacturing Location</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $traceabilityIndex = 1;
                                                @endphp
                                                {{-- @if (!empty($traceability_gi)) --}}
                                                @if (!empty($traceability_gi) && is_array($traceability_gi->data))
                                                    @foreach ($traceability_gi->data as $index => $tracebil)
                                                        <tr>
                                                            <td><input disabled type="text"
                                                                    name="trace_ability[{{ $index }}][serial]"
                                                                    value="{{ $traceabilityIndex++ }}"
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required>
                                                            </td>
                                                            <td><input type="text"
                                                                    name="trace_ability[{{ $index }}][product_name_tr]"
                                                                    value="{{ $tracebil['product_name_tr'] }}"
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required>
                                                            </td>
                                                            <td><input type="text"
                                                                    name="trace_ability[{{ $index }}][batch_no_tr]"
                                                                    value="{{ $tracebil['batch_no_tr'] }}"
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required>
                                                            </td>
                                                            <td><input type="text"
                                                                    name="trace_ability[{{ $index }}][manufacturing_location_tr]"
                                                                    value="{{ $tracebil['manufacturing_location_tr'] }}"
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required>
                                                            </td>
                                                            <td><input type="text"
                                                                    name="trace_ability[{{ $index }}][remarks_tr]"
                                                                    value="{{ $tracebil['remarks_tr'] }}"
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required>
                                                            </td>
                                                            <td><button type="text"
                                                                    class="removeRowBtn"{{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}>Remove</button>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    {{-- <tr>
                                                        <td colspan="5">No found</td>
                                                    </tr> --}}
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#traceblity_add').click(function(e) {
                                        e.preventDefault();

                                        function generateTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="trace_ability[' + serialNumber +
                                                '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="trace_ability[' + serialNumber +
                                                '][product_name_tr]"></td>' +
                                                '<td><input type="text" name="trace_ability[' + serialNumber +
                                                '][batch_no_tr]"></td>' +
                                                '<td><input type="text" name="trace_ability[' + serialNumber +
                                                '][manufacturing_location_tr]"></td>' +
                                                '<td><input type="text" name="trace_ability[' + serialNumber +
                                                '][remarks_tr]"></td>' +
                                                '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +

                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#traceblity tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });
                                });
                            </script>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Initiator Group">Categorization of complaint
                                     @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                    </label>
                                    <select name="categorization_of_complaint_gi" onchange=""
                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required>
                                        <option value="">-- select --</option>
                                        <option value="Critical"
                                            {{ $data->categorization_of_complaint_gi == 'Critical' ? 'selected' : '' }}>
                                            Critical</option>
                                        <option value="Major"
                                            {{ $data->categorization_of_complaint_gi == 'Major' ? 'selected' : '' }}>Major
                                        </option>
                                        <option value="Minor"
                                            {{ $data->categorization_of_complaint_gi == 'Minor' ? 'selected' : '' }}>Minor
                                        </option>
                                    </select>
                                </div>
                                    <!-- <input type="hidden" name="categorization_of_complaint_gi" value="{{ $data->categorization_of_complaint_gi }}"> -->
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="is_repeat_gi">Is Repeat
                                     @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                    </label>
                                    <select name="is_repeat_gi" id="is_repeat_gi"
                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} required>
                                        <option value="" {{ $data->is_repeat_gi == '0' ? 'selected' : '' }}>--
                                            select --</option>
                                        <option value="yes" {{ $data->is_repeat_gi == 'yes' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="no" {{ $data->is_repeat_gi == 'no' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>
                                        <!-- <input type="hidden" name="is_repeat_gi" value="{{ $data->is_repeat_gi }}"> -->
                            </div>

                            <div class="col-md-12 mb-3" id="repeat_nature_div" style="display: none;">
                                <div class="group-input">
                                    <label for="repeat_nature_gi">Repeat Nature
                                    <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small>
                                    </div>
                                    <textarea  name="repeat_nature_gi" id="repeat_nature_gi"
                                        {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}>{{ $data->repeat_nature_gi }}</textarea>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var isRepeatSelect = document.getElementById('is_repeat_gi');
                                    var repeatNatureDiv = document.getElementById('repeat_nature_div');

                                    // Handle the change event for the select element
                                    isRepeatSelect.addEventListener('change', function() {
                                        if (isRepeatSelect.value === 'yes') {
                                            repeatNatureDiv.style.display = 'block';
                                        } else {
                                            repeatNatureDiv.style.display = 'none';
                                        }
                                    });

                                    // Check the current value and show/hide the repeat nature div on page load
                                    if (isRepeatSelect.value === 'yes') {
                                        repeatNatureDiv.style.display = 'block';
                                    }
                                });
                            </script>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Review of Control Sample">Review of Complaint Sample @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="review_of_complaint_sample_gi"  id="summernote-1">{{ $data->review_of_complaint_sample_gi }} </textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Review of Control Sample">Review of Control Sample @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="review_of_control_sample_gi"  id="summernote-1">{{ $data->review_of_control_sample_gi }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Review of stability study program and samples">Review of stability study
                                        program and samples
                                        @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="review_of_stability_study_gi" id="summernote-1"
                                        >{{ $data->review_of_stability_study_gi }}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Review of product manufacturing and analytical process">Review of product
                                        manufacturing and analytical process
                                        @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="review_of_product_manu_gi" id="summernote-1"
                                         >{{ $data->review_of_product_manu_gi }}
                                </textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="In case of Invalide complain then">Additional information if require
                                        @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="additional_inform" id="summernote-1">{{ $data->additional_inform }}
                                </textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Additional information if require">Type of Market Complaints @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif </label>
                                    <select
                                        name="probable_root_causes_complaint_hodsr"  {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}
                                        id="probable_root_causes_complaint_hodsr" required>
                                        {{-- <option value="">-- select --</option> --}}
                                        <option value=""
                                            {{ $data->probable_root_causes_complaint_hodsr == '0' ? 'selected' : '' }}>--
                                            select --</option>
                                        <option value="valid"
                                            {{ $data->probable_root_causes_complaint_hodsr == 'valid' ? 'selected' : '' }}>
                                            Valid
                                        </option>
                                        <option value="invalid"
                                            {{ $data->probable_root_causes_complaint_hodsr == 'invalid' ? 'selected' : '' }}>
                                            Invalid
                                        </option>
                                    </select>
                                </div>
                                    <!-- <input type="hidden" name="probable_root_causes_complaint_hodsr" value="{{ $data->probable_root_causes_complaint_hodsr }}"> -->
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="In case of Invalide complain then">Comments @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="in_case_Invalide_com" id="summernote-1"
                                         >{{ $data->in_case_Invalide_com }}
                                </textarea>
                                </div>
                            </div>
                            
                            <div class="button-block">
                                <button type="submit" class="saveButton"
                                    id="saveButton"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>

                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-------------Acknoledgment--------------->

                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <button id="printButton" onclick="printTabContent()"
                                style="margin-left: 110rem; width:60px">Print</button>
                            <script>
                                function printTabContent() {
                                    var printContents = document.getElementById('CCForm2').innerHTML;
                                    var originalContents = document.body.innerHTML;

                                    document.body.innerHTML = printContents;
                                    window.print();
                                    document.body.innerHTML = originalContents;
                                }
                            </script>

                            <div class="sub-head">Complaint Acknowledgement</div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Manufacturer name & Address">Manufacturer Name & Address
                                     @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="manufacturer_name_address_ca" id="summernote-1"
                                        >{{ $data->manufacturer_name_address_ca }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Product Details
                                        @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                                        <button type="button" id="promate_add"
                                        {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                     
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="prod_mate_details" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Product Name</th>
                                                    <th>Batch No.</th>
                                                    <th>Mfg. Date</th>
                                                    <th>Exp. Date</th>
                                                    <th>Batch Size</th>
                                                    <th>Pack Profile</th>
                                                    <th>Released Quantity</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $productmateIndex = 0;
                                                @endphp
                                                @if (!empty($product_materialDetails) && is_array($product_materialDetails->data))
                                                    @foreach ($product_materialDetails->data as $index => $Prodmateriyal)
                                                        <tr>
                                                            <td>{{ ++$productmateIndex }}</td>
                                                            <td><input
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}  type="text"
                                                                    name="Product_MaterialDetails[{{ $index }}][product_name_ca]"
                                                                    value="{{ array_key_exists('product_name_ca', $Prodmateriyal) ? $Prodmateriyal['product_name_ca'] : '' }} " required>
                                                            </td>
                                                            <td><input
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                    type="text"
                                                                    name="Product_MaterialDetails[{{ $index }}][batch_no_pmd_ca]"
                                                                    value="{{ array_key_exists('batch_no_pmd_ca', $Prodmateriyal) ? $Prodmateriyal['batch_no_pmd_ca'] : '' }}" required>
                                                            </td>
                                                            <td>
                                                                <div class="new-date-data-field">
                                                                    <div class="group-input input-date">
                                                                        <div class="calenderauditee">
                                                                            <input
                                                                                {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                                class="click_date"
                                                                                id="text_date_{{ $index }}_mfg_date_pmd_ca"
                                                                                type="text"
                                                                                name="Product_MaterialDetails[{{ $index }}][mfg_date_pmd_ca_text]"
                                                                                placeholder="DD-MMM-YYYY"
                                                                                value="{{ !empty($Prodmateriyal['mfg_date_pmd_ca']) ? \Carbon\Carbon::parse($Prodmateriyal['mfg_date_pmd_ca'])->format('d-M-Y') : '' }}"
                                                                                readonly
                                                                                onclick="document.getElementById('date_{{ $index }}_mfg_date_pmd_ca').click();" />

                                                                            <input type="date"
                                                                                {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                                name="Product_MaterialDetails[{{ $index }}][mfg_date_pmd_ca]"
                                                                                value="{{ !empty($Prodmateriyal['mfg_date_pmd_ca']) ? \Carbon\Carbon::parse($Prodmateriyal['mfg_date_pmd_ca'])->format('Y-m-d') : '' }}"
                                                                                id="date_{{ $index }}_mfg_date_pmd_ca"
                                                                                class="hide-input show_date"
                                                                                style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                                onchange="handleDateInput(this, 'text_date_{{ $index }}_mfg_date_pmd_ca'); setExpiryMinDate('{{ $index }}');" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="new-date-data-field">
                                                                    <div class="group-input input-date">
                                                                        <div class="calenderauditee">
                                                                            <input
                                                                                {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                                class="click_date"
                                                                                id="text_date_{{ $index }}_expiry_date_pmd_ca"
                                                                                type="text"
                                                                                name="Product_MaterialDetails[{{ $index }}][expiry_date_pmd_ca_text]"
                                                                                placeholder="DD-MMM-YYYY"
                                                                                value="{{ !empty($Prodmateriyal['expiry_date_pmd_ca']) ? \Carbon\Carbon::parse($Prodmateriyal['expiry_date_pmd_ca'])->format('d-M-Y') : '' }}"
                                                                                readonly
                                                                                onclick="document.getElementById('date_{{ $index }}_expiry_date_pmd_ca').click();" />

                                                                            <input type="date"
                                                                                {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                                name="Product_MaterialDetails[{{ $index }}][expiry_date_pmd_ca]"
                                                                                value="{{ !empty($Prodmateriyal['expiry_date_pmd_ca']) ? \Carbon\Carbon::parse($Prodmateriyal['expiry_date_pmd_ca'])->format('Y-m-d') : '' }}"
                                                                                id="date_{{ $index }}_expiry_date_pmd_ca"
                                                                                class="hide-input show_date"
                                                                                style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                                onchange="handleDateInput(this, 'text_date_{{ $index }}_expiry_date_pmd_ca')" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td><input
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                    type="text"
                                                                    name="Product_MaterialDetails[{{ $index }}][batch_size_pmd_ca]"
                                                                    value="{{ array_key_exists('batch_size_pmd_ca', $Prodmateriyal) ? $Prodmateriyal['batch_size_pmd_ca'] : '' }}" required>
                                                            </td>
                                                            <td><input
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                    type="text"
                                                                    name="Product_MaterialDetails[{{ $index }}][pack_profile_pmd_ca]"
                                                                    value="{{ array_key_exists('pack_profile_pmd_ca', $Prodmateriyal) ? $Prodmateriyal['pack_profile_pmd_ca'] : '' }}" required>
                                                            </td>
                                                            <td><input
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                    type="text"
                                                                    name="Product_MaterialDetails[{{ $index }}][released_quantity_pmd_ca]"
                                                                    value="{{ array_key_exists('released_quantity_pmd_ca', $Prodmateriyal) ? $Prodmateriyal['released_quantity_pmd_ca'] : '' }}" required>
                                                            </td>
                                                            <td><input
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                    type="text"
                                                                    name="Product_MaterialDetails[{{ $index }}][remarks_ca]"
                                                                    value="{{ array_key_exists('remarks_ca', $Prodmateriyal) ? $Prodmateriyal['remarks_ca'] : '' }}" required>
                                                            </td>
                                                            <td><button
                                                                    {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} 
                                                                    type="text" class="removeRowBtn">Remove</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="10">No found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $('#promate_add').click(function (e) {
                                e.preventDefault();

                                function generateTableRow(productserialno) {
                                    var html =
                                        '<tr>' +
                                        '<td>' + (productserialno + 1) + '</td>' +
                                        '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][product_name_ca]"></td>' +
                                        '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][batch_no_pmd_ca]"></td>' +
                                        '<td><div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee">' +
                                        '<input id="text_date_' + productserialno + '_mfg_date_pmd_ca" type="text" name="Product_MaterialDetails[' + productserialno + '][mfg_date_pmd_ca_text]" placeholder="DD-MMM-YYYY" readonly onclick="document.getElementById(\'date_' + productserialno + '_mfg_date_pmd_ca\').click();"/>' +
                                        '<input type="date" name="Product_MaterialDetails[' + productserialno + '][mfg_date_pmd_ca]" value="" id="date_' + productserialno + '_mfg_date_pmd_ca" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'text_date_' + productserialno + '_mfg_date_pmd_ca\'); setExpiryMinDate(' + productserialno + ');"/>'+
                                        '</div></div></div></td>' +
                                        '<td><div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee">' +
                                        '<input id="text_date_' + productserialno + '_expiry_date_pmd_ca" type="text" name="Product_MaterialDetails[' + productserialno + '][expiry_date_pmd_ca_text]" placeholder="DD-MMM-YYYY" readonly onclick="document.getElementById(\'date_' + productserialno + '_expiry_date_pmd_ca\').click();"/>' +
                                        '<input type="date" name="Product_MaterialDetails[' + productserialno + '][expiry_date_pmd_ca]" value="" id="date_' + productserialno + '_expiry_date_pmd_ca" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'text_date_' + productserialno + '_expiry_date_pmd_ca\')"/>' +
                                        '</div></div></div></td>' +
                                        '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][batch_size_pmd_ca]"></td>' +
                                        '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][pack_profile_pmd_ca]"></td>' +
                                        '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][released_quantity_pmd_ca]"></td>' +
                                        '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][remarks_ca]"></td>' +
                                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                        '</tr>';
                                    return html;
                                }

                                var tableBody = $('#prod_mate_details tbody');
                                var rowCount = tableBody.children('tr').length;
                                var newRow = generateTableRow(rowCount);
                                tableBody.append(newRow);
                                indexMaetDetails++;
                             });
                            </script>

                            <script>
                                function setExpiryMinDate(index) {
                                    const mfgDateInput = document.getElementById('date_' + index + '_mfg_date_pmd_ca');
                                    const expiryDateInput = document.getElementById('date_' + index + '_expiry_date_pmd_ca');

                                    if (mfgDateInput && expiryDateInput) {
                                        const mfgDate = mfgDateInput.value;
                                        if (mfgDate) {
                                            expiryDateInput.min = mfgDate;
                                        }
                                    }
                                }
                            </script>


                            <script>
                                function updateExpiryMinDate(index) {
                                    var mfgDateInput = document.getElementById('date_' + index + '_mfg_date_pmd_ca');
                                    var expiryDateInput = document.getElementById('date_' + index + '_expiry_date_pmd_ca');

                                    if (mfgDateInput && expiryDateInput) {
                                        // Get the selected manufacturing date
                                        var mfgDate = new Date(mfgDateInput.value);
                                        if (!isNaN(mfgDate.getTime())) {
                                            // Add 1 day to the manufacturing date
                                            mfgDate.setDate(mfgDate.getDate() + 1);

                                            // Format the new minimum date for expiry date (YYYY-MM-DD)
                                            var day = ('0' + mfgDate.getDate()).slice(-2);
                                            var month = ('0' + (mfgDate.getMonth() + 1)).slice(-2);
                                            var year = mfgDate.getFullYear();
                                            var minExpiryDate = year + '-' + month + '-' + day;

                                            // Set the min attribute for the expiry date input
                                            expiryDateInput.min = minExpiryDate;
                                        }
                                    }
                                }
                            </script>

                            <script>
                                function handleDateInput(dateInput, textInputId) {
                                    const selectedDate = new Date(dateInput.value);
                                    const today = new Date();

                                    // Remove the time portion of today's date for comparison
                                    today.setHours(0, 0, 0, 0);

                                    if (selectedDate < today) {
                                        alert("Selected date is in the past. Please choose a current or future date.");
                                        dateInput.value = "";
                                        document.getElementById(textInputId).value = "";
                                    } else {
                                        const formattedDate = selectedDate.toLocaleDateString('en-GB', {
                                            day: '2-digit',
                                            month: 'short',
                                            year: 'numeric'
                                        }).replace(/ /g, '-');
                                        document.getElementById(textInputId).value = formattedDate;
                                    }
                                }

                                // Set minimum date for date inputs to today
                                document.querySelectorAll('input[type="date"]').forEach(input => {
                                    // input.setAttribute('min', new Date().toISOString().split('T')[0]);
                                });
                            </script>
                            @php
                                $canEdit1 = ($data->stage == 1 && $istab1);
                            @endphp
                            
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Complaint Sample Required">Complaint Sample Required
                                        @if($data->stage == 1)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <select name="complaint_sample_required_ca"
                                        id="complaint_sample_required_ca"
                                        {{ $canEdit1 ? '' : 'disabled' }}>
                                        <option value="">-- select --</option>
                                        <option value="yes" {{ $data->complaint_sample_required_ca == 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no"  {{ $data->complaint_sample_required_ca == 'no'  ? 'selected' : '' }}>No</option>
                                        <option value="na"  {{ $data->complaint_sample_required_ca == 'na'  ? 'selected' : '' }}>NA</option>
                                    </select>
                                </div>
                                @if(!$canEdit1)
                                    <input type="hidden"
                                        name="complaint_sample_required_ca"
                                        value="{{ $data->complaint_sample_required_ca }}">
                                @endif
                            </div>

                            <div class="col-md-12 mb-3" id="complaint_sample_status_div"
                                style="display: {{ isset($data) && $data->complaint_sample_required_ca == 'yes' ? 'block' : 'none' }};">
                                <div class="group-input">
                                    <label for="Analytical Data review observation">Complaint Sample Status
                                        @if($data->stage == 1)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <div>
                                        <small class="text-primary">
                                            Please insert "NA" in the data field if it does not require completion
                                        </small>
                                    </div>
                                    <textarea class="summernote" data-stage="1" name="complaint_sample_status_ca" id="summernote-1"
                                        >{{ $data->complaint_sample_status_ca }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Brief Description of complaint">Brief Description Of Complaint @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="brief_description_of_complaint_ca"  id="summernote-1"
                                        >{{ $data->brief_description_of_complaint_ca }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Batch Record review observation">Batch Record Review
                                        Observation
                                        @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="batch_record_review_observation_ca"  id="summernote-1"
                                        >{{ $data->batch_record_review_observation_ca }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Analytical Data review observation">Analytical Data Review
                                        Observation @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="analytical_data_review_observation_ca"  id="summernote-1"
                                        >{{ $data->analytical_data_review_observation_ca }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Retention sample review observation">Retention Sample Review
                                        Observation
                                        @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="retention_sample_review_observation_ca" id="summernote-1"
                                    >{{ $data->retention_sample_review_observation_ca }}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Stablity study data review">Stablity Study Data Review
                                        @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="stability_study_data_review_ca" id="summernote-1"
                                    >{{ $data->stability_study_data_review_ca }}
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="QMS Events(if any) review Observation">QMS Events(if Any) Review
                                        Observation
                                        @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="qms_events_ifany_review_observation_ca"  id="summernote-1"
                                        >{{ $data->qms_events_ifany_review_observation_ca }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Repeated complaints/queries for product">Repeated Complaints/Queries
                                        For Product: @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="repeated_complaints_queries_for_product_ca"  id="summernote-1"
                                        >{{ $data->repeated_complaints_queries_for_product_ca }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Interpretation on compalint sample">Interpretation on Complaint sample(if
                                        recieved)<span
                                        class="text-danger">*</span></label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="interpretation_on_complaint_sample_ifrecieved_ca"  id="summernote-1"
                                        >{{ $data->interpretation_on_complaint_sample_ifrecieved_ca }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Comments">Comments(if Any) @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" data-stage="1" name="comments_ifany_ca"  id="summernote-1"
                                        >{{ $data->comments_ifany_ca }}</textarea>
                                </div>
                            </div>



                            <div class="sub-head">
                                Proposal To Accomplish Investigation: @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                         @endif
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <div class="why-why-chart">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">Sr. No.</th>
                                                    <th style="width: 40%;">Requirements</th>
                                                    <th style="width: 10%;">Yes/No</th>
                                                    {{-- <th style="width: 20%;">Expected date of investigation completion</th> --}}
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <style>
                                                .main-head {
                                                    display: flex;
                                                    justify-content: space-around;
                                                    gap: 12px;
                                                }

                                                .label-head {
                                                    display: flex !important;
                                                    gap: 14px;
                                                }

                                                .input-head {
                                                    margin-top: 4px;
                                                }
                                            </style>
                                            <tbody>
                                                @php
                                                    $canEdit = ($data->stage == 1 && $istab1);
                                                @endphp

                                                <tr>
                                                    <td class="flex text-center">1</td>
                                                    <td>Complaint sample Required</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <span class="input-head">
                                                                <input type="radio" name="csr1_yesno"
                                                                    value="yes"  {{ $canEdit ? '' : 'readonly' }}
                                                                    {{ isset($proposalData['Complaint sample Required']['csr3']) && $proposalData['Complaint sample Required']['csr3'] == 'yes' ? 'checked' : '' }}
                                                                    onchange="toggleInputs('csr1_yesno', 'csr1', 'csr2')">
                                                            </span>
                                                            <span>Yes</span>
                                                        </label>
                                                        <label class="label-head">
                                                            <span class="input-head">
                                                                <input type="radio" name="csr1_yesno"
                                                                    value="no" {{ $canEdit ? '' : 'readonly' }}
                                                                    {{ isset($proposalData['Complaint sample Required']['csr3']) && $proposalData['Complaint sample Required']['csr3'] == 'no' ? 'checked' : '' }}
                                                                    onchange="toggleInputs('csr1_yesno', 'csr1', 'csr2')">
                                                            </span>
                                                            <span>No</span>
                                                        </label>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea  {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} name="csr2"
                                                                style="border-radius: 7px; border: 1.5px solid black;" required>{{ $proposalData['Complaint sample Required']['csr2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">2</td>
                                                    <td>Additional info. From Complaint</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="afc1_yesno"
                                                                value="yes" {{ $canEdit ? '' : 'readonly' }}
                                                                {{ isset($proposalData['Additional info. From Complainant']['afc3']) && $proposalData['Additional info. From Complainant']['afc3'] == 'yes' ? 'checked' : '' }}
                                                                onchange="toggleInputs('afc1_yesno', 'afc1', 'afc2')">
                                                            <span>Yes</span>
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="afc1_yesno"
                                                                value="no" {{ $canEdit ? '' : 'readonly' }}
                                                                {{ isset($proposalData['Additional info. From Complainant']['afc3']) && $proposalData['Additional info. From Complainant']['afc3'] == 'no' ? 'checked' : '' }}
                                                                onchange="toggleInputs('afc1_yesno', 'afc1', 'afc2')">
                                                            <span>No</span>
                                                        </label>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea  {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} name="afc2"
                                                                style="border-radius: 7px; border: 1.5px solid black;" required>{{ $proposalData['Additional info. From Complainant']['afc2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">3</td>
                                                    <td>Analysis of complaint Sample</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="acs1_yesno"
                                                                value="yes" {{ $canEdit ? '' : 'readonly' }}
                                                                {{ isset($proposalData['Analysis of complaint Sample']['acs3']) && $proposalData['Analysis of complaint Sample']['acs3'] == 'yes' ? 'checked' : '' }}
                                                                onchange="toggleInputs('acs1_yesno', 'acs1', 'acs2')">
                                                            <span>Yes</span>
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="acs1_yesno"
                                                                value="no" {{ $canEdit ? '' : 'readonly' }}
                                                                {{ isset($proposalData['Analysis of complaint Sample']['acs3']) && $proposalData['Analysis of complaint Sample']['acs3'] == 'no' ? 'checked' : '' }}
                                                                onchange="toggleInputs('acs1_yesno', 'acs1', 'acs2')">
                                                            <span>No</span>
                                                        </label>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}  name="acs2"
                                                                style="border-radius: 7px; border: 1.5px solid black;" required>{{ $proposalData['Analysis of complaint Sample']['acs2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">4</td>
                                                    <td>QRM Approach</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="qrm1_yesno"
                                                                value="yes" {{ $canEdit ? '' : 'readonly' }}
                                                                {{ isset($proposalData['QRM Approach']['qrm3']) && $proposalData['QRM Approach']['qrm3'] == 'yes' ? 'checked' : '' }}
                                                                onchange="toggleInputs('qrm1_yesno', 'qrm1', 'qrm2')">
                                                            <span>Yes</span>
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="qrm1_yesno"
                                                                value="no" {{ $canEdit ? '' : 'readonly' }}
                                                                {{ isset($proposalData['QRM Approach']['qrm3']) && $proposalData['QRM Approach']['qrm3'] == 'no' ? 'checked' : '' }}
                                                                onchange="toggleInputs('qrm1_yesno', 'qrm1', 'qrm2')">
                                                            <span>No</span>
                                                        </label>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}  name="qrm2"
                                                                style="border-radius: 7px; border: 1.5px solid black;" required>{{ $proposalData['QRM Approach']['qrm2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">5</td>
                                                    <td>Others</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="oth1_yesno"
                                                                value="yes" {{ $canEdit ? '' : 'readonly' }}
                                                                {{ isset($proposalData['Others']['oth3']) && $proposalData['Others']['oth3'] == 'yes' ? 'checked' : '' }}
                                                                onchange="toggleInputs('oth1_yesno', 'oth1', 'oth2')">
                                                            <span>Yes</span>
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="oth1_yesno"
                                                                value="no" {{ $canEdit ? '' : 'readonly' }}
                                                                {{ isset($proposalData['Others']['oth3']) && $proposalData['Others']['oth3'] == 'no' ? 'checked' : '' }}
                                                                onchange="toggleInputs('oth1_yesno', 'oth1', 'oth2')">
                                                            <span>No</span>
                                                        </label>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea  name="oth2"
                                                                style="border-radius: 7px; border: 1.5px solid black;" {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }}  required>{{ $proposalData['Others']['oth2'] ?? '' }}</textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <script>
                                function toggleInputs(radioName, textarea1, textarea2) {
                                    const radios = document.getElementsByName(radioName);
                                    let selectedValue = '';
                                    for (const radio of radios) {
                                        if (radio.checked) {
                                            selectedValue = radio.value;
                                            break;
                                        }
                                    }

                                    document.getElementsByName(textarea1)[0].disabled = selectedValue !== 'yes';
                                    document.getElementsByName(textarea2)[0].disabled = selectedValue !== 'yes';
                                }

                                // Call toggleInputs for each row on page load
                                document.addEventListener('DOMContentLoaded', function() {
                                    toggleInputs('csr1_yesno', 'csr1', 'csr2');
                                    toggleInputs('afc1_yesno', 'afc1', 'afc2');
                                    toggleInputs('acs1_yesno', 'acs1', 'acs2');
                                    toggleInputs('qrm1_yesno', 'qrm1', 'qrm2');
                                    toggleInputs('oth1_yesno', 'oth1', 'oth2');
                                });
                            </script>




                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due_date">Expected Date of Investigation Completion</label>
                                        <div class="calenderauditee">
                                            @php
                                                $DateExpectdate = isset($data->Expecteddate_of_investigation_completion)
                                                    ? new \DateTime($data->Expecteddate_of_investigation_completion)
                                                    : null;
                                            @endphp
                                            {{-- Format the date as desired --}}
                                            <input type="text" id="due_date_display_expected" placeholder="DD-MMM-YYYY"
                                                value="{{ $DateExpectdate ? $DateExpectdate->format('d-M-Y') : '' }}" readonly />

                                            <input type="date" name="Expecteddate_of_investigation_completion" id="Expecteddate_of_investigation_completion" class="hide-input"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                value="{{ $data->Expecteddate_of_investigation_completion ?? '' }}"
                                                oninput="handleDateInput(this, 'due_date_display_expected')"
                                                {{ $data->stage == 1 && $istab1 ? '' : 'readonly' }} />


                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function handleDateInput(input, displayId) {
                                        var display = document.getElementById(displayId);
                                        var date = new Date(input.value);
                                        var options = {
                                            day: '2-digit',
                                            month: 'short', // Change 'short' instead of 'Short'
                                            year: 'numeric'
                                        };
                                        var formattedDate = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                        display.value = formattedDate;
                                    }
                                </script>


                                <style>
                                    .hide-input{
                                        display: none;
                                    }
                                </style>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="initial_attachment_ca">Acknowledgment Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_ca">
                                            @if ($data->initial_attachment_ca)
                                                @foreach (json_decode($data->initial_attachment_ca) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                            <i class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i>
                                                        </a>
                                                        <a type="button" class="remove-file2"
                                                            data-file-name="{{ $file }}">
                                                            <i class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i>
                                                        </a>
                                                        <input type="hidden" name="existing_initial_attachment_ca[]"
                                                            value="{{ $file }}">
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="initial_attachment_ca[]"
                                            {{ $data->stage == 1 && $istab1 ? '' : 'disabled' }}
                                                oninput="addMultipleFiles(this, 'initial_attachment_ca')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden field to keep track of files to be deleted -->
                            <input type="hidden" id="deleted_initial_attachment_ca" name="deleted_initial_attachment_ca"
                                value="">

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const removeButtons = document.querySelectorAll('.remove-file2');

                                    removeButtons.forEach(button => {
                                        button.addEventListener('click', function() {
                                            const fileName = this.getAttribute('data-file-name');
                                            const fileContainer = this.closest('.file-container');

                                            // Hide the file container
                                            if (fileContainer) {
                                                fileContainer.style.display = 'none';
                                                // Remove hidden input associated with this file
                                                const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                if (hiddenInput) {
                                                    hiddenInput.remove();
                                                }

                                                // Add the file name to the deleted files list
                                                const deletedFilesInput = document.getElementById(
                                                    'deleted_initial_attachment_ca');
                                                let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                    ',') : [];
                                                deletedFiles.push(fileName);
                                                deletedFilesInput.value = deletedFiles.join(',');
                                            }
                                        });
                                    });
                                });

                                function addMultipleFiles(input, id) {
                                    const fileListContainer = document.getElementById(id);
                                    const files = input.files;

                                    for (let i = 0; i < files.length; i++) {
                                        const file = files[i];
                                        const fileName = file.name;
                                        const fileContainer = document.createElement('h6');
                                        fileContainer.classList.add('file-container', 'text-dark');
                                        fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                        const fileText = document.createElement('b');
                                        fileText.textContent = fileName;

                                        const viewLink = document.createElement('a');
                                        viewLink.href = '#'; // You might need to adjust this to handle local previews
                                        viewLink.target = '_blank';
                                        viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                        const removeLink = document.createElement('a');
                                        removeLink.classList.add('remove-file');
                                        removeLink.dataset.fileName = fileName;
                                        removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                        removeLink.addEventListener('click', function() {
                                            fileContainer.style.display = 'none';
                                        });

                                        fileContainer.appendChild(fileText);
                                        fileContainer.appendChild(viewLink);
                                        fileContainer.appendChild(removeLink);

                                        fileListContainer.appendChild(fileContainer);
                                    }
                                }
                            </script>

                        </div>
                        <div class="button-block">

                            <button type="submit" class="saveButton" id="saveButton"
                                {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <!----- QA/CQa----->
                    @php
                      $istab2  = (Helpers::check_roles($data->division_id, 'Market Complaint', 9) ||
                                 Helpers::check_roles($data->division_id, 'Market Complaint', 42) ||
                                  Helpers::check_roles($data->division_id, 'Market Complaint', 43) ||
                                  Helpers::check_roles($data->division_id, 'Market Complaint', 39) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 65) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18))
                    @endphp
                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            QA/CQA Head Review
                        </div>
                        <div class="row">
                   
     
                            <div class="col-md-12">
                                @if ($data->stage == 2)
                                    <div class="group-input">
                                        <label for="HOD Remarks">QA/CQA Head Comment <span
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class="tiny" name="qa_head_comment" id="summernote-4" required {{ $data->stage == 2 && $istab2 ? '' : 'readonly' }}>{{ $data->qa_head_comment }}</textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="QA/CQA Head Comment">QA/CQA Head Comment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea readonly class="tiny" name="qa_head_comment" id="summernote-4" {{ $data->stage == 2 && $istab2 ? '' : 'readonly' }}>{{ $data->qa_head_comment }}</textarea>
                                    </div>
                                @endif
                                @error('qa_head_comment')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="qa_cqa_he_attach">QA/CQA Head Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="qa_cqa_he_attach">
                                            @if ($data->qa_cqa_he_attach)
                                                @foreach (json_decode($data->qa_cqa_he_attach) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                            <i class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i>
                                                        </a>
                                                        <a type="button" class="remove-file3"
                                                            data-file-name="{{ $file }}">
                                                            <i class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i>
                                                        </a>
                                                        <input type="hidden" name="existing_qa_cqa_he_attach[]"
                                                            value="{{ $file }}">
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="qa_cqa_he_attach[]"
                                            {{ $data->stage == 2 && $istab2 ? '' : 'disabled' }}
                                                oninput="addMultipleFiles(this, 'qa_cqa_he_attach')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden field to keep track of files to be deleted -->
                            <input type="hidden" id="deleted_qa_cqa_he_attach" name="deleted_qa_cqa_he_attach"
                                value="">

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const removeButtons = document.querySelectorAll('.remove-file3');

                                    removeButtons.forEach(button => {
                                        button.addEventListener('click', function() {
                                            const fileName = this.getAttribute('data-file-name');
                                            const fileContainer = this.closest('.file-container');

                                            // Hide the file container
                                            if (fileContainer) {
                                                fileContainer.style.display = 'none';
                                                // Remove hidden input associated with this file
                                                const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                if (hiddenInput) {
                                                    hiddenInput.remove();
                                                }

                                                // Add the file name to the deleted files list
                                                const deletedFilesInput = document.getElementById(
                                                    'deleted_qa_cqa_he_attach');
                                                let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                    ',') : [];
                                                deletedFiles.push(fileName);
                                                deletedFilesInput.value = deletedFiles.join(',');
                                            }
                                        });
                                    });
                                });

                                function addMultipleFiles(input, id) {
                                    const fileListContainer = document.getElementById(id);
                                    const files = input.files;

                                    for (let i = 0; i < files.length; i++) {
                                        const file = files[i];
                                        const fileName = file.name;
                                        const fileContainer = document.createElement('h6');
                                        fileContainer.classList.add('file-container', 'text-dark');
                                        fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                        const fileText = document.createElement('b');
                                        fileText.textContent = fileName;

                                        const viewLink = document.createElement('a');
                                        viewLink.href = '#'; // You might need to adjust this to handle local previews
                                        viewLink.target = '_blank';
                                        viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                        const removeLink = document.createElement('a');
                                        removeLink.classList.add('remove-file');
                                        removeLink.dataset.fileName = fileName;
                                        removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                        removeLink.addEventListener('click', function() {
                                            fileContainer.style.display = 'none';
                                        });

                                        fileContainer.appendChild(fileText);
                                        fileContainer.appendChild(viewLink);
                                        fileContainer.appendChild(removeLink);

                                        fileListContainer.appendChild(fileContainer);
                                    }
                                }
                            </script>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" id="saveButton"
                                {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/GeneralInformationComplaint_report',$data->id) }}">Report
                            </a> </button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
                    @php

                      $istab4  = (Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18))
                    @endphp
                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head col-12"> Investigation</div>
                            <div class="col-12">
                            <div class="group-input">
                                <label for="root_cause">
                                    Investigation Team  <span
                                    class="text-danger">*</span>
                                    <button type="button" id="investigation_team_add" {{ $data->stage == 3 && $istab4 ? '' : 'disabled' }}>+</button>

                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="Investing_team" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 100px;">Sr. No.</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $investingTeamIndex = 1;
                                            @endphp
                                            @if (!empty($investing_team) && is_array($investing_team->data))
                                                @foreach ($investing_team->data as $index => $inves)
                                                    <tr>
                                                        <td>
                                                            <input disabled type="text" name="Investing_team[{{ $index }}][serial]"
                                                                value="{{ $investingTeamIndex++ }}">
                                                        </td>
                                                        <td>
                                                            <select class="selectUserDropdown" name="Investing_team[{{ $index }}][name_inv_tem]">
                                                                <option value="">-Select-</option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}"
                                                                        data-department-id="{{ $user->departmentid ?? '' }}"
                                                                        {{ isset($inves['name_inv_tem']) && $inves['name_inv_tem'] == $user->id ? 'selected' : '' }}>
                                                                        {{ $user->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <input type="text" class="departmentInput"
                                                                name="Investing_team[{{ $index }}][department_inv_tem]"
                                                                value="{{ $inves['department_inv_tem'] ?? '' }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="Investing_team[{{ $index }}][remarks_inv_tem]"
                                                                value="{{ $inves['remarks_inv_tem'] ?? '' }}">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="removeRowBtn">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5">No data found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <script>
                        $(document).ready(function() {
                            // Add new row to the table
                            $('#investigation_team_add').click(function(e) {
                                e.preventDefault();

                                function generateTableRow(serialNumber) {
                                    var users = @json($users);

                                    var selectOptions = '<option value="">-Select-</option>';
                                    users.forEach(function(user) {
                                        selectOptions += '<option value="' + user.id + '" data-department-id="' + (user.departmentid || '') + '">' + user.name + '</option>';
                                    });

                                    var html = '<tr>' +
                                        '<td><input disabled type="text" name="Investing_team[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                        '<td>' +
                                            '<select class="selectUserDropdown" name="Investing_team[' + serialNumber + '][name_inv_tem]" required>' +
                                                selectOptions +
                                            '</select>' +
                                        '</td>' +
                                        '<td><input type="text" class="departmentInput" name="Investing_team[' + serialNumber + '][department_inv_tem]" readonly></td>' +
                                        '<td><input type="text" name="Investing_team[' + serialNumber + '][remarks_inv_tem]"></td>' +
                                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                        '</tr>';
                                    return html;
                                }

                                var tableBody = $('#Investing_team tbody');
                                var rowCount = tableBody.children('tr').length;
                                var newRow = generateTableRow(rowCount);
                                tableBody.append(newRow);
                            });

                            // Remove row from the table
                            $(document).on('click', '.removeRowBtn', function() {
                                $(this).closest('tr').remove();
                            });

                            // Fetch department name dynamically when a user is selected
                            $(document).on("change", ".selectUserDropdown", function () {
                                let selectedOption = $(this).find(":selected");
                                let departmentId = selectedOption.data("department-id");
                                let departmentInput = $(this).closest("tr").find(".departmentInput");

                                if (departmentId) {
                                    fetch(`/get-department-name/${departmentId}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            departmentInput.val(data.department_name || "N/A");
                                        })
                                        .catch(error => {
                                            console.error("Error fetching department name:", error);
                                        });
                                } else {
                                    departmentInput.val("N/A");
                                }
                            });
                        });
                        </script>

                            <div class="col-md-12">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="HOD Remarks">Review of Batch Manufacturing Record (BMR) <span
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_batch_manufacturing_record_BMR_gi" id="summernote-1" required >{{ $data->review_of_batch_manufacturing_record_BMR_gi }}</textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Review of Batch Manufacturing Record (BMR)">Review of Batch
                                            Manufacturing Record (BMR)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea readonly class="summernote" data-stage="3" name="review_of_batch_manufacturing_record_BMR_gi" id="summernote-1" >{{ $data->review_of_batch_manufacturing_record_BMR_gi }}</textarea>
                                    </div>
                                @endif
                                @error('review_of_batch_manufacturing_record_BMR_gi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label
                                            for="Review of Raw materials used in batch manufacturing">Review
                                            Of Raw Materials Used In Batch
                                            Manufacturing <span
                                            class="text-danger">*</span> </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_raw_materials_used_in_batch_manufacturing_gi" id="summernote-1"
                                        required >{{ $data->review_of_raw_materials_used_in_batch_manufacturing_gi }} </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label
                                            for="Review of Raw materials used in batch manufacturing">Review
                                            Of Raw Materials Used In Batch
                                            Manufacturing </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_raw_materials_used_in_batch_manufacturing_gi" id="summernote-1"
                                           >{{ $data->review_of_raw_materials_used_in_batch_manufacturing_gi }}</textarea>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Review of Batch Packing record (BPR)">Review of Batch Packing Record
                                            (BPR)<span
                                            class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_Batch_Packing_record_bpr_gi" id="summernote-1"
                                        required  >{{ $data->review_of_Batch_Packing_record_bpr_gi }}</textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Review of Batch Packing record (BPR)">Review of Batch Packing Record
                                            (BPR)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea readonly class="summernote" data-stage="3" name="review_of_Batch_Packing_record_bpr_gi" id="summernote-1"
                                        >{{ $data->review_of_Batch_Packing_record_bpr_gi }}  </textarea>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Review of packing materials used in batch packing">Review Of Packing
                                            Materials Used In Batch
                                            Packing <span
                                            class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_packing_materials_used_in_batch_packing_gi" id="summernote-1"
                                        required >{{ $data->review_of_packing_materials_used_in_batch_packing_gi }}</textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Review of packing materials used in batch packing">Review Of Packing
                                            Materials Used In Batch
                                            Packing</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea readonly class="summernote" data-stage="3" name="review_of_packing_materials_used_in_batch_packing_gi" id="summernote-1"
                                            >{{ $data->review_of_packing_materials_used_in_batch_packing_gi }} </textarea>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12 mb-3">

                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Review of Analytical Data">Review of Analytical Data <span
                                        class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_analytical_data_gi" id="summernote-1"
                                        required >{{ $data->review_of_analytical_data_gi }}
                                       </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Review of Analytical Data">Review of Analytical Data</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_analytical_data_gi" id="summernote-1"
                                            >{{ $data->review_of_analytical_data_gi }}
                                        </textarea>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Review of Complaint Sample (if applicable)">Review of Complaint Sample (if applicable) <span
                                    class="text-danger">*</span></label>
                                    <div>
                                        <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                    </div>
                                    <textarea class="summernote"  data-stage="3"  name="review_of_complaint_sample_if" id="summernote-1"  {{ $data->stage == 3 ? 'required' : '' }}
                                     >{{ $data->review_of_complaint_sample_if }}</textarea>
                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Review of training record of Concern Persons">Review Of Training
                                            Record
                                            Of Concern Persons <span
                                            class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_training_record_of_concern_persons_gi" id="summernote-1"
                                        required >{{ $data->review_of_training_record_of_concern_persons_gi }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Review of training record of Concern Persons">Review Of Training
                                            Record
                                            Of Concern Persons</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_training_record_of_concern_persons_gi" id="summernote-1"
                                            >{{ $data->review_of_training_record_of_concern_persons_gi }}
                                         </textarea>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label
                                            for="Review of Equipment/Instrument qualification/Calibration record">Review
                                            of Equipment/Instrument qualification/Calibration Record <span
                                            class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="rev_eq_inst_qual_calib_record_gi" id="summernote-1"
                                        required >{{ $data->rev_eq_inst_qual_calib_record_gi }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label
                                            for="Review of Equipment/Instrument qualification/Calibration record">Review
                                            of Equipment/Instrument qualification/Calibration Record</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="rev_eq_inst_qual_calib_record_gi" id="summernote-1"
                                            >{{ $data->rev_eq_inst_qual_calib_record_gi }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Review of Equipment Break-down and Maintainance Record">Review of
                                            Equipment Break-down and Maintenance Record <span
                                            class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_equipment_break_down_and_maintainance_record_gi" id="summernote-1"
                                        required >{{ $data->review_of_equipment_break_down_and_maintainance_record_gi }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Review of Equipment Break-down and Maintainance Record">Review of
                                            Equipment Break-down and Maintenance Record</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea  class="summernote" data-stage="3" name="review_of_equipment_break_down_and_maintainance_record_gi"
                                            id="summernote-1">{{ $data->review_of_equipment_break_down_and_maintainance_record_gi }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Review of Past history of product">Review Of Past History Of
                                            Product <span
                                            class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_past_history_of_product_gi" id="summernote-1"
                                        required >{{ $data->review_of_past_history_of_product_gi }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Review of Past history of product">Review Of Past History Of
                                            Product</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="review_of_past_history_of_product_gi" id="summernote-1"
                                            >{{ $data->review_of_past_history_of_product_gi }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Brain Storming Session/Discussion With Concerned Person
                                        <span
                                                class="text-danger">*</span>
                                        <button type="button" id="brain-stroming"
                                            {{ $data->stage == 3 && $istab4 ? '' : 'disabled' }}>+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal-Market_Complaint_BrainStorming"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="brain_stroming_details"
                                            style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Possibility</th>
                                                    <th>Facts/Controls</th>
                                                    <th>Probable Cause</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $brainindex = 1;
                                                @endphp
                                                {{-- @if (!empty($brain_stroming_details)) --}}
                                                @if (!empty($brain_stroming_details) && is_array($brain_stroming_details->data))
                                                    @foreach ($brain_stroming_details->data as $index => $bra_st_s)
                                                        <tr>
                                                            <td><input disabled type="text"
                                                                    name="brain_stroming_details[{{ $index }}][serial]"
                                                                    value="{{ $brainindex++ }}"
                                                                    {{ $data->stage == 3 && $istab4 ? '' : 'readonly' }}>
                                                            </td>
                                                            <td>
                                                                <textarea name="brain_stroming_details[{{ $index }}][possibility_bssd]"
                                                                          {{ $data->stage == 3 && $istab4 ? '' : 'readonly' }}
                                                                          rows="2" style="width: 100%;">{{ $bra_st_s['possibility_bssd'] }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="brain_stroming_details[{{ $index }}][factscontrols_bssd]"
                                                                          {{ $data->stage == 3 && $istab4 ? '' : 'readonly' }}
                                                                          rows="2" style="width: 100%;">{{ $bra_st_s['factscontrols_bssd'] }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="brain_stroming_details[{{ $index }}][probable_cause_bssd]"
                                                                          {{ $data->stage == 3 && $istab4 ? '' : 'readonly' }}
                                                                          rows="2" style="width: 100%;">{{ $bra_st_s['probable_cause_bssd'] }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="brain_stroming_details[{{ $index }}][remarks_bssd]"
                                                                          {{ $data->stage == 3 && $istab4 ? '' : 'readonly' }}
                                                                          rows="2" style="width: 100%;">{{ $bra_st_s['remarks_bssd'] }}</textarea>
                                                            </td>

                                                            {{-- <td><input type="text"
                                                                    name="brain_stroming_details[{{ $index }}][possibility_bssd]"
                                                                    value="{{ $bra_st_s['possibility_bssd'] }}"
                                                                    {{ $data->stage == 3 ? '' : 'readonly' }}>
                                                            </td>
                                                            <td><input type="text"
                                                                    name="brain_stroming_details[{{ $index }}][factscontrols_bssd]"
                                                                    value="{{ $bra_st_s['factscontrols_bssd'] }}"
                                                                    {{ $data->stage == 3 ? '' : 'readonly' }}>
                                                            </td>
                                                            <td><input type="text"
                                                                    name="brain_stroming_details[{{ $index }}][probable_cause_bssd]"
                                                                    value="{{ $bra_st_s['probable_cause_bssd'] }}"
                                                                    {{ $data->stage == 3 ? '' : 'readonly' }}>
                                                            </td>
                                                            <td><input type="text"
                                                                    name="brain_stroming_details[{{ $index }}][remarks_bssd]"
                                                                    value="{{ $bra_st_s['remarks_bssd'] }}"
                                                                    {{ $data->stage == 3 ? '' : 'readonly' }}>
                                                            </td> --}}
                                                            <td><button type="button" class="removeRowBtn"
                                                                    {{ $data->stage == 3 && $istab4 ? '' : 'readonly' }}>Remove</button>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">No product details found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#brain-stroming').click(function(e) {
                                        e.preventDefault();

                                        function generateTableRow(serialNumber) {
                                            var html =
                                            '<tr>' +
                                                '<td><input disabled type="text" name="brain_stroming_details[' + serialNumber +
                                                '][serial]" value="' + (serialNumber + 1) + '"></td>' +

                                                '<td><textarea name="brain_stroming_details[' + serialNumber +
                                                '][possibility_bssd]" rows="2" style="width: 100%;"></textarea></td>' +

                                                '<td><textarea name="brain_stroming_details[' + serialNumber +
                                                '][factscontrols_bssd]" rows="2" style="width: 100%;"></textarea></td>' +

                                                '<td><textarea name="brain_stroming_details[' + serialNumber +
                                                '][probable_cause_bssd]" rows="2" style="width: 100%;"></textarea></td>' +

                                                '<td><textarea name="brain_stroming_details[' + serialNumber +
                                                '][remarks_bssd]" rows="2" style="width: 100%;"></textarea></td>' +

                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                            '</tr>';
                                            return html;
                                                // '<tr>' +
                                                // '<td><input disabled type="text" name="brain_stroming_details[' + serialNumber +
                                                // '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                // '<td><input type="text" name="brain_stroming_details[' + serialNumber +
                                                // '][possibility_bssd]"></td>' +
                                                // '<td><input type="text" name="brain_stroming_details[' + serialNumber +
                                                // '][factscontrols_bssd]"></td>' +
                                                // '<td><input type="text" name="brain_stroming_details[' + serialNumber +
                                                // '][probable_cause_bssd]"></td>' +
                                                // '<td><input type="text" name="brain_stroming_details[' + serialNumber +
                                                // '][remarks_bssd]"></td>' +
                                                // '<td><button type="button" class="removeRowBtn">Remove</button></td>' +

                                                // '</tr>';

                                        }

                                        var tableBody = $('#brain_stroming_details tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });
                                });
                            </script>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label
                                            for="Conclusion (A dedicated provision must be established to record the inference or outcome of brainstorming sessions) ">Conclusion <span
                                            class="text-danger">*</span>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="conclusion_pi" id="summernote-1"
                                        required>{{ $data->conclusion_pi }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label
                                            for="Conclusion (A dedicated provision must be established to record the inference or outcome of brainstorming sessions) ">Conclusion
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="conclusion_pi" id="summernote-1"
                                           >{{ $data->conclusion_pi }}
                                        </textarea>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Conclusion">Root Cause Analysis <span
                                        class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="conclusion_hodsr" id="summernote-1"
                                        required>{{ $data->conclusion_hodsr }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Conclusion">Root Cause Analysis</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="conclusion_hodsr" id="summernote-1"
                                            >{{ $data->conclusion_hodsr }}
                                        </textarea>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Root Cause Analysis">Other Methodology <span
                                        class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="root_cause_analysis_hodsr" id="summernote-1"
                                        required>{{ $data->root_cause_analysis_hodsr }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Root Cause Analysis">Other Methodology</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="root_cause_analysis_hodsr" id="summernote-1"
                                            >{{ $data->root_cause_analysis_hodsr }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="The probable root causes or Root Cause">The probable root causes or
                                            Root
                                            Cause <span
                                            class="text-danger">*</span> </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="the_probable_root" id="summernote-1"
                                        required>{{ $data->the_probable_root }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="The probable root causes or Root Cause">The probable root causes or
                                            Root
                                            Cause </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="the_probable_root" id="summernote-1"
                                            >{{ $data->the_probable_root }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>
                            

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Impact Assessment">Impact Assessment  <span
                                        class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="impact_assessment_hodsr" id="summernote-1"
                                        required >{{ $data->impact_assessment_hodsr }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Impact Assessment">Impact Assessment </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="impact_assessment_hodsr" id="summernote-1"
                                            >{{ $data->impact_assessment_hodsr }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>



                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Corrective Action">Corrective Action  <span
                                        class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="corrective_action_hodsr" id="summernote-1"
                                        required>{{ $data->corrective_action_hodsr }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Corrective Action">Corrective Action </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="corrective_action_hodsr" id="summernote-1"
                                            >{{ $data->corrective_action_hodsr }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>


                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action <span
                                        class="text-danger">*</span> </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="preventive_action_hodsr" id="summernote-1"
                                          required>{{ $data->preventive_action_hodsr }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="preventive_action_hodsr" id="summernote-1"
                                          >{{ $data->preventive_action_hodsr }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($data->stage == 3)
                                    <div class="group-input">
                                        <label for="Summary and Conclusion">Summary And Conclusion <span
                                        class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="summary_and_conclusion_hodsr" id="summernote-1"
                                        required>{{ $data->summary_and_conclusion_hodsr }}
                                        </textarea>
                                    </div>
                                @else
                                    <div class="group-input">
                                        <label for="Summary and Conclusion">Summary And Conclusion</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" data-stage="3" name="summary_and_conclusion_hodsr" id="summernote-1"
                                        required>{{ $data->summary_and_conclusion_hodsr }}
                                        </textarea>
                                    </div>
                                @endif

                            </div>






            <div class="col-12">
                <div class="group-input">
                    <label for="Inv Attachments">Investigation attachment</label>
                    <div>
                        <small class="text-primary">
                            Please Attach all relevant or supporting documents
                        </small>
                    </div>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="investigation_attach">

                            @if ($data->investigation_attach)
                                @foreach (json_decode($data->investigation_attach) as $file)
                                    <h6 type="button" class="file-container text-dark"
                                        style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                class="fa fa-eye text-primary"
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
                            <input type="file" id="investigation_attach" {{ $data->stage == 3 && $istab4 ? '' : 'disabled' }}
                                name="investigation_attach[]"
                                oninput="addMultipleFiles(this,'investigation_attach')"
                                multiple>
                        </div>
                    </div>
                </div>
            </div>


                    </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" id="saveButton"
                                {{ $data->stage == 3 && $istab4 ? '' : 'readonly' }}>Save</button>

                            
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

                <!-------------------------------------------cft------------------------------------------------->

                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">
                                Production (Tablet/Capsule/Powder)
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->Production_Table_Review !== 'yes')
                                        $('.productionTable').hide();

                                        $('[name="Production_Table_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.productionTable').show();
                                                $('.productionTable span').show();
                                            } else {
                                                $('.productionTable').hide();
                                                $('.productionTable span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Tablet">Production Tablet/Capsule/Powder Review Required? <span
                                                class="text-danger">*</span></label>
                                        <select name="Production_Table_Review" id="Production_Table_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Production_Table_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Production_Table_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{-- <option @if ($data1->Production_Table_Review == 'na') selected @endif value='na'>
                                                NA</option> --}}
                                                <option @if ($data1->Production_Table_Review == 'NA' || empty($data1->Production_Table_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 51,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet notification">Production Tablet/Capsule/Powder Person <span
                                                id="asteriskPT"
                                                style="display: {{ $data1->Production_Table_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="Production_Table_Person" class="Production_Table_Person"
                                            id="Production_Table_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet assessment">Impact Assessment(By Production (Tablet/Capsule/Powder)
                                            <span id="asteriskPT1"
                                                style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <textarea @if ($data1->Production_Table_Review == 'yes' && $data->stage == 4) required @endif class="Production_Table_Assessment"
                                            @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif name="Production_Table_Assessment" id="summernote-17" {{ $data->stage == 4 ? '' : 'readonly' }}>{{ $data1->Production_Table_Assessment }}</textarea>
                                    </div>

                                </div>
                                {{-- <div class="col-md-12 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet feedback">Production Tablet Feedback <span
                                                id="asteriskPT2"
                                                style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" Production_Table_Feedback" @if (
                                            $data->stage == 3 ||
                                                (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif
                                            name="Production_Table_Feedback" id="summernote-18" @if ($data1->Production_Table_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_Table_Feedback }}</textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet attachment">Production Tablet/Capsule/Powder Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Production_Table_Attachment">
                                                @if ($data1->Production_Table_Attachment)
                                                    @foreach (json_decode($data1->Production_Table_Attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Production_Table_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet Completed By">Production Tablet/Capsule/Powder  Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->Production_Table_By }}"
                                            name="Production_Table_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="Production_Table_By">
                                    </div>
                                </div>

                                {{-- <div class="col-6 productionTable new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Production Tablet Completed On">Production Tablet/Capsule/Powder Review  Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Production_Table_On" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                            <input readonly type="date" name="Production_Table_On"
                                                 value=""
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'Production_Table_On')" />
                                        </div>
                                        @error('Production_Table_On')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}


                                 <div class="col-6 mb-3 productionTable new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Tablet Completed On">Production Tablet/Capsule / Powder Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Production_Table_On" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                        <input readonly type="date" name="Production_Table_On"
                                                            min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Production_Table_On')" />
                                                    </div>
                                                    @error('Production_Table_On')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>



                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Production_Table_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Production_Table_Person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Table_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Table_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Tablet">Production Tablet/Capsule/Powder Review Required?</label>
                                        <select name="Production_Table_Review" disabled id="Production_Table_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Production_Table_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Production_Table_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{-- <option @if ($data1->Production_Table_Review == 'na') selected @endif value='na'>
                                                NA</option> --}}
                                            <option @if ($data1->Production_Table_Review == 'NA' || empty($data1->Production_Table_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 51,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet notification">Production Tablet/Capsule/Powder Person<span
                                                id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="Production_Table_Person" disabled id="Production_Table_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Tablet assessment">Impact Assessment By Production (Tablet/Capsule/Powder)
                                                <!-- <span
                                                                                                                                                                                                                                    id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Tablet feedback">Production Tablet Feedback
                                                <!-- <span
                                                                                                                                                                                                                                    id="asteriskInvi22" style="display: none"
                                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="col-md-12 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Tablet assessment">Impact Assessment By Production (Tablet/Capsule/Powder)
                                                <!-- <span
                                                                                                                                                                                                     id="asteriskInvi12" style="display: none"
                                                                                                                                                                                    class="text-danger">*</span> -->
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Tablet feedback">Production Tablet Feedback
                                                <!-- <span
                                                                                                                                                                                                                                    id="asteriskInvi22" style="display: none"
                                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Production_Table_Feedback" id="summernote-18" {{ $data->stage == 5 ? '' : 'readonly' }}>{{ $data1->Production_Table_Feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @endif
                                <div class="col-12 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet attachment">Production Tablet/Capsule/Powder Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Production_Table_Attachment">
                                                @if ($data1->Production_Table_Attachment)
                                                    @foreach (json_decode($data1->Production_Table_Attachment) as $file)
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
                                                <input disabled
                                                {{ $data->stage == 5 ? '' : 'disabled' }}
                                                    type="file" id="myfile" name="Production_Table_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet Completed By">Production Tablet/Capsule/Powder  Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->Production_Table_By }}"
                                            name="Production_Table_By" id="Production_Table_By">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet Completed On">Production Tablet/Capsule/Powder Review  Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date"id="Production_Table_On"
                                            name="Production_Table_On"
                                              value="{{ \Carbon\Carbon::parse($data1->Production_Table_On)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}


                                 <div class="col-6 mb-3 productionTable new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Tablet Completed On">Production Tablet/Capsule/Powder Review  Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Production_Table_On" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                        <input readonly type="date" name="Production_Table_On"
                                                            min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Production_Table_On')" />
                                                    </div>
                                                    @error('Production_Table_On')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                            @endif

                            <div class="sub-head">
                                Production Injection
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->Production_Injection_Review !== 'yes')
                                        $('.productionInjection').hide();

                                        $('[name="Production_Injection_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.productionInjection').show();
                                                $('.productionInjection span').show();
                                            } else {
                                                $('.productionInjection').hide();
                                                $('.productionInjection span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Injection"> Production Injection Review Required? <span
                                                class="text-danger">*</span></label>
                                        <select name="Production_Injection_Review" id="Production_Injection_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Production_Injection_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Production_Injection_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Production_Injection_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Production_Injection_Review == 'NA' || empty($data1->Production_Injection_Review)) selected @endif value='NA'>NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 53,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection notification">Production Injection Person
                                            <span id="asteriskPT"
                                                style="display: {{ $data1->Production_Injection_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="Production_Injection_Person" class="Production_Injection_Person"
                                            id="Production_Injection_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection assessment">Impact Assessment (By Production
                                            Injection) <span id="asteriskPT1"
                                                style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 4) required @endif class=" Production_Injection_Assessment"
                                            @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                    </div>
                                </div>

                            {{--
                                <div class="col-md-12 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection feedback">Production Injection Feedback <span
                                                id="asteriskPT2"
                                                style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" Production_Injection_Feedback" @if (
                                            $data->stage == 3 ||
                                                (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif
                                            name="Production_Injection_Feedback" id="summernote-18" @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_Injection_Feedback }}</textarea>
                                    </div>
                                </div>
                            --}}


                                <div class="col-12 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection attachment">Production Injection
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Production_Injection_Attachment">
                                                @if ($data1->Production_Injection_Attachment)
                                                    @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Production_Injection_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection Completed By">Production Injection Review  Completed
                                            By</label>
                                        <input readonly type="text" value="{{ $data1->Production_Injection_By }}"
                                            name="Production_Injection_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="Production_Injection_By">
                                    </div>
                                </div>
                                <div class="col-6 productionInjection new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Production Injection Completed On">Production Injection Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Production_Injection_On" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Production_Injection_On) }}" />
                                            <input readonly type="date" name="Production_Injection_On"
                                                 value=""
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'Production_Injection_On')" />
                                        </div>
                                        @error('Production_Injection_On')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Production_Injection_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Production_Injection_Person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Injection">Production Injection Review Required?</label>
                                        <select name="Production_Injection_Review" disabled
                                            id="Production_Injection_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Production_Injection_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Production_Injection_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Production_Injection_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                                <option @if ($data1->Production_Injection_Review == 'NA' || empty($data1->Production_Injection_Review)) selected @endif value='NA'>NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 53,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection notification">Production Injection Person
                                            <span id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="Production_Injection_Person" disabled
                                            id="Production_Injection_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection assessment">Impact Assessment (By
                                                Production Injection)
                                                <!-- <span
                                                                                                                                                                                                                                    id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection feedback">Production Injection Feedback
                                                <!-- <span
                                                                                                                                                                                                                                    id="asteriskInvi22" style="display: none"
                                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection assessment">Impact Assessment (By
                                                Production Injection)
                                                <!-- <span
                                                                                                                                                                                                                                    id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection feedback">Production Injection Feedback
                                                <!-- <span
                                                                                                                                                                                                                                    id="asteriskInvi22" style="display: none"
                                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @endif
                                <div class="col-12 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection attachment">Production Injection
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Production_Injection_Attachment">
                                                @if ($data1->Production_Injection_Attachment)
                                                    @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Production_Injection_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection Completed By">Production Injection Review  Completed
                                            By</label>
                                        <input readonly type="text" value="{{ $data1->Production_Injection_By }}"
                                            name="Production_Injection_By" id="Production_Injection_By">


                                    </div>
                                </div>
                               <div class="col-lg-6 productionInjection">
                                <div class="group-input">
                                    <label>Production Injection Review Completed On</label>

                                    <!-- Display formatted date -->
                                    <input type="text"
                                        readonly
                                        value="{{ Helpers::getdateFormat($data1->Production_Injection_On) }}"
                                        placeholder="DD-MMM-YYYY">

                                    <!-- Actual date value -->
                                    <input type="date"
                                        id="Production_Injection_On"
                                        name="Production_Injection_On"
                                        value="{{ \Carbon\Carbon::parse($data1->Production_Injection_On)->format('Y-m-d') }}"
                                        class="d-none">
                                </div>
                            </div>




                            @endif


                            <div class="sub-head">
                                Research & Development
                            </div>
                            <script>
                                $(document).ready(function() {

                                    @if ($data1->ResearchDevelopment_Review !== 'yes')
                                        $('.researchDevelopment').hide();

                                        $('[name="ResearchDevelopment_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.researchDevelopment').show();
                                                $('.researchDevelopment span').show();
                                            } else {
                                                $('.researchDevelopment').hide();
                                                $('.researchDevelopment span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Research Development"> Research  & Development Review Required? <span
                                                class="text-danger">*</span></label>
                                        <select name="ResearchDevelopment_Review" id="ResearchDevelopment_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->ResearchDevelopment_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                                <option @if ($data1->ResearchDevelopment_Review == 'NA' || empty($data1->ResearchDevelopment_Review)) selected @endif value='NA'>NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 55,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development notification">Research & Development Person
                                            <span id="asteriskPT"
                                                style="display: {{ $data1->ResearchDevelopment_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="ResearchDevelopment_person" class="ResearchDevelopment_person"
                                            id="ResearchDevelopment_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development assessment">Impact Assessment (By Research & Development) <span id="asteriskPT1"
                                                style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4) required @endif class=" ResearchDevelopment_assessment"
                                            @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->ResearchDevelopment_person) && Auth::user()->name != $data1->ResearchDevelopment_person)) readonly @endif name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development feedback">Research Development Feedback <span
                                                id="asteriskPT2"
                                                style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" ResearchDevelopment_feedback" @if (
                                            $data->stage == 3 ||
                                                (isset($data1->ResearchDevelopment_person) && Auth::user()->name != $data1->ResearchDevelopment_person)) readonly @endif
                                            name="ResearchDevelopment_feedback" id="summernote-18" @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                    </div>
                                </div> --}}

                                <div class="col-12 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development attachment">Research & Development Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="ResearchDevelopment_attachment">
                                                @if ($data1->ResearchDevelopment_attachment)
                                                    @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="ResearchDevelopment_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development Completed By">Research & Development Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->ResearchDevelopment_by }}"
                                            name="ResearchDevelopment_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="ResearchDevelopment_by">


                                    </div>
                                </div>

                                {{-- <div class="col-6 researchDevelopment new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Research Development Completed On">Research & Development Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="ResearchDevelopment_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />
                                            <input readonly type="date" name="ResearchDevelopment_on"
                                                 value=""
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'ResearchDevelopment_on')" />
                                        </div>
                                        @error('ResearchDevelopment_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

                                 <div class="col-6 researchDevelopment new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Research Development Completed On">Research & Development Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="ResearchDevelopment_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />
                                                        <input readonly type="date" name="ResearchDevelopment_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'ResearchDevelopment_on')" />
                                                    </div>
                                                    @error('ResearchDevelopment_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('ResearchDevelopment_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('ResearchDevelopment_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Research Development">Research  & Development Review Required?</label>
                                        <select name="ResearchDevelopment_Review" disabled
                                            id="ResearchDevelopment_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->ResearchDevelopment_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->ResearchDevelopment_Review == 'NA' || empty($data1->ResearchDevelopment_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 55,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development notification">Research & Development Person
                                            <span id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="ResearchDevelopment_person" disabled
                                            id="ResearchDevelopment_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development assessment">Impact Assessment (By Research & Development)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development feedback">Research Development
                                                Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="col-md-12 mb-3 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development assessment">Impact Assessment (By Research & Development)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 researchDevelopment">
                                        <div class="group-input">
                                            <label for="Research Development feedback">Research Development
                                                Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @endif
                                <div class="col-12 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development attachment">Research & Development Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="ResearchDevelopment_attachment">
                                                @if ($data1->ResearchDevelopment_attachment)
                                                    @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="ResearchDevelopment_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development Completed By">Research & Development Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->ResearchDevelopment_by }}"
                                            name="ResearchDevelopment_by" id="StorResearchDevelopment_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development Completed On">Research & Development Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date" id="ResearchDevelopment_on"
                                            name="ResearchDevelopment_on"

                                              value="{{ \Carbon\Carbon::parse($data1->ResearchDevelopment_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}


                                 <div class="col-6 researchDevelopment new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Research Development Completed On">Research & Development Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="ResearchDevelopment_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />
                                                        <input readonly type="date" name="ResearchDevelopment_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'ResearchDevelopment_on')" />
                                                    </div>
                                                    @error('ResearchDevelopment_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                            @endif



                            <div class="sub-head">
                                Human Resource
                            </div>
                            <script>
                                $(document).ready(function() {

                                    @if ($data1->Human_Resource_review !== 'yes')
                                        $('.Human_Resource').hide();

                                        $('[name="Human_Resource_review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.Human_Resource').show();
                                                $('.Human_Resource span').show();
                                            } else {
                                                $('.Human_Resource').hide();
                                                $('.Human_Resource span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Human Resource"> Human Resource Review Required? <span
                                                class="text-danger">*</span></label>
                                        <select name="Human_Resource_review" id="Human_Resource_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Human_Resource_review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Human_Resource_review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Human_Resource_review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Human_Resource_review == 'NA' || empty($data1->Human_Resource_review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 31,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource notification">Human Resource Person <span
                                                id="asteriskPT"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="Human_Resource_person" class="Human_Resource_person"
                                            id="Human_Resource_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource assessment">Impact Assessment (By Human Resource)
                                            <span id="asteriskPT1"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif class=" Human_Resource_assessment"
                                            @if ($data->stage == 3 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 mb-3 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource feedback">Human Resource Feedback <span
                                                id="asteriskPT2"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" Human_Resource_feedback" @if ($data->stage == 3 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif
                                            name="Human_Resource_feedback" id="summernote-18" @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Human_Resource_feedback }}</textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource attachment">Human Resource Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                @if ($data1->Human_Resource_attachment)
                                                    @foreach (json_decode($data1->Human_Resource_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Human_Resource_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource Completed By">Human Resource Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->Human_Resource_by }}"
                                            name="Human_Resource_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="Human_Resource_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 Human_Resource">
                                    <div class="group-input ">
                                        <label for="Human Resource Completed On"> Human Resource Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Human_Resource_on"
                                            name="Human_Resource_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Human_Resource_on }}">
                                    </div>
                                </div> --}}


                                 <div class="col-lg-6 Human_Resource new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Human Resource Completed On"> Human Resource Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Human_Resource_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Human_Resource_on) }}" />
                                                        <input readonly type="date" name="Human_Resource_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Human_Resource_on')" />
                                                    </div>
                                                    @error('Human_Resource_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Human_Resource_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Human_Resource_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Human Resource">Human Resource Review Required?</label>
                                        <select name="Human_Resource_review" disabled id="Human_Resource_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Human_Resource_review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Human_Resource_review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Human_Resource_review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Human_Resource_review == 'NA' || empty($data1->Human_Resource_review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 31,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource notification">Human Resource Person <span
                                                id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="Human_Resource_person" disabled id="Human_Resource_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 Human_Resource">
                                        <div class="group-input">
                                            <label for="Human Resource assessment">Impact Assessment (By Human
                                                Resource)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 Human_Resource">
                                        <div class="group-input">
                                            <label for="Human Resource feedback">Human Resource Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="col-md-12 mb-3 Human_Resource">
                                        <div class="group-input">
                                            <label for="Human Resource assessment">Impact Assessment (By Human
                                                Resource)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 Human_Resource">
                                        <div class="group-input">
                                            <label for="Human Resource feedback">Human Resource Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @endif
                                <div class="col-12 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource attachment">Human Resource Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                @if ($data1->Human_Resource_attachment)
                                                    @foreach (json_decode($data1->Human_Resource_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource Completed By">Human Resource Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->Human_Resource_by }}"
                                            name="Human_Resource_by" id="Human_Resource_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 Human_Resource">
                                    <div class="group-input">
                                        <label for="Human Resource Completed On"> Human Resource Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date" id="Human_Resource_on" name="Human_Resource_on"
                                              value="{{ \Carbon\Carbon::parse($data1->Human_Resource_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}

                                 <div class="col-lg-6 Human_Resource new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Human Resource Completed On">Human Resource Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Human_Resource_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Human_Resource_on) }}" />
                                                        <input readonly type="date" name="Human_Resource_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Human_Resource_on')" />
                                                    </div>
                                                    @error('Human_Resource_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                            @endif





                            <div class="sub-head">
                                Corporate Quality Assurance
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->CorporateQualityAssurance_Review !== 'yes')
                                        $('.CQA').hide();

                                        $('[name="CorporateQualityAssurance_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.CQA').show();
                                                $('.CQA span').show();
                                            } else {
                                                $('.CQA').hide();
                                                $('.CQA span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance"> Corporate Quality Assurance Review Required? <span class="text-danger">*</span></label>
                                        <select name="CorporateQualityAssurance_Review"
                                            id="CorporateQualityAssurance_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->CorporateQualityAssurance_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->CorporateQualityAssurance_Review == 'NA' || empty($data1->CorporateQualityAssurance_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 58,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance notification">Corporate Quality
                                            Assurance Person <span id="asteriskPT"
                                                style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="CorporateQualityAssurance_person"
                                            class="CorporateQualityAssurance_person"
                                            id="CorporateQualityAssurance_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance assessment">Impact Assessment (By
                                            Corporate Quality
                                            Assurance) <span id="asteriskPT1"
                                                style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4) required @endif class=" CorporateQualityAssurance_assessment"
                                            @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->CorporateQualityAssurance_person) &&
                                                        Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif name="CorporateQualityAssurance_assessment"
                                            id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance
                                            Feedback <span id="asteriskPT2"
                                                style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" CorporateQualityAssurance_feedback" @if (
                                            $data->stage == 3 ||
                                                (isset($data1->CorporateQualityAssurance_person) &&
                                                    Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif
                                            name="CorporateQualityAssurance_feedback" id="summernote-18"
                                            @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance attachment">Corporate Quality
                                            Assurance
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="CorporateQualityAssurance_attachment">
                                                @if ($data1->CorporateQualityAssurance_attachment)
                                                    @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="CorporateQualityAssurance_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance Review  Completed By</label>
                                        <input readonly type="text"
                                            value="{{ $data1->CorporateQualityAssurance_by }}"
                                            name="CorporateQualityAssurance_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="CorporateQualityAssurance_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 CQA">
                                    <div class="group-input ">
                                        <label for="Corporate Quality Assurance Completed On">Corporate Quality Assurance Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="CorporateQualityAssurance_on"
                                            name="CorporateQualityAssurance_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->CorporateQualityAssurance_on }}">
                                    </div>
                                </div> --}}


                                 <div class="col-lg-6 CQA new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Corporate Quality Assurance Completed On">Corporate
                                            Quality
                                            Assurance Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="CorporateQualityAssurance_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}" />
                                            <input readonly type="date"
                                                name="CorporateQualityAssurance_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'CorporateQualityAssurance_on')" />
                                        </div>
                                        @error('CorporateQualityAssurance_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('CorporateQualityAssurance_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('CorporateQualityAssurance_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance">Corporate Quality Assurance Review Required?</label>
                                        <select name="CorporateQualityAssurance_Review" disabled
                                            id="CorporateQualityAssurance_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->CorporateQualityAssurance_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                                <option @if ($data1->CorporateQualityAssurance_Review == 'NA' || empty($data1->CorporateQualityAssurance_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 58,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance notification">Corporate Quality
                                            Assurance Person <span id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="CorporateQualityAssurance_person" disabled
                                            id="CorporateQualityAssurance_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 CQA">
                                        <div class="group-input">
                                            <label for="Corporate Quality Assurance assessment">Impact Assessment (By
                                                Corporate
                                                Quality Assurance)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 CQA">
                                        <div class="group-input">
                                            <label for="Corporate Quality Assurance feedback">Corporate Quality
                                                Assurance
                                                Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="col-md-12 mb-3 CQA">
                                        <div class="group-input">
                                            <label for="Corporate Quality Assurance assessment">Impact Assessment (By
                                                Corporate
                                                Quality Assurance)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 CQA">
                                        <div class="group-input">
                                            <label for="Corporate Quality Assurance feedback">Corporate Quality
                                                Assurance
                                                Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @endif
                                <div class="col-12 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance attachment">Corporate Quality
                                            Assurance
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="CorporateQualityAssurance_attachment">
                                                @if ($data1->CorporateQualityAssurance_attachment)
                                                    @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Microbiology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance Review  Completed By</label>
                                        <input readonly type="text"
                                            value="{{ $data1->CorporateQualityAssurance_by }}"
                                            name="CorporateQualityAssurance_by" id="CorporateQualityAssurance_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance Completed On">Corporate Quality Assurance Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date" id="CorporateQualityAssurance_on"
                                            name="CorporateQualityAssurance_on"
                                              value="{{ \Carbon\Carbon::parse($data1->CorporateQualityAssurance_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 CQA new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Corporate Quality Assurance Completed On">Corporate
                                                        Quality
                                                        Assurance Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="CorporateQualityAssurance_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}" />
                                                        <input readonly type="date"
                                                            name="CorporateQualityAssurance_on"
                                                             value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'CorporateQualityAssurance_on')" />
                                                    </div>
                                                    @error('CorporateQualityAssurance_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                            @endif



                            <div class="sub-head">
                                Stores
                            </div>
                            <script>
                                $(document).ready(function() {

                                    @if ($data1->Store_Review !== 'yes')
                                        $('.store').hide();

                                        $('[name="Store_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.store').show();
                                                $('.store span').show();
                                            } else {
                                                $('.store').hide();
                                                $('.store span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Store"> Stores Review Required? <span
                                                class="text-danger">*</span></label>
                                        <select name="Store_Review" id="Store_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Store_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Store_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Store_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Store_Review == 'NA' || empty($data1->Store_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 54,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 store">
                                    <div class="group-input">
                                        <label for="Store notification">Store Person <span id="asteriskPT"
                                                style="display: {{ $data1->Store_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif name="Store_person"
                                            class="Store_person" id="Store_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Store_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store assessment">Impact Assessment (By Store) <span
                                                id="asteriskPT1"
                                                style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->Store_Review == 'yes' && $data->stage == 4) required @endif class=" Store_assessment"
                                            @if ($data->stage == 3 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="store feedback">store Feedback <span id="asteriskPT2"
                                                style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" Store_feedback" @if ($data->stage == 3 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif name="Store_feedback"
                                            id="summernote-18" @if ($data1->Store_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Store_feedback }}</textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12 store">
                                    <div class="group-input">
                                        <label for="Store attachment">Store Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="store_attachment">
                                                @if ($data1->store_attachment)
                                                    @foreach (json_decode($data1->store_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="store_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'store_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store Completed By">Store Review Completed  By</label>
                                        <input readonly type="text" value="{{ $data1->Store_by }}"
                                            name="Store_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="Store_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 store">
                                    <div class="group-input ">
                                        <label for="Store Completed On">Store Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Store_on"
                                            name="Store_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Store_on }}">
                                    </div>
                                </div> --}}


                                <div class="col-lg-6 store new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Store Completed On">Store Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Store_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Store_on) }}" />
                                                        <input readonly type="date" name="Store_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Store_on')" />
                                                    </div>
                                                    @error('Store_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Store_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Store_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Store">Stores Review Required?</label>
                                        <select name="Store_Review" disabled id="Store_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Store_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Store_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Store_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Store_Review == 'NA' || empty($data1->Store_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 54,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 store">
                                    <div class="group-input">
                                        <label for="Store notification">Store Person <span id="asteriskInvi11"
                                                style="display: none" class="text-danger">*</span></label>
                                        <select name="Store_person" disabled id="Store_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Store_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 store">
                                        <div class="group-input">
                                            <label for="Store assessment">Impact Assessment (By Store)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 store">
                                        <div class="group-input">
                                            <label for="Store feedback">Store Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="col-md-12 mb-3 store">
                                        <div class="group-input">
                                            <label for="Store assessment">Impact Assessment (By Store)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 store">
                                        <div class="group-input">
                                            <label for="Store feedback">Store Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @endif
                                <div class="col-12 store">
                                    <div class="group-input">
                                        <label for="Store attachment">Store Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="store_attachment">
                                                @if ($data1->store_attachment)
                                                    @foreach (json_decode($data1->store_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="store_attachment[]"
                                                    oninput="addMultipleFiles(this, 'store_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store Completed By">Store Review Completed  By</label>
                                        <input readonly type="text" value="{{ $data1->Store_by }}"
                                            name="Store_by" id="Store_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 store">
                                    <div class="group-input">
                                        <label for="Store Completed On">Store Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date" id="Store_on" name="Store_on"
                                              value="{{ \Carbon\Carbon::parse($data1->Store_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 store new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Store Completed On">Store Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Store_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Store_on) }}" />
                                                        <input readonly type="date" name="Store_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Store_on')" />
                                                    </div>
                                                    @error('Store_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                            @endif
                            <div class="sub-head">
                                Engineering
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->Engineering_review !== 'yes')
                                        $('.Engineering').hide();

                                        $('[name="Engineering_review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.Engineering').show();
                                                $('.Engineering span').show();
                                            } else {
                                                $('.Engineering').hide();
                                                $('.Engineering span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering"> Engineering Review Required ? <span
                                                class="text-danger">*</span></label>
                                        <select name="Engineering_review" id="Engineering_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Engineering_review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Engineering_review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Engineering_review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Engineering_review == 'NA' || empty($data1->Engineering_review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 25,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering notification">Engineering Person <span id="asteriskPT"
                                                style="display: {{ $data1->Engineering_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="Engineering_person" class="Engineering_person"
                                            id="Engineering_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Engineering_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering assessment">Impact Assessment (By Engineering) <span
                                                id="asteriskPT1"
                                                style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif class=" Engineering_assessment"
                                            @if ($data->stage == 3 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 mb-3 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering feedback">Engineering Feedback <span id="asteriskPT2"
                                                style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" Engineering_feedback" @if ($data->stage == 3 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif
                                            name="Engineering_feedback" id="summernote-18" @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Engineering_feedback }}</textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering attachment">Engineering Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                @if ($data1->Engineering_attachment)
                                                    @foreach (json_decode($data1->Engineering_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Engineering_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering Completed By">Engineering Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->Engineering_by }}"
                                            name="Engineering_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="Engineering_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 Engineering">
                                    <div class="group-input ">
                                        <label for="Engineering Completed On">Engineering Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Engineering_on"
                                            name="Engineering_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Engineering_on }}">
                                    </div>
                                </div> --}}

                                 <div class="col-lg-6 Engineering new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Store Completed On">Engineering Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Engineering_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Engineering_on) }}" />
                                                        <input readonly type="date" name="Engineering_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Engineering_on')" />
                                                    </div>
                                                    @error('Engineering_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Engineering_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Engineering_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering">Engineering Review Required ?</label>
                                        <select name="Engineering_review" disabled id="Engineering_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Engineering_review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Engineering_review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Engineering_review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Engineering_review == 'NA' || empty($data1->Engineering_review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 25,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering notification">Engineering Person <span
                                                id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="Engineering_person" disabled id="Engineering_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Engineering_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 Engineering">
                                        <div class="group-input">
                                            <label for="Engineering assessment">Impact Assessment (By
                                                Engineering)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 Engineering">
                                        <div class="group-input">
                                            <label for="Engineering feedback">Engineering Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="col-md-12 mb-3 Engineering">
                                        <div class="group-input">
                                            <label for="Engineering assessment">Impact Assessment (By
                                                Engineering)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 Engineering">
                                        <div class="group-input">
                                            <label for="Engineering feedback">Engineering Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @endif
                                <div class="col-12 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering attachment">Engineering Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                @if ($data1->Engineering_attachment)
                                                    @foreach (json_decode($data1->Engineering_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Engineering_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering Completed By">Engineering Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->Engineering_by }}"
                                            name="Engineering_by" id="Engineering_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 Engineering">
                                    <div class="group-input">
                                        <label for="Engineering Completed On">Engineering Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date" id="Engineering_on" name="Engineering_on"
                                              value="{{ \Carbon\Carbon::parse($data1->Engineering_on)->format('Y-m-d') }}">
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 Engineering new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Store Completed On">Engineering Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Engineering_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Engineering_on) }}" />
                                                        <input readonly type="date" name="Engineering_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Engineering_on')" />
                                                    </div>
                                                    @error('Engineering_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                            @endif

                            <div class="sub-head">
                                Regulatory Affair
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->RegulatoryAffair_Review !== 'yes')
                                        $('.RegulatoryAffair').hide();

                                        $('[name="RegulatoryAffair_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.RegulatoryAffair').show();
                                                $('.RegulatoryAffair span').show();
                                            } else {
                                                $('.RegulatoryAffair').hide();
                                                $('.RegulatoryAffair span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RegulatoryAffair"> Regulatory Affair Review Required ? <span
                                                class="text-danger">*</span></label>
                                        <select name="RegulatoryAffair_Review" id="RegulatoryAffair_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->RegulatoryAffair_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->RegulatoryAffair_Review == 'NA' || empty($data1->RegulatoryAffair_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 57,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair notification">Regulatory Affair Person <span
                                                id="asteriskPT"
                                                style="display: {{ $data1->RegulatoryAffair_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="RegulatoryAffair_person" class="RegulatoryAffair_person"
                                            id="RegulatoryAffair_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory
                                            Affair) <span id="asteriskPT1"
                                                style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4) required @endif class=" RegulatoryAffair_assessment"
                                            @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair feedback">Regulatory Affair Feedback <span
                                                id="asteriskPT2"
                                                style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" RegulatoryAffair_feedback" @if (
                                            $data->stage == 3 ||
                                                (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif
                                            name="RegulatoryAffair_feedback" id="summernote-18" @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                    </div>
                                </div>

                                --}}
                                <div class="col-12 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair attachment">Regulatory Affair
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="RegulatoryAffair_attechment">
                                                @if ($data1->RegulatoryAffair_attechment)
                                                    @foreach (json_decode($data1->RegulatoryAffair_attechment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="RegulatoryAffair_attechment[]"{{ $data->stage == 3 ? '' : 'readonly' }}
                                                    oninput="addMultipleFiles(this, 'RegulatoryAffair_attechment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--@php
                                dd(json_decode($data1->RegulatoryAffair_attechment));
                                @endphp--}}

                                <div class="col-md-6 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair Completed By">Regulatory Affair Review  Completed
                                            By</label>
                                        <input readonly type="text" value="{{ $data1->RegulatoryAffair_by }}"
                                            name="RegulatoryAffair_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="RegulatoryAffair_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input ">
                                        <label for="Regulatory Affair Completed On">Regulatory Affair Review  Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="RegulatoryAffair_on"
                                            name="RegulatoryAffair_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->RegulatoryAffair_on }}">
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 RegulatoryAffair new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Regulatory Affair Completed On">Regulatory Affair Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="RegulatoryAffair_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}" />
                                                        <input readonly type="date" name="RegulatoryAffair_on"
                                                             value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'RegulatoryAffair_on')" />
                                                    </div>
                                                    @error('RegulatoryAffair_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('RegulatoryAffair_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('RegulatoryAffair_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Regulatory Affair">Regulatory Affair Required ?</label>
                                        <select name="RegulatoryAffair_Review" disabled id="RegulatoryAffair_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->RegulatoryAffair_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->RegulatoryAffair_Review == 'NA' || empty($data1->RegulatoryAffair_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 57,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair notification">Regulatory Affair Person <span
                                                id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="RegulatoryAffair_person" disabled id="RegulatoryAffair_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 RegulatoryAffair">
                                        <div class="group-input">
                                            <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory
                                                Affair)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                        <div class="group-input">
                                            <label for="Regulatory Affair feedback">Impact Assessment (By Regulatory Affair)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="col-md-12 mb-3 RegulatoryAffair">
                                        <div class="group-input">
                                            <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory
                                                Affair)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                        <div class="group-input">
                                            <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                @endif
                                {{-- <div class="col-12 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair attachment">Regulatory Affair
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="RegulatoryAffair_attechment">
                                                @if ($data1->RegulatoryAffair_attechment)
                                                    @foreach (json_decode($data1->RegulatoryAffair_attechment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="RegulatoryAffair_attechment[]"
                                                    oninput="addMultipleFiles(this, 'RegulatoryAffair_attechment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair Completed By">Regulatory Affair Review  Completed
                                            By</label>
                                        <input readonly type="text" value="{{ $data1->RegulatoryAffair_by }}"
                                            name="RegulatoryAffair_by" id="RegulatoryAffair_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair Completed On">Regulatory Affair Review  Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date" id="RegulatoryAffair_on"
                                            name="RegulatoryAffair_on"
                                              value="{{ \Carbon\Carbon::parse($data1->RegulatoryAffair_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}
                                 <div class="col-lg-6 RegulatoryAffair new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Regulatory Affair Completed On">Regulatory Affair Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="RegulatoryAffair_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}" />
                                            <input readonly type="date" name="RegulatoryAffair_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'RegulatoryAffair_on')" />
                                        </div>
                                        @error('RegulatoryAffair_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif









                            <div class="sub-head">
                                Quality Assurance
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->Quality_Assurance_Review !== 'yes')

                                        $('.quality_assurance').hide();

                                        $('[name="Quality_Assurance_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.quality_assurance').show();
                                                $('.quality_assurance span').show();
                                            } else {
                                                $('.quality_assurance').hide();
                                                $('.quality_assurance span').hide();
                                            }
                                        });
                                    @endif

                                });
                            </script>
                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Required">Quality Assurance Review Required ?
                                            <span class="text-danger">*</span></label>
                                        <select name="Quality_Assurance_Review" id="Quality_Assurance_Review"
                                        @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value="no">
                                                No
                                            </option>
                                            {{--<option @if ($data1->Quality_Assurance_Review == 'na') selected @endif value="na">
                                                NA
                                            </option>--}}
                                            <option @if ($data1->Quality_Assurance_Review == 'NA' || empty($data1->Quality_Assurance_Review)) selected @endif value='NA'>NA</option>

                                        </select>
                                        @if ($data->stage != 3)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Quality_Assurance_Review" value="{{ $data1->Quality_Assurance_Review }}">
                                    @endif
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person <span
                                                id="asteriskQQA"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="QualityAssurance_person" class="QualityAssurance_person"
                                            id="QualityAssurance_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->QualityAssurance_person == $user->name ? 'selected' : '' }}
                                                    value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance) <span
                                                id="asteriskQQA1"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class=" QualityAssurance_assessment"
                                            name="QualityAssurance_assessment" @if ($data->stage == 3 || Auth::user()->name != $data1->QualityAssurance_person) readonly @endif id="summernote-23">{{ $data1->QualityAssurance_assessment }}</textarea>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback <span
                                                id="asteriskQQA2"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class=" QualityAssurance_feedback"
                                            name="QualityAssurance_feedback" @if ($data->stage == 3 || Auth::user()->name != $data1->QualityAssurance_person) readonly @endif id="summernote-24">{{ $data1->QualityAssurance_feedback }}</textarea>
                                    </div>
                                </div>
                                --}}
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Quality_Assurance_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('QualityAssurance_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskQQA');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Quality_Assurance_attachment">
                                                @if ($data1->Quality_Assurance_attachment)
                                                    @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Quality_Assurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed By">Quality Assurance Review
                                            Completed By</label>
                                        <input type="text" name="QualityAssurance_by" id="QualityAssurance_by"
                                            value="{{ $data1->QualityAssurance_by }}" disabled>
                                    </div>
                                </div>
                                {{-- <div class="col-6 mb-3 quality_assurance new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="QualityAssurance_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->QualityAssurance_on) }}" />
                                            <input type="date" name="QualityAssurance_on"
                                                 value=""
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                        </div>
                                        @error('QualityAssurance_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

                                 <div class="col-6 mb-3 quality_assurance new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Quality Assurance Review Completed On">Quality Assurance
                                                    Review
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="QualityAssurance_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->QualityAssurance_on) }}" />
                                                    <input type="date" name="QualityAssurance_on"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                                </div>
                                                @error('QualityAssurance_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Required">Quality Assurance Review Required ?
                                            <span class="text-danger"></span></label>
                                            @if ($data->stage != 3) @endif
                                        <select name="Quality_Assurance_Review" id="Quality_Assurance_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value="no">
                                                No
                                            </option>
                                            {{--<option @if ($data1->Quality_Assurance_Review == 'na') selected @endif value="na">
                                                NA
                                            </option>--}}
                                            <option @if ($data1->Quality_Assurance_Review == 'NA' || empty($data1->Quality_Assurance_Review)) selected @endif value='NA'>NA</option>

                                        </select>
                                        @if ($data->stage != 3)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Quality_Assurance_Review" value="{{ $data1->Quality_Assurance_Review }}">
                                    @endif
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person <span
                                                id="asteriskQQA"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="QualityAssurance_person" class="QualityAssurance_person"
                                            id="QualityAssurance_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->QualityAssurance_person == $user->name ? 'selected' : '' }}
                                                    value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance) <span
                                                id="asteriskQQA1"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class=" QualityAssurance_assessment"
                                            name="QualityAssurance_assessment" @if ($data->stage == 3 || Auth::user()->name != $data1->QualityAssurance_person) readonly @endif id="summernote-23">{{ $data1->QualityAssurance_assessment }}</textarea>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback <span
                                                id="asteriskQQA2"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class=" QualityAssurance_feedback"
                                            name="QualityAssurance_feedback" @if ($data->stage == 3 || Auth::user()->name != $data1->QualityAssurance_person) readonly @endif id="summernote-24">{{ $data1->QualityAssurance_feedback }}</textarea>
                                    </div>
                                </div>
                                --}}
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Quality_Assurance_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('QualityAssurance_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskQQA');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Quality_Assurance_attachment">
                                                @if ($data1->Quality_Assurance_attachment)
                                                    @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Quality_Assurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed By">Quality Assurance Review
                                            Completed By</label>
                                        <input type="text" name="QualityAssurance_by" id="QualityAssurance_by"
                                            value="{{ $data1->QualityAssurance_by }}" disabled>
                                    </div>
                                </div>
                                {{-- <div class="col-6 mb-3 quality_assurance new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="QualityAssurance_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->QualityAssurance_on) }}" />
                                            <input type="date" name="QualityAssurance_on"
                                                 value=""
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                        </div>
                                        @error('QualityAssurance_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

                                 <div class="col-6 mb-3 quality_assurance new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Quality Assurance Review Completed On">Quality Assurance
                                                    Review
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="QualityAssurance_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->QualityAssurance_on) }}" />
                                                    <input type="date" name="QualityAssurance_on"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                                </div>
                                                @error('QualityAssurance_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                            @endif



                            <div class="sub-head">
                                Production (Liquid/Ointment)
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->ProductionLiquid_Review !== 'yes')
                                        $('.productionLiquid').hide();

                                        $('[name="ProductionLiquid_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.productionLiquid').show();
                                                $('.productionLiquid span').show();
                                            } else {
                                                $('.productionLiquid').hide();
                                                $('.productionLiquid span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Liquid"> Production Liquid/Ointment Review Required ? <span
                                                class="text-danger">*</span></label>
                                        <select name="ProductionLiquid_Review" id="ProductionLiquid_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->ProductionLiquid_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->ProductionLiquid_Review == 'NA' || empty($data1->ProductionLiquid_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 52,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid notification">Production Liquid/Ointment Person<span
                                                id="asteriskPT"
                                                style="display: {{ $data1->ProductionLiquid_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="ProductionLiquid_person" class="ProductionLiquid_person"
                                            id="ProductionLiquid_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid assessment">Impact Assessment(By Production Liquid/Ointment)<span id="asteriskPT1"
                                                style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 4) required @endif class=" ProductionLiquid_assessment"
                                            @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-12 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid feedback">Production Liquid Feedback <span
                                                id="asteriskPT2"
                                                style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" ProductionLiquid_feedback" @if (
                                            $data->stage == 3 ||
                                                (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif
                                            name="ProductionLiquid_feedback" id="summernote-18" @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ProductionLiquid_feedback }}</textarea>
                                    </div>
                                </div>
                                --}}
                                <div class="col-12 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid attachment">Production Liquid/Ointment Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="ProductionLiquid_attachment">
                                                @if ($data1->ProductionLiquid_attachment)
                                                    @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="ProductionLiquid_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid Completed By">Production Liquid/Ointment Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->ProductionLiquid_by }}"
                                            name="ProductionLiquid_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="ProductionLiquid_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 productionLiquid">
                                    <div class="group-input ">
                                        <label for="Production Liquid Completed On">Production Liquid/Ointment Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="ProductionLiquid_on"
                                            name="ProductionLiquid_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                              value="{{ \Carbon\Carbon::parse($data1->ProductionLiquid_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 productionLiquid new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Liquid Completed On">Production Liquid/ointment Review
                                                        Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="ProductionLiquid_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}" />
                                                        <input readonly type="date" name="ProductionLiquid_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'ProductionLiquid_on')" />
                                                    </div>
                                                    @error('ProductionLiquid_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('ProductionLiquid_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('ProductionLiquid_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Liquid">Production Liquid/Ointment Review Required?</label>
                                        <select name="ProductionLiquid_Review" disabled id="ProductionLiquid_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->ProductionLiquid_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->ProductionLiquid_Review == 'NA' || empty($data1->ProductionLiquid_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 52,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid notification">Production Liquid/Ointment Person <span
                                                id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="ProductionLiquid_person" disabled id="ProductionLiquid_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid assessment">Impact Assessment(By Production Liquid/Ointment)
                                                </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{--
                                    <div class="col-md-12 mb-3 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid feedback">Production Liquid Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                        </div>
                                    </div>

                                    --}}
                                @else
                                    <div class="col-md-12 mb-3 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid assessment">Impact Assessment(By Production Liquid/Ointment)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{--
                                    <div class="col-md-12 mb-3 productionLiquid">
                                        <div class="group-input">
                                            <label for="Production Liquid feedback">Production Liquid Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                        </div>
                                    </div>
                                    --}}
                                @endif
                                <div class="col-12 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid attachment">Production Liquid/Ointment Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="ProductionLiquid_attachment">
                                                @if ($data1->ProductionLiquid_attachment)
                                                    @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="ProductionLiquid_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid Completed By">Production Liquid/Ointment Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->ProductionLiquid_by }}"
                                            name="ProductionLiquid_by" id="ProductionLiquid_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid Completed On">Production Liquid/Ointment Review Completed On</label>

                                        <input readonly type="date" id="ProductionLiquid_on"
                                            name="ProductionLiquid_on"
                                              value="{{ \Carbon\Carbon::parse($data1->ProductionLiquid_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 productionLiquid new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Production Liquid Completed On">Production Liquid/Ointment Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="ProductionLiquid_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}" />
                                                        <input readonly type="date" name="ProductionLiquid_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'ProductionLiquid_on')" />
                                                    </div>
                                                    @error('ProductionLiquid_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                            @endif


                            <div class="sub-head">
                                Quality Control
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->Quality_review !== 'yes')
                                        $('.qualityControl').hide();

                                        $('[name="Quality_review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.qualityControl').show();
                                                $('.qualityControl span').show();
                                            } else {
                                                $('.qualityControl').hide();
                                                $('.qualityControl span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control">Quality Control Review Required ? <span
                                                class="text-danger">*</span></label>
                                        <select name="Quality_review" id="Quality_review_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Quality_review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Quality_review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Quality_review == 'NA' || empty($data1->Quality_review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 24,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control notification">Quality Control Person <span
                                                id="asteriskPT"
                                                style="display: {{ $data1->Quality_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="Quality_Control_Person" class="Quality_Control_Person"
                                            id="Quality_Control_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control assessment">Impact Assessment (By Quality Control)
                                            <span id="asteriskPT1"
                                                style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif class=" Quality_Control_assessment"
                                            @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-12 mb-3 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control feedback">Quality Control Feedback <span
                                                id="asteriskPT2"
                                                style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" Quality_Control_feedback" @if (
                                            $data->stage == 3 ||
                                                (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif
                                            name="Quality_Control_feedback" id="summernote-18" @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Quality_Control_feedback }}</textarea>
                                    </div>
                                </div>
                                --}}
                                <div class="col-12 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control attachment">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                @if ($data1->Quality_Control_attachment)
                                                    @foreach (json_decode($data1->Quality_Control_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Quality_Control_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control Completed By">Quality Control Review Completed
                                            By</label>
                                        <input readonly type="text" value="{{ $data1->Quality_Control_by }}"
                                            name="Quality_Control_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="Quality_Control_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 qualityControl">
                                    <div class="group-input ">
                                        <label for="Quality Control Completed On">Quality Control Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Quality_Control_on"
                                            name="Quality_Control_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                              value="{{ \Carbon\Carbon::parse($data1->Quality_Control_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}


                                 <div class="col-lg-6 qualityControl new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Quality Control Completed On">Quality Control Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Quality_Control_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Quality_Control_on) }}" />
                                            <input readonly type="date" name="Quality_Control_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'Quality_Control_on')" />
                                        </div>
                                        @error('Quality_Control_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Quality_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Quality_Control_Person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control">Quality Control Review Required ?</label>
                                        <select name="Quality_review" disabled id="Quality_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Quality_review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Quality_review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Quality_review == 'NA' || empty($data1->Quality_review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 24,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control notification">Quality Control Person <span
                                                id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="Quality_Control_Person" disabled id="Quality_Control_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 qualityControl">
                                        <div class="group-input">
                                            <label for="Quality Control assessment">Impact Assessment (By Quality
                                                Control)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                        </div>
                                    </div>

                                    {{--
                                    <div class="col-md-12 mb-3 qualityControl">
                                        <div class="group-input">
                                            <label for="Quality Control feedback">Quality Control Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                        </div>
                                    </div>
                                    --}}
                                @else
                                    <div class="col-md-12 mb-3 qualityControl">
                                        <div class="group-input">
                                            <label for="Quality Control assessment">Impact Assessment (By Quality
                                                Control)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{--
                                    <div class="col-md-12 mb-3 qualityControl">
                                        <div class="group-input">
                                            <label for="Quality Control feedback">Quality Control Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                        </div>
                                    </div>
                                    --}}
                                @endif
                                <div class="col-12 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control attachment">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                @if ($data1->Quality_Control_attachment)
                                                    @foreach (json_decode($data1->Quality_Control_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="store_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control Completed By">Quality Control Review Completed
                                            By</label>
                                        <input readonly type="text" value="{{ $data1->Quality_Control_by }}"
                                            name="Quality_Control_by" id="Quality_Control_by">

                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 qualityControl">
                                    <div class="group-input">
                                        <label for="Quality Control Completed On">Quality Control Review Completed
                                            On</label>

                                        <input readonly type="date" id="Quality_Control_on"
                                            name="Quality_Control_on"
                                              value="{{ \Carbon\Carbon::parse($data1->Quality_Control_on)->format('Y-m-d') }}"
                                            >
                                    </div>
                                </div> --}}

                                  <div class="col-lg-6 qualityControl new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Quality Control Completed On">Quality Control Review Completed On</label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="Quality_Control_on" readonly
                                                            placeholder="DD-MMM-YYYY"
                                                            value="{{ Helpers::getdateFormat($data1->Quality_Control_on) }}" />
                                                        <input readonly type="date" name="Quality_Control_on"
                                                            value="" class="hide-input"
                                                            oninput="handleDateInput(this, 'Quality_Control_on')" />
                                                    </div>
                                                    @error('Quality_Control_on')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                            @endif

                            <div class="sub-head">
                                Microbiology
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->Microbiology_Review !== 'yes')
                                        $('.Microbiology').hide();

                                        $('[name="Microbiology_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.Microbiology').show();
                                                $('.Microbiology span').show();
                                            } else {
                                                $('.Microbiology').hide();
                                                $('.Microbiology span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology">Microbiology Review  Required?<span
                                                class="text-danger">*</span></label>
                                        <select name="Microbiology_Review" id="Microbiology_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Microbiology_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Microbiology_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Microbiology_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Microbiology_Review == 'NA' || empty($data1->Microbiology_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 56,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology notification">Microbiology Person <span id="asteriskPT"
                                                style="display: {{ $data1->Microbiology_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="Microbiology_person" class="Microbiology_person"
                                            id="Microbiology_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology assessment">Impact Assessment (By Microbiology) <span
                                                id="asteriskPT1"
                                                style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->Microbiology_Review == 'yes' && $data->stage == 4) required @endif class=" Microbiology_assessment"
                                            @if ($data->stage == 3 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-12 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology feedback">Microbiology Feedback <span id="asteriskPT2"
                                                style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" Microbiology_feedback" @if ($data->stage == 3 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif
                                            name="Microbiology_feedback" id="summernote-18" @if ($data1->Microbiology_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Microbiology_feedback }}</textarea>
                                    </div>
                                </div>
                                --}}
                                <div class="col-12 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology attachment">Microbiology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Microbiology_attachment">
                                                @if ($data1->Microbiology_attachment)
                                                    @foreach (json_decode($data1->Microbiology_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Microbiology_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology Completed By">Microbiology Review Completed
                                            By</label>
                                        <input readonly type="text" value="{{ $data1->Microbiology_by }}"
                                            name="Microbiology_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="Microbiology_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 Microbiology">
                                    <div class="group-input ">
                                        <label for="Microbiology Completed On">Microbiology Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Microbiology_on"
                                            name="Microbiology_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Microbiology_on }}">
                                    </div>
                                </div> --}}

                                 <div class="col-lg-6 Microbiology new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Microbiology Completed On">Microbiology Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Microbiology_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Microbiology_on) }}" />
                                            <input readonly type="date" name="Microbiology_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'Microbiology_on')" />
                                        </div>
                                        @error('Microbiology_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Microbiology_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Microbiology_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology">Microbiology Review  Required?</label>
                                        <select name="Microbiology_Review" disabled id="Microbiology_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Microbiology_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Microbiology_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Microbiology_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Microbiology_Review == 'NA' || empty($data1->Microbiology_Review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 56,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology notification">Microbiology Person <span
                                                id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select name="Microbiology_person" disabled id="Microbiology_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 Microbiology">
                                        <div class="group-input">
                                            <label for="Microbiology assessment">Impact Assessment (By
                                                Microbiology)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                        </div>
                                    </div>
                                {{--
                                    <div class="col-md-12 mb-3 Microbiology">
                                        <div class="group-input">
                                            <label for="Microbiology feedback">Microbiology Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                        </div>
                                    </div>
                                 --}}
                                @else
                                    <div class="col-md-12 mb-3 Microbiology">
                                        <div class="group-input">
                                            <label for="Microbiology assessment">Impact Assessment (By
                                                Microbiology)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                        </div>
                                    </div>
                                {{--
                                    <div class="col-md-12 mb-3 Microbiology">
                                        <div class="group-input">
                                            <label for="Microbiology feedback">Microbiology Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                        </div>
                                    </div>
                                    --}}
                                @endif
                                <div class="col-12 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology attachment">Microbiology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Microbiology_attachment">
                                                @if ($data1->Microbiology_attachment)
                                                    @foreach (json_decode($data1->Microbiology_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Microbiology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology Completed By">Microbiology Review Completed
                                            By</label>
                                        <input readonly type="text" value="{{ $data1->Microbiology_by }}"
                                            name="Microbiology_by" id="Microbiology_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology Completed On">Microbiology Review Completed
                                            On</label>

                                        <input readonly type="date" id="Microbiology_on" name="Microbiology_on"

                                              value="{{ \Carbon\Carbon::parse($data1->Microbiology_on)->format('Y-m-d') }}">
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 Microbiology new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Microbiology Completed On">Microbiology Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Microbiology_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Microbiology_on) }}" />
                                            <input readonly type="date" name="Microbiology_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'Microbiology_on')" />
                                        </div>
                                        @error('Microbiology_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif



                            <div class="sub-head">
                                Safety
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if ($data1->Environment_Health_review !== 'yes')
                                        $('.safety').hide();

                                        $('[name="Environment_Health_review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.safety').show();
                                                $('.safety span').show();
                                            } else {
                                                $('.safety').hide();
                                                $('.safety span').hide();
                                            }
                                        });
                                    @endif
                                });
                            </script>
                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety">Safety Review Required ?<span
                                                class="text-danger">*</span></label>
                                        <select name="Environment_Health_review" id="Environment_Health_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Environment_Health_review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Environment_Health_review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Environment_Health_review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Environment_Health_review == 'NA' || empty($data1->Environment_Health_review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 59,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 safety">
                                    <div class="group-input">
                                        <label for="Safety notification">Safety Person <span id="asteriskPT"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="Environment_Health_Safety_person"
                                            class="Environment_Health_Safety_person"
                                            id="Environment_Health_Safety_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 safety">
                                    <div class="group-input">
                                        <label for="Safety assessment">Impact Assessment (By Safety) <span
                                                id="asteriskPT1"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif class=" Health_Safety_assessment"
                                            @if (
                                                $data->stage == 3 ||
                                                    (isset($data1->Environment_Health_Safety_person) &&
                                                        Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                    </div>
                                </div>

                                {{--
                                <div class="col-md-12 mb-3 safety">
                                    <div class="group-input">
                                        <label for="Safety feedback">Safety Feedback <span id="asteriskPT2"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" Health_Safety_feedback" @if (
                                            $data->stage == 3 ||
                                                (isset($data1->Environment_Health_Safety_person) &&
                                                    Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif
                                            name="Health_Safety_feedback" id="summernote-18" @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Health_Safety_feedback }}</textarea>
                                    </div>
                                </div>
                                --}}
                                <div class="col-12 safety">
                                    <div class="group-input">
                                        <label for="Safety attachment">Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Environment_Health_Safety_attachment">
                                                @if ($data1->Environment_Health_Safety_attachment)
                                                    @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Environment_Health_Safety_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 safety">
                                    <div class="group-input">
                                        <label for="Safety Completed By">Safety Review Completed
                                            By</label>
                                        <input readonly type="text"
                                            value="{{ $data1->Environment_Health_Safety_by }}"
                                            name="Environment_Health_Safety_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                            id="Environment_Health_Safety_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 safety">
                                    <div class="group-input ">
                                        <label for="Safety Completed On">Safety Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Environment_Health_Safety_on }}">
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 safety new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Safety Completed On">Safety Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Environment_Health_Safety_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Environment_Health_Safety_on) }}" />
                                            <input readonly type="date"
                                                name="Environment_Health_Safety_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                        </div>
                                        @error('Environment_Health_Safety_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Environment_Health_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Environment_Health_Safety_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }
                                        // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                        // for (var i = 0; i < facilityNameInputs.length; i++) {
                                        //     inputsToToggle.push(facilityNameInputs[i]);
                                        // }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety">Safety Review Required ?</label>
                                        <select name="Environment_Health_review" disabled
                                            id="Environment_Health_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Environment_Health_review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->Environment_Health_review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->Environment_Health_review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->Environment_Health_review == 'NA' || empty($data1->Environment_Health_review)) selected @endif value='NA'>NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 59,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 safety">
                                    <div class="group-input">
                                        <label for="Safety notification">Safety Person <span id="asteriskInvi11"
                                                style="display: none" class="text-danger">*</span></label>
                                        <select name="Environment_Health_Safety_person" disabled
                                            id="Environment_Health_Safety_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data->stage == 4)
                                    <div class="col-md-12 mb-3 safety">
                                        <div class="group-input">
                                            <label for="Safety assessment">Impact Assessment (By Safety)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{--
                                    <div class="col-md-12 mb-3 safety">
                                        <div class="group-input">
                                            <label for="Safety feedback">Safety Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                        </div>
                                    </div>
                                    --}}
                                @else
                                    <div class="col-md-12 mb-3 safety">
                                        <div class="group-input">
                                            <label for="Safety assessment">Impact Assessment (By Safety)</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{--
                                    <div class="col-md-12 mb-3 safety">
                                        <div class="group-input">
                                            <label for="Safety feedback">Safety Feedback</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it
                                                    does not require completion</small></div>
                                            <textarea disabled class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                        </div>
                                    </div>
                                    --}}
                                @endif
                                <div class="col-12 safety">
                                    <div class="group-input">
                                        <label for="Safety attachment">Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Environment_Health_Safety_attachment">
                                                @if ($data1->Environment_Health_Safety_attachment)
                                                    @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
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
                                                <input disabled
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 safety">
                                    <div class="group-input">
                                        <label for="Safety Completed By">Safety Review Completed
                                            By</label>
                                        <input readonly type="text"
                                            value="{{ $data1->Environment_Health_Safety_by }}"
                                            name="Environment_Health_Safety_by" id="Environment_Health_Safety_by">


                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 safety">
                                    <div class="group-input">
                                        <label for="Safety Completed On">Safety Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                              value="{{ \Carbon\Carbon::parse($data1->Environment_Health_Safety_on)->format('Y-m-d') }}">
                                    </div>
                                </div> --}}

                                 <div class="col-lg-6 safety new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Safety Completed On">Safety Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Environment_Health_Safety_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->Environment_Health_Safety_on) }}" />
                                            <input readonly type="date"
                                                name="Environment_Health_Safety_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                        </div>
                                        @error('Environment_Health_Safety_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif





                            <!-- HTML Section -->
                            <div class="sub-head">
                                Contract Giver
                            </div>

                            @php
                                $data1 = DB::table('market_complaint_cfts')
                                    ->where('mc_id', $data->id)
                                    ->first();
                            @endphp

                            @if ($data1->ContractGiver_Review !== 'yes')
                                <script>
                                    $(document).ready(function() {
                                        // Initially hide or show based on the current value of the select
                                        if ($('[name="ContractGiver_Review"]').val() === 'yes') {
                                            $('.ContractGiver').show();
                                            $('.ContractGiver span').show();
                                        } else {
                                            $('.ContractGiver').hide();
                                            $('.ContractGiver span').hide();
                                        }

                                        // Handle changes to the select field
                                        $('[name="ContractGiver_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.ContractGiver').show();
                                                $('.ContractGiver span').show();
                                            } else {
                                                $('.ContractGiver').hide();
                                                $('.ContractGiver span').hide();
                                            }
                                        });
                                    });
                                </script>
                            @endif

                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Contract Giver">Contract Giver Review Required ?<span
                                                class="text-danger">*</span></label>
                                        <select name="ContractGiver_Review" id="ContractGiver_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->ContractGiver_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->ContractGiver_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->ContractGiver_Review == 'NA') selected @endif value='NA'>
                                                NA</option>--}}
                                            <option @if ($data1->ContractGiver_Review == 'NA' || empty($data1->ContractGiver_Review)) selected @endif value='NA'>NA</option>

                                        </select>
                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 60,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get();
                                @endphp

                                <div class="col-lg-6 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver notification">Contract Giver comment update by <span
                                                id="asteriskPT" class="text-danger">*</span></label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="ContractGiver_person" id="ContractGiver_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->ContractGiver_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver assessment">Impact Assessment (By Contract Giver)
                                            <span id="asteriskPT1" class="text-danger"
                                                style="display: {{ $data1->ContractGiver_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"></span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea @if ($data1->ContractGiver_Review == 'yes' && $data->stage == 4) required @endif class=" ContractGiver_assessment"
                                            @if ($data->stage == 3 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                    </div>
                                </div>
                            {{--
                                <div class="col-md-12 mb-3 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver feedback">Contract Giver Feedback <span
                                                id="asteriskPT2" class="text-danger"
                                                style="display: {{ $data1->ContractGiver_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"></span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" ContractGiver_feedback" @if ($data->stage == 3 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif
                                            name="ContractGiver_feedback" id="summernote-18" @if ($data1->ContractGiver_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ContractGiver_feedback }}</textarea>
                                    </div>
                                </div>
                             --}}
                                <div class="col-12 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ContractGiver_attachment">
                                                @if ($data1->ContractGiver_attachment)
                                                    @foreach (json_decode($data1->ContractGiver_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="ContractGiver_attachment[]"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver Completed By">Contract Giver Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->ContractGiver_by }}"
                                            name="ContractGiver_by" id="ContractGiver_by">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver Completed On">Contract Giver Review Completed On</label>
                                        <input type="date" id="ContractGiver_on" name="ContractGiver_on"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->ContractGiver_on }}">
                                    </div>
                                </div> --}}

                                 <div class="col-6 ContractGiver new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Contract Giver Completed On">Contract Giver
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="ContractGiver_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->ContractGiver_on) }}" />
                                            <input readonly type="date" name="ContractGiver_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'ContractGiver_on')" />
                                        </div>
                                                                            @error('ContractGiver_on')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Contract Giver">Contract Giver Review Required ?</label>
                                        <select name="ContractGiver_Review" disabled id="ContractGiver_Review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->ContractGiver_Review == 'yes') selected @endif value='yes'>
                                                Yes</option>
                                            <option @if ($data1->ContractGiver_Review == 'no') selected @endif value='no'>
                                                No</option>
                                            {{--<option @if ($data1->ContractGiver_Review == 'na') selected @endif value='na'>
                                                NA</option>--}}
                                            <option @if ($data1->ContractGiver_Review == 'NA' || empty($data1->ContractGiver_Review)) selected @endif value='NA'>NA</option>

                                        </select>
                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where([
                                            'q_m_s_roles_id' => 60,
                                            'q_m_s_divisions_id' => $data->division_id,
                                        ])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get();
                                @endphp

                                <div class="col-lg-6 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver notification">Contract Giver comment update by<span
                                                id="asteriskInvi11" style="display: none"
                                                class="text-danger">*</span></label>
                                        <select @if ($data->stage == 4) disabled @endif
                                            name="ContractGiver_person" id="ContractGiver_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}"
                                                    @if ($user->name == $data1->ContractGiver_person) selected @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver assessment">Impact Assessment (By Contract Giver)
                                            <span id="asteriskPT1" style="display: none"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" ContractGiver_assessment" @if ($data->stage == 3 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif
                                            name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                    </div>
                                </div>
                            {{--
                                <div class="col-md-12 mb-3 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver feedback">Contract Giver Feedback <span
                                                id="asteriskPT2" style="display: none"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                        <textarea class=" ContractGiver_feedback" @if ($data->stage == 3 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif
                                            name="ContractGiver_feedback" id="summernote-18">{{ $data1->ContractGiver_feedback }}</textarea>
                                    </div>
                                </div>
                                --}}
                                <div class="col-12 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ContractGiver_attachment">
                                                @if ($data1->ContractGiver_attachment)
                                                    @foreach (json_decode($data1->ContractGiver_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="ContractGiver_attachment[]"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver Completed By">Contract Giver Review Completed By</label>
                                        <input readonly type="text" value="{{ $data1->ContractGiver_by }}"
                                            name="ContractGiver_by" id="ContractGiver_by">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6 ContractGiver">
                                    <div class="group-input">
                                        <label for="Contract Giver Completed On">Contract Giver Review Completed On</label>
                                        <input type="date" id="ContractGiver_on" name="ContractGiver_on"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                              value="{{ \Carbon\Carbon::parse($data1->ContractGiver_on)->format('Y-m-d') }}">
                                    </div>
                                </div> --}}

                                 <div class="col-6 ContractGiver new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Contract Giver Completed On">Contract Giver
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="ContractGiver_on" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($data1->ContractGiver_on) }}" />
                                            <input readonly type="date" name="ContractGiver_on"
                                                value="" class="hide-input"
                                                oninput="handleDateInput(this, 'ContractGiver_on')" />
                                        </div>
                                                                            @error('ContractGiver_on')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif


                            <div class="sub-head">
                                Other's 1 (Additional Person Review From Departments If Required)
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Review Required1">Other's 1 Review Required?</label>
                                    <select name="Other1_review" id="Other1_review"  @if ($data->stage != 3) disabled @endif >
                                        <option value="">-- Select --</option>
                                        <option value="yes" @if ($data1->Other1_review == 'yes') selected @endif>Yes</option>
                                        <option value="no" @if ($data1->Other1_review == 'no') selected @endif>No</option>
                                        {{-- <option value="na" @if ($data1->Other1_review == 'na') selected @endif>NA</option> --}}
                                        <option @if ($data1->Other1_review == 'NA' || empty($data1->Other1_review)) selected @endif value='NA'>NA</option>
                                    </select>
                                </div>
                            </div>

                            @php
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_divisions_id' => $data->division_id])
                                    ->select('user_id')
                                    ->distinct()
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp

                            {{-- <div class="col-lg-6 other1_reviews">
                                <div class="group-input">
                                    <label for="Person1">Other's 1 Person
                                        <span id="asterisko1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                    </label>
                                    <select name="Other1_person" id="Other1_person" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other1_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 3)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-12 other1_reviews">
                                <div class="group-input">
                                    <label for="Department1">Other's 1 Department
                                        <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                    </label>
                                    <select name="Other1_Department_person" id="Other1_Department_person" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach (Helpers::getDepartments() as $key => $name)
                                            <option value="{{ $key }}" @if ($data1->Other1_Department_person == $key) selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 3)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                @endif
                                </div>
                            </div> --}}
                            {{-- by kp code  --}}
                            <div class="col-lg-6 other1_reviews">
                                <div class="group-input">
                                    <label for="Person1">Other's 1 Person
                                        <span id="asterisko1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                    </label>
                                    <select name="Other1_person" id="Other1_person" @if ($data->stage != 3) disabled @endif>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}" @if ($data1->Other1_person == $user->name) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($data->stage != 3)
                                    <!-- Hidden field to retain the value if select is disabled -->
                                    <input type="hidden" name="Other1_person" value="{{ $data1->Other1_person }}">
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-12 other1_reviews">
                                <div class="group-input">
                                    <label for="Department1">Other's 1 Department
                                        <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                    </label>

                                    <input type="text" name="Other1_Department_person" id="Other1_Department_person" readonly
                                        value="{{ old('Other1_Department_person', $data1->Other1_Department_person ?: '') }}"
                                        @if ($data->stage != 3) readonly @endif>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 other1_reviews">
                                <div class="group-input">
                                    <label for="Impact Assessment12">Impact Assessment (By Other's 1)</label>
                                    <textarea class="tiny" name="Other1_assessment" id="summernote-41" @if ($data->stage != 4 || Auth::user()->name != $data1->Other1_person) readonly @endif>{{ $data1->Other1_assessment }}</textarea>
                                </div>
                            </div>
                        
                            <div class="col-12 other1_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other1_attachment">
                                                @if ($data1->Other1_attachment)
                                                    @foreach (json_decode($data1->Other1_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile"
                                                    name="Other1_attachment[]" oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-md-6 mb-3 other1_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By1">Other's 1 Review Completed By</label>
                                    <input type="text" name="Other1_by" id="Other1_by" value="{{ $data1->Other1_by }}" disabled>
                                </div>
                            </div>
                            <div class="col-6 other1_reviews new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Others 1 Completed On">Other's 1 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other1_on" readonly placeholder="DD-MMM-YYYY"
                                            value="{{ Helpers::getdateFormat($data1->Other1_on) }}" />
                                        <input readonly type="date" name="Other1_on"  value="" class="hide-input" oninput="handleDateInput(this, 'Other1_on')" />
                                    </div>
                                </div>
                            </div>

                            <!-- Add your script to handle the show/hide functionality -->
                            <script>
                                $(document).ready(function () {
                                    // Function to toggle visibility based on the selected value
                                    function toggleFieldsBasedOnSelection(value) {
                                        if (value === 'yes') {
                                            $('.other1_reviews').show(); // Show all fields
                                            $('.other1_reviews span').show(); // Show asterisks
                                            $('input[name="Other1_person"]').prop('required', true);
                                            $('select[name="Other1_Department_person"]').prop('required', true);
                                            $('#asterisko1').show();
                                            $('#asteriskod1').show();
                                        } else {
                                            $('.other1_reviews').hide(); // Hide all fields
                                            $('.other1_reviews span').hide(); // Hide asterisks
                                            $('input[name="Other1_person"]').prop('required', false);
                                            $('select[name="Other1_Department_person"]').prop('required', false);
                                            $('#asterisko1').hide();
                                            $('#asteriskod1').hide();
                                        }
                                    }

                                    // On page load
                                    toggleFieldsBasedOnSelection($('[name="Other1_review"]').val());

                                    // On dropdown value change
                                    $('[name="Other1_review"]').change(function () {
                                        toggleFieldsBasedOnSelection($(this).val());
                                    });
                                });
                            </script>
                     
                        <div class="sub-head">
                            Other's 2 (Additional Person Review From Departments If Required)
                        </div>

                        <script>
                            $(document).ready(function () {
                                // Function to toggle visibility based on "yes" value
                                function toggleFieldsBasedOnSelection(value) {
                                    if (value === 'yes') {
                                        $('.Other2_reviews').show();
                                        $('.Other2_reviews span').show();
                                        $('input[name="Other2_person"]').prop('required', true);
                                        $('select[name="Other2_Department_person"]').prop('required', true);
                                        $('#asterisko2').show();
                                        $('#asteriskod2').show();
                                    } else {
                                        $('.Other2_reviews').hide();
                                        $('.Other2_reviews span').hide();
                                        $('input[name="Other2_person"]').prop('required', false);
                                        $('select[name="Other2_Department_person"]').prop('required', false);
                                        $('#asterisko2').hide();
                                        $('#asteriskod2').hide();
                                    }
                                }

                                // On page load
                                toggleFieldsBasedOnSelection($('[name="Other2_review"]').val());

                                // On dropdown value change
                                $('[name="Other2_review"]').change(function () {
                                    toggleFieldsBasedOnSelection($(this).val());
                                });
                            });
                        </script>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="review2"> Other's 2 Review Required?</label>
                                <select name="Other2_review" id="Other2_review"  @if ($data->stage != 3) disabled @endif>
                                    <option value="">-- Select --</option>
                                    <option value="yes" @if ($data1->Other2_review == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if ($data1->Other2_review == 'no') selected @endif>No</option>
                                    {{-- <option value="na" @if ($data1->Other2_review == 'na') selected @endif>NA</option> --}}
                                    <option @if ($data1->Other2_review == 'NA' || empty($data1->Other2_review)) selected @endif value='NA'>NA</option>

                                </select>
                            </div>
                        </div>

                        @php
                            $userRoles = DB::table('user_roles')
                                ->where(['q_m_s_divisions_id' => $data->division_id])
                                ->select('user_id')
                                ->distinct()
                                ->get();
                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                        @endphp

                        {{-- by kp code  --}}
                        <div class="col-lg-6 Other2_reviews">
                            <div class="group-input">
                                <label for="Person2">Other's 2 Person <span id="asterisko2" style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                <select name="Other2_person" id="Other2_person" @if ($data->stage != 3) disabled @endif>
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}" @if ($data1->Other2_person == $user->name) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @if ($data->stage != 3)
                                <!-- Hidden field to retain the value if select is disabled -->
                                <input type="hidden" name="Other2_person" value="{{ $data1->Other2_person }}">
                            @endif
                            </div>
                        </div>

                        <div class="col-lg-12 Other2_reviews">
                            <div class="group-input">
                                <label for="Department2">Other's 2 Department <span id="asteriskod2" style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>

                                <input type="text" name="Other2_Department_person" id="Other2_Department_person"
                                        value="{{ old('Other2_Department_person', $data1->Other2_Department_person ?: '') }}"
                                        @if ($data->stage != 3) readonly @endif>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3 Other2_reviews">
                            <div class="group-input">
                                <label for="Impact Assessment13">Impact Assessment (By Other's 2)</label>
                                <textarea class="tiny" name="Other2_Assessment" id="summernote-43" @if ($data->stage != 4 || Auth::user()->name != $data1->Other2_person) readonly @endif>{{ $data1->Other2_Assessment }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 Other2_reviews">
                            <div class="group-input">
                                <label for="Audit Attachments">Other's 2 Attachments</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                <div class="file-attachment-field">
                                    <div disabled class="file-attachment-list" id="Other2_attachment">
                                        @if ($data1->Other2_attachment)
                                            @foreach (json_decode($data1->Other2_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other2_attachment[]" oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3 Other2_reviews">
                            <div class="group-input">
                                <label for="Review Completed By2">Other's 2 Review Completed By</label>
                                <input type="text" name="Other2_by" id="Other2_by" value="{{ $data1->Other2_by }}" disabled>
                            </div>
                        </div>

                        <div class="col-6 Other2_reviews new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Others 2 Completed On">Other's 2 Review Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Other2_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other2_on) }}" />
                                    <input readonly type="date" name="Other2_on"  value="" class="hide-input" oninput="handleDateInput(this, 'Other2_on')" />
                                </div>
                                @error('Other2_on')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="sub-head">
                            Other's 3 (Additional Person Review From Departments If Required)
                        </div>

                        <script>
                            $(document).ready(function () {
                                // Function to toggle visibility based on "yes" value
                                function toggleFieldsBasedOnSelection(value) {
                                    if (value === 'yes') {
                                        $('.Other3_reviews').show();
                                        $('.Other3_reviews span').show();
                                        $('input[name="Other3_person"]').prop('required', true);
                                        $('select[name="Other3_Department_person"]').prop('required', true);
                                        $('#asterisko3').show();
                                        $('#asteriskod3').show();
                                    } else {
                                        $('.Other3_reviews').hide();
                                        $('.Other3_reviews span').hide();
                                        $('input[name="Other3_person"]').prop('required', false);
                                        $('select[name="Other3_Department_person"]').prop('required', false);
                                        $('#asterisko3').hide();
                                        $('#asteriskod3').hide();
                                    }
                                }

                                // On page load
                                toggleFieldsBasedOnSelection($('[name="Other3_review"]').val());

                                // On dropdown value change
                                $('[name="Other3_review"]').change(function () {
                                    toggleFieldsBasedOnSelection($(this).val());
                                });
                            });
                        </script>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="review3">Other's 3 Review Required?</label>
                                <select name="Other3_review" id="Other3_review" @if ($data->stage != 3) disabled @endif>
                                    <option value="">-- Select --</option>
                                    <option value="yes" @if ($data1->Other3_review == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if ($data1->Other3_review == 'no') selected @endif>No</option>
                                    {{-- <option value="na" @if ($data1->Other3_review == 'na') selected @endif>NA</option> --}}
                                    <option @if ($data1->Other3_review == 'NA' || empty($data1->Other3_review)) selected @endif value='NA'>NA</option>

                                </select>
                            </div>
                        </div>

                        @php
                            $userRoles = DB::table('user_roles')
                                ->where(['q_m_s_divisions_id' => $data->division_id])
                                ->select('user_id')
                                ->distinct()
                                ->get();
                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                        @endphp
                        
                        {{-- code by kp --}}
                        <div class="col-lg-6 Other3_reviews">
                            <div class="group-input">
                                <label for="Person3">Other's 3 Person <span id="asterisko3" style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                <select name="Other3_person" id="Other3_person" @if ($data->stage != 3) disabled @endif>
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}" @if ($data1->Other3_person == $user->name) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @if ($data->stage != 3)
                                <!-- Hidden field to retain the value if select is disabled -->
                                <input type="hidden" name="Other3_person" value="{{ $data1->Other3_person }}">
                            @endif
                            </div>
                        </div>

                        <div class="col-lg-12 Other3_reviews">
                            <div class="group-input">
                                <label for="Department3">Other's 3 Department <span id="asteriskod3" style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>

                                <input type="text" name="Other3_Department_person" id="Other3_Department_person"
                                        value="{{ old('Other3_Department_person', $data1->Other3_Department_person ?: '') }}"
                                        @if ($data->stage != 3) readonly @endif>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3 Other3_reviews">
                            <div class="group-input">
                                <label for="Impact Assessment14">Impact Assessment (By Other's 3)</label>
                                <textarea class="tiny" name="Other3_Assessment" id="summernote-45" @if ($data->stage != 4 || Auth::user()->name != $data1->Other3_person) readonly @endif>{{ $data1->Other3_Assessment }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 Other3_reviews">
                            <div class="group-input">
                                <label for="Audit Attachments">Other's 3 Attachments</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                <div class="file-attachment-field">
                                    <div disabled class="file-attachment-list" id="Other3_attachment">
                                        @if ($data1->Other3_attachment)
                                            @foreach (json_decode($data1->Other3_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other3_attachment[]" oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3 Other3_reviews">
                            <div class="group-input">
                                <label for="productionfeedback">Other's 3 Review Completed By</label>
                                <input type="text" name="Other3_by" id="Other3_by" value="{{ $data1->Other3_by }}" disabled>
                            </div>
                        </div>

                        <div class="col-6 new-date-data-field Other3_reviews">
                            <div class="group-input input-date">
                                <label for="Others 3 Completed On">Other's 3 Review Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Other3_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other3_on) }}" />
                                    <input readonly type="date" name="Other3_on"  value="" class="hide-input" oninput="handleDateInput(this, 'Other3_on')" />
                                </div>
                                @error('Other3_on')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- Other's 4 Section -->
                        <div class="sub-head">
                            Other's 4 (Additional Person Review From Departments If Required)
                        </div>

                        <script>
                            $(document).ready(function () {
                                // Function to toggle visibility based on "yes" value
                                function toggleOther4Fields(value) {
                                    if (value === 'yes') {
                                        $('.Other4_reviews').show();
                                        $('.Other4_reviews span').show();
                                        $('#Other4_person').prop('required', true);
                                        // $('#hod_Other4_person').prop('required', true);
                                        $('#Other4_Department_person').prop('required', true);
                                        $('#asterisko4').show();
                                    } else {
                                        $('.Other4_reviews').hide();
                                        $('.Other4_reviews span').hide();
                                        $('#Other4_person').prop('required', false);
                                        // $('#hod_Other4_person').prop('required', false);
                                        $('#Other4_Department_person').prop('required', false);
                                        $('#asterisko4').hide();
                                    }
                                }

                                // Initial toggle on page load
                                toggleOther4Fields($('[name="Other4_review"]').val());

                                // Toggle on value change
                                $('[name="Other4_review"]').change(function () {
                                    toggleOther4Fields($(this).val());
                                });
                            });
                        </script>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="review4">Other's 4 Review Required?</label>
                                <select name="Other4_review" id="Other4_review" @if ($data->stage != 3) disabled @endif>
                                    <option value="">-- Select --</option>
                                    <option value="yes" @if ($data1->Other4_review == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if ($data1->Other4_review == 'no') selected @endif>No</option>
                                    {{-- <option value="na" @if ($data1->Other4_review == 'na') selected @endif>NA</option> --}}
                                    <option @if ($data1->Other4_review == 'NA' || empty($data1->Other4_review)) selected @endif value='NA'>NA</option>

                                </select>
                            </div>
                        </div>

                        {{-- code by kp --}}
                        <div class="col-lg-6 Other4_reviews">
                            <div class="group-input">
                                <label for="Person4">Other's 4 Person <span id="asterisko4" class="text-danger">*</span></label>
                                <select name="Other4_person" id="Other4_person" @if ($data->stage != 3) disabled @endif>
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}" @if ($data1->Other4_person == $user->name) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @if ($data->stage != 3)
                                <!-- Hidden field to retain the value if select is disabled -->
                                <input type="hidden" name="Other4_person" value="{{ $data1->Other4_person }}">
                            @endif
                            </div>
                        </div>

                        <div class="col-lg-12 Other4_reviews">
                            <div class="group-input">
                                <label for="Department4">Other's 4 Department <span id="asteriskod4" class="text-danger">*</span></label>

                                <input type="text" name="Other4_Department_person" id="Other4_Department_person"
                                        value="{{ old('Other4_Department_person', $data1->Other4_Department_person ? : '') }}"
                                        @if ($data->stage != 3) readonly @endif>

                            </div>
                        </div>
                        <div class="col-md-12 mb-3 Other4_reviews">
                            <div class="group-input">
                                <label for="Description of Action Item15">Impact Assessment (By Other's 4)</label>
                                <textarea class="tiny" name="Other4_Assessment" id="summernote-47"
                                    @if ($data->stage != 4 || Auth::user()->name != $data1->Other4_person) readonly @endif>{{ $data1->Other4_Assessment }}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-12 Other4_reviews">
                            <div class="group-input">
                                <label for="Audit Attachments">Other's 4 Attachments</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                <div class="file-attachment-field">
                                    <div disabled class="file-attachment-list" id="Other4_attachment">
                                        @if ($data1->Other4_attachment)
                                            @foreach (json_decode($data1->Other4_attachment) as $file)
                                                <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px;"></i></a>
                                                    <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other4_attachment[]" oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3 Other4_reviews">
                            <div class="group-input">
                                <label for="Review Completed By4">Other's 4 Review Completed By</label>
                                <input type="text" name="Other4_by" id="Other4_by" value="{{ $data1->Other4_by }}" disabled>
                            </div>
                        </div>

                        <div class="col-6 new-date-data-field Other4_reviews">
                            <div class="group-input input-date">
                                <label for="Others 4 Completed On">Other's 4 Review Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Other4_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other4_on) }}" />
                                    <input readonly type="date" name="Other4_on"  class="hide-input" oninput="handleDateInput(this, 'Other4_on')" />
                                </div>
                                @error('Other4_on')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Other's 5 Section -->

                        <div class="sub-head">
                            Other's 5 (Additional Person Review From Departments If Required)
                        </div>

                        <script>
                            $(document).ready(function () {
                                // Function to toggle visibility based on "yes" value
                                function toggleOther5Fields(value) {
                                    if (value === 'yes') {
                                        $('.Other5_reviews').show();
                                        $('.Other5_reviews span').show();
                                        $('#Other5_person').prop('required', true);
                                        // $('#hod_Other5_person').prop('required', true);
                                        $('#Other5_Department_person').prop('required', true);
                                        $('#asterisko5').show();
                                    } else {
                                        $('.Other5_reviews').hide();
                                        $('.Other5_reviews span').hide();
                                        $('#Other5_person').prop('required', false);
                                        // $('#hod_Other5_person').prop('required', false);
                                        $('#Other5_Department_person').prop('required', false);
                                        $('#asterisko5').hide();
                                    }
                                }

                                // Initial toggle on page load
                                toggleOther5Fields($('[name="Other5_review"]').val());

                                // Toggle on value change
                                $('[name="Other5_review"]').change(function () {
                                    toggleOther5Fields($(this).val());
                                });
                            });
                        </script>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="review5">Other's 5 Review Required?</label>
                                <select name="Other5_review" id="Other5_review" @if ($data->stage != 3) disabled @endif>
                                    <option value="">-- Select --</option>
                                    <option value="yes" @if ($data1->Other5_review == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if ($data1->Other5_review == 'no') selected @endif>No</option>
                                    {{-- <option value="na" @if ($data1->Other5_review == 'na') selected @endif>NA</option> --}}
                                    <option @if ($data1->Other5_review == 'NA' || empty($data1->Other5_review)) selected @endif value='NA'>NA</option>

                                </select>
                            </div>
                        </div>

                        
                        {{-- code by kp --}}

                        <div class="col-lg-6 Other5_reviews">
                            <div class="group-input">
                                <label for="Person5">Other's 5 Person <span id="asterisko5" class="text-danger">*</span></label>
                                <select name="Other5_person" id="Other5_person" @if ($data->stage != 3) disabled @endif>
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}" @if ($data1->Other5_person == $user->name) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @if ($data->stage != 3)
                                <!-- Hidden field to retain the value if select is disabled -->
                                <input type="hidden" name="Other5_person" value="{{ $data1->Other5_person }}">
                            @endif
                            </div>
                        </div>


                        <div class="col-lg-12 Other5_reviews">
                            <div class="group-input">
                                <label for="Department5">Other's 5 Department <span id="asteriskod5" class="text-danger">*</span></label>

                                <input type="text" name="Other5_Department_person" id="Other5_Department_person"
                                        value="{{ old('Other5_Department_person', $data1->Other5_Department_person ?: '') }}"
                                        @if ($data->stage != 3) readonly @endif>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 Other5_reviews">
                            <div class="group-input">
                                <label for="Description of Action Item16">Impact Assessment (By Other's 5)</label>
                                <textarea class="tiny" name="Other5_Assessment" id="summernote-49"
                                @if ($data->stage != 4 || Auth::user()->name != $data1->Other5_person) readonly @endif>{{ $data1->Other5_Assessment }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 Other5_reviews">
                            <div class="group-input">
                                <label for="Audit Attachments">Other's 5 Attachments</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                <div class="file-attachment-field">
                                    <div disabled class="file-attachment-list" id="Other5_attachment">
                                        @if ($data1->Other5_attachment)
                                            @foreach (json_decode($data1->Other5_attachment) as $file)
                                                <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px;"></i></a>
                                                    <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other5_attachment[]" oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3 Other5_reviews">
                            <div class="group-input">
                                <label for="Review Completed By5">Other's 5 Review Completed By</label>
                                <input type="text" name="Other5_by" id="Other5_by" value="{{ $data1->Other5_by }}" disabled>
                            </div>
                        </div>

                        <div class="col-6 new-date-data-field Other5_reviews">
                            <div class="group-input input-date">
                                <label for="Others 5 Completed On">Other's 5 Review Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Other5_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other5_on) }}" />
                                    <input readonly type="date" name="Other5_on"  class="hide-input" oninput="handleDateInput(this, 'Other5_on')" />
                                </div>
                                @error('Other5_on')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="button-block">
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 12 ? 'disabled' : '' }}
                                id="ChangesaveButton" class="saveButton saveAuditFormBtn d-flex"
                                style="align-items: center;">
                                <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                    role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                Save
                            </button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                type="button"{{ $data->stage == 0 || $data->stage == 12 ? 'disabled' : '' }}
                                id="ChangeNextButton" class="nextButton">Next</button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a
                                    href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                            @if (
                                $data->stage == 2 ||
                                    $data->stage == 3 ||
                                    $data->stage == 4 ||
                                    $data->stage == 5 ||
                                    $data->stage == 6 ||
                                    $data->stage == 7)
                                {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> --}}
                            @endif
                            <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                                                                                                                                                                data-bs-target="#effectivenss_extension">
                                                                                                                                                                                Launch Effectiveness Check
                                                                                                                                                                            </a> -->
                        </div>
                    </div>
                </div>


            @php

                $istab6  = (Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18))
            @endphp
            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        All Action Completion Verification by QA/CQA
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            @if ($data->stage == 5)
                                <div class="group-input">
                                    <label for="Closure Comment">QA/CQA Comment <span
                                            class="text-danger">*</span></label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea  name="qa_cqa_comments" {{ $data->stage == 5 && $istab6 ? '' : 'readonly' }}>{{ $data->qa_cqa_comments }}</textarea>
                                </div>
                            @else
                                <div class="group-input">
                                    <label for="Closure Comment">QA/CQA Comment <span
                                            class="text-danger"></span></label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea  name="qa_cqa_comments"
                                    {{ $data->stage == 5 && $istab6 ? '' : 'readonly' }}>{{ $data->qa_cqa_comments }}
                                    </textarea>
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-12">
                            <div class="group-input">
                                <label for="qa_cqa_attachments">QA/CQA Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="qa_cqa_attachments">
                                        @if ($data->qa_cqa_attachments)
                                            @foreach (json_decode($data->qa_cqa_attachments) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                        <i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i>
                                                    </a>
                                                    <a type="button" class="remove-file4"
                                                        data-file-name="{{ $file }}">
                                                        <i class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i>
                                                    </a>
                                                    <input type="hidden" name="existing_qa_cqa_attachments[]"
                                                        value="{{ $file }}">
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="qa_cqa_attachments[]"
                                        {{ $data->stage == 5 && $istab6 ? '' : 'disabled' }}
                                            oninput="addMultipleFiles(this, 'qa_cqa_attachments')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden field to keep track of files to be deleted -->
                        <input type="hidden" id="deleted_qa_cqa_attachments" name="deleted_qa_cqa_attachments"
                            value="">

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const removeButtons = document.querySelectorAll('.remove-file4');

                                removeButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const fileName = this.getAttribute('data-file-name');
                                        const fileContainer = this.closest('.file-container');

                                        // Hide the file container
                                        if (fileContainer) {
                                            fileContainer.style.display = 'none';
                                            // Remove hidden input associated with this file
                                            const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                            if (hiddenInput) {
                                                hiddenInput.remove();
                                            }

                                            // Add the file name to the deleted files list
                                            const deletedFilesInput = document.getElementById(
                                                'deleted_qa_cqa_attachments');
                                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                ',') : [];
                                            deletedFiles.push(fileName);
                                            deletedFilesInput.value = deletedFiles.join(',');
                                        }
                                    });
                                });
                            });

                            function addMultipleFiles(input, id) {
                                const fileListContainer = document.getElementById(id);
                                const files = input.files;

                                for (let i = 0; i < files.length; i++) {
                                    const file = files[i];
                                    const fileName = file.name;
                                    const fileContainer = document.createElement('h6');
                                    fileContainer.classList.add('file-container', 'text-dark');
                                    fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                    const fileText = document.createElement('b');
                                    fileText.textContent = fileName;

                                    const viewLink = document.createElement('a');
                                    viewLink.href = '#'; // You might need to adjust this to handle local previews
                                    viewLink.target = '_blank';
                                    viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                    const removeLink = document.createElement('a');
                                    removeLink.classList.add('remove-file');
                                    removeLink.dataset.fileName = fileName;
                                    removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                    removeLink.addEventListener('click', function() {
                                        fileContainer.style.display = 'none';
                                    });

                                    fileContainer.appendChild(fileText);
                                    fileContainer.appendChild(viewLink);
                                    fileContainer.appendChild(removeLink);

                                    fileListContainer.appendChild(fileContainer);
                                }
                            }
                        </script>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" id="saveButton"
                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>

            @php

                $istab7  =  (Helpers::check_roles($data->division_id, 'Market Complaint', 9) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 39) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 42) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 43) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 65) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18))
            @endphp
            <div id="CCForm7" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        QA/CQA Head Approval
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            @if ($data->stage == 6)
                                <div class="group-input">
                                    <label for="HOD Remarks">QA/CQA Head Approval Comment <span
                                            class="text-danger">*</span></label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                            does not require completion</small></div>
                                    <textarea class="tiny" name="qa_cqa_head_comm" id="summernote-4" required {{ $data->stage == 6 && $istab7  ? '' : 'readonly' }}>{{ $data->qa_cqa_head_comm }}</textarea>
                                </div>
                            @else
                                <div class="group-input">
                                    <label for="QA/CQA Head Comment">QA/CQA Head Approval Comment</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                            does not require completion</small></div>
                                    <textarea readonly class="tiny" name="qa_cqa_head_comm" id="summernote-4" {{ $data->stage == 6 && $istab7 ? '' : 'readonly' }}>{{ $data->qa_cqa_head_comm }}</textarea>
                                </div>
                            @endif
                            @error('qa_cqa_head_comm')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="group-input">
                                <label for="qa_cqa_head_attach">QA/CQA Head Approval Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="qa_cqa_head_attach">
                                        @if ($data->qa_cqa_head_attach)
                                            @foreach (json_decode($data->qa_cqa_head_attach) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                        <i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i>
                                                    </a>
                                                    <a type="button" class="remove-file5"
                                                        data-file-name="{{ $file }}">
                                                        <i class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i>
                                                    </a>
                                                    <input type="hidden" name="existing_qa_cqa_head_attach[]"
                                                        value="{{ $file }}">
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="qa_cqa_head_attach[]"
                                        {{ $data->stage == 6 && $istab7 ? '' : 'disabled' }}
                                            oninput="addMultipleFiles(this, 'qa_cqa_head_attach')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden field to keep track of files to be deleted -->
                        <input type="hidden" id="deleted_qa_cqa_head_attach" name="deleted_qa_cqa_head_attach"
                            value="">

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const removeButtons = document.querySelectorAll('.remove-file5');

                                removeButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const fileName = this.getAttribute('data-file-name');
                                        const fileContainer = this.closest('.file-container');

                                        // Hide the file container
                                        if (fileContainer) {
                                            fileContainer.style.display = 'none';
                                            // Remove hidden input associated with this file
                                            const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                            if (hiddenInput) {
                                                hiddenInput.remove();
                                            }

                                            // Add the file name to the deleted files list
                                            const deletedFilesInput = document.getElementById(
                                                'deleted_qa_cqa_head_attach');
                                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                ',') : [];
                                            deletedFiles.push(fileName);
                                            deletedFilesInput.value = deletedFiles.join(',');
                                        }
                                    });
                                });
                            });

                            function addMultipleFiles(input, id) {
                                const fileListContainer = document.getElementById(id);
                                const files = input.files;

                                for (let i = 0; i < files.length; i++) {
                                    const file = files[i];
                                    const fileName = file.name;
                                    const fileContainer = document.createElement('h6');
                                    fileContainer.classList.add('file-container', 'text-dark');
                                    fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                    const fileText = document.createElement('b');
                                    fileText.textContent = fileName;

                                    const viewLink = document.createElement('a');
                                    viewLink.href = '#'; // You might need to adjust this to handle local previews
                                    viewLink.target = '_blank';
                                    viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                    const removeLink = document.createElement('a');
                                    removeLink.classList.add('remove-file');
                                    removeLink.dataset.fileName = fileName;
                                    removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                    removeLink.addEventListener('click', function() {
                                        fileContainer.style.display = 'none';
                                    });

                                    fileContainer.appendChild(fileText);
                                    fileContainer.appendChild(viewLink);
                                    fileContainer.appendChild(removeLink);

                                    fileListContainer.appendChild(fileContainer);
                                }
                            }
                        </script>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" id="saveButton"
                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"><a class="text-white" href="{{ url('rcms/alltabmarketComplain',$data->id) }}">Report
                        </a> </button>
                        <button type="button"><a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>

            @php

                $istab8  =  (Helpers::check_roles($data->division_id, 'Market Complaint', 7) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 66) ||
                                    Helpers::check_roles($data->division_id, 'Market Complaint', 18))
            @endphp
            <div id="CCForm8" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Closure
                    </div>
                    <div class="row">
                        @if ($data->stage == 7)
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Closure Comment">Closure Comment <span class="text-danger">*</span>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea  name="closure_comment_c"{{ $data->stage == 7 && $istab8 ? '' : 'readonly' }}>{{ $data->closure_comment_c }}</textarea>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Closure Comment">Closure Comment <span class="text-danger"></span>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea  name="closure_comment_c"
                                    {{ $data->stage == 7 && $istab8 ? '' : 'readonly' }}>{{ $data->closure_comment_c }}
                                    </textarea>
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <div class="group-input">
                                <label for="initial_attachment_c">Closure Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="initial_attachment_c">
                                        @if ($data->initial_attachment_c)
                                            @foreach (json_decode($data->initial_attachment_c) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                        <i class="fa fa-eye text-primary"
                                                            style="font-size:20px; margin-right:-10px;"></i>
                                                    </a>
                                                    <a type="button" class="remove-file6"
                                                        data-file-name="{{ $file }}">
                                                        <i class="fa-solid fa-circle-xmark"
                                                            style="color:red; font-size:20px;"></i>
                                                    </a>
                                                    <input type="hidden" name="existing_initial_attachment_c[]"
                                                        value="{{ $file }}">
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="initial_attachment_c[]"
                                        {{ $data->stage == 7 && $istab8 ? '' : 'disabled' }}
                                            oninput="addMultipleFiles(this, 'initial_attachment_c')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden field to keep track of files to be deleted -->
                        <input type="hidden" id="deleted_initial_attachment_c" name="deleted_initial_attachment_c"
                            value="">

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const removeButtons = document.querySelectorAll('.remove-file6');

                                removeButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const fileName = this.getAttribute('data-file-name');
                                        const fileContainer = this.closest('.file-container');

                                        // Hide the file container
                                        if (fileContainer) {
                                            fileContainer.style.display = 'none';
                                            // Remove hidden input associated with this file
                                            const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                            if (hiddenInput) {
                                                hiddenInput.remove();
                                            }

                                            // Add the file name to the deleted files list
                                            const deletedFilesInput = document.getElementById(
                                                'deleted_initial_attachment_c');
                                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                ',') : [];
                                            deletedFiles.push(fileName);
                                            deletedFilesInput.value = deletedFiles.join(',');
                                        }
                                    });
                                });
                            });

                            function addMultipleFiles(input, id) {
                                const fileListContainer = document.getElementById(id);
                                const files = input.files;

                                for (let i = 0; i < files.length; i++) {
                                    const file = files[i];
                                    const fileName = file.name;
                                    const fileContainer = document.createElement('h6');
                                    fileContainer.classList.add('file-container', 'text-dark');
                                    fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                    const fileText = document.createElement('b');
                                    fileText.textContent = fileName;

                                    const viewLink = document.createElement('a');
                                    viewLink.href = '#'; // You might need to adjust this to handle local previews
                                    viewLink.target = '_blank';
                                    viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                    const removeLink = document.createElement('a');
                                    removeLink.classList.add('remove-file');
                                    removeLink.dataset.fileName = fileName;
                                    removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                    removeLink.addEventListener('click', function() {
                                        fileContainer.style.display = 'none';
                                    });

                                    fileContainer.appendChild(fileText);
                                    fileContainer.appendChild(viewLink);
                                    fileContainer.appendChild(removeLink);

                                    fileListContainer.appendChild(fileContainer);
                                }
                            }
                        </script>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton" id="saveButton"
                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                        <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                            </a> </button>
                    </div>
                </div>
            </div>


            <div id="CCForm9" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">

                        <div class="sub-head">
                            Activity Log
                        </div>


                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Submit By : </label>
                                @if ($data->submitted_by)
                                <div class="static">{{ $data->submitted_by }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Submit On : </label>
                                @if ($data->submitted_on)
                                <div class="static">{{ $data->submitted_on }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Comment">Submit Comment : </label>
                                @if ($data->submitted_comment)
                                <div class="static">{{ $data->submitted_comment }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Complete Review By : </label>
                                @if ($data->complete_review_by)
                                <div class="static">{{ $data->complete_review_by }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Complete Review On : </label>
                                @if ($data->complete_review_on)
                                <div class="static">{{ $data->complete_review_on }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Comment">Complete Review Comment : </label>
                                @if ($data->complete_review_Comments)
                                <div class="static">{{ $data->complete_review_Comments }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Cancel By : </label>
                                @if ($data->cancelled_by)
                                <div class="static">{{ $data->cancelled_by }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Cancel On : </label>
                                @if ($data->cancelled_on)
                                <div class="static">{{ $data->cancelled_on }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Comment">Cancel Comment : </label>
                                @if ($data->cancelled_comment)
                                <div class="static">{{ $data->cancelled_comment }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Send To CFT Review By : </label>
                                @if ($data->send_cft_by)
                                <div class="static">{{ $data->send_cft_by }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Send To CFT Review On : </label>
                                @if ($data->send_cft_on)
                                <div class="static">{{ $data->send_cft_on }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Comment">Send To CFT Review Comment : </label>
                                @if ($data->send_cft_comment)
                                <div class="static">{{ $data->send_cft_comment }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">CFT Review Complete By : </label>
                                @if ($data->cft_complate_by)
                                <div class="static">{{ $data->cft_complate_by }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">CFT Review Complete On : </label>
                                @if ($data->cft_complate_on)
                                <div class="static">{{ $data->cft_complate_on }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Comment">CFT Review Complete Comment : </label>
                                @if ($data->cft_complate_comm)
                                <div class="static">{{ $data->cft_complate_comm }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">QA/CQA Verification Complete By : </label>
                                @if ($data->qa_cqa_verif_comp_by)
                                <div class="static">{{ $data->qa_cqa_verif_comp_by }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">QA/CQA Verification Complete On : </label>
                                @if ($data->qa_cqa_verif_comp_on)
                                <div class="static">{{ $data->qa_cqa_verif_comp_on }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Comment">QA/CQA Verification Complete Comment : </label>
                                @if ($data->QA_cqa_verif_Comments)
                                <div class="static">{{ $data->QA_cqa_verif_Comments }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Approval Complete By : </label>
                                @if ($data->approve_plan_by)
                                <div class="static">{{ $data->approve_plan_by }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Approval Complete On : </label>
                                @if ($data->approve_plan_on)
                                <div class="static">{{ $data->approve_plan_on }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Comment">Approval Complete Comment : </label>
                                @if ($data->approve_plan_comment)
                                <div class="static">{{ $data->approve_plan_comment }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator Group">Send Letter By : </label>
                                @if ($data->send_letter_by)
                                <div class="static">{{ $data->send_letter_by }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="OOC Logged On">Send Letter On : </label>
                                @if ($data->send_letter_on)
                                <div class="static">{{ $data->send_letter_on }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Comment">Send Letter Comment : </label>
                                @if ($data->send_letter_comment)
                                <div class="static">{{ $data->send_letter_comment }}</div>
                                @else
                                    Not Applicable
                                @endif
                            </div>
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

        // $('#summernote').summernote({
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear', 'italic']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //         ['insert', ['link', 'picture', 'video']],
        //         ['view', ['fullscreen', 'codeview', 'help']]
        //     ]
        // });

        // $('.summernote').summernote({
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear', 'italic']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //         ['insert', ['link', 'picture', 'video']],
        //         ['view', ['fullscreen', 'codeview', 'help']]
        //     ]
        // });

        const snToolbar = [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear', 'italic']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ];

        // single id summernote
        // $('#summernote').summernote({
        //     toolbar: snToolbar
        // });

        $('.summernote').each(function () {

            const editorStage = $(this).data('stage');

            $(this).summernote({
                // height: 200,
                toolbar: snToolbar
            });

            // STAGE + ROLE CHECK (PER EDITOR)
            let canEdit = false;

        if (editorStage == 1) {
            canEdit = @json($istab1);
        }

        if (editorStage == 3) {
            canEdit = @json($istab4);
        }

        if (!canEdit) {
            $(this).summernote('disable');
        }

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
        var textlen = maxLength - $('#docname').val().length;
        $('#rchars').text(textlen);

        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
    {{-- ====================script for record number and intir--code ===================== --}}
    {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
var originalRecordNumber = document.getElementById('record').value;
var initialPlaceholder = '---';

document.getElementById('initiator_group').addEventListener('change', function() {
    var selectedValue = this.value;
    var recordNumberElement = document.getElementById('record');
    var initiatorGroupCodeElement = document.getElementById('initiator_group_code');

    // Update the initiator group code
    initiatorGroupCodeElement.value = selectedValue;

    // Update the record number by replacing the initial placeholder with the selected initiator group code
    var newRecordNumber = originalRecordNumber.replace(initialPlaceholder, selectedValue);
    recordNumberElement.value = newRecordNumber;

    // Update the original record number to keep track of changes
    originalRecordNumber = newRecordNumber;
    initialPlaceholder = selectedValue;
});
});

</script> --}}

    <!--------------------------Modal-------------------->


    <div class="modal fade" id="rejection-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('marketcomplaint.mar_comp_reject_stateChange', $data->id) }}" method="POST" class="signatureModalFormloder">
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

    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('marketcomplaint.mar_comp_stagechange', $data->id) }}" method="POST" id="signatureModalFormloder">
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
                            <label for="comment">Comment</label>
                            <input type="text" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                            <button type="submit" data-bs-dismiss="modal">Submit</button>
                            <button>Close</button>
                        </div> -->
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

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('marketcomplaint.MarketComplaintCancel', $data->id) }}" method="POST" class="signatureModalFormloder">
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
                    {{-- <div class="modal-footer">
                        <button type="submit">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div> --}}
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
    {{-- ================================== Capa and  Action child =============================================== --}}


    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="model-body">

                    <form action="{{ route('marketcomplaint.capa_action_child', $data->id) }}" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="group-input">
                                <label for="root-item" style="display: flex; gap: 18px; width: 60px;">
                                    <input type="radio" name="revision" id="root-item" value="rca">
                                    RCA
                                </label>
                            </div>

                            <div class="group-input">
                                <label style="display: flex; gap: 18px; width: 60px;" for="capa-child">
                                    <input type="radio" name="revision" id="capa-child" value="capa-child">
                                    CAPA
                                </label>
                            </div>
                            <div class="group-input">
                                <label style="display: flex; gap: 16px; width: 60px;" for="root-item">
                                    <input type="radio" name="revision" id="root-item" value="Action-Item">
                                    Action Item
                                </label>
                            </div>
                            @if(Helpers::getChildData($data->id, 'Market Complaint') < 3)
                                <div class="group-input">
                                    <label style="display: flex; gap: 16px; width: 60px;" for="extension">
                                        <input type="radio" name="revision" id="extension" value="extension">
                                    Extension
                                    </label>
                                </div>
                            @endif

                        </div>

                        <!-- Modal footer -->
                        <!-- <div class="modal-footer">
                                                                    <button type="button" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit">Continue</button>
                                                                </div> -->
                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    <div class="modal fade" id="child-modal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Child</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('marketcomplaint.marketCompalinExtensionChild', $data->id) }}" method="POST">
                    @csrf
                    @if(Helpers::getChildData($data->id, 'RCA') < 3)
                    <div class="form-check mb-3">
                        <input class="" type="radio" name="revision" id="extension" value="extension" required>
                        <label class="form-check-label" for="extension">Extension</label>
                    </div>
                    @endif


                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

    {{-- ==================================RCA and Action child=============================================== --}}
    <div class="modal fade" id="child-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="model-body">
                    <form action="{{ route('marketcomplaint.rca_action_child', $data->id) }}" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="group-input">
                                <label style="  display: flex;     gap: 18px; width: 60px;" for="capa-child">
                                    <input type="radio" name="revision" id="capa-child" value="rca-child">
                                    RCA
                                </label>
                            </div>
                            <div class="group-input">
                                <label style=" display: flex;     gap: 16px; width: 60px;" for="root-item">
                                    <input type="radio" name="revision" id="root-item" value="Action-Item">
                                    <span style="width: 100px;"> Action Item</span>
                                </label>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- ==================================Regulatory  Reporting  and Effectiveness  Check child=============================================== --}}

    <div class="modal fade" id="child-modal3">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="model-body">

                    <form action="{{ route('marketcomplaint.Regu_Effec_child', $data->id) }}" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            {{-- <div class="group-input">
                                    <label style=" display: flex; gap: 16px; width: 60px;" for="capa-child">
                                        <input type="radio" name="revision" id="rca-child" value="regulatory-child">
                                        Regulatory Reporting
                                    </label>
                                </div> --}}
                            <div class="group-input">
                                <label style="  display: flex;     gap: 18px; width: 60px;"for="root-item">
                                    <input type="radio" name="revision" id="root-item"
                                        value="Effectiveness-child">
                                    Effectiveness Check
                                </label>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- ==========================single regulatory ======================= --}}
    <div class="modal fade" id="child-modal4">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="model-body">

                    <form action="{{ route('marketcomplaint.Regu_Effec_child', $data->id) }}" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="group-input">
                                <label style=" display: flex;     gap: 16px; width: 60px;" for="capa-child">
                                    <input type="radio" name="revision" id="rca-child" value="regulatory-child">
                                    Regulatory Reporting
                                </label>
                            </div>


                        </div>


                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

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

        .input_full_width {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeButtons = document.querySelectorAll('.remove-file');

            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
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
        var maxLength = 240;
        $('#duedoc').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchar').text(textlen);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function setupPersonToDepartmentMapping(personSelectId, departmentInputId, usersData) {
                let personSelect = document.getElementById(personSelectId);
                let departmentInput = document.getElementById(departmentInputId);

                if (personSelect && departmentInput) {
                    personSelect.addEventListener("change", function () {
                        let selectedPerson = personSelect.value;
                        departmentInput.value = usersData[selectedPerson] || ""; // Assign department or clear field
                    });
                }
            }

            // Store user department data
            // let userDepartments = {
            //     @foreach ($users as $user)
            //         "{{ $user->name }}": "{{ Helpers::getUsersDepartmentName($user->departmentid) }}",
            //     @endforeach
            // };
            let userDepartments = {
                @foreach ($users as $user)
                    "{{ $user->name }}": `{!! Helpers::getUsersDepartmentName($user->departmentid) !!}`,
                @endforeach
            };

            // Apply function to "Other's 1 Person" and "Other's 1 Department"
            setupPersonToDepartmentMapping("Other1_person", "Other1_Department_person", userDepartments);
            setupPersonToDepartmentMapping("Other2_person", "Other2_Department_person", userDepartments);
            setupPersonToDepartmentMapping("Other3_person", "Other3_Department_person", userDepartments);
            setupPersonToDepartmentMapping("Other4_person", "Other4_Department_person", userDepartments);
            setupPersonToDepartmentMapping("Other5_person", "Other5_Department_person", userDepartments);
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
                // var signatureForm = document.getElementById('signatureModalFormloder');
              var signatureForm = document.querySelector('.signatureModalFormloder'); // <-- class use kiya

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.signatureModalButton');
                    var spinner = signatureForm.querySelector('.signatureModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
                var signatureForm = document.getElementById('signatureModalFormloder');
            //   var signatureForm = document.querySelector('.signatureModalFormloder'); // <-- class use kiya

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.signatureModalButton');
                    var spinner = signatureForm.querySelector('.signatureModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });
</script>

<script>
$(document).ready(function() {

    function toggleComplaintSampleStatus() {
        var val = $('#complaint_sample_required_ca').val();
        if (val === 'yes') {
            $('#complaint_sample_status_div').show();
        } else {
            $('#complaint_sample_status_div').hide();
            $('#summernote-1').val(''); // optionally clear value
        }
    }

    // Run on change
    $('#complaint_sample_required_ca').on('change', toggleComplaintSampleStatus);

    // Run on page load (for edit mode)
    toggleComplaintSampleStatus();
});
</script>

    <!-- SweetAlert2 CDN -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <script>
        @if (Session::has('swal'))
            Swal.fire({
                title: '{{ Session::get('swal.title') }}',
                text: '{{ Session::get('swal.message') }}',
                icon: '{{ Session::get('swal.type') }}', // Type can be success, warning, error
                confirmButtonText: 'OK',
                width: '300px',
                height: '200px',
                size: '50px',
            });
        @endif
    </script> --}}
    {{-- <style>
        .swal2-title {
            font-size: 18px;
            /* Customize title font size */
        }

        .swal2-html-container {
            font-size: 14px;
            /* Customize content text font size */
        }

        .swal2-confirm {
            font-size: 14px;
            /* Customize confirm button font size */
        }
    </style> --}}

@endsection
