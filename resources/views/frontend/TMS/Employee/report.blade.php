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
                Employee Report
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
                            <th class="w-20">Site Division/Project:</th>
                           
                            <td class="w-30">@if($data->site_division){{ $data->site_division }}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class="w-20">Joining Date:</th>
                        <td class="w-30">@if($data->joining_date){{ $data->joining_date}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class="w-20">Prefix:</th>
                        <td class="w-30">@if($data->prefix){{ $data->prefix}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Employee ID</th>
                        <td class="w-30">@if($data->emp_id){{ $data->emp_id}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Employee Name</th>
                        <td class="w-30">@if($data->employee_name){{ $data->employee_name}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Gender</th>
                        <td class="w-30">@if($data->gender){{ $data->gender}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Department Name</th>
                        <td class="w-30">@if($data->department){{ $data->department}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Qualification</th>
                        <td class="w-30">@if($data->qualification){{ $data->qualification}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Experience (No. of Years)</</th>
                        <td class="w-30">@if($data->experience){{ $data->experience}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Designation</th>
                        <td class="w-30">@if($data->job_title){{ $data->job_title}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Other Department</th>
                        <td class="w-30">@if($data->other_department){{ $data->other_department}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Other Designation</th>
                        <td class="w-30">@if($data->other_designation){{ $data->other_designation}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Attached CV</th>
                        <td class="w-30">@if($data->attached_cv){{ $data->attached_cv}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Certification/Qualification</th>
                        <td class="w-30">@if($data->certification){{ $data->certification}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Medical Checkup Report</th>
                        <td class="w-30">@if($data->has_additional_document){{ $data->has_additional_document}}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                        <th class ="w-20">Medical Checkup Attachment</th>
                        <td class="w-30">@if($data->additional_document){{ $data->additional_document}}@else Not Applicable @endif</td>
                     </tr>
                     
                    </table>

</div>
</div>
</div>


<div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                Employee Address Details
                </div>
   
                 <table>
                       <tr>
                         <th class="w-20">Country</th>
                         <td class="w-30">@if($data->country){{ $data->country }}@else Not Applicable @endif</td>
                     </tr>
                       <tr>
                            <th class="w-20">state</th>
                            <td class="w-30">@if($data->state){{ $data->state }}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                         <th class="w-20">City</th>
                         <td class="w-30">@if($data->city){{ $data->city }}@else Not Applicable @endif</td>
                     </tr>
                       <tr>
                            <th class="w-20">Building</th>
                            <td class="w-30">@if($data->building){{ $data->building }}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                         <th class="w-20">Floor</th>
                         <td class="w-30">@if($data->floor){{ $data->floor }}@else Not Applicable @endif</td>
                     </tr>
                       <tr>
                            <th class="w-20">Room</th>
                            <td class="w-30">@if($data->room){{ $data->room }}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                         <th class="w-20">Picture</th>
                         <td class="w-30">@if($data->picture){{ $data->picture }}@else Not Applicable @endif</td>
                     </tr>
                       <tr>
                            <th class="w-20">Speciman Signature</th>
                            <td class="w-30">@if($data->specimen_signature){{ $data->specimen_signature }}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                         <th class="w-20">HOD</th>
                         <td class="w-30">@if($data->hod){{ $data->hod }}@else Not Applicable @endif</td>
                     </tr>
                       <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-30">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                     </tr>
                     <tr>
                            <th class="w-20">File Attachment</th>
                            <td class="w-30">@if($data->file_attachment){{ $data->file_attachment }}@else Not Applicable @endif</td>
                     </tr>

                    </table>

                </div>
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
