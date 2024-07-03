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

.imageContainer {
    /* max-height: 700px;
    page-break-inside: auto;
    overflow: visible;
    max-height: 100%;
    white-space: wrap;
  overflow: hidden;
  text-overflow: ellipsis; */
}

.imageContainer p,span {
    /* margin: 0;
    padding: 0;
    page-break-inside: auto;  */
}
.imageContainer p span{
    /* margin: 0;
    padding: 0;
    page-break-inside: auto;
    page-break-after: always; */

}
.imageContainer p img {
    width: 350px !important;
    height: 200px;
}

@media print {
    .imageContainer {
        page-break-inside: auto; /* Allow page breaks inside container for printing */
        /* page-break-after: always; */
    }
}
body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        min-width: 100vw;
        min-height: 100vh;
    }


    .w-10 {
        width: 10%;
    }

    .w-20 {
        width: 20%;
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

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;

    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    header .head {
        font-weight: bold;
        text-align: center;
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
        position: fixed;
        bottom: -40px;
        left: 0;
        width: 100%;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block .head {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .inner-block .division {
        margin-bottom: 10px;
    }

    .first-table {
        border-top: 1px solid black;
        margin-bottom: 20px;
    }

    .first-table table td,
    .first-table table th,
    .first-table table {
        border: 0;
    }

    .second-table td:nth-child(1)>div {
        margin-bottom: 10px;
    }

    .second-table td:nth-child(1)>div:nth-last-child(1) {
        margin-bottom: 0px;
    }

    .table_bg {
        background: #4274da57;
    }
</style>
{{-- <style>


    table {
        width: 100%;
        table-layout: fixed; /* Ensures table respects defined column widths */
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        font-size: 0.9rem;
        padding: 10px;
        text-align: left;
        word-wrap: break-word; /* Ensures text wraps within cell */
    }

    header .head {
        font-weight: bold;
        text-align: center;
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
        position: fixed;
        bottom: -40px;
        left: 0;
        width: 100%;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block .head {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .inner-block .division {
        margin-bottom: 10px;
    }

    .first-table {
        border-top: 1px solid black;
        margin-bottom: 20px;
    }

    .first-table table td,
    .first-table table th,
    .first-table table {
        border: 0;
    }

    .second-table td:nth-child(1)>div {
        margin-bottom: 10px;
    }

    .second-table td:nth-child(1)>div:nth-last-child(1) {
        margin-bottom: 0px;
    }

    .table_bg {
        background: #4274da57;
    }

    /* Define fixed widths for each column */
    .table-field-history th:nth-child(1),
    .table-field-history td:nth-child(1) {
        width: 70%; /* Adjust as necessary */
    }

    .table-field-history th:nth-child(2),
    .table-field-history td:nth-child(2) {
        width: 10%; /* Adjust as necessary */
    }

    .table-field-history th:nth-child(3),
    .table-field-history td:nth-child(3) {
        width: 10%; /* Adjust as necessary */
    }

    .table-field-history th:nth-child(4),
    .table-field-history td:nth-child(4) {
        width: 10%; /* Adjust as necessary */
    }

</style> --}}

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                     Audit Trial Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>ERRATA No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::getDivisionName($doc->division_id) }}/ERRATA/{{ Helpers::year($doc->created_at)}}/ {{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">

        <div class="head">Audit Trial Histroy Configuration Report</div>



        <div class="first-table">
            <table>
                <tr>
                    <td class="w-50">
                        <strong>Config Area :</strong> All - No Filter
                    </td>
                    <td class="w-50">
                        <strong>Start Date (GMT) :</strong> {{ Helpers::getDateFormat($doc->created_at) }}
                    </td>
                </tr>
                <tr>
                    <td class="w-50">
                        <strong>Config Sub Area :</strong> All - No Filter
                    </td>
                    <td class="w-50">
                        <strong>End Date (GMT) :</strong>
                        @if ($doc->stage >= 9)
                            {{ Helpers::getDateFormat($doc->updated_at) }}
                        @endif
                    </td>
                </tr>

            </table>
        </div>

        <div class="second-table">
            <table>
                <tr class="table_bg">
                    <th>Field History</th>
                    <th>Date Performed</th>
                    <th>Person Responsible</th>
                    <th>Change Type</th>
                </tr>
                @foreach ($data as $datas)
                    <tr>
                        <td>
                            <div>{{ $datas->activity_type }}</div>
                            <div>
                                @if($datas->activity_type == "Activity Log")
                                    <div><strong>Changed From :</strong></div>
                                    @if(!empty($datas->change_from))
                                        <div class="imageContainer">{!! str_replace(',', ', ', $datas->change_from) !!}</div>
                                    @else
                                        <div>Not Applicable</div>
                                    @endif
                                @else
                                    <div><strong>Changed From :</strong></div>
                                    @if(!empty($datas->previous))
                                        <div class="imageContainer">{!!str_replace(',', ', ', $datas->previous) !!}</div>
                                    @else
                                        <div>Null</div>
                                    @endif
                                @endif

                                <!-- <div><strong>Changed From :</strong></div>
                                @if(!empty($datas->previous))
                                    <div>{{ $datas->previous }}</div>
                                @else
                                    <div>Null</div>
                                @endif -->
                            </div>
                            <div>
                                @if($datas->activity_type == "Activity Log")
                                    <div><strong>Changed To :</strong></div>
                                    @if(!empty($datas->change_to))
                                        <div class="imageContainer">{!!str_replace(',', ', ', $datas->change_to) !!}</div>
                                    @else
                                        <div>Not Applicable</div>
                                    @endif
                                @else
                                    <div><strong>Changed To :</strong></div>
                                    @if(!empty($datas->current))
                                        <div class="imageContainer">{!! str_replace(',', ', ',$datas->current) !!}</div>
                                    @else
                                        <div>Null</div>
                                    @endif
                                @endif
                                <!-- <div><strong>Changed To :</strong></div>
                                <div>{{ $datas->current }}</div> -->
                            </div>
                        </td>
                        <td>{{ Helpers::getDateFormat($datas->created_at) }}</td>
                        <td>{{ $datas->user_name }}</td>
                        <td>
                            @if ($datas->previous != "NULL")
                                Modify
                            @else
                                New
                            @endif
                        </td>
                    </tr>
                @endforeach
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

            </tr>
        </table>
    </footer>
</body>
</html>

