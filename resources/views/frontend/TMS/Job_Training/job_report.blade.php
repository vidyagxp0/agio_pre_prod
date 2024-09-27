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
                Job Training Report
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
                    General Information
                </div>
                <table>
                    <tr>
                    <th class="w-20">Emp Name</th>
                            
                    <td class="w-30">@if($data->name){{ $data->name }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Emp Code</th>
                            
                    <td class="w-30">@if($data->empcode){{ $data->empcode }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">SOP Document</th>
                            
                    <td class="w-30">@if($data->sopdocument){{ $data->sopdocument }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Type of Training</th>
                            
                    <td class="w-30">@if($data->type_of_training){{ $data->type_of_training }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Start Date</th>
                            
                    <td class="w-30">@if($data->start_date){{ $data->start_date }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">End Date</th>
                            
                    <td class="w-30">@if($data->end_date){{ $data->end_date }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Department</th>
                            
                    <td class="w-30">@if($data->department){{ $data->department }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Location</th>
                            
                    <td class="w-30">@if($data->location){{ $data->location }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">HOD</th>
                            
                    <td class="w-30">@if($data->hod){{ $data->hod }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Revision Purpose</th>
                            
                    <td class="w-30">@if($data->revision_purpose){{ $data->revision_purpose }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Revision Purpose</th>
                            
                    <td class="w-30">@if($data->revision_purpose){{ $data->revision_purpose }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Remark</th>
                            
                    <td class="w-30">@if($data->remark){{ $data->remark }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>

                    <tr>
                    <th class="w-20">Evaluation Required</th>
                            
                    <td class="w-30">@if($data->evaluation_required){{ $data->evaluation_required }}@else Not Applicable @endif</td>
                    </tr>
                    </tr>
                </table>
                <div class="block-heads">
                                
                                </div>
                                <style>
                                    .block-heads {
                                        background-color: black;  
                                                
                                    }
    
                                </style>
                <div class="col-12">
                <div class="group-input">
                    <div class="why-why-chart">
                    <table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 5%;">Sr.No.</th>
            <th style="width: 30%;">Subject</th>
            <th>Type of Training</th>
            <th>Reference Document No.</th>
            <th>Trainer</th>
            <th>Date of Training</th>
            <th>Date of Completion</th>
        </tr>
    </thead>
    <tbody>
      
        
        <!-- Row 1 -->
        <tr>
            <td>1</td>
            <td>@if($data->subject_1){{ $data->subject_1 }}@else Not Applicable @endif</td>
            <td>  @if($data->type_of_training_1){{ $data->type_of_training_1 }}@else Not Applicable @endif</td>
            <td>@if($data->reference_document_no_1){{ $data->reference_document_no_1 }}@else Not Applicable @endif</td>
            <td>
                @if($data->trainer_1){{ $data->trainer_1 }}@else Not Applicable @endif
            </td>
            <td>@if($data->startdate_1){{ $data->startdate_1 }}@else Not Applicable @endif</td>
            <td>@if($data->enddate_1){{ $data->enddate_1 }}@else Not Applicable @endif</td>
        </tr>

        <!-- Row 2 -->
        <tr>
            <td>2</td>
            <td>@if($data->subject_2){{ $data->subject_2 }}@else Not Applicable @endif</td>
            <td>  @if($data->type_of_training_2){{ $data->type_of_training_2 }}@else Not Applicable @endif</td>
            <td>@if($data->reference_document_no_2){{ $data->reference_document_no_2 }}@else Not Applicable @endif</td>
            <td>
                @if($data->trainer_2){{ $data->trainer_2 }}@else Not Applicable @endif
            </td>
            <td>@if($data->startdate_2){{ $data->startdate_2 }}@else Not Applicable @endif</td>
            <td>@if($data->enddate_2){{ $data->enddate_2 }}@else Not Applicable @endif</td>
        </tr>

        <!-- Row 3 -->
        <tr>
            <td>3</td>
            <td>@if($data->subject_3){{ $data->subject_3 }}@else Not Applicable @endif</td>
            <td>@if($data->type_of_training_3){{ $data->type_of_training_3 }}@else Not Applicable @endif</td>
            <td> @if($data->reference_document_no_3){{ $data->reference_document_no_3 }}@else Not Applicable @endif</td>
            <td>
                @if($data->trainer_3){{ $data->trainer_3 }}@else Not Applicable @endif
            </td>
            <td>@if($data->startdate_3){{ $data->startdate_3 }}@else Not Applicable @endif</td>
            <td> @if($data->enddate_3){{ $data->enddate_3 }}@else Not Applicable @endif</td>
        </tr>

        <!-- Row 4 -->
        <tr>
            <td>4</td>
            <td> @if($data->subject_4){{ $data->subject_4 }}@else Not Applicable @endif</td>
            <td>@if($data->type_of_training_4){{ $data->type_of_training_4 }}@else Not Applicable @endif</td>
            <td> @if($data->reference_document_no_4){{ $data->reference_document_no_4 }}@else Not Applicable @endif</td>
            <td>
                
                @if($data->trainer_4){{ $data->trainer_4 }}@else Not Applicable @endif
            </td>
            <td> @if($data->startdate_4){{ $data->startdate_4 }}@else Not Applicable @endif</td>
            <td>  @if($data->enddate_4){{ $data->enddate_4 }}@else Not Applicable @endif</td>
        </tr>

        <!-- Row 5 -->
        <tr>
            <td>5</td>
            <td> @if($data->subject_5){{ $data->subject_5 }}@else Not Applicable @endif</td>
            <td> @if($data->type_of_training_5){{ $data->type_of_training_5 }}@else Not Applicable @endif</td>
            <td>@if($data->reference_document_no_5){{ $data->reference_document_no_5 }}@else Not Applicable @endif</td>
            <td>
                
                @if($data->trainer_5){{ $data->trainer_5 }}@else Not Applicable @endif
            </td>
            <td>  @if($data->startdate_5){{ $data->startdate_5 }}@else Not Applicable @endif</td>
            <td>@if($data->enddate_5){{ $data->enddate_5 }}@else Not Applicable @endif</td>
        </tr>
    </tbody>
</table>

                    </div>
                </div>
            </div>

    </div>
        </div>
        </div>
        </div>