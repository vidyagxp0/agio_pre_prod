<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VidyaGxP - Software</title>
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
                    OOT Report
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
                <td class="w-30">
                    <strong> Deviation No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->ootc_id) }}/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
            <div class="inner-block">
                <div class="content-table">
                    <div class="block">
                        <div class="block-head">
                            General Information
                        </div>
                        <table>
                            <tr> {{ $data->created_at }} added by {{ $data->originator }}
                                <th class="w-20">Site/Location Code</th>
                                <td class="w-30"> {{ Helpers::getDivisionName(session()->get('division')) }}</td>
                                <th class="w-20">Initiator</th>
                                <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Date of Initiation</th>
                                <td class="w-30">{{ $data->created_at ? $data->created_at->format('d-M-Y') : '' }} </td>
        
                                <th class="w-20">Due Date</th>
                                <td class="w-30">
                                    @if ($data->due_date)
                                        {{ Helpers::getdateFormat($data->due_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Severity Level</th>
                               
                                <th class="w-20">Intiater Group</th>
                                <td class="w-30">
                                    @if ($data->initiator_group)
                                        {{ $data->initiator_group }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Initiator Group Code</th>
                                <td class="w-30">
                                    @if ($data->initiator_group_code)
                                        {{ $data->initiator_group_code }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20"> Initiated Through</th>
                                <td class="w-30">
                                    @if ($data->initiated_through)
                                        {{ $data->initiated_through }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">If Others</th>
                                <td class="w-30">
                                    @if ($data->if_others)
                                        {{ strip_tags($data->if_others) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
        
                            </tr>
                           
                            <tr>
                                <th class="w-20">Is Repeat </th>
                                <td class="w-30">
                                    @if ($data->is_repeat)
                                        {{ $data->is_repeat }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20"> Repeat Nature</th>
                                <td class="w-30">
                                    @if ($data->nature_of_repeat)
                                        {{ $data->nature_of_repeat }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Nature Of Change</th>
                                <td class="w-30">
                                    @if ($data->nature_of_change)
                                        {{ $data->nature_of_change }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
        
                                <th class="w-20">Occured On</th>
                                <td class="w-30">
                                    @if ($data->oot_occured_on)
                                        {{ Helpers::getdateFormat($data->oot_occured_on) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Oot Details</th>
                                <td class="w-30">
                                    @if ($data->oot_details)
                                        {{ strip_tags($data->oot_details) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
        
                            </tr>
                            <tr>
        
                                <th class="w-20">Product History</th>
                                <td class="w-30">
                                    @if ($data->producct_history)
                                        {{ strip_tags($data->producct_history) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Probable Cause</th>
                                <td class="w-30">
                                    @if ($data->probble_cause)
                                        {{ strip_tags($data->probble_cause) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
        
        
                            {{-- <tr> --}}
                            {{-- <th class="w-20">Name of Product & Batch No</th> --}}
                            {{-- <td class="w-30">@if ($data->Product_Batch){{ ($data->Product_Batch) }} @else Not Applicable @endif</td> --}}
                            {{-- </tr> --}}
        
                            <tr>
                                <th class="w-20">Investigation Detail</th>
                                <td class="w-30">
                                    @if ($data->investigation_details)
                                        {{strip_tags( $data->investigation_details) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Comments</th>
                                <td class="w-30">
                                    @if ($data->comments)
                                        {{ strip_tags($data->comments) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
        
                        </table>
                        <div class="block">
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        OOT Information
                                    </div>
                                    <table>
                                        <tr>
                                            <th class="w-20">Product Material NAme   </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->productmaterialname)
                                                        {{ $data->productmaterialname }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Grade Type Of Water</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->grade_typeofwater)
                                                        {{ $data->grade_typeofwater }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
        
                                            <th class="w-20"> Sample Location Point </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->sampleLocation_Point)
                                                        {{ $data->sampleLocation_Point }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Market</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->market)
                                                        {{ $data->market }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>

                                            <th class="w-20">Customer</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->customer)
                                                        {{ $data->customer }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                      
                                    </table>                                    
                                </div> 
                            </div>
                            
                            <div class="block-head"> Product/Material  </div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-10">Sr. No.</th>
                                        <th class="w-25">Item/Product Code</th>
                                        <th class="w-25">Lot/Batch No</th>
                                        <th class="w-25">A.R.Number</th>
                                        <th class="w-25">MFG Date</th>
                                        <th class="w-25">Expiry Date</th>
                                        <th class="w-25">Lable Claim</th>
        
                                    </tr>
                                    @if ($grid_product_mat && is_array($grid_product_mat->data))
                                                @php
                                                    $serialNumber = 1;
                                                @endphp
                                                    @foreach ($grid_product_mat->data as $gridData)
                                                 
                                            <tr>
                                                <td class="w-15">{{ $serialNumber++ }}</td>
                                                <td class="w-15">{{ isset($gridData['item_product_code']) ? $gridData['item_product_code'] : 'Not Applicable' }}</td>
                                                <td class="w-15">{{ isset($gridData['low_batch_no']) ? $gridData['low_batch_no'] : 'Not Applicable' }}</td>
                                                <td class="w-15">{{ isset($gridData['a_r_number']) ? $gridData['a_r_number'] : 'Not Applicable' }}</td>
                                                <td class="w-15">{{ isset($gridData['m_f_g_date']) ? $gridData['m_f_g_date'] : 'Not Applicable' }}</td>  
                                                 <td class="w-15">{{ isset($gridData['expiry_date']) ? $gridData['expiry_date'] : 'Not Applicable' }}</td>
                                                <td class="w-15">{{ isset($gridData['label_claim']) ? $gridData['label_claim'] : 'Not Applicable' }}</td>        
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>1</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            
                                        </tr>
                                    @endif
                                </table>

                            </div>
                           
                        </div>
     
                    </div>

                    <div class="block">
                        <div class="head">
                            
                            <table>

                                <tr>        
                                    <th class="w-20">Analyst Name
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->analyst_name)
                                                {{ $data->analyst_name }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Sample Type</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->reference_record)
                                                {{ $data->reference_record }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                

                                <tr>

                                    <th class="w-20"> Ohers </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->others)
                                                {{ $data->others }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Stability For </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->stability_for)
                                                {{ $data->stability_for }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>                              
                            </table>
                        </div>
                        
                    </div>

                    <div class="block">
                        <div class="head">         
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        Details Of Stability Study
                                    </div>
                                    <div class="border-table">
                                        <table>
                                            <tr class="table_bg">
                                                <th class="w-10">Sr. No.</th>
                                                <th class="w-25">Ar Number</th>
                                                <th class="w-25">Condition Temprature</th>
                                                <th class="w-25">Interval</th>
                                                <th class="w-25">Orientation</th>
                                                <th class="w-25">Pack Details</th>
            
                                            </tr>
                                             @if ($gridStability && is_array($gridStability->data))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                                @foreach ($gridStability->data as $gridData)
                                                    <tr>
                                                        <td class="w-15">{{ $serialNumber++ }}</td>
                                                        <td class="w-15">{{ isset($gridData['a_r_number']) ? $gridData['a_r_number'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['temprature']) ? $gridData['temprature'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['interval']) ? $gridData['interval'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['orientation']) ? $gridData['orientation'] : 'Not Applicable' }} </td> 
                                                         <td class="w-15">{{ isset($gridData['orientation']) ? $gridData['orientation'] : 'Not Applicable' }}
                                                        </td>
                                                       
                
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>1</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                   
                                </div>
                                
                            </div>
        
                            <div class="block">
                                <div class="head">
                                
                                    <table>
        
                                        <tr>
        
                                            <th class="w-20">Specification Procedure Number </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->specification_procedure_number)
                                                        {{ $data->specification_procedure_number }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Specification Limit</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->specification_limit)
                                                        {{ $data->specification_limit }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>

                                            {{-- <th class="w-20">File Attachment</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->Attachment)
                                                        {{ $data->Attachment }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td> --}}
                                        </tr>
        
                                       
                                      
                                    </table>
                                </div>
                                <div class="border-table">
                                    <div class="block-">
                                       File Attechment
                                    </div>
                                    <table>
        
                                        <tr class="table_bg">
                                            <th class="w-20">S.N.</th>
                                            <th class="w-60">Attachment</th>
                                        </tr>
                                        @if ($data->Attachment)
                                            @foreach (json_decode($data->Attachment) as $key => $file)
                                                <tr>
                                                    <td class="w-20">{{ $key + 1 }}</td>
                                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                            target="_blank"><b>{{ $file }}</b></a> </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif
        
                                    </table>
                                </div>

                                <div class="border-table">
                                    <div class="block-head">
                                        OOT Result
                                    </div>
                                    <div class="border-table">
                                        <table>
                                            <tr class="table_bg">
                                                <th class="w-10">Sr. No.</th>
                                                <th class="w-25">Ar Number</th>
                                                <th class="w-25">Test Name Orf Oot </th>
                                                <th class="w-25">Result Obtained</th>
                                                <th class="w-25">Initial interview Details</th>
                                                <th class="w-25">Previous interval Details </th>
                                                <th class="w-25">Difference Of Results</th>
                                                <th class="w-25">Trend Limit</th>
                
                                            </tr>
                                           
                                            @if ($GridOotRes && is_array($GridOotRes->data))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                                @foreach ($GridOotRes->data as $gridData)
                                                    <tr>
                                                        <td class="w-15">{{ $serialNumber++ }}</td>
                                                        <td class="w-15">{{ isset($gridData['a_r_number']) ? $gridData['a_r_number'] : 'Not Applicable' }} </td>                                                        

                                                        <td class="w-15">{{ isset($gridData['test_name_of_oot']) ? $gridData['test_name_of_oot'] : 'Not Applicable' }} </td>                                                        
                                                        <td class="w-15">{{ isset($gridData['result_obtained']) ? $gridData['result_obtained'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['i_i_details']) ? $gridData['i_i_details'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['p_i_details']) ? $gridData['p_i_details'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['difference_of_result']) ? $gridData['difference_of_result'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['trend_limit']) ? $gridData['trend_limit'] : 'Not Applicable' }} </td>               
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>1</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
        
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        Preliminary Lab Investigation
                                    </div>
                                    <table>
        
                                        <tr>
        
                                            <th class="w-20">Corrective Action </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->corrective_action)
                                                        {{ strip_tags($data->corrective_action) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Preventive Action</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->preventive_action)
                                                        {{ strip_tags($data->preventive_action) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
        
                                            <th class="w-20"> Comments </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->inv_comments)
                                                        {{ strip_tags($data->inv_comments)}}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <th class="w-20">Person Name</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->inv_head_designee)
                                                        {{ $data->inv_head_designee }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="border-table">
                                <div class="block-">
                                   File Attechment
                                </div>
                                <table>
    
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data->inv_file_attachment)
                                        @foreach (json_decode($data->inv_file_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-20">Not Applicable</td>
                                        </tr>
                                    @endif
    
                                </table>
                            </div>
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                    Other Then Stability Batches
                                    </div>
                                    <table>
        
                                        <tr>
        
                                            <th class="w-20">Reason For Stability </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->reason_for_stability)
                                                        {{ $data->reason_for_stability }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Description Of OOT Details</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->description_of_oot_details)
                                                        {{ strip_tags($data->description_of_oot_details) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
        
                                            <th class="w-20">Product History </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->sta_bat_product_history)
                                                        {{ strip_tags($data->sta_bat_product_history) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Probable cause</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->sta_bat_probable_cause)
                                                        {{ strip_tags($data->sta_bat_probable_cause) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
        
                                            <th class="w-20">Analyst Name</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->sta_bat_analyst_name)
                                                        {{ $data->sta_bat_analyst_name }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Qc/Qa Head/ Designee</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->qa_head_designee)
                                                        {{ $data->qa_head_designee }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="border-table">
                                    <div class="block-">
                                        Info On Product Material
                                    </div>
                                    <div class="border-table">
                                        <table>
                                            <tr class="table_bg">
                                                <th class="w-10">Sr. No.</th>
                                                <th class="w-25">Batch Number</th>
                                                <th class="w-25">MFG Date </th>
                                                <th class="w-25">Expiry Date</th>
                                                <th class="w-25">A R Number</th>
                                                <th class="w-25">Pack Style </th>
                                                <th class="w-25">Frequency</th>
                                                <th class="w-25">Condition</th>
                
                                            </tr>
                                             @if ($InfoProductMat && is_array($InfoProductMat->data))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                                @foreach ($InfoProductMat->data as $gridData)
                                                    <tr>
                                                        <td class="w-15">{{ $loop->index + 1 }}</td>
                                                        
                                                        <td class="w-15">{{ isset($gridData['batch_no']) ? $gridData['batch_no'] : 'Not Applicable' }} </td>                                                        
                                                        <td class="w-15">{{ isset($gridData['mfg_date']) ? $gridData['mfg_date'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['exp_date']) ? $gridData['exp_date'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['ar_number']) ? $gridData['ar_number'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['pack_style']) ? $gridData['pack_style'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['frequency']) ? $gridData['frequency'] : 'Not Applicable' }} </td>
                                                        <td class="w-15">{{ isset($gridData['condition']) ? $gridData['condition'] : 'Not Applicable' }} </td>                                                   
                
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    <td>Not Applicable</td>
                                                    
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        CheckList Preliminary Laboratory Investigation
        
                                    </div>
                                    <table>
                                        <tr>
                                            <th class="w-20"> Preliminary Laboratory Investigation Required </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($checkList->p_l_irequired)
                                                        {{ $checkList->p_l_irequired }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td> 
                                        </tr>

                                        <tr>
                                            <th>Were the equipment instrument used for analysis was in calibrated state?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_one)
                                                    {{ $checkList->responce_one }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_one)
                                                    {{ $checkList->responce_one }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Did all components/parts of equipment instrument function properly?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce  : 
                                                @if ($checkList->responce_two)
                                                    {{ $checkList->responce_two }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_two)
                                                    {{ $checkList->remark_two }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was there any evidence that the sample is contaminated?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_three)
                                                    {{ $checkList->responce_three }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_three)
                                                    {{ $checkList->remark_three }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Is the SOP adequate and operation performed as per sop?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_four)
                                                    {{ $checkList->responce_four }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_four)
                                                    {{ $checkList->remark_four }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was the glassware used of Class A?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_five)
                                                    {{ $checkList->responce_five }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_five)
                                                    {{ $checkList->remark_five }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was there any evidence that the glassware used .may be contaminated?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_six)
                                                    {{ $checkList->responce_six}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_six)
                                                    {{ $checkList->remark_six }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Were the instrument problems such as noisy baseline, poor peak resolution, poor injection reproducibility, unidentified peak or contamination that affected peak integration, etc. noticed?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_seven)
                                                    {{ $checkList->responce_seven}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_seven)
                                                    {{ $checkList->remark_seven }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Any critical parts of equipment/instrument like detector, lamp etc. and needed replacement?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_eight)
                                                    {{ $checkList->responce_eight}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_eight)
                                                    {{ $checkList->remark_eight }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was the correct testing procedure followed?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_nine)
                                                    {{ $checkList->responce_nine}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_nine)
                                                    {{ $checkList->remark_nine }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Was there change in instrument, column, method, integration technique or standard?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_ten)
                                                    {{ $checkList->responce_ten}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_ten)
                                                    {{ $checkList->remark_ten }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Were the standards & reagents properly stored?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_eleven)
                                                    {{ $checkList->responce_eleven}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_eleven)
                                                    {{ $checkList->remark_eleven }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Were standards, reagents properly labelled?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_twele)
                                                    {{ $checkList->responce_twele}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twele)
                                                    {{ $checkList->remark_twele }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Was there any evidence that the standards, reagents have degraded?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_thrteen)
                                                    {{ $checkList->responce_thrteen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_thrteen)
                                                    {{ $checkList->remark_thrteen }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Were the reagents/chemicals used of recommended grade?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_fourteen)
                                                    {{ $checkList->responce_fourteen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_fourteen)
                                                    {{ $checkList->remark_fourteen }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>
                                       
                                        <tr>
                                            <th>Was the evidence that the reagents, standards or other materials used for test were contaminated.?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_fifteen)
                                                    {{ $checkList->responce_fifteen	}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_fifteen)
                                                    {{ $checkList->remark_fifteen }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Whether correct working /reference standard were used?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Responce : 
                                                @if ($checkList->responce_sixteen)
                                                    {{ $checkList->responce_sixteen	}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_sixteen)
                                                    {{ $checkList->remark_sixteen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was the testing procedure adequate and followed properly?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_seventeen)
                                                    {{ $checkList->responce_seventeen	}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_seventeen)
                                                    {{ $checkList->remark_seventeen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was the glassware used properly washed?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_eighteen)
                                                    {{ $checkList->responce_eighteen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_eighteen)
                                                    {{ $checkList->remark_eighteen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Were standards, reagents used within their expiration dates?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_ninteen)
                                                    {{ $checkList->responce_ninteen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_ninteen)
                                                    {{ $checkList->remark_ninteen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>	Were volumetric solutions standardized as per testing procedure?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty)
                                                    {{ $checkList->responce_twenty}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_ninteen)
                                                    {{ $checkList->remark_ninteen}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Were Working standards standardized as per testing procedure?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_one)
                                                    {{ $checkList->responce_twenty_one}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_one)
                                                    {{ $checkList->remark_twenty_one}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Were the dilutions made in sample /standard preparation as per testing procedure?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_two)
                                                    {{ $checkList->responce_twenty_two}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_two)
                                                    {{ $checkList->remark_twenty_two}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Was the analyst trained / certified?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_three)
                                                    {{ $checkList->responce_twenty_three}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_three)
                                                    {{ $checkList->remark_twenty_three}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Analyst understood the testing procedure?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_four)
                                                    {{ $checkList->responce_twenty_four}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_four)
                                                    {{ $checkList->remark_twenty_four}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Analyst calculated the results correctly as mentioned in testing procedure?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_five)
                                                    {{ $checkList->responce_twenty_five}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_five)
                                                    {{ $checkList->remark_twenty_five}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was there any similar occurrence with the same analyst earlier?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_six)
                                                    {{ $checkList->responce_twenty_six}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_six)
                                                    {{ $checkList->remark_twenty_six}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Was there any similar history with the product / material?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_seven)
                                                    {{ $checkList->responce_twenty_seven}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_seven)
                                                    {{ $checkList->remark_twenty_seven}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <th>Retention time of concerned peak is comparable with respect to previous station (ln case of OOT in any individual and total impurity)?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_eight)
                                                    {{ $checkList->responce_twenty_eight}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_eight)
                                                    {{ $checkList->remark_twenty_eight}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was the sample quantity is sufficient?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_twenty_nine)
                                                    {{ $checkList->responce_twenty_nine}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_twenty_nine)
                                                    {{ $checkList->remark_twenty_nine}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was Error in labelling details on the sample container?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_thirty)
                                                    {{ $checkList->responce_thirty}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_thirty)
                                                    {{ $checkList->remark_thirty}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Was the Specified storage condition of product sample maintained?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_thirty_one)
                                                    {{ $checkList->responce_thirty_one}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_thirty_one)
                                                    {{ $checkList->remark_thirty_one}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Transient equipment /Instrument malfunction is suspected?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_thirty_two)
                                                    {{ $checkList->responce_thirty_two}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_thirty_two)
                                                    {{ $checkList->remark_thirty_two}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Where any change in the character of the sample observed?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_thirty_three)
                                                    {{ $checkList->responce_thirty_three}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_thirty_three)
                                                    {{ $checkList->remark_thirty_three}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Any other specific reason?</th>
                                            <th>Remark</th>
                                        </tr>
                                        <tr>
                                            <td> Response: 
                                                @if ($checkList->responce_thirty_four)
                                                    {{ $checkList->responce_thirty_four}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <td>
                                                @if ($checkList->remark_thirty_four)
                                                    {{ $checkList->remark_thirty_four}}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                    <table>
                                        <tr>
                                            <th class="w-20">Information Technology Feedback</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->Information_Technology_feedback)
                                                        {{ $data->Information_Technology_feedback }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>

                                            <th class="w-20">Laboratory error Identified for OOT - Result(s)</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->l_e_i_oot)
                                                        {{ $data->l_e_i_oot }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <th class="w-20">Elaborate The Reason(s) If Yes</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->elaborate_the_reson)
                                                        {{ strip_tags($data->elaborate_the_reson) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20"> In Charge</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->in_charge)
                                                        {{ strip_tags($data->in_charge) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">QC Head/Designee</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->pli_head_designee)
                                                        {{ ($data->pli_head_designee) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </div>
                                
                            </div>
        
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        ChecList- Part B Applicable If Laboratory Error
                                    </div>
                                    <table>
        
                                        <tr>
        
                                            <th class="w-20">Action Taken On OOt </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->Project_management_review)
                                                        {{ $data->Project_management_review }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Retraining to Analyst Required ?</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->retraining_to_analyst_required)
                                                        {{ $data->retraining_to_analyst_required }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>

                                            <th class="w-20">Remark </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->cheklist_part_b_remarks)
                                                        {{ strip_tags($data->cheklist_part_b_remarks) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <th class="w-20">Correct the Error and Repeat the analysis on same sample</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->analysis_on_same_sample)
                                                        {{ $data->analysis_on_same_sample }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Any Other Action Required ?</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->any_other_action)
                                                        {{ strip_tags($data->any_other_action) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20"> Reanalisis Result OOT</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->reanalysis_result_oot)
                                                        {{ strip_tags($data->reanalysis_result_oot) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
        
                                            <th class="w-20"> Reanalysis Result</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->re_analysis_result)
                                                        {{ $data->re_analysis_result }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>

                                            <th class="w-20"> Reanalisis Result OOT</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->reanalysis_result_oot)
                                                        {{ $data->reanalysis_result_oot }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>

                                            <th class="w-20">Comments</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->part_b_comments)
                                                        {{ strip_tags($data->part_b_comments) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                           
                                        </tr>
                                    </table>
                                </div>  
                            </div>
                            <div class="border-table">
                                <div class="block-">
                                   Supporting Attechment
                                </div>
                                <table>
    
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data->supporting_attechment)
                                        @foreach (json_decode($data->supporting_attechment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-20">Not Applicable</td>
                                        </tr>
                                    @endif
    
                                </table>
                            </div>
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        CheckList Part D: Communication of confirmed of Oot With Technical Commitee
                                    </div>
                                    <table>
        
                                        <tr>
        
                                            <th class="w-20">R&D (F) Comments </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->r_d_comments_part_b)
                                                        {{ strip_tags($data->r_d_comments_part_b) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">ADL Comments</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->a_d_l_comments)
                                                        {{ strip_tags($data->a_d_l_comments) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Regulatory Comments</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->regulatory_comments)
                                                        {{ strip_tags($data->regulatory_comments) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
        
                                            <th class="w-20">Manufacturing Comments </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->manufacturing_comments)
                                                        {{ strip_tags($data->manufacturing_comments) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Technical Comment</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->technical_commitee_comments)
                                                        {{ strip_tags($data->technical_commitee_comments) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </table>
                                </div> 
                            </div>
                            <div class="border-table">
                                <div class="block-">
                                   Supporting Attechment
                                </div>
                                <table>
    
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data->supporting_attechment)
                                        @foreach (json_decode($data->supporting_attechment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-20">Not Applicable</td>
                                        </tr>
                                    @endif
    
                                </table>
                            </div>

                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        Justification Of Delay
                                    </div>
                                    <table>
        
                                        <tr>
        
                                            <th class="w-20">Last Due Date</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->last_due_date)
                                                        {{ $data->last_due_date }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Progress/ Justification For Delay</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->progress_justification_delay)
                                                        {{ strip_tags($data->progress_justification_delay) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Tentative Clousure Date</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->tentative_clousure_date)
                                                        {{ $data->tentative_clousure_date }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
        
                                            <th class="w-20">Remarks By QA Department </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->remarks_by_qa_department)
                                                        {{ strip_tags($data->remarks_by_qa_department) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>  
                            </div>
                            <div class="border-table">
                                <div class="block-">
                                   Supporting Attechment
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data->conclusion_attechment)
                                        @foreach (json_decode($data->conclusion_attechment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-20">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        Closure Attachment
                                    </div>
                                    <table>
        
                                        <tr>
        
                                            <th class="w-20"> Closure Comments    </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->closure_comments)
                                                        {{ strip_tags($data->closure_comments) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="border-table">
                                <div class="block-">
                                   Supporting Attechment
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">S.N.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data->doc_closure)
                                        @foreach (json_decode($data->doc_closure) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-20">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                           
                        
                        </div>
                    </div>
        
        

                </div>
        
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
