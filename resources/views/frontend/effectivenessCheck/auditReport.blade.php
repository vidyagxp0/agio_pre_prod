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
    @page {
         margin: 160px 35px 100px; /* top header, side margin, bottom footer */
     }
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        font-size: 11px;
        line-height: 1.4;
        color: #000;
        margin-top: 10px;
         margin-bottom: -60px; 
    }

    header, footer {
        position: fixed;
        left: 0;
        right: 0;
        /* padding: 20px 35px; */
        font-size: 12px;
        box-sizing: border-box;
    }

    header {
        top: -140px;
        border-bottom: none;
    }

    footer {
        bottom: 0;
        bottom: -100px;
        border-top: none;
    }

    .logo img {
        display: block;
        margin-left: auto;
    }
    /* To remove borders from content part only */
    .content-area table {
        border: none !important;
    }

    .inner-block {
        /* padding: 20px 35px;  */
        box-sizing: border-box;
    }
    
    .block {
        margin-bottom: 25px;
    }

    .block-head {
        font-size: 13px;
        font-weight: bold;
        border-bottom: 2px solid #387478;
        color: #387478;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }

    .table_bg {
        background-color: #387478;
        color: #111;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
    }

    th, td {
        padding: 6px 10px;
        font-size: 10.5px;
        border: 1px solid #ccc;
        text-align: left;
        vertical-align: top;
    }

    th {
         white-space: normal !important;
    word-wrap: break-word;
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .section-gap {
        margin-top: 20px;
    }

    .no-border th, .no-border td {
        border: none !important;
    }

    /* .w-5 { width: 5%; } */
    .w-5 { width: 6%; }
    .w-6 { width: 7%; }
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-40 { width: 40%; }
    .w-50 { width: 50%; }
    .w-60 { width: 60%; }
    .w-70 { width: 70%; }
    .w-80 { width: 80%; }
    .w-100 { width: 100%; }
    .text-center { text-align: center; }
    .border-table {
        overflow-x: auto;
    }

    table th, table td {
        word-wrap: break-word;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                      Effectiveness Check Audit Trail Report
                    </div>
                </td>
                <td class="w-30">
                    <div class="logo" style="text-align: center;">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                        style="max-height: 55px; max-width: 40px;">
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

        <footer>
        <table>
            <tr>
                <td class="w-30"><strong>Printed On :</strong> {{ date('d-M-Y') }}</td>
                <td class="w-40"><strong>Printed By :</strong> {{ Auth::user()->name }}</td>
                <td class="w-30"><strong>Page No.</strong></td>
            </tr>
        </table>
    </footer>

    <div class="inner-block">
        <div class="second-table">
        <table class="allow-wb" >
                <thead>
                    <tr class="table_bg">
                        <th class="w-6">S.No</th>
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

</body>

</html>
