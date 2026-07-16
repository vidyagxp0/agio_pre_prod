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
<style>
    .change-grid {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .change-grid th,
    .change-grid td {
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 11px;
        vertical-align: top;
        text-align: left;
        word-break: break-word;
        overflow-wrap: break-word;
        line-height: 0.8;
    }

    .change-grid th {
        background: #f2f2f2;
        font-weight: bold;
    }

    .change-grid .sr-no {
        width: 8%;
    }

    .change-grid .text-col {
        width: 30.66%;
    }

    .pdf-text {
        white-space: pre-line;
    }
     .report-title {
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #000;
            text-align: center;
            font-size: 15px;
            font-weight: bold;
        }

        .record-table,
        .action-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .record-table {
            margin-bottom: 15px;
        }

        .record-table th,
        .record-table td {
            padding: 6px;
            border: 1px solid #000;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .record-table th {
            width: 22%;
            background: #f2f2f2;
            text-align: left;
        }

        .section-heading {
            padding: 7px 10px;
            border: 1px solid #000;
            border-bottom: none;
            background: #eeeeee;
            font-size: 13px;
            font-weight: bold;
        }

        .action-table th,
        .action-table td {
            border: 1px solid #000;
            padding: 7px 6px;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .action-table thead {
            display: table-header-group;
        }

        .action-table tr {
            page-break-inside: avoid;
        }

        .action-table th {
            height: 42px;
            text-align: center;
            vertical-align: middle;
            background: #f7f7f7;
            font-weight: bold;
        }

        .action-table td {
            min-height: 55px;
        }

        .sr-column {
            width: 8%;
            text-align: center;
        }

        .task-column {
            width: 43%;
        }

        .assigned-column {
            width: 20%;
            text-align: center;
        }

        .due-date-column {
            width: 14%;
            text-align: center;
        }

        .acknowledge-column {
            width: 15%;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .no-record {
            height: 70px;
            text-align: center;
            vertical-align: middle !important;
            font-weight: bold;
        }

        .generated-date {
            margin-top: 10px;
            text-align: right;
            font-size: 9px;
        }
</style>
<body>

    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    Risk-Assesment Summary Report
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
                    {{ Helpers::getDivisionName($data->division_id) }}/RA/{{ date('Y') }}/{{ $data->record ? str_pad($data->record, 4, '0', STR_PAD_LEFT) : '' }}
                   </td>
                <td class="w-30">
                    <strong>Page No.</strong>
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
        {{-- <table class="record-table">
            <tr>
                <th>Change Control No.</th>
                <td>
                    {{ $data->record_number
                        ?? $data->record
                        ?? $data->id }}
                </td>

                <th>Originator</th>
                <td>
                    {{ $data->originator ?? 'N/A' }}
                </td>
            </tr>

            <tr>
                <th>Short Description</th>
                <td colspan="3">
                    {!! $data->short_description
                        ?? $data->description
                        ?? 'N/A' !!}
                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    {{ $data->status ?? 'N/A' }}
                </td>

                <th>Created Date</th>
                <td>
                    {{ !empty($data->created_at)
                        ? \Carbon\Carbon::parse($data->created_at)->format('d-M-Y')
                        : 'N/A' }}
                </td>
            </tr>
        </table> --}}

        <div class="section-heading">
            Proposed Action Item
        </div>

        <table class="action-table">
            <thead>
                <tr>
                    <th class="sr-column">
                        Sr.<br>No.
                    </th>

                    <th class="task-column">
                        Proposed Action / Task
                    </th>

                    <th class="assigned-column">
                        Assigned To
                    </th>

                    <th class="due-date-column">
                        Due Date
                    </th>

                    <th class="acknowledge-column">
                        Acknowledge By
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($actionItems as $key => $actionItem)
                    <tr>
                        <td class="sr-column center">
                            {{ $key + 1 }}
                        </td>

                        <td class="task-column">
                            {!! $actionItem->description ?? 'N/A' !!}
                        </td>

                        <td class="assigned-column">
                            {{ $actionItem->assigned_to_name ?? 'N/A' }}
                        </td>

                        <td class="due-date-column center">
                            {{ $actionItem->formatted_due_date ?? 'N/A' }}
                        </td>

                        <td class="acknowledge-column">
                            {{ $actionItem->acknowledgement_by ?? 'N/A' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="no-record">
                            No Action Item has been created from this  Risk-Assesment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
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
                <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
