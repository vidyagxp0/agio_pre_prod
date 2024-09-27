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
                Induction Training Report
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
                <td class="w-70" style="height:1rem;">
                @if($data->employee_id){{ $data->employee_id }}@else Not Applicable @endif
                </td>
        
                <td class="w-70" style="height:1rem">
                @if($data->name_employee_display){{ $data->name_employee_display }}@else Not Applicable @endif

                </td>
            </tr>
        </table>
    </header>
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
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>

                <table>
                <tr>
                <th class="w-20">Name of Employee</th>
                            
                <td class="w-30">@if($data->name_employee_display){{ $data->name_employee_display }}@else Not Applicable @endif</td>

                <th class="w-20">Employee ID</th>
                            
                <td class="w-30">@if($data->employee_id){{ $data->employee_id }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                <th class="w-20">Department</th>
                            
                <td class="w-30">@if($data->department){{ $data->department }}@else Not Applicable @endif</td>
           
                <th class="w-20">Location</th>
                            
                <td class="w-30">@if($data->location){{ $data->location }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                <th class="w-20">Designation</th>
                            
                <td class="w-30">@if($data->designation){{ $data->designation }}@else Not Applicable @endif</td>
              
                <th class="w-20">Qualification</th>
                            
                <td class="w-30">@if($data->qualification){{ $data->qualification }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                <th class="w-20">Experience (if any)</th>
                            
                <td class="w-30">@if($data->experience_if_any){{ $data->experience_if_any }}@else Not Applicable @endif</td>

                <th class="w-20">Date of Joining</th>
                            
                <td class="w-30">@if($data->date_joining){{ $data->date_joining }}@else Not Applicable @endif</td>
                </tr>

                <tr>
                <th class="w-20">Evaluation Required</th>
                            
                <td class="w-30">@if($data->evaluation_required){{ $data->evaluation_required }}@else Not Applicable @endif</td>
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
                                                    <th style="width: 30%;">Name of Document</th>
                                                    <th>Document Number</th>
                                                    <th>Training Date</th>
                                                    {{-- <th>Trainee Sign/Date </th>--}}
                                                        <th>Attachment</th>
                                                    <th>Remark</th>



                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td style="background: #DCD8D8">Introduction of Agio Plant</td>

                                                    <td>
                                                    @if($data->document_number_1){{ $data->document_number_1 }}@else Not Applicable @endif
                                                        
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                @if($data->training_date_1){{ $data->training_date_1 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                
                                                    <td>
                  
                                                    <label for="Attached CV"></label>
                                                    @if($data->attachment_1){{ $data->attachment_1 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                    @if($data->remark_1){{ $data->remark_1 }}@else Not Applicable @endif

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td style="background: #DCD8D8">Personnel Hygiene</td>
                                                    <td>
                                                        @if($data->document_number_2){{ $data->document_number_2 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    @if($data->training_date_2){{ $data->training_date_2 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
          
                                                        @if($data->attachment_2){{ $data->attachment_2 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>

                                                        @if($data->remark_2){{ $data->remark_2 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td style="background: #DCD8D8">Entry Exit Procedure in Factory premises</td>
                                                    <td>
                                                 
                                                        @if($data->document_number_3){{ $data->document_number_3 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    @if($data->training_date_3){{ $data->training_date_3 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        @if($data->attachment_3){{ $data->attachment_3 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                         
                                                        @if($data->remark_3){{ $data->remark_3 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td style="background: #DCD8D8">Good Documentation Practices</td>
                                                    <td>
                                            
                                                        @if($data->document_number_4){{ $data->document_number_4 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    
                                                                    @if($data->training_date_4){{ $data->training_date_4 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        
                                                        @if($data->attachment_4){{ $data->attachment_4 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>

                                                        @if($data->remark_4){{ $data->remark_4 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td style="background: #DCD8D8">Data Integrity</td>
                                                    <td>
                                                        @if($data->document_number_5){{ $data->document_number_5 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                   
                                                                    @if($data->training_date_5){{ $data->training_date_5 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        
                                                        @if($data->attachment_5){{ $data->attachment_5 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                     
                                                        @if($data->remark_5){{ $data->remark_5 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td style="background: #77a5d1">Modules</td>


                                                </tr>
                                                <tr>
                                                    <td>(a)</td>
                                                    <td style="background: #DCD8D8"> GMP</td>
                                                    <td>
                                                        
                                                        @if($data->document_number_6){{ $data->document_number_6 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                 
                                                                    @if($data->training_date_6){{ $data->training_date_6 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                       
                                                        @if($data->attachment_6){{ $data->attachment_6 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>

                                                        @if($data->remark_6){{ $data->remark_6 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>(b)</td>
                                                    <td style="background: #DCD8D8"> Documentation</td>
                                                    <td>
                                                        
                                                        @if($data->document_number_7){{ $data->document_number_7 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    
                                                                    @if($data->training_date_7){{ $data->training_date_7 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                       
                                                        @if($data->attachment_7){{ $data->attachment_7 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>

                                                        @if($data->remark_7){{ $data->remark_7 }}@else Not Applicable @endif
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>(c)</td>
                                                    <td style="background: #DCD8D8"> Process Control</td>
                                                    <td>

                                                        @if($data->document_number_8){{ $data->document_number_8 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                  
                                                                    @if($data->training_date_8){{ $data->training_date_8 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                      
                                                        @if($data->attachment_8){{ $data->attachment_8 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        
                                                        @if($data->remark_8){{ $data->remark_8 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>(d)</td>
                                                    <td style="background: #DCD8D8"> Cross Contamination</td>
                                                    <td>
                                                        @if($data->document_number_9){{ $data->document_number_9 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                       
                                                                    @if($data->training_date_9){{ $data->training_date_9 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                       
                                                        @if($data->attachment_9){{ $data->attachment_9 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
               
                                                        @if($data->remark_9){{ $data->remark_9 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>(e)</td>
                                                    <td style="background: #DCD8D8"> Sanitization and Hygiene</td>
                                                    <td>
                                                
                                                        @if($data->document_number_10){{ $data->document_number_10 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">

                                                                    @if($data->training_date_10){{ $data->training_date_10 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>

                                                        @if($data->attachment_10){{ $data->attachment_10 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        
                                                        @if($data->remark_10){{ $data->remark_10 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>(f)</td>
                                                    <td style="background: #DCD8D8"> Warehousing</td>
                                                    <td>
                                      
                                                        @if($data->document_number_11){{ $data->document_number_11 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                       
                                                                    @if($data->training_date_11){{ $data->training_date_11 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
    
                                                        @if($data->attachment_11){{ $data->attachment_11 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>

                                                        @if($data->remark_11){{ $data->remark_11 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>(g)</td>
                                                    <td style="background: #DCD8D8"> Complaint and Recall</td>
                                                    <td>

                                                        @if($data->document_number_12){{ $data->document_number_12 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">

                                                                    @if($data->training_date_12){{ $data->training_date_12 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>

                                                        @if($data->attachment_12){{ $data->attachment_12 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                               
                                                        @if($data->remark_12){{ $data->remark_12 }}@else Not Applicable @endif

                                                    </td>
                                                <tr>
                                                    <td>(h)</td>
                                                    <td style="background: #DCD8D8"> Utilities</td>
                                                    <td>
                              
                                                        @if($data->document_number_13){{ $data->document_number_13 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">

                                                                    @if($data->training_date_13){{ $data->training_date_13 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>

                                                        @if($data->attachment_13){{ $data->attachment_13 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
             
                                                        @if($data->remark_13){{ $data->remark_13 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>(i)</td>
                                                    <td style="background: #DCD8D8"> Water</td>
                                                    <td>
                                                        @if($data->document_number_14){{ $data->document_number_14 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
      
                                                                    @if($data->training_date_14){{ $data->training_date_14 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>

                                                        @if($data->attachment_14){{ $data->attachment_14 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>

                                                        @if($data->remark_14){{ $data->remark_14 }}@else Not Applicable @endif


                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>(j)</td>
                                                    <td style="background: #DCD8D8"> Safety Module</td>
                                                    <td>
     
                                                        @if($data->document_number_15){{ $data->document_number_15 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">

                                                                    @if($data->training_date_15){{ $data->training_date_15 }}@else Not Applicable @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>

                                                        @if($data->attachment_15){{ $data->attachment_15 }}@else Not Applicable @endif

                                                    </td>
                                                    <td>
     
                                                        @if($data->remark_15){{ $data->remark_15 }}@else Not Applicable @endif

                                                    </td>

                                                </tr>
                                                </tr>
                                            </tbody>
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
                            <table>
                                <tr>

                                <th class="w-20">HR Department</th>
                                <td>   @if($data->hr_name){{ $data->hr_name }}@else Not Applicable @endif </td>

                                <th class="w-20">Type of Training</th>
                                <td class="w-30">@if($data->training_type){{ $data->training_type}}@else Not Applicable @endif</td>

                                </tr>

                              
                                        
                                <tr>

                                <th class="w-20">Trainer Name</th>
                                <td class="w-30">@if($data->trainer_name){{ $data->trainer_name}}@else Not Applicable @endif</td>

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
