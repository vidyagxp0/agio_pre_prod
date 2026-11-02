@extends('frontend.layout.main')
@section('container')
<head>

    <meta charset="UTF-8">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>Documents</title>

</head>
{{-- ======================================
                    DASHBOARD
    ======================================= --}}
<div id="document">
    <div class="container-fluid">
        <div class="dashboard-container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="document-left-block">
                        <div class="inner-block create-block">
                            <div class="head text-right mb-0">
                                <a href="#" id="set-division">
                                    <i class="fa-solid fa-plus"></i> Create Document
                                </a>
                            </div>
                        </div>
                        <div class="inner-block table-block">

                            {{-- =========================================================
                                FILTERS
                            ========================================================== --}}

                            <div
                                style="display:flex; justify-content:space-around;"
                                class="main-filter"
                            >


                                {{-- =====================================================
                                    STATUS
                                ====================================================== --}}

                                <div class="filter-block">

                                    <div class="drop-filter-block">

                                        <div class="icon">

                                            <i class="fa-solid fa-gauge-high"></i>

                                        </div>

                                        <div class="right">

                                            <label for="status">
                                                Status
                                            </label>


                                            <select
                                                name="status"
                                                class="filterSelect"
                                            >

                                                <option value="">
                                                    All
                                                </option>


                                                @php

                                                    $uniqueStatus = $documentStatus
                                                        ->pluck('status')
                                                        ->filter()
                                                        ->unique();

                                                @endphp


                                                @foreach ($uniqueStatus as $status)

                                                    <option value="{{ $status }}">

                                                        {{ $status }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                {{-- =====================================================
                                    DOCUMENT TYPE
                                ====================================================== --}}

                                <div class="filter-block">

                                    <div class="drop-filter-block">

                                        <div class="icon">

                                            <i class="fa-solid fa-file"></i>

                                        </div>


                                        <div class="right">

                                            <label for="document_type_id">
                                                Document Type
                                            </label>


                                            <select
                                                name="document_type_id"
                                                class="filterSelect"
                                            >

                                                <option value="">
                                                    All
                                                </option>


                                                @foreach (
                                                    Helpers::getDocumentTypes()
                                                    as $code => $name
                                                )

                                                    <option value="{{ $code }}">

                                                        {{ $name }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                {{-- =====================================================
                                    DIVISION
                                ====================================================== --}}

                                <div class="filter-block">

                                    <div class="drop-filter-block">

                                        <div class="icon">

                                            <i class="fa-solid fa-sitemap"></i>

                                        </div>


                                        <div class="right">

                                            <label for="division_id">
                                                Division
                                            </label>


                                            <select
                                                name="division_id"
                                                class="filterSelect"
                                            >

                                                <option value="">
                                                    All
                                                </option>


                                                @foreach ($divisions as $data)

                                                    <option value="{{ $data->id }}">

                                                        {{ $data->name }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                {{-- =====================================================
                                    ORIGINATOR
                                ====================================================== --}}

                                <div class="filter-block">

                                    <div class="drop-filter-block">

                                        <div class="icon">

                                            <i class="fa-solid fa-user"></i>

                                        </div>


                                        <div class="right">

                                            <label for="originator_id">
                                                Originator
                                            </label>


                                            <select
                                                name="originator_id"
                                                class="filterSelect"
                                            >

                                                <option value="">
                                                    All
                                                </option>


                                                @foreach ($originator as $data)

                                                    <option value="{{ $data->id }}">

                                                        {{ $data->name }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            {{-- =========================================================
                                LOADING
                            ========================================================== --}}

                            <div
                                class="loadingRecords"
                                style="display:none;"
                            >

                                <p>
                                    Fetching records...
                                </p>

                            </div>



                            {{-- =========================================================
                                DOCUMENT TABLE
                            ========================================================== --}}

                            <div class="record-body">

                                @include(
                                    'frontend.documents.comps.record_table'
                                )

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="group-input mb-3">
                        <label for="file">Upload Document (All PDF with csv or xls)</label>
                        <input type="file" name="files[]" multiple>
                    </div>
                    <div class="download mb-3">
                        <div class="title">(Download the example format from here.)</div>
                        <a href="{{ asset('user/images/document.xls') }}" class="btn btn-primary" download>
                            Download
                        </a>
                    </div>
                    <div>
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="division-modal" class="d-none">
    <div class="division-container">
        <div class="content-container">
            <form action="{{ route('division_submit') }}" method="post">
                @csrf
            <div class="division-tabs">

    {{-- ===== HEADINGS ===== --}}
    <div class="division-header">
        <h5 class="division-header-left">Site/Division</h5>
        <h5 class="division-header-right">Process</h5>
    </div>

    {{-- ===== BODY ===== --}}
    <div class="division-body">

        <div class="tab">
            @php
                $userRoles = DB::table('user_roles')->where('user_id', Auth::user()->id)->get();
                $divisionIds = [];
                foreach ($userRoles as $role) {
                    $divisionIds[] = $role->q_m_s_divisions_id;
                }
                $divisions = DB::table('q_m_s_divisions')->where('status', 1)->whereIn('id', $divisionIds)->get();
            @endphp

            @foreach ($divisions as $temp)
                <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                <a class="divisionlinks" onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</a>
            @endforeach
        </div>

        <div class="process-area">
            @php $process = DB::table('processes')->get(); @endphp

            @foreach ($process as $temp)
                <div id="{{ $temp->division_id }}" class="divisioncontent">
                    @php
                        $pro = DB::table('processes')->where('division_id', $temp->division_id)->get();
                    @endphp
                    @foreach ($pro as $test)
                        <label for="process">
                            <input type="radio" class="process_id_reset" value="{{ $test->id }}" name="process_id" required>
                            {{ $test->process_name }}
                        </label>
                    @endforeach
                </div>
            @endforeach
        </div>

    </div>
</div>
<style>
    /* Outer wrapper: bina border, bas white background */
    #division-modal .division-tabs {
        display: block !important;
        border: none !important;
        width: 100%;
        padding: 5px;
        background: #fff;
    }

    /* ===== Headings ===== */
    #division-modal .division-header {
        display: flex;
        width: 100%;
        margin-bottom: 12px;
    }

    #division-modal .division-header-left,
    #division-modal .division-header-right {
        margin: 0;
        padding: 0;
        border: none;
        background: none;
        font-size: 1.1rem;
        font-weight: 600;
        color: #212529;
    }

    #division-modal .division-header-left {
        width: 270px;            /* grey box ki width ke barabar */
        flex-shrink: 0;
    }

    #division-modal .division-header-right {
        flex: 1;
        padding-left: 0;
    }

    /* ===== Body ===== */
    #division-modal .division-body {
        display: flex;
        width: 100%;
        align-items: flex-start;
    }

    /* Left grey box */
    #division-modal .division-body .tab {
        width: 270px;
        flex-shrink: 0;
        float: none !important;
        height: 280px;
        background: #f0f0f0;
        border: 1px solid #c8c8c8;
        box-sizing: border-box;
        padding: 8px 0;
        overflow-y: auto;
    }

    #division-modal .division-body .tab a.divisionlinks {
        display: block;
        width: 100%;
        padding: 8px 10px;
        margin-bottom: 8px;
        background: transparent;
        color: #000;
        font-size: 0.85rem;
        text-align: left;
        cursor: pointer;
        border: none;
        outline: none;
        transition: 0.3s;
    }

    #division-modal .division-body .tab a.divisionlinks.active {
        background-color: #23a723 !important;
        color: #fff !important;
    }

    /* Right process area: white, bina border */
    #division-modal .division-body .process-area {
        flex: 1;
        padding-left: 0;
        background: #fff;
        border: none;
    }

    #division-modal .division-body .divisioncontent {
        float: none !important;
        width: auto !important;
        border: none;
        padding: 0 0 0 0;
    }

    #division-modal .division-body .divisioncontent label {
        display: block;
        margin: 6px 0;
        font-size: 0.9rem;
    }

    /* Buttons ke liye thoda gap */
    #division-modal .button-container {
        margin-top: 15px;
    }
