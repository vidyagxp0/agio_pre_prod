<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexo - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<style>
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

    header table,
    header th,
    header td,
    footer table,
    footer th,
    footer td {
        border: 1px solid black;
        border-collapse: collapse;
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

    footer {
        position: fixed;
        display: block;
        bottom: 0;
        left: 0;
        width: 100%;
        font-size: 0.9rem;
    }

    footer td {
        text-align: center;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Change Control Summary
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://dms.mydemosoftware.com/user/images/logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Change Control No.</strong>
                </td>
                <td class="w-40">
                    CC/P1/QC01/2023/{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
            <table>
                <tr>
                    <th class="w-30">Initiator</th>
                    <td class="w-70">{{ $data->originator }}</td>
                </tr>
                <tr>
                    <th class="w-30">Date Initiation</th>
                    <td class="w-70">{{$data->created_at}}</td>
                </tr>
                <tr>
                    <th class="w-30">Short Description</th>
                    <td class="w-70">
                        {{ $data->short_description }}
                    </td>
                </tr>
                <tr>
                    <th class="w-30">Due Date</th>
                    <td class="w-70">{{ $data->due_date }}</td>
                </tr>
                <tr>
                    <th class="w-30">Division Code</th>
                    <td class="w-70">{{ $data->Division_Code }}</td>
                </tr>
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
                <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
