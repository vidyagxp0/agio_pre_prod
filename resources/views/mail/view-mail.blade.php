<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        h2 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 30px 0;
        }

        /* Table Styles */

        .table-wrapper {
            box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
        }

        .fl-table {
            border-radius: 5px;
            font-size: 12px;
            font-weight: normal;
            border: none;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            background-color: white;
            table-layout: fixed;
            /* Added for fixed table layout */
        }

        .fl-table td,
        .fl-table th {
            text-align: center;
            padding: 8px;
            word-wrap: break-word;
            /* Allows text to break within the cell */
            white-space: normal;
            /* Allows text to wrap to a new line */
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 12px;
        }

        .fl-table thead th {
            color: #000000;
            background: #4254be9e;
        }

        .fl-table thead th:nth-child(odd) {
            color: #000000;
            background: #4254be9e;
        }

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }

        /* Responsive */

        @media (max-width: 767px) {
            .fl-table {
                display: block;
                width: 100%;
            }

            .table-wrapper:before {
                content: "Scroll horizontally >";
                display: block;
                font-size: 11px;
                color: white;
                padding: 0 0 10px;
            }

            .fl-table thead,
            .fl-table tbody,
            .fl-table thead th {
                display: block;
            }

            .fl-table thead th:last-child {
                border-bottom: none;
            }

            .fl-table thead {
                float: left;
            }

            .fl-table tbody {
                width: auto;
                position: relative;
                overflow-x: auto;
            }

            .fl-table td,
            .fl-table th {
                padding: 20px .625em .625em .625em;
                height: 60px;
                vertical-align: middle;
                box-sizing: border-box;
                overflow-x: hidden;
                overflow-y: auto;
                width: 120px;
                font-size: 13px;
                font-family: sans-serif;
                text-overflow: ellipsis;
            }

            .fl-table thead th {
                text-align: left;
                border-bottom: 1px solid #f7f7f9;
            }

            .fl-table tbody tr {
                display: table-cell;
            }

            .fl-table tbody tr:nth-child(odd) {
                background: none;
            }

            .fl-table tr:nth-child(even) {
                background: transparent;
            }

            .fl-table tr td:nth-child(odd) {
                background: #F8F8F8;
                border-right: 1px solid #E6E4E4;
            }

            .fl-table tr td:nth-child(even) {
                border-right: 1px solid #E6E4E4;
            }

            .fl-table tbody td {
                display: block;
                text-align: center;
            }
        }

        body,
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lora', serif;
        }

        #main-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: left;
        }

        #main-container .notification-container {
            max-width: 1250px;
            width: 100%;
            padding: 20px;
            backdrop-filter: blur(10px);
            background: #86bceb27;
            border-top: 10px solid #8e9adf9e;
        }

        #main-container .logo {
            width: 120px;
            aspect-ratio: 1/0.3;
            margin-bottom: 30px;
        }

        #main-container .logo img {
            width: 100%;
            height: 100%;
        }

        #main-container .mail-content {
            text-align: justify;
            margin-bottom: 20px;
        }

        #main-container .bar {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

  
    <div id="main-container">
        <div class="notification-container">
            <div class="inner-block">
                <div style="display: flex; justify-content: space-between;" class="logo-container">

                    <div style="width: 60%;">
                        <p>{{ $process }} No.:-
                            @if($process == 'Extension')
                                {{ Helpers::getDivisionName($data->site_location_code) }}/{{ $site }}/{{ date('Y') }}/{{ Helpers::record($data->record_number) }}
                            @elseif($process == 'Observation')
                                {{ Helpers::getDivisionName($data->division_code) }}/{{ $site }}/{{ date('Y') }}/{{ Helpers::record($data->record) }}
                            @else
                                {{ Helpers::getDivisionName($data->division_id) }}/{{ $site }}/{{ date('Y') }}/{{ Helpers::record($data->record) }}
                            @endif
                        </p>

                        <p>"{{ $history }}" activity was performed on the below listed {{ $process }}.</p>

                        <p>
                            Originator Name :-
                             <!-- {{ Helpers::getInitiatorName($data->initiator_id) }} -->
                            @if ($data->initiator_id)
                                {{ Helpers::getInitiatorName($data->initiator_id) }}
                            @else
                                {{ Helpers::getInitiatorName($data->initiator) }}
                            @endif
                        </p>

                        <p>Date Opened:- {{ $data->created_at->format('d-M-Y H:i:s') }}</p>

                        <p>Comment:- {{ $comment }}.</p>

                    </div>
                    <div style="margin-left: 250px" class="logo">
                        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="...">
                        <!-- <img src="https://www.agio-pharma.com/wp-content/uploads/2019/10/logo-agio.png" alt="..."> -->
                    </div>
                </div>
                <div class="mail-content" style="margin-top: 20px">
                    <div class="table-wrapper">
                        <table class="fl-table">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Record ID</th>
                                    <th style="width: 10%">Division</th>
                                    @if ($process == 'OOS/OOT')
                                    <th style="width: 20%">Form Type</th>
                                    @endif
                                    <th style="width: 50%">Short Description</th>
                                    <th style="width: 10%">Due Date</th>
                                    <th style="width: 20%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @if ($process == 'Extension')
                                            {{ Helpers::record($data->record_number) }}
                                        @else
                                            {{ Helpers::record($data->dashboard_unique_id) }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($process == 'Extension')
                                            {{ Helpers::getDivisionName($data->site_location_code) }}
                                        @elseif ($process == 'Observation')
                                            {{ Helpers::getDivisionName($data->division_code) }}
                                        @else
                                            {{ Helpers::getDivisionName($data->division_id) }}
                                        @endif
                                    </td>
                                    @if ($process == 'OOS/OOT')
                                    <td>
                                        {{ $data->Form_type }}
                                    </td>
                                    @endif
                                    
                                    <td>
                                    @if ($process == 'Lab Incident')
                                    {{ $data->short_desc }}
                                    @elseif($process == 'OOC')
                                    {{ $data->description_ooc }}
                                    @elseif($process == 'OOS/OOT')
                                    {{ $data->description_gi }}
                                    @else
                                    {{ $data->short_description }}
                                    @endif
                                    </td>

                                    <td>
                                        @if ($process == 'Extension')
                                        {{ Helpers::getDateFormat($data->due_date) }}    
                                        @elseif($process == 'OOS/OOT')
                                        {{ Helpers::getDateFormat($data->due_date) }}    
                                        @else
                                        {{ $data->due_date ?  Helpers::getDateFormat($data->due_date) : 'Not Applicable' }}                                        @endif
                                    </td>
                                    <td>{{ $data->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top: 20px">
                        The "{{ $history }}" activity was performed by {{ $user }}.
                    </div>

                    <div style="margin-top: 20px">
                        This notification has been automatically generated by the VidyaGxP System.
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
