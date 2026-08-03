<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>{{ $title }}</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 8mm;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;

            background: #ffffff;
            color: #000000;

            font-family: Arial, sans-serif;
            font-size: 9px;
        }

        .print-wrapper {
            width: 100%;
        }

        .report-header {
            width: 100%;
            margin-bottom: 10px;
            text-align: center;
        }

        .report-header h2 {
            margin: 0 0 5px 0;

            font-size: 18px;
            line-height: 1.3;
            font-weight: bold;
        }

        .report-header p {
            margin: 0;
            font-size: 9px;
        }

        .filter-table {
            width: 100%;
            margin-bottom: 8px;

            border-collapse: collapse;
            table-layout: fixed;
        }

        .filter-table td {
            padding: 4px 6px;

            border: 1px solid #777;

            font-size: 8px;
            line-height: 1.3;

            vertical-align: top;

            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .report-table {
            width: 100%;
            max-width: 100%;

            border-collapse: collapse;
            border-spacing: 0;

            table-layout: fixed;
        }

        .report-table thead {
            display: table-header-group;
        }

        .report-table tbody {
            display: table-row-group;
        }

        .report-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .report-table th,
        .report-table td {
            padding: 4px;

            border: 1px solid #000000;

            font-size: 7px;
            line-height: 1.25;

            text-align: left;
            vertical-align: top;

            white-space: normal;

            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .report-table th {
            background-color: #dce9f7;

            font-weight: bold;
            text-align: center;
        }

        .report-table td:first-child,
        .report-table th:first-child {
            width: 4%;
            text-align: center;
        }

        .no-record {
            padding: 15px !important;

            text-align: center !important;
            font-size: 10px !important;
        }

        .print-actions {
            margin-bottom: 10px;
            text-align: right;
        }

        .print-button {
            padding: 7px 18px;

            border: 1px solid #5c98e7;
            border-radius: 4px;

            background: #5c98e7;
            color: #ffffff;

            cursor: pointer;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="print-wrapper">

        <div class="print-actions no-print">
            <button
                type="button"
                class="print-button"
                onclick="window.print()"
            >
                Print
            </button>
        </div>

        <div class="report-header">
            <h2>{{ $title }}</h2>

            <p>
                Printed On: {{ $printedOn }}
                |
                Total Records: {{ count($rows) }}
            </p>
        </div>

        @if (!empty($filters))

            <table class="filter-table">
                <tr>
                    @foreach ($filters as $filterName => $filterValue)
                        <td>
                            <strong>
                                {{ $filterName }}:
                            </strong>

                            {{ $filterValue }}
                        </td>
                    @endforeach
                </tr>
            </table>

        @endif

        <table class="report-table">

            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th>
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>

                @forelse ($rows as $row)

                    <tr>
                        @foreach ($headers as $key => $header)
                            <td>
                                {{ $row[$key] ?? 'Not Applicable' }}
                            </td>
                        @endforeach
                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="{{ count($headers) }}"
                            class="no-record"
                        >
                            No records found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <script>
        window.addEventListener('load', function () {
            /*
             * Print page open hote hi preview automatically open.
             */
            window.setTimeout(function () {
                window.print();
            }, 400);
        });
    </script>

</body>

</html>