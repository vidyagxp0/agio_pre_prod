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

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;
        vertical-align: top;
        word-wrap: break-word; /* Ensure text breaks and wraps inside the cell */
    }

    table {
        width: 100%;
    }

    th, td {
        padding: 8px;
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

    .table_bg {
        background-color: #4274da57;
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
                <td class="w-70 head">Effectiveness Check Audit Trail Report</td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30"><strong>Effectiveness Check Audit No.</strong></td>
                <td class="w-40">{{ Helpers::getDivisionName($doc->division_id) }}/EC/{{ Helpers::year($doc->created_at) }}/{{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}</td>
                <td class="w-30"><strong>Record No.</strong> {{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}</td>
            </tr>
        </table>
    </header>

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
                <tbody>
                    @foreach ( $data as $index => $dataDemo)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div><strong>Changed From :</strong> {{ $dataDemo->change_from ?: 'Not Applicable' }}</div>
                        </td>
                        <td>
                            <div><strong>Changed To :</strong> {{ $dataDemo->change_to ?: 'Not Applicable' }}</div>
                        </td>
                        <td>
                            <div><strong>Data Field Name :</strong> {{ $dataDemo->activity_type ?: 'Not Applicable' }}</div>
                            <div style="margin-top: 5px;">
                                @if ($dataDemo->activity_type == 'Activity Log')
                                    <strong>Change From :</strong>
                                    {{str_replace(',', ', ', $dataDemo->change_from )?: 'Not Applicable' }}
                                @else
                                    <strong>Change From :</strong> {{str_replace(',', ', ', $dataDemo->previous) ?: 'Null' }}
                                @endif
                            </div>
                            <div style="margin-top: 5px;">
                                @if ($dataDemo->activity_type == 'Activity Log')
                                    <strong>Change To :</strong> {{ str_replace(',', ', ',$dataDemo->change_to )?: 'Not Applicable' }}
                                @else
                                    <strong>Change To :</strong> {{ str_replace(',', ', ',$dataDemo->current) ?: 'Not Applicable' }}
                                @endif
                            </div>
                            <div style="margin-top: 5px;">
                                <strong>Change Type :</strong> {{ $dataDemo->action_name ?: 'Not Applicable' }}
                            </div>
                        </td>
                        <td>
                            <div><strong>Action Name :</strong> {{ $dataDemo->action ?: 'Not Applicable' }}</div>
                        </td>
                        <td>
                            <div><strong>Performed By :</strong> {{ $dataDemo->user_name ?: 'Not Applicable' }}</div>
                            <div style="margin-top: 5px;">
                                <strong>Performed On :</strong> {{ $dataDemo->created_at ? \Carbon\Carbon::parse($dataDemo->created_at)->format('j F Y H:i') : 'Not Applicable' }}
                            </div>
                            <div style="margin-top: 5px;">
                                <strong>Comments :</strong> {{ $dataDemo->comment ?: 'Not Applicable' }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <table>
            <tr>
                <td class="w-30"><strong>Printed On :</strong> {{ date('d-M-Y') }}</td>
                <td class="w-40"><strong>Printed By :</strong> {{ Auth::user()->name }}</td>
            </tr>
        </table>
    </footer>

</body>

</html>
