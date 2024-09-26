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
<header>
        <table>
            <tr>
                <td class="w-70 head">
                TrainerQualification Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://navin.mydemosoftware.com/public/user/images/logo.png" alt=""
                            class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                Trainer Information
                </div>
                  <table>
                    <tr>
                        <th class="w-20">Trainer Name</th>
                        <td class="w-30">@if($data->trainer_name){{ $data->trainer_name }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Name of Employee</th>
                        <td class="w-30">@if($data->employee_name){{ $data->employee_name }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Employee ID</th>
                        <td class="w-30">@if($data->employee_id){{ $data->employee_id }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Department</th>
                        <td class="w-30">@if($data->department){{ $data->department }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Designation</th>
                        <td class="w-30">@if($data->designation){{ $data->designation }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Experience (if any)</th>
                        <td class="w-30">@if($data->experience_if_any){{ $data->experience_if_any }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD</th>
                        <td class="w-30">@if($data->hod){{ $data->hod }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Qualification</th>
                        <td class="w-30">@if($data->qualification){{ $data->qualification }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Training Date<</th>
                        <td class="w-30">@if($data->training_date){{ $data->training_date }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Topic of Training</th>
                        <td class="w-30">@if($data->topic){{ $data->topic }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Type of Training</th>
                        <td class="w-30">@if($data->type){{ $data->type }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Evaluation Required<</th>
                        <td class="w-30">@if($data->evaluation){{ $data->evaluation }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Site Division/Project</th>
                        <td class="w-30">@if($data->site_code){{ $data->site_code }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">@if($data->initiator){{ $data->initiator }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">@if($data->date_of_initiation){{ $data->date_of_initiation }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20"> Assigned To</th>
                        <td class="w-30">@if($data->assigned_to){{ $data->assigned_to }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                    </tr>
                  </table>
        </div>
        </div>
        </div>
        <div class="block-heads">
                                
                                </div>
                                <style>
                                    .block-heads {
                                        background-color: black;  
                                                
                                    }
    
                                </style>
        <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                Evaluation Criteria
                </div>
                  <table>


                  <tr>
                        <th class="w-20">Qualification Status</th>
                        <td class="w-30">@if($data->trainer){{ $data->trainer }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Qualification Comments</th>
                        <td class="w-30">@if($data->qualification_comments){{ $data->qualification_comments }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initial Attachment</th>
                        <td class="w-30">@if($data->initial_attachment){{ $data->initial_attachment }}@else Not Applicable @endif</td>
                    </tr>
                    </table>