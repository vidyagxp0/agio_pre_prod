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
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-50 { width: 50%; }
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
                    Action Item Audit Trial Report
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
                <td class="w-30">
                    <strong>ActionItem Audit No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($doc->division_id) }}/{{ Helpers::year($doc->created_at) }}/{{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">

        <div class="head">Action Item Audit Trial Report</div>

            <div class="division">
                {{ Helpers::divisionNameForQMS($doc->division_id) }}/{{ Helpers::year($doc->created_at) }}/{{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
            </div>
        
        <div class="second-table">
            <table>
                <tr class="table_bg">
                    <th>Field History</th>
                    <th>Date Performed</th>
                    <th>Person Responsible</th>
                    <th>Change Type</th>
                </tr>
                @foreach ($data as $datas)
                    <tr>
                        <td>
                            <div>{{ $datas->activity_type }}</div>
                            <div>
                                <div><strong>Changed From :</strong></div>
                                @if(!empty($datas->previous))
                                @if($datas->activity_type == "Assigned To" || $datas->activity_type == "HOD Persons" )
                                @foreach(explode(',',$datas->previous) as $prev)
                                <div>{{ $prev != 'Null' ?  Helpers::getInitiatorName($prev ) : $prev  }}</div>
                                @endforeach
                                @else
                                <div>{{ $datas->previous }}</div>
                                @endif
                                @elseif($datas->activity_type == "Action Item Related Records")
                                
                                <div>{{ Helpers::getDivisionName($doc->division_id) }}/AI/{{ date('Y') }}/{{ Helpers::recordFormat($doc->record) }}</div>
                                @else
                                <div>Null</div>
                                @endif
                            </div>
                            <div>
                                <div><strong>Changed To :</strong></div>
                                @if($datas->activity_type == "Assigned To" || $datas->activity_type == "HOD Persons" )
                                @foreach(explode(',',$datas->current) as $curr)
                                <div>{{ Helpers::getInitiatorName($curr) }}</div>
                                @endforeach
                                @elseif($datas->activity_type == "Action Item Related Records")
                                <div>{{ Helpers::getDivisionName($doc->division_id) }}/AI/{{ date('Y') }}/{{ Helpers::recordFormat($doc->record) }}</div>
                                @else
                                <div>{{ $datas->current }}</div>
                                @endif
                            </div>
                        </td>
                        <td>{{ Helpers::getdateFormat($datas->created_at) }}</td>
                        <td>{{ $datas->user_name }}</td>
                        <td>
                            @if(($datas->previous == 'Null') && ($datas->current !='Null'))
                                New
                            @elseif(($datas->previous != $datas->current))
                                Modify
                            @else 
                               New
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

</body>

</html>
