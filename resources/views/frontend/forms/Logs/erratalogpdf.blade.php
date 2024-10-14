<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errata Log Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #000;
        }
        .header img {
            width: 120px; /* Adjust logo size here */
        }
        .header h2 {
            font-size: 24px;
            margin: 0;
        }
        .report-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            font-size: 14px;
        }
        .footer div {
            padding: 10px 0;
        }
        /* Landscape orientation */
        @page {
            size: A4 landscape;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header with Logo and Report Name -->
    <div class="header">
        <img src="https://www.agio-pharma.com/wp-content/uploads/2019/10/logo-agio.png" alt="Company Logo">
        <h2>Errata Log Report</h2>
    </div>

    <!-- Report Title -->
    <div class="report-title">
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">Sr.No.</th>
                <th>Date of Initiation</th>
                <th>Errata No.</th>
                <th>Short Description</th>
                <th>Initiator</th>
                <th>Division</th>
                <th>Department</th>
                <th>Document Type</th>
                <th>Type of Error</th>
                <th>Date of Correction</th>
                <th>Due Date</th>
                <th>Closure Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($FilterDDD as $errata)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $errata->intiation_date }}</td>
                <td>{{ $errata->errata_no }}</td>
                <td>{{ $errata->short_description }}</td>
                <td>{{ $errata->initiator_id ? $errata->name:'Not Applicable' }}</td>
                <td>{{ $errata->division->name ?? 'N/A' }}</td>
                <td>{{ $errata->department->name ?? 'N/A' }}</td>
                <td>{{ $errata->document_type }}</td>
                <td>{{ $errata->type_of_error }}</td>
                <td>{{ $errata->correction_date }}</td>
                <td>{{ $errata->due_date }}</td>
                <td>{{ $errata->closure_date }}</td>
                <td>{{ $errata->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer with Printed by and Printed on -->
    <div class="footer">

        <div>Printed by: {{ $errata->initiator ? $errata->initiator->name : 'Not Applicable' }}</div>
        <div>Printed on: {{ \Carbon\Carbon::now()->format('d-M-Y H:i:s') }}</div>
        
    </div>
</div>

</body>
</html>
