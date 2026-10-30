<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Review Notification</title>
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
        $division = DB::table('divisions')->find($document->division_id);
        $doctype = DB::table('document_types')->find($document->document_type_id);
        $originator = DB::table('users')->find($document->originator_id);

        $year = $document->created_at
            ? \Carbon\Carbon::parse($document->created_at)->format('Y')
            : date('Y');

        $num = str_pad($document->id, 5, '0', STR_PAD_LEFT);

        $documentNumber = $document->document_number ?? 'N/A';

        $currentStatus = $document->status ?? 'N/A';
        $activity = $history ?? 'Document Notification';
        $activityComment = $comment ?? 'N/A';
        $performedBy = $user ?? 'System';
        
    @endphp



    <div id="main-container">
        <div class="notification-container">
            <div class="inner-block">

                

                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td style="width:70%; vertical-align:top; padding:0;">

                            <p style="margin-bottom:12px;">Document No.: {{ $documentNumber }}</p>

                            <p style="margin-bottom:12px;">The "{{ $activity }}" activity was performed on the
                                following document.</p>

                            <p style="margin-bottom:12px;">Author: {{ $originator->name ?? 'N/A' }}</p>

                            <p style="margin-bottom:12px;">Date Created:
                                {{ $document->created_at
                                    ? \Carbon\Carbon::parse($document->created_at)->format('d-M-Y H:i:s')
                                    : 'N/A' }}
                            </p>

                            <p style="margin-bottom:12px;">Comment: {{ $activityComment }}</p>

                        </td>
                      
                        <td style="width:30%; vertical-align:top; text-align:right; padding:0;">
                            <div class="logo" style="display:inline-block;">
                                <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="Logo">
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="mail-content" style="margin-top: 20px">

                    <p style="margin-bottom:12px;">Document Details</p>

                    <div class="table-wrapper">
                        


                         <table class="fl-table">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Document Name</th>
                                    <th style="width: 12%">Document Number</th>
                                    <th style="width: 10%">Division</th>
                                    <th style="width: 10%">Document Type</th>
                                    <th style="width: 10%">Author</th>
                                    <th style="width: 10%">Current Status</th>
                                    <th style="width: 14%">Activity</th>
                                    <th style="width: 14%">Activity Performed By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $document->document_name ?? 'N/A' }}</td>
                                    <td>{{ $documentNumber }}</td>
                                    <td>{{ $division->name ?? 'N/A' }}</td>
                                    <td>{{ $doctype->name ?? $doctype->typecode ?? 'N/A' }}</td>
                                    <td>{{ $originator->name ?? 'N/A' }}</td>
                                    <td>{{ $currentStatus }}</td>
                                    <td>{{ $activity }}</td>
                                    <td>{{ $performedBy }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top: 20px">
                        Please log in to the Document Management System to review the document.
                    </div>

                    <!-- <div style="margin-top: 20px">
                        <a href="{{ url('rev-details', $document->id) }}"
                           style="display:inline-block; padding:10px 22px; background-color:#4254be; color:#ffffff; text-decoration:none; font-size:13px; border-radius:4px;">
                            View Document
                        </a>
                    </div> -->

                    <div style="margin-top: 20px">
                        You can see all your assigned tasks on your DMS Dashboard.
                    </div>

                    <div style="margin-top: 20px">
                        This is an automated notification from the Document Management System.
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>