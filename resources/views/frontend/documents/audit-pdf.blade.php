<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    body {
        font-family: "Roboto", sans-serif;
    }

    .doc-details .doc-num {
        font-weight: bold;
        margin-bottom: 10px
    }

    .doc-details .detail-bar {
        margin-bottom: 10px;
    }

    .doc-details .detail-bar td {
        min-width: 50px;
    }

    .control-table .action-btns {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .control-table .action-btns button,
    .control-table .action-btns a {
        border: 1px solid #a3a0a0a6;
        color: #355cab;
        display: grid;
        width: 30px;
        height: 30px;
        place-items: center;
    }

    .control-table th {
        background: #0039bd57;
        font-size: 0.8rem;
    }

    .control-table td {
        vertical-align: middle;
        word-break: keep-all;
        font-size: 0.8rem;
    }
</style>

<body>

    <div class="doc-details">
        <div class="doc-num">
            DMS-EMEA/WI/2023/SOP-00001
        </div>
        <div class="detail-bar">
            <table>
                <tbody>
                    <tr>
                        <td>Site/Division/Process</td>
                        <td class="text-center">:</td>
                        <td>DMS-EMEA/New Document</td>
                    </tr>
                    <tr>
                        <td>Document Stage</td>
                        <td class="text-center">:</td>
                        <td>Draft</td>
                    </tr>
                    <tr>
                        <td>Originator</td>
                        <td class="text-center">:</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="control-table table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Person</th>
                    <th>Role</th>
                    <th>Today Print Count</th>
                    <th>Total Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Shaleen Mishra</td>
                    <td>HOD</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="control-table table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Person</th>
                    <th>Role</th>
                    <th>Today Download Count</th>
                    <th>Total Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Shaleen Mishra</td>
                    <td>HOD</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="control-table table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Activity Type</th>
                    <th>Performed On</th>
                    <th>Performed By</th>
                    {{-- <th>Performer Role</th> --}}
                    <th>Origin State</th>
                    <th>Resulting State</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Document Type</td>
                    <td>12-12-2023 11:00 PM</td>
                    <td>Shaleen Mishra</td>
                    {{-- <td>HOD</td> --}}
                    <td>Under Review</td>
                    <td>Reviewed</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
