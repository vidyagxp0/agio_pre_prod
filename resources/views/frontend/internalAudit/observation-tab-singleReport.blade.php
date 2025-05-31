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
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .w-10 {
        width: 10%;
    }

    .w-20 {
        width: 20%;
    }

    .w-25 {
        width: 25%;
    }

    .w-30 {
        width: 30%;
    }

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    .w-60 {
        width: 60%;
    }

    .w-70 {
        width: 70%;
    }

    .w-80 {
        width: 80%;
    }

    .w-90 {
        width: 90%;
    }

    .w-100 {
        width: 100%;
    }

    .h-100 {
        height: 100%;
    }

    header table,
    header th,
    header td,
    footer table,
    footer th,
    footer td,
    .border-table table,
    .border-table th,
    .border-table td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    footer .head,
    header .head {
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    @page {
        size: A4;
        margin-top: 160px;
        margin-bottom: 60px;
    }

    header {
        position: fixed;
        top: -140px;
        left: 0;
        width: 100%;
        display: block;
    }

    footer {
        width: 100%;
        position: fixed;
        display: block;
        bottom: -40px;
        left: 0;
        font-size: 0.9rem;
    }

    footer td {
        text-align: center;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block tr {
        font-size: 0.8rem;
    }

    .inner-block .block {
        margin-bottom: 30px;
    }

    .inner-block .block-head {
        font-weight: bold;
        font-size: 1.1rem;
        padding-bottom: 5px;
        border-bottom: 2px solid #4274da;
        margin-bottom: 10px;
        color: #4274da;
    }

    .inner-block th,
    .inner-block td {
        vertical-align: baseline;
    }

    .table_bg {
        background: #4274da57;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                   Audit Observation Report
                </td>
                <td class="w-10">
                    <div class="logo">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrea9eMhBk2x4bUAwSzPRHm49lrqzVodbT6g&s" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Internal Audit No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/IA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    Audit Observation Report 
                </div>

                <div style="font-weight: 200">Internal Audit (Observations/Discrepancy)</div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 50px;">Sr. No</th>
                            <th class="w-20">Observations/Discrepancy</th>
                            <th class="w-20">Category</th>
                            <th class="w-20">Remarks</th>
                        </tr>
                        @if ($grid_Data3 && is_array($grid_Data3->data))
                        @foreach ($grid_Data3->data as $item)
                                <tr>
                                    <td class="w-20">{{ $loop->index + 1 }}</td>
                                    <td class="w-20">
                                        {{ isset($item['observation']) ? $item['observation'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($item['category']) ? $item['category'] : '' }}</td>
                                    <td class="w-20">
                                        {{ isset($item['remarks']) ? $item['remarks'] : '' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                {{-- <td>Not Applicable</td> --}}
                            </tr>
                        @endif
                    </table>
                </div>
                {{-- </div> --}}
            </div>

            </div>
        </div>
    </div>      


    {{-- <div style="font-weight: 200">Auditors Roles(Names)</div>
                {{-- </div> -
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 50px;">Sr. No</th>
                             <th class="w-20">Role</th>
                             <th class="w-20">Name</th>
                             <th class="w-20">Date</th>
                             <th class="w-20">Remarks</th>
                        </tr>                            
                        @if ($grid_Data4 && is_array($grid_Data4->data))
                        @foreach ($grid_Data4->data as $item)
                                <tr>
                                    <td class="w-20">
                                    {{ $loop->index + 1 }}
                                    </td>
                                    <td class="w-20">
                                    {{ $item['role'] ?? '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ $item['name'] ?? '' }}
                                    </td>
                                    <td class="w-20">
                                         {{ isset($item['internal_start_date']) ? \Carbon\Carbon::parse($item['internal_start_date'])->format('d-M-Y') : '' }} 
                                    </td>
                                    <td class="w-20">
                                        {{ $item['remarks'] ?? '' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>
                {{-- </div> --
            </div>

            </div>
        </div>
    </div>       --}}



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

</body>

</html>
