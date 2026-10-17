<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Notification</title>

    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lora', serif;
        }

        body {
            background: #f5f7fb;
            padding: 20px 10px;
            color: #333;
        }

        #main-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .notification-container {
            width: 100%;
            padding: 25px;
            background: #ffffff;
            border-top: 8px solid #8e9adf;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .header {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .header-left,
        .header-right {
            display: table-cell;
            vertical-align: top;
        }

        .header-left {
            width: 75%;
            padding-right: 15px;
        }

        .header-right {
            width: 25%;
            text-align: right;
        }

        .logo {
            max-width: 150px;
            max-height: 65px;
            object-fit: contain;
        }

        .process-number {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            overflow-wrap: anywhere;
        }

        .intro {
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
            font-size: 13px;
        }

        .details-table th {
            background: #4254be9e;
            color: #111;
            text-align: left;
            padding: 12px;
            border: 1px solid #d9deeb;
        }

        .details-table td {
            padding: 12px;
            border: 1px solid #d9deeb;
            vertical-align: top;
            overflow-wrap: anywhere;
            line-height: 1.6;
        }

        .details-table tr:nth-child(even) {
            background: #f5f7fb;
        }

        .label-column {
            width: 30%;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 5px 12px;
            background: #e8eefc;
            border: 1px solid #c7d4f5;
            border-radius: 4px;
            font-weight: bold;
        }

        .comment-box {
            margin-top: 20px;
            padding: 15px;
            background: #f5f7fb;
            border-left: 4px solid #8e9adf;
            font-size: 13px;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        .action {
            margin-top: 25px;
            text-align: center;
        }

        .action a {
            display: inline-block;
            padding: 11px 22px;
            background: #4254be;
            color: #fff !important;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
        }

        .footer {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #e2e5ed;
            font-size: 11px;
            line-height: 1.8;
            color: #666;
        }

        @media only screen and (max-width: 600px) {
            .notification-container {
                padding: 15px;
            }

            .header-left,
            .header-right {
                display: block;
                width: 100%;
            }

            .header-right {
                margin-top: 15px;
                text-align: left;
            }

            .details-table th,
            .details-table td {
                padding: 8px;
                font-size: 12px;
            }
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

        <div class="header">
            <div class="header-left">
                <p class="process-number">
                    Document No.: {{ $documentNumber }}
                </p>

                <p class="intro">
                    The "{{ $activity }}" activity was performed on the
                    following document.
                </p>

                <p class="intro">
                    <strong>Author:</strong>
                    {{ $originator->name ?? 'N/A' }}
                </p>

                <p class="intro">
                    <strong>Date Created:</strong>
                    {{ $document->created_at
                        ? \Carbon\Carbon::parse($document->created_at)->format('d-M-Y H:i:s')
                        : 'N/A' }}
                </p>
            </div>

            <div class="header-right">
                <img
                    src="{{ asset('user/images/logo.png') }}"
                    alt="Company Logo"
                    class="logo"
                >
            </div>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th colspan="2">Document Details</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="label-column">Document Name</td>
                    <td>{{ $document->document_name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <td class="label-column">Document Number</td>
                    <td>{{ $documentNumber }}</td>
                </tr>

                <tr>
                    <td class="label-column">Division</td>
                    <td>{{ $division->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <td class="label-column">Document Type</td>
                    <td>{{ $doctype->name ?? $doctype->typecode ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <td class="label-column">Author</td>
                    <td>{{ $originator->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <td class="label-column">Current Status</td>
                    <td>
                        <span class="status">{{ $currentStatus }}</span>
                    </td>
                </tr>

                <tr>
                    <td class="label-column">Activity</td>
                    <td>{{ $activity }}</td>
                </tr>

                <tr>
                    <td class="label-column">Activity Performed By</td>
                    <td>{{ $performedBy }}</td>
                </tr>
            </tbody>
        </table>

        <div class="comment-box">
            <strong>Comment:</strong><br>
            {{ $activityComment }}
        </div>

        <div class="action">
            <a href="{{ url('rev-details', $document->id) }}">
                View Document Status
            </a>
        </div>

        <div class="footer">
            <p>You can see your tasks and document updates on your DMS Dashboard.</p>
            <p>
                This notification has been automatically generated by the
                VidyaGxP Document Management System.
            </p>
        </div>

    </div>
</div>

</body>
</html>
