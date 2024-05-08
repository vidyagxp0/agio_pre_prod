<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <style>
        *{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}

h2{
    text-align: center;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;

    padding: 30px 0;
}

/* Table Styles */

.table-wrapper{
    /* margin: 10px 70px 70px; */
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: #000000;
    background: #4254be9e;
}


.fl-table thead th:nth-child(odd) {
    color: #000000;
    background: #4254be9e;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        font-family: sans-serif;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}
        body,
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lora', serif;
        }

        #main-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: left;
        }

        #main-container .notification-container {
            max-width: 650px;
            width: 100%;
            padding: 20px;
            backdrop-filter: blur(10px);
            background: #86bceb27;
            border-top: 10px solid #8e9adf9e;
        }

        #main-container .logo {
            width: 120px;
            aspect-ratio: 1/0.3;
            margin-bottom: 30px;
        }

        #main-container .logo img {
            width: 100%;
            height: 100%;
        }

        #main-container .mail-content {
            text-align: justify;
            margin-bottom: 20px;
        }

        #main-container .bar {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div id="main-container">
        <div class="notification-container">
            <div class="inner-block">
                <div class="logo">
                    <img src="https://dms.mydemosoftware.com/user/images/logo.png" alt="...">
                </div>
                <div class="mail-content">


                    <h4>Hey !</h4>
                    <br>
                    <p style="font-size: 15px;">Change Control Records is Assigned to You.</p>
                    <br>
                    <h3>Record Information:</h3>
                    <br>

                    <div class="table-wrapper">


                        <table class="fl-table">
                            <thead>
                            <tr>
                                <th>Record ID</th>
                                <th>Division</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                        <tr>
                            <td>{{ Helpers::record($data->record)}}</td>
                            <td>{{ Helpers::getDivisionName($data->division_id)}}</td>
                            <td>{{ $data->short_description}}</td>
                            <td>{{ Helpers::getDateFormat($data->created_at)}}</td>
                            <td>{{ Helpers::getDateFormat($data->due_date)}}</td>
                            <td>{{ $data->status }}</td>
                        </tr>
                        <tbody>
                        </table>
                    </div>






                </div>


                <h4>Connexo eQMS</h4>
            </div>
        </div>
    </div>

</body>

</html>



