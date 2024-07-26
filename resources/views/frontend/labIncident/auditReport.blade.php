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

    .w-10 {
        width: 10%;
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
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Lab Incident Audit Trial Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>    Lab Incident No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::getDivisionName($doc->division_id) }}/MC
                    /{{ Helpers::year($doc->created_at) }}/
                    {{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                </td>
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
            <table>
                <thead>
                    <tr class="table_bg">
                        <th>S.No</th>
                        <th>Flow Changed From</th>
                        <th>Flow Changed To</th>
                        <th>Data Field</th>
                        <th>Action Type</th>
                        <th>Performer</th>
                    </tr>
                </thead>
                {{-- @foreach ($data as $datas)
                    <tr>
                        @php
                            $previousItem = null;
                        @endphp --}}
                <tbody>
                    @foreach ( $data as $index => $dataDemo)
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
                                    <strong>Data Field Name :</strong>
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
                                        @if (!empty(strip_tags($dataDemo->previous)))
                                            {{-- Check if the previous is a date --}}
                                            @if (strtotime($dataDemo->previous))
                                                {{ \Carbon\Carbon::parse($dataDemo->previous)->format('d/m/Y') }}
                                            @else
                                                {!! $dataDemo->previous !!}
                                            @endif
                                        @elseif($dataDemo->previous == null)
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
                                            {!! !empty(strip_tags($dataDemo->current)) ? $dataDemo->current : 'Not Applicable' !!}
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
                                <div style="margin-top: 5px;">
                                    <strong>Performed On :</strong>
                                    {{ $dataDemo->created_at ? \Carbon\Carbon::parse($dataDemo->created_at)->format('j F Y H:i') : 'Not Applicable' }}
                                </div>
                                <div style="margin-top: 5px;">
                                    <strong>Comments :</strong>
                                    {{ $dataDemo->comment ? $dataDemo->comment : 'Not Applicable' }}
                                </div>
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