</style>                <div class="button-container">

                    <a href="/documents" style="border: 1px solid grey;
                        letter-spacing: 1px;
                        font-size: 0.9rem;
                        padding: 3px 10px;
                        background: black;
                        color: white;">Cancel</a>
                    <button id="submit-division" type="submit">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script>
    $(document).ready(function() {
        let postUrl = "{{ route('record.filter') }}";
        $('.loadingRecords').hide();
        async function updateRecords() {
            $('.loadingRecords').show();
            let data = {
                status: $('select[name=status]').val(),
                document_type_id: $('select[name=document_type_id]').val(),
                division_id: $('select[name=division_id]').val(),
                originator_id: $('select[name=originator_id]').val(),
            }

            const res = await axios.post(postUrl, data)
            $('.record-body').html(res.data.html);
            $('.loadingRecords').hide();
        }

        $('.filterSelect').change(function() {
            try {
                updateRecords()
            } catch (err) {
                console.log("Error", err.message);
            }
        })
    })
</script> --}}

<script>

    $(document).ready(function () {

        /*
        |--------------------------------------------------------------------------
        | FILTER URL
        |--------------------------------------------------------------------------
        */

        let postUrl = "{{ route('record.filter') }}";


        /*
        |--------------------------------------------------------------------------
        | CSRF
        |--------------------------------------------------------------------------
        */

        let csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');


        axios.defaults.headers.common['X-CSRF-TOKEN'] =
            csrfToken;


        /*
        |--------------------------------------------------------------------------
        | UPDATE DOCUMENT RECORDS
        |--------------------------------------------------------------------------
        */

        async function updateRecords() {

            $('.loadingRecords').show();


            /*
            |--------------------------------------------------------------------------
            | GET FILTER VALUES
            |--------------------------------------------------------------------------
            */

            let data = {

                status:
                    $('select[name="status"]').val(),

                document_type_id:
                    $('select[name="document_type_id"]').val(),

                division_id:
                    $('select[name="division_id"]').val(),

                originator_id:
                    $('select[name="originator_id"]').val()

            };


            console.log(
                'Filter Data:',
                data
            );


            try {

                /*
                |--------------------------------------------------------------------------
                | SEND REQUEST
                |--------------------------------------------------------------------------
                */

                const response = await axios.post(
                    postUrl,
                    data
                );


                console.log(
                    'Filter Response:',
                    response.data
                );


                /*
                |--------------------------------------------------------------------------
                | UPDATE ONLY DOCUMENT TABLE
                |--------------------------------------------------------------------------
                */

                if (response.data.html) {

                    $('.record-body').html(
                        response.data.html
                    );

                }


            } catch (error) {

                console.error(
                    'Filter Error:',
                    error
                );


                if (error.response) {

                    console.error(
                        'Status:',
                        error.response.status
                    );


                    console.error(
                        'Server Response:',
                        error.response.data
                    );


                    alert(
                        error.response.data.message
                        ||
                        'Something went wrong while filtering records.'
                    );

                }

            } finally {

                $('.loadingRecords').hide();

            }

        }


        /*
        |--------------------------------------------------------------------------
        | FILTER CHANGE
        |--------------------------------------------------------------------------
        */

        $(document).on(
            'change',
            '.filterSelect',
            function () {

                updateRecords();

            }
        );

    });

</script>

@endsection