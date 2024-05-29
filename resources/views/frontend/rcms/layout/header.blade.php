<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Vidyagxp - Software</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/nlsiabbt295w89cjmcocv6qjdg3k7ozef0q9meowv2nkwyd3/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('user/css/virtual-select.min.css') }}">
    <script src="{{ asset('user/js/virtual-select.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('user/css/rcms_style.css') }}">
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/stock.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <style>
        .bottom-links {
            display: flex;
            align-items: center;
            margin-top: 15px;
            margin-left: 10px;
            position: relative;
        }

        .bottom-links div {
            height: 35px;
            margin-right: 15px;
            display: grid;
            place-items: center;
        }

        .bottom-links a {
            color: black;
            width: 100%;
            display: grid;
            place-items: center;
            height: 100%;
            transition: all 0.3s linear;
            text-decoration: none;
        }

        .bottom-links a:hover {
            color: #4274da;
            text-decoration: none;
        }

        .bottom-links .notification {
            position: absolute;
            right: 0;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>


    {{-- ======================================
            PRELOADER
    ======================================= --}}
    {{-- <div id="preloader">
        <span class="loader"></span>
    </div> --}}


    {{-- ======================================
            HEADER
    ======================================= --}}

    <header>

        {{-- Header Top --}}
        <div class="header_rcms_top">
            <div class="container-fluid">
                <div class="container">
                    <div></div>
                </div>
            </div>
        </div>

        {{-- Header Middle --}}
        <div class="header_rcms_middle">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="middle-head">
                        <div class="logo-container">
                            <div class="logo">
                                <img src="{{ asset('user/images/vidyagxplogo.png') }}" alt="..."
                                    class="w-100 h-100" style="scale: 5; pointer-events: none;">
                            </div>
                            <div class="logo">
                                <img src="{{ asset('user/images/agio.jpg') }}" alt="..." class="w-100 h-100">
                            </div>
                        </div>
                        <div class="icon-grid">
                            <div class="icon-drop">
                                <div class="icon">
                                    <i class="fa-solid fa-user-tie"></i>
                                    @if (Auth::user())
                                        {{ Auth::user()->name }}
                                        {{-- @else
                                        Amit Guru --}}
                                    @endif
                                    <i class="fa-solid fa-angle-down"></i>
                                </div>
                                <div class="icon-block small-block">
                                    {{-- <div data-bs-toggle="modal" data-bs-target="#setting-modal">Settings</div> --}}
                                    <div data-bs-toggle="modal" data-bs-target="#about-modal">About</div>
                                    {{-- <div><a href="#">Help</a></div> --}}
                                    <div><a href="/rcms/helpdesk-personnel">Helpdesk Personnel</a></div>
                                    <div><a href="{{ url('rcms/logout') }}">Log Out</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Header Bottom --}}
        <div class="header_rcms_bottom">
            <div class="container-fluid">
                <div class="bottom-head">
                    <div class="left-block">
                        <div class="link-block">
                            <a href="{{ url('rcms/qms-dashboard') }}" data-bs-toggle="tooltip" title="Dekstop">
                                <i class="fa-solid fa-house-user"></i>
                            </a>
                            <button class="btn-transparent bg-transparent text-black" data-bs-toggle="modal" data-bs-target="#log-list-modal" title="Logs">
                                <i class="fa-solid fa-gauge-high"></i>
                            </button>
                            
                        </div>
                    </div>
                    <div class="right-block">
                        <div class="search-bar">
                            <form>
                                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                                <input type="text" name="search" id="searchInput" placeholder="Search...">
                            </form>
                        </div>
                        <div class="create">
                            <a href="{{ url('rcms/form-division') }}"> <button class="button_theme1">Create
                                    Record</button> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container-fluid">
                    <div class="bottom-links">
                        <div>
                            <a href="#"><i class="fa-solid fa-braille"></i></a>
                        </div>
                        <div>
                            <a href="/dashboard">DMS Dashboard</a>
                        </div>
                        <div>
                            <a href="/TMS">TMS Dashboard</a>
                        </div>
                        <div>
                            <a href="/rcms/qms-dashboard">QMS-Dashboard</a>
                        </div>
                        {{-- <div>
                                    <a href="/analytics">Analytics</a>
                                    </div>  --}}

                        @if (Auth::user())
                            @if (Helpers::checkRoles(3) || Helpers::checkRoles(1) || Helpers::checkRoles(2))
                                <div>
                                    <a href="/mydms">My DMS</a>
                                </div>
                            @endif
                            @if (Helpers::checkRoles(3))
                                <div>
                                    <a href="{{ route('documents.index') }}">Documents</a>
                                </div>
                            @endif
                            @if (Helpers::checkRoles(1) || Helpers::checkRoles(2) || Helpers::checkRoles(4))
                                <div>
                                    <a href="{{ url('mytaskdata') }}">My Tasks</a>
                                </div>
                            @endif
                            {{-- @if (Helpers::checkRoles(4) || Helpers::checkRoles(5) || Helpers::checkRoles(3))
                                            <div>
                                                <a href="{{ route('change-control.index') }}">Change Control</a>
                                            </div>
                                        @endif --}}
                        @endif


                        {{-- <div class="notification">
                                        <a href="/notifications"><i class="fa-solid fa-bell"></i></a>
                                    </div> --}}
                        <!-- <div id="create-record-button">
                                        <a href="{{ url('rcms/form-division') }}"> <button class="button_theme1">Create
                                                Record</button> </a>
                                    </div> -->
                    </div>
                </div>
            </div>
        </div>


    </header>


    {{-- ======================================
                    STANDARDS MODAL MODAL
    ======================================= --}}
    <div class="modal fade" id="standards-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Standards</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="standard-list">
                        <div class="item">ISO 14971</div>
                        <div class="item">ICH Q10</div>
                        <div class="item">ICH Q9</div>
                        <div class="item">ISO 17025</div>
                        <div class="item">ISO 9001</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        #standards-modal .standard-list {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        #standards-modal .standard-list .item {
            background: #4274da52;
            padding: 7px 15px;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
            transition: all 0.3s linear;
            cursor: pointer;
        }

        #standards-modal .standard-list .item:hover {
            background: #4274da;
            color: white
        }
    </style>




    {{-- ======================================
                    SETTING MODAL
    ======================================= --}}
    <div class="modal fade" id="setting-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">User's Settings</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="image">
                        <img src="{{ asset('user/images/login.jpg') }}" alt="..." class="w-100 h-100">
                    </div>
                    <div class="bar">
                        <strong>Name : </strong> Amit Guru
                    </div>
                    <div class="bar">
                        <strong>E-Mail : </strong> amit.guru@vidyaGxP.io
                    </div>
                    <div class="bar">
                        <a href="#">Change Password</a>
                    </div>
                </div>

            </div>
        </div>
    </div>




    {{-- ======================================
                    ABOUT MODAL
    ======================================= --}}
    <div class="modal fade" id="about-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">About</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="logo">
                        <img src="{{ asset('user/images/logo.png') }}" alt="..." class="w-100 h-100">
                    </div>
                    <div class="bar">
                        <strong>Version : </strong> 10.0.0
                    </div>
                    <div class="bar">
                        <strong>Build # : </strong> 2
                    </div>
                    <div class="bar">
                        April 23, 2023
                    </div>
                    <div class="bar">
                        <strong>Licensed to : </strong> vidyaGxP
                    </div>
                    <div class="bar">
                        <strong>Environment : </strong> Master Demo Dev
                    </div>
                    <div class="bar">
                        <strong>Server : </strong> SCRRREVE3 (100.23.34.0)
                    </div>
                    <div class="copyright-bar">
                        <i class="fa-regular fa-copyright"></i>&nbsp;
                        Copyright 2023 vidyaGxP Asia Limited
                    </div>
                </div>

            </div>
        </div>
    </div>

@php
    $logs_list = [
        'CAPA',
        'Change Control',
        'Deviation',
        'Errata',
        'Failure Investigation',
        'Incident',
        'Inernal Audit',
        'Lab Incident',
        'Market Complaint',
        'Non Conformance',
        'OOC',
        'OOT',
        'Risk Management',
            
    ];                
@endphp

    {{-- LOG LIST MODAL START --}}
    <div class="modal fade" id="log-list-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Log Reports</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                @foreach ($logs_list as $log_list)
                    <p> <a href="{{ route('rcms.logs.show', Str::slug($log_list)) }}" target="_blank">{{ $log_list }}</a> </p>
                @endforeach
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    {{-- LOG LIST MODAL END --}}