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

    .control-table {
        font-size: 0.8rem;
    }

    .control-table th {
        background: #0039bd57;
    }

    .control-table td {
        vertical-align: middle;
        word-break: keep-all;
    }
</style>

<body>

    <div class="control-table table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Reocrd No.</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Current Status</th>
                    <th>Originator</th>
                    <th>Date Opened</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody id="searchTable">
                <tr>
                    <td>01.</td>
                    <td>0001</td>
                    <td>EQMS_DCR</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                    <td>Under HOD Review</td>
                    <td>Shaleen Mishra</td>
                    <td>12-09-2023</td>
                    <td>12-10-2023</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
