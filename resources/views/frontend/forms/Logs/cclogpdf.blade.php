<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errata Log Report</title>
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
                <td style="text-align: left; font-size: 20px;">
                    <strong>Errata Log Report</strong>
                </td>
                <td style="text-align: right;">
                    <div class="logo">
                        <img src="https://www.agio-pharma.com/wp-content/uploads/2019/10/logo-agio.png" alt="Logo">
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
                @php
                    use Carbon\Carbon;
                @endphp
                @foreach ($filteredDataCC as $index => $doc)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Carbon::parse($doc->intiation_date)->format('d-M-Y') }}</td>
                    <td>{{ $doc->errata_no }}</td>
                    <td>{{ $doc->short_description ?? 'N/A' }}</td>
                    <td>{{ $doc->initiator ?? 'N/A' }}</td>
                    <td>{{ $doc->division->name ?? 'N/A' }}</td>
                    <td>{{ $doc->department->name ?? 'N/A' }}</td>
                    <td>{{ $doc->document_type ?? 'N/A' }}</td>
                    <td>{{ $doc->type_of_error ?? 'N/A' }}</td>
                    <td>{{ $doc->correction_date ?? 'N/A' }}</td>
                    <td>{{ $doc->due_date ?? 'N/A' }}</td>
                    <td>{{ $doc->closure_date ?? 'N/A' }}</td>
                    <td>{{ $doc->status ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <table style="width: 100%;">
            <tr>
                <td class="w-30">
                    <strong>Printed By:</strong> {{ auth()->user()->name }}
                </td>
                <td class="w-40">
                    <strong>Printed On:</strong> {{ \Carbon\Carbon::now()->format('d-M-Y H:i:s') }}
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
