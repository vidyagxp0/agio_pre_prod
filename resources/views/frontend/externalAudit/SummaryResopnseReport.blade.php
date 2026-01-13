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


        .head-number {
            font-weight: bold;
            font-size: 13px;
            padding-left: 10px;
        }

        .div-data {
            font-size: 13px;
            padding-left: 10px;
            margin-bottom: 10px;
        }



                .why-why-chart-container {
                width: 100%;
                padding: 10px;
                background: #fff;
                border-radius: 5px;
            }

            .block-head {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th, .table td {
                padding: 10px;
                border: 1px solid #ddd;
            }

            .problem-statement th {
                background: #f4bb22;
                width: 150px;
            }

            .why-label {
                color: #393cd4;
                width: 150px;
            }

            .answer-label {
                color: #393cd4;
                width: 150px;
            }

            .root-cause th {
                background: #0080006b;
                width: 150px;
            }

            .text-muted {
                color: gray;
            }
    </style>

<body>

    {{-- <header>
        <table>
            <tr>
                <td class="w-70 head">
                   External Audit Response Summary Report
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
                    <strong>External Audit No.</strong>
                </td>
                
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/EA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header> --}}

    
    <header>

    <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    External Audit No.
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
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/EA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>

                <td class="w-30">
                    <strong>Page No.</strong>
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
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>


    <div class="inner-block">

<div class="content-table">

<div class="block">

<div class="border-table">
    <div class="block-head">
        Summary Response
    </div>

    @if (!empty($oocgrid->data) && count($oocgrid->data) > 0)
        <table>
            <tr class="table_bg">
                <th class="w-10">Sr.No.</th>
                <th class="w-20">Observation</th>
                <th class="w-20">Category</th>
                <th class="w-20">Response</th>
                <th class="w-20">CAPA / Child action Reference If Any</th>
                <th class="w-20">Status</th>
                <th class="w-20">Remarks</th>
            </tr>

            @php
                $serialNumber = 1;
            @endphp

            @foreach ($oocgrid->data as $oogrid)
                <tr>
                    <td>{{ $serialNumber++ }}</td>
                    <td>{{ $oogrid['observation'] ?? 'Not Applicable' }}</td>
                    <td>{{ $oogrid['category'] ?? 'Not Applicable' }}</td>
                    <td>{{ $oogrid['response'] ?? 'Not Applicable'}}</td>
                    <td>{{ $oogrid['reference_id']?? 'Not Applicable' }}</td>
                    <td>{{ $oogrid['status'] ?? 'Not Applicable' }}</td>
                    
                    <td>{{ $oogrid['remarks'] ?? 'Not Applicable' }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No summary responses available.</p>
    @endif
</div>


            <!-- 
                <div class="border-table">
                                <div class="block-head">
                                Summary Response
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">Obs.N.</th>
                                        <th class="w-60">Status</th>
                                        <th class="w-60">Remarks</th>




                                    </tr>
                                    @php
                $serialNumber = 1;
            @endphp
            @foreach ($oocgrid->data as $oogrid)
                <tr>
                    <td disabled>{{ $serialNumber++ }}</td>
                    <td>{{$oogrid['status']}}</td>
                    <td>{{$oogrid['remarks']}}</td>
                    
                </tr>
            @endforeach
                </table>
                </div> -->

    <div class="border-table">
                    <div class="block-head">
                    Summary And Response Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80">Attachment</th>
                        </tr>
                            @if($data->myfile)
                            @foreach(json_decode($data->myfile) as $key => $file)
                        <tr>
                            <td class="w-20">{{ $key + 1 }}</td>
                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                        </tr>
                            @endforeach
                            @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                        @endif

                    </table>
                </div>
</div>
</div>
</div>






</body>

</html>
