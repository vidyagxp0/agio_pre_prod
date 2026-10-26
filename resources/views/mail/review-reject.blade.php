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

        body,
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lora', serif;
        }

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
            background-color: white;
            table-layout: fixed;
        }

        .fl-table td,
        .fl-table th {
            text-align: center;
            padding: 8px;
            word-wrap: break-word;
            white-space: normal;
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 12px;
        }

        .fl-table thead th {
            color: #000000;
            background: #4254be9e;
        }

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }

        @media (max-width: 767px) {
            .fl-table {
                display: block;
                width: 100%;
            }

            .fl-table thead,
            .fl-table tbody,
            .fl-table thead th {
                display: block;
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
                overflow-x: hidden;
                overflow-y: auto;
                width: 120px;
                font-size: 13px;
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

        #main-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        #main-container .notification-container {
            max-width: 1250px;
            width: 100%;
            padding: 20px;
            background: #86bceb27;
            border-top: 10px solid #8e9adf9e;
        }

        #main-container .logo {
            width: 120px;
        }

        #main-container .logo img {
            width: 100%;
            height: auto;
        }

        #main-container .mail-content {
            text-align: justify;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    @php
        $division   = Helpers::getDivisionName($document->division_id);
        $originator = Helpers::getInitiatorName($document->originator_id);
        $docNumber  = $document->document_number ?? 'N/A';
        $openedOn   = $document->created_at
                        ? \Carbon\Carbon::parse($document->created_at)->format('d-M-Y H:i:s')
                        : 'N/A';
        $dueDate    = !empty($document->due_date)
                        ? \Carbon\Carbon::parse($document->due_date)->format('d-M-Y')
                        : 'Not Applicable';
        $activity   = 'More Info Required';
        $actionBy   = $user ?? 'Reviewer';
        $remark     = $comment ?? 'N/A';
    @endphp

    <div id="main-container">
        <div class="notification-container">
            <div class="inner-block">

                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td style="width:70%; vertical-align:top; padding:0;">

                            <p style="margin-bottom:12px;">Document No.:- {{ $docNumber }}</p>

                            <p style="margin-bottom:12px;">"{{ $activity }}" activity was performed on the below listed Document.</p>

                            <p style="margin-bottom:12px;">Originator Name :- {{ $originator }}</p>

                            <p style="margin-bottom:12px;">Date Opened:- {{ $openedOn }}</p>

                            <p style="margin-bottom:12px;">Comment:- {{ $remark }}.</p>

                        </td>
                        <td style="width:30%; vertical-align:top; text-align:right; padding:0;">
                            <div class="logo" style="display:inline-block;">
                                <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="Logo">
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="mail-content" style="margin-top: 20px">
                    <div class="table-wrapper">
                        <table class="fl-table">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Document No.</th>
                                    <th style="width: 12%">Division</th>
                                    <th style="width: 38%">Document Name</th>
                                    <th style="width: 15%">Due Date</th>
                                    <th style="width: 20%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $docNumber }}</td>
                                    <td>{{ $division }}</td>
                                    <td>{{ $document->document_name ?? 'N/A' }}</td>
                                    <td>{{ $dueDate }}</td>
                                    <td>{{ $document->status ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top: 20px">
                        The "{{ $activity }}" activity was performed by {{ $actionBy }}.
                    </div>

                    <div style="margin-top: 20px">
                        Please log in to the Document Management System to view the document details and take the necessary action.
                    </div>

                    <div style="margin-top: 20px">
                        <a href="{{ url('doc-details', $document->id) }}"
                           style="display:inline-block; padding:10px 22px; background-color:#4254be; color:#ffffff; text-decoration:none; font-size:13px; border-radius:4px;">
                            View Document
                        </a>
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