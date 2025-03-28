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

    .Summer {
        font-weight: bold;
        font-size: 0.8rem;
        margin-left: 10px;
    }

    .div-data {
        font-size: 0.8rem;
        margin-left: 10px;
        margin-bottom: 10px;

    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">Extension Report</td>
                <td class="w-30">
                    <div class="logo" style="text-align: center;">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                        style="max-height: 55px; max-width: 40px;">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30"><strong>Extension No.</strong></td>
                
            </tr>
        </table>
    </header>
    <footer>
        <table>
            <tr>
                <td class="w-30"><strong>Printed On:</strong> {{ date('d-M-Y') }}</td>
                <td class="w-40"><strong>Printed By:</strong> {{ Auth::user()->name }}</td>
            </tr>
        </table>
    </footer>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">Extension Details</div>
                <table>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-80">
                           
                        </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-80">
                            
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        
                    </tr>
                </table>

                <label class="Summer" for="Short Description">Short Description</label>
<div class="div-data">
    @foreach($data as $item)
        <p>{{ $item->short_description ?? 'No description available' }}</p>
    @endforeach
</div>



                
                   
                <table>
                    

                    <tr>
                        <th class="w-20">Extension Number</th>
                        <td class="w-80">
                            
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">HOD Review</th>
                        <td class="w-80">
                          
                        </td>
                        <th class="w-20">QA/CQA Approval</th>
                        <td class="w-80">
                           
                        </td>
                    </tr>
                </table>

                {{-- <table>
                    <tr>
                        <th class="w-20">Parent Record Number</th>
                        <td class="w-80">
                           
                        </td>

                    </tr>
                </table> --}}

                <label class="Summer" for="Parent Record Number">Parent Records Number</label>
                <div class="div-data">
                  
                </div>
               

                <table>
                    <tr>
                        <th class="w-20">Current Due Date (Parent)</th>
                        <td class="w-80">
                           
                        </td>
                        <th class="w-20">Proposed Due Date</th>
                        <td class="w-80">
                           
                        </td>
                    </tr>
                </table>

                {{-- <table>
                    <tr>
                        <th class="w-20"> Description</th>
                        <td class="w-80">
                            
                        </td>
                        <th class="w-20">Justification / Reason</th>
                        <td class="w-80">
                           
                        </td>
                    </tr>
                </table> --}}    
                <label class="Summer" for="Description">Description</label>
                <div class="div-data">
                    
                </div>

                <label class="Summer" for="Justification / Reason">Justification / Reason</label>
                <div class="div-data">
                   
                </div>
            </div>
            <div class="block">
                <div class="block-head">Attachment Extension</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80">File</th>
                        </tr>
                       
                    </table>
                </div>
            </div>
           