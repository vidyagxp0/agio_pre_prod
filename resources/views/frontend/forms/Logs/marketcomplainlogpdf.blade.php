<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Complaint Log Report</title>
    <style>
        @page {
            margin: 20px;
            size: A4 landscape;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .table-container {
            position: relative;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .header-table td {
            padding: 10px;
        }

        .logo img {
            height: 100px;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            font-size: 12px;
            text-align: left;
        }

        .footer td {
            padding: 5px;
            border: 1px solid black;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <!-- Header Section with Logo and Title -->
    <header>
        <table class="header-table" style="width: 100%;">
            <tr>
                 <td>
                <strong>Market Complaint Log</strong>
            </td>
            <td class="w-50">
                <div class="logo">
                <img src="https://www.agio-pharma.com/wp-content/uploads/2019/10/logo-agio.png" alt="" class="w-50 h-50" style="height: 100px; scale: 1;" >

                </div>
            </td>
            </tr>
        </table>
    </header>

    <!-- Main Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Date of Initiation</th>
                    <th>Complaint No.</th>
                    <th>Description of Complaint</th>
                    <th>Originator</th>
                    <th>Department</th>
                    <th>Division</th>
                    <th>Product Name & Strength</th>
                    <th>Batch No.</th>
                    <th>Mfg. Date</th>
                    <th>Exp. Date</th>
                    <th>Nature of complaint</th>
                    <th>Category of complaint</th>
                    <th>Response / Report ( Date)</th>
                    <th>Due Date</th>
                    <th>Closure Date </th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    use Carbon\Carbon;
                @endphp
                @foreach ($filteredDataLI as $index => $doc)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Carbon::parse($doc->intiation_date)->format('d-M-Y') }}</td>
                    <td>{{ $doc->failureinvestigationrecordno }}</td>
                    <td>{{ $doc->initiator ? $doc->initiator->name :  'N/A' }}</td>
                    <td>{{ $doc->department ?? 'N/A' }}
                    <td>{{ $doc->division->name ?? 'N/A' }}</td>
                    <td>{{ $doc->short_description ?? 'N/A' }}</td>
                    <td>{{ $doc->status ?? 'N/A' }}</td>
                    <td>{{ $doc->status ?? 'N/A' }}</td>
                    <td>{{ $doc->status ?? 'N/A' }}</td>
                    <td>{{ $doc->due_date ?? 'N/A' }}</td>
                    <td>{{ $doc->closure_date ?? 'N/A' }}</td>
                    <td>{{ $doc->status ?? 'N/A' }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Footer Section -->
    <footer class="footer">
        <table style="width: 100%;">
            <tr>
                <td class="w-30">
                    <strong>Printed By:</strong>
                </td>
                <td class="w-40">
                    <strong>Printed On:</strong> {{ \Carbon\Carbon::now()->format('d-M-Y H:i:s') }}
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
