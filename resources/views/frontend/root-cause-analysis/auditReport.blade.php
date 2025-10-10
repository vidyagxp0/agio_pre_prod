<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        min-width: 100vw;
        min-height: 100vh;
    }

    .w-5 {
        width: 5%;
    }

    .w-10 {
        width: 10%;
    }

    .w-15 {
        width: 15%;
    }

    .w-20 {
        width: 20%;
    }

    .w-30 {
        width: 30%;
    }

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    .w-60 {
        width: 60%;
    }

    .w-70 {
        width: 70%;
    }

    .w-80 {
        width: 80%;
    }

    .w-90 {
        width: 90%;
    }

    .w-100 {
        width: 100%;
    }

    .h-100 {
        height: 100%;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;
        overflow: hidden;
        vertical-align: middle;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    header .head {
        font-weight: bold;
        text-align: center;
        font-size: 1.2rem;
    }

    @page {
        size: A4;
        margin-top: 160px;
        margin-bottom: 60px;
    }

    header {
        position: fixed;
        top: -140px;
        left: 0;
        width: 100%;
        display: block;
    }

    footer {
        position: fixed;
        bottom: -40px;
        left: 0;
        width: 100%;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block .head {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .inner-block .division {
        margin-bottom: 10px;
    }

    .first-table {
        border-top: 1px solid black;
        margin-bottom: 20px;
    }

    .first-table table td,
    .first-table table th,
    .first-table table {
        border: 0;
    }

    .second-table td:nth-child(1)>div {
        margin-bottom: 10px;
    }

    .second-table td:nth-child(1)>div:nth-last-child(1) {
        margin-bottom: 0px;
    }

    .table_bg {
        background: #4274da57;
    }

    .allow-wb {
        word-break: break-all;
        word-wrap: break-word;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                     Root Cause Analysis Audit Trail Report
                </td>
                <td class="w-30">
                    <div class="logo">
<img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                        style="max-height: 55px; max-width: 40px;">
                    </div>
                    {{-- <div class="logo">
                        <img src="data:image/png;base64,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" alt="" class="w-50">
                    </div> --}}
                    
                </td>
            </tr>
        </table>
        <table>
             <tr>
                <td class="w-30">
                    <strong> Root Cause Analysis No.</strong>
                </td>
               
                <td class="w-40">
                    {{ Helpers::getDivisionName($doc->division_id) }}/
                    RCA
                    /{{ Helpers::year($doc->created_at) }}/
                    {{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                {{-- <td class="w-30"></td> --}}
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>

            </tr>
        </table>
    </footer>

    <div class="inner-block">


        <div class="second-table">
            <table class="allow-wb" style="table-layout: fixed; width: 700px;">
                <thead>
                    <tr class="table_bg">
                        <th class="w-5">S.No</th>
                        <th class="w-15">Flow Changed From</th>
                        <th class="w-15">Flow Changed To</th>
                        <th class="w-30">Data Field</th>
                        <th class="w-15" style="word-break: break-all;">Action Type</th>
                        <th class="w-15" style="word-break: break-all;">Performer</th>
                    </tr>
                </thead>
                {{-- @foreach ($data as $datas)
                    <tr>
                        @php
                            $previousItem = null;
                        @endphp --}}

                <tbody>
                    @foreach ($data  as $index => $dataDemo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div><strong>Changed From :</strong> {{ $dataDemo->change_from }}</div>
                            </td>
                            <td>
                                <div><strong>Changed To :</strong> {{ $dataDemo->change_to }}</div>
                            </td>
                            <td>
                                <div>
                                    <strong>Data Field Name   :</strong>
                                    {{ $dataDemo->activity_type ?: 'Not Applicable' }}
                                </div>
                                <div style="margin-top: 5px;" class="imageContainer">
                                    <!-- Assuming $dataDemo->image_url contains the URL of your image -->
                                    @if ($dataDemo->activity_type == 'Activity Log')
                                        <strong>Change From :</strong>
                                        @if ($dataDemo->change_from)
                                            {{-- Check if the change_from is a date --}}
                                            @if (strtotime($dataDemo->change_from))
                                                {{ \Carbon\Carbon::parse($dataDemo->change_from)->format('d/m/Y') }}
                                            @else
                                                {{ str_replace(',', ', ', $dataDemo->change_from) }}
                                            @endif
                                        @elseif($dataDemo->change_from && trim($dataDemo->change_from) == '')
                                            NULL
                                        @else
                                            Not Applicable
                                        @endif
                                    @else
                                        <strong>Change From :</strong>
                                        @if (!empty(strip_tags($dataDemo->previous)) || $dataDemo->previous === '0' || $dataDemo->previous === 0)
                                            @if (strtotime($dataDemo->previous))
                                                {{ \Carbon\Carbon::parse($dataDemo->previous)->format('d/m/Y') }}
                                            @else
                                                {!! $dataDemo->previous !!}
                                            @endif
                                        @elseif($dataDemo->previous === null)
                                            Null
                                        @else
                                            Not Applicable
                                        @endif

                                    @endif
                                </div>
                                <br>

                                <div class="imageContainer">
                                    @if ($dataDemo->activity_type == 'Activity Log')
                                        <strong>Change To :</strong>
                                        @if (strtotime($dataDemo->change_to))
                                            {{ \Carbon\Carbon::parse($dataDemo->change_to)->format('d/m/Y') }}
                                        @else
                                            {!! str_replace(',', ', ', $dataDemo->change_to) ?: 'Not Applicable' !!}
                                        @endif
                                    @else
                                        <strong>Change To :</strong>
                                        @if (strtotime($dataDemo->current))
                                            {{ \Carbon\Carbon::parse($dataDemo->current)->format('d/m/Y') }}
                                        @else
                                            {!! ($dataDemo->current === 0 || $dataDemo->current === '0' || !empty(strip_tags($dataDemo->current))) 
                                                ? $dataDemo->current 
                                                : 'Not Applicable' !!}
                                        @endif

                                    @endif
                                </div>
                                <div style="margin-top: 5px;">
                                    <strong>Change Type :</strong>
                                    {{ $dataDemo->action_name ? $dataDemo->action_name : 'Not Applicable' }}
                                </div>
                            </td>
                            <td>
                                <div><strong>Action Name :</strong>
                                    {{ $dataDemo->action ? $dataDemo->action : 'Not Applicable' }}</div>
                            </td>
                            <td>
                                <div><strong>Performed By :</strong>
                                    {{ $dataDemo->user_name ? $dataDemo->user_name : 'Not Applicable' }}</div>
                                <div style="margin-top: 5px;"> <strong>Performed On
                                        :</strong>{{ $dataDemo->created_at ? \Carbon\Carbon::parse($dataDemo->created_at)->format('d/m/Y H:i:s') : 'Not Applicable' }}
                                </div>
                                <div style="margin-top: 5px;"><strong>Comments :</strong>
                                    {{ $dataDemo->comment ? $dataDemo->comment : 'Not Applicable' }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            </table>
        </div>

    </div>


</body>

</html>
