<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

{{-- <style>
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

    .w-80 {
        width: 80%;
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
        height: 100px;
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
        margin-bottom: 80px;
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



    .summernote-content table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    .summernote-content table td,
    .summernote-content table th {
        border: 1px solid #ddd !important;
        padding: 8px !important;
        vertical-align: top !important;
        text-align: left !important;
    }
    .summernote-content table th {
        background-color: #f2f2f2 !important;
    }
</style> --}}
<style>
    @page {
         margin: 160px 35px 100px; /* top header, side margin, bottom footer */
     }
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        font-size: 11px;
        line-height: 1.4;
        color: #000;
        margin-top: 10px;
        margin-bottom: -60px; 
    }

    header, footer {
        position: fixed;
        left: 0;
        right: 0;
        /* padding: 20px 35px; */
        font-size: 12px;
        box-sizing: border-box;
    }

    header {
        top: -140px;
        border-bottom: none;
    }

    footer {
        bottom: 0;
        bottom: -100px;
        border-top: none;
    }

    .logo img {
        display: block;
        margin-left: auto;
    }
    /* To remove borders from content part only */
    .content-area table {
        border: none !important;
    }

    .inner-block {
        /* padding: 20px 35px;  */
        box-sizing: border-box;
    }
    
    .block {
        margin-bottom: 25px;
    }

    .block-head {
        font-size: 13px;
        font-weight: bold;
        border-bottom: 2px solid #387478;
        color: #387478;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }

    .table_bg {
        background-color: #387478;
        color: #111;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
    }

    th, td {
        padding: 6px 10px;
        font-size: 10.5px;
        border: 1px solid #ccc;
        text-align: left;
        vertical-align: top;
    }

    th {
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .section-gap {
        margin-top: 20px;
    }

    .no-border th, .no-border td {
        border: none !important;
    }

    /* .w-5 { width: 5%; } */
    .w-5 { width: 6%; }
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-50 { width: 50%; }
    .w-70 { width: 70%; }
    .w-80 { width: 80%; }
    .w-100 { width: 100%; }
    .text-center { text-align: center; }
    .border-table {
        overflow-x: auto;
    }
    table th, table td {
        word-wrap: break-word;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    Market Complaint Family Report
                    </div>
                </td>
                <td class="w-30">
                    <div class="logo" style="text-align: center;">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                        style="max-height: 55px; max-width: 40px;">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            @foreach($records as $data)
            <tr>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/MC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Page No.</strong>
                </td>
            </tr>
            @endforeach       
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-50">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-50">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-80">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

    @foreach($records as $data)
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head" style="margin-top: 50px;">
                    General Information
                </div>
                <table>
                <tr>
                    <th class="w-20">Record Number</th>
                    <td class="w-30">
                        @if ($data->record)
                            {{ Helpers::divisionNameForQMS($data->division_id) }}/MC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    {{ $data->created_at }} added by {{ $data->originator }}
                    <th class="w-20">Site / Location</th>
                    {{-- <td class="w-30"> {{ Helpers::getDivisionName(id()->get('division')) }}</td> --}}
                    <td class="w-30"> {{ Helpers::getDivisionName($data->division_id) }}</td>

                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date Of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" >{{ $data->description_gi ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->due_date_gi) ?? 'Not Applicable' }}</td>
                        {{-- <th class="w-20">Repeat Nature</th>
                        <td class="w-80">{!! $data->repeat_nature_gi ?? 'Not Applicable' !!}</td> --}}
                    
                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->initiator_group)
                                {{ $data->initiator_group }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                {{-- </table>
                <table> --}}
                    <tr>
                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-80" colspan="3">
                            @if ($data->initiator_group_code_gi)
                                {{ $data->initiator_group_code_gi }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>


                {{-- <table>
                    <tr>
                        <th class="w-20">Assign To</th>
                        <td class="w-80">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table> --}}


                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Information Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->initial_attachment_gi)
                                @foreach (json_decode($data->initial_attachment_gi) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <table>
                   

                  

                    <tr>

                        <th class="w-20">Complainant</th>
                        <td class="w-80" colspan="3">{{ $data->complainant_gi ?? 'Not Applicable' }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Complaint Reported On</th>
                        <td class="w-80">
                            {{ Helpers::getdateFormat($data->complaint_reported_on_gi) ?? 'Not Applicable' }}</td>
                       
                    </tr>
                    <!-- <tr>
                        <th class="w-20">Details of Nature of Market Complaint</th>
                        <td class="w-80" colspan='5'>{!! $data->details_of_nature_market_complaint_gi ?? 'Not Applicable' !!}</td>
                    </tr> -->
                </table>

                <table>

                    <tr>
                        <th class="w-20 align-top">Details of Nature of Market Complaint</th>
                        <td class="w-80" colspan="3">
                            @if ($data->details_of_nature_market_complaint_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->details_of_nature_market_complaint_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                </table>

            <div class="border-table">
                <div class="block-head">
                    Product Details 
                </div>


               
                <table>
                    <tr class="table_bg">
                        <th class="w-10">Sr.No.</th>
                        <th class="w-20">Product Name</th>
                        <th class="w-10">Batch No.</th>
                        <th class="w-10">Mfg. Date</th>
                        <th class="w-10">Exp. Date</th>

                        <th class="w-10">Batch Size</th>
                        <th class="w-10">Pack Size</th>
                        <th class="w-10">Dispatch Quantity</th>
                        <th class="w-10">Remarks</th>
                    </tr>

                    <tbody>

                        @php $productsdetails = 1; @endphp
                        @if (!empty($prductgigrid) && is_array($prductgigrid->data))
                            @foreach ($prductgigrid->data as $detail)
                                <tr>
                                    <td>{{ $productsdetails++ }}</td>


                                    <td class="w-20">
                                        {{ isset($detail['info_product_name']) ? $detail['info_product_name'] : '' }}
                                    </td>

                                    <td class="w-20">
                                        {{ isset($detail['info_batch_no']) ? $detail['info_batch_no'] : '' }}</td>

                                    <td class="w-20">
                                        {{ isset($detail['info_mfg_date']) ? \Carbon\Carbon::parse($detail['info_mfg_date'])->format('j M Y') : '' }}
                                    </td>

                                    <td class="w-20">
                                        {{ isset($detail['info_expiry_date']) ? \Carbon\Carbon::parse($detail['info_expiry_date'])->format('j M Y') : '' }}
                                    </td>


                                    <td class="w-20">
                                        {{ isset($detail['info_batch_size']) ? $detail['info_batch_size'] : '' }}
                                    </td>

                                    <td class="w-20">
                                        {{ isset($detail['info_pack_size']) ? $detail['info_pack_size'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['info_dispatch_quantity']) ? $detail['info_dispatch_quantity'] : '' }}
                                    </td>

                                    <td class="w-20">
                                        {{ isset($detail['info_remarks']) ? $detail['info_remarks'] : '' }}
                                    </td>
                                    {{-- <td class="w-15">{{ $data->detail && unserialize($data->detail->info_product_name)[$key] ?  unserialize($data->detail->info_product_name)[$key]: "Not Applicable"}}</td>
                                       <td class="w-15">{{ $data->detail && unserialize($data->detail->info_batch_no)[$key] ?  unserialize($data->detail->info_batch_no)[$key]: "Not Applicable"}}</td>
                                       <td class="w-15">{{ $data->detail && unserialize($data->detail->info_mfg_date)[$key] ?  unserialize($data->detail->info_mfg_date)[$key]: "Not Applicable"}}</td>
                                       <td class="w-15">{{ $data->detail && unserialize($data->detail->info_expiry_date)[$key] ?  unserialize($data->detail->info_expiry_date)[$key]: "Not Applicable"}}</td> --}}

                                </tr>
                            @endforeach
                        @else
                        <tr>
                                <td>1</td>
                                <td colspan="8">Not Applicable</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>

            <br>

            <div class="border-table">
                <div class="block-head">
                    Traceability
                </div>

                <table>
                    <tr class="table_bg">
                        <th>Sr.No.</th>
                        <th class="w-10">Product Name</th>
                        <th class="w-20">Batch No.</th>
                        <th class="10">Manufacturing Location</th>
                        <th class="w-5">Remarks</th>
                        {{-- <th class="w-5">Action</th> --}}
                    </tr>

                    <tbody>
                        @php $productsdetails = 1; @endphp
                        @if (!empty($gitracebilty) && is_array($gitracebilty->data))

                            @foreach ($gitracebilty->data as $index => $detail)
                                <tr>
                                    <td>{{ $productsdetails++ }}</td>
                                    <td class="w-20">
                                        {{ isset($detail['product_name_tr']) ? $detail['product_name_tr'] : '' }} </td>
                                    <td class="w-20">
                                        {{ isset($detail['batch_no_tr']) ? $detail['batch_no_tr'] : '' }} </td>
                                    <td class="w-20">
                                        {{ isset($detail['manufacturing_location_tr']) ? $detail['manufacturing_location_tr'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['remarks_tr']) ? $detail['remarks_tr'] : '' }} </td>
                                    {{-- <td class="w-20"> {{ isset($detail['Action']) ? $detail['Action'] : '' }} </td> --}}

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>1</td>

                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                {{-- <td>Not Applicable</td> --}}

                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>

             <table>
                    <tr>
                    <th class="w-20">Categorization Of Complaint</th>
                        <td class="w-30">{{ $data->categorization_of_complaint_gi ?? 'Not Applicable' }}</td>

                    
                        
                    <th class="w-20">Is Repeat</th>
                        <td class="w-30" >{{ ucfirst($data->is_repeat_gi ?? 'Not Applicable') }}</td>

                    </tr>
                
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-30" colspan="3">{{ $data->repeat_nature_gi ?? 'Not Applicable' }}</td>
                    </tr>
                </table>



                <table>
                   
                </table>



                <table>

                <tr>
                        <th class="w-20 align-top">Review Of Complaint Sample</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_complaint_sample_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_complaint_sample_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20 align-top">Review Of Control Sample</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_control_sample_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_control_sample_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    

                    
                </table>
                <table>
                    
                    <tr>
                        <th class="w-20 align-top">Review of Stability Study Program and Samples</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_stability_study_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_stability_study_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20 align-top">Review of Product Manufacturing and Analytical Process</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_product_manu_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_product_manu_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    
                </table>
                <table>
                    

                    <tr>
                        <th class="w-20 align-top">Additional Information if Require</th>
                        <td class="w-80" colspan="3">
                            @if ($data->additional_inform)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->additional_inform !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                   

                    <tr>
                        <th class="w-20 align-top">Type of Market Complaints</th>
                        <td class="w-80" colspan="3">
                            @if ($data->probable_root_causes_complaint_hodsr)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->probable_root_causes_complaint_hodsr !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20 align-top">Comments</th>
                        <td class="w-80" colspan="3">
                            @if ($data->in_case_Invalide_com)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->in_case_Invalide_com !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            
            

           
            <br>

            <div class="block-head">
            Complaint Acknowledgement
            </div>
              
            <table>
                    

                    <tr>
                        <th class="w-20 align-top">Manufacturer Name & Address</th>
                        <td class="w-80" colspan="3">
                            @if ($data->manufacturer_name_address_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->manufacturer_name_address_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
            </table>
            
            <div class="border-table">
                <div class="block-head">
                    Product Details 
                </div>

                <table>
                    <tr class="table_bg">
                        <th>Sr. No.</th>
                        <th class="w-10">Product Name</th>
                        <th class="w-10">Batch No.</th>
                        <th class="w-10">Mfg. Date</th>
                        <th class="w-10">Exp. Date</th>
                        <th class="w-10">Batch Size</th>
                        <th class="w-10">Pack Size</th>
                        <th class="w-10">Released Quantity</th>
                        <th class="w-10">Remarks</th>
                    </tr>

                    <tbody>
                        @php $productsdetails = 1; @endphp

                        @if (!empty($marketrproducts) && is_array($marketrproducts->data))
                            @foreach ($marketrproducts->data as $index => $detaildata)
                                <tr>
                                    <td>{{ $productsdetails++ }}</td>
                                    <td class="w-20">{{ $detaildata['product_name_ca'] ?? '' }}</td>
                                    <td class="w-20">{{ $detaildata['batch_no_pmd_ca'] ?? '' }}</td>

                                    <td class="w-20">
                                        {{ !empty($detaildata['mfg_date_pmd_ca_text']) ? \Carbon\Carbon::parse($detaildata['mfg_date_pmd_ca_text'])->format('j M Y') : '' }}
                                    </td>

                                    <td class="w-20">
                                        {{ !empty($detaildata['expiry_date_pmd_ca_text']) ? \Carbon\Carbon::parse($detaildata['expiry_date_pmd_ca_text'])->format('j M Y') : '' }}
                                    </td>

                                    <td class="w-20">{{ $detaildata['batch_size_pmd_ca'] ?? '' }}</td>
                                    <td class="w-20">{{ $detaildata['pack_profile_pmd_ca'] ?? '' }}</td>
                                    <td class="w-20">{{ $detaildata['released_quantity_pmd_ca'] ?? '' }}</td>
                                    <td class="w-20">{{ $detaildata['remarks_ca'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>1</td>
                                <td colspan="8">Not Applicable</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
            <br>



            <table>
                    
                    <tr>
                        <th class="w-20">Complaint Sample Required</th>
                        <td class="w-80">{!! $data->complaint_sample_required_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Complaint Sample Status</th>
                        <td class="w-80" colspan="3">
                            @if ($data->complaint_sample_status_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->complaint_sample_status_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    

                    <tr>
                        <th class="w-20 align-top">Brief Description of Complaint</th>
                        <td class="w-80" colspan="3">
                            @if ($data->brief_description_of_complaint_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->brief_description_of_complaint_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <th class="w-20 align-top">Batch Record Review Observation</th>
                        <td class="w-80" colspan="3">
                            @if ($data->batch_record_review_observation_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->batch_record_review_observation_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   
                    
                    <tr>
                        <th class="w-20 align-top">Analytical Data Review Observation</th>
                        <td class="w-80" colspan="3">
                            @if ($data->analytical_data_review_observation_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->analytical_data_review_observation_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Retention Sample Review Observation</th>
                        <td class="w-80" colspan="3">
                            @if ($data->retention_sample_review_observation_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->retention_sample_review_observation_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="w-20 align-top">Stablity Study Data Review</th>
                        <td class="w-80" colspan="3">
                            @if ($data->stability_study_data_review_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->stability_study_data_review_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                  
                    <tr>
                        <th class="w-20 align-top">QMS Events(if Any) Review Observation</th>
                        <td class="w-80" colspan="3">
                            @if ($data->qms_events_ifany_review_observation_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->qms_events_ifany_review_observation_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Repeated Complaints/Queries For Product</th>
                        <td class="w-80" colspan="3">
                            @if ($data->repeated_complaints_queries_for_product_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->repeated_complaints_queries_for_product_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Interpretation on Complaint sample(if recieved)</th>
                        <td class="w-80" colspan="3">
                            @if ($data->interpretation_on_complaint_sample_ifrecieved_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->interpretation_on_complaint_sample_ifrecieved_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <!-- <tr>
                        <th class="w-20">Comments (if any)</th>
                        <td class="w-80">{!! $data->comments_ifany_ca ?? 'Not Applicable' !!}</td>
                    </tr> -->

                    <tr>
                        <th class="w-20 align-top">Comments (if any)</th>
                        <td class="w-80" colspan="3">
                            @if ($data->comments_ifany_ca)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->comments_ifany_ca !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
           
           



            <div class="border-table">
                    <div class="block-head">
                        Proposal To Accomplish Investigation
                    </div>

                    <table>


                        <thead>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr. No.</th>
                                <th style="width: 40%;">Requirements</th>
                                <th style="width: 10%;">Yes/No</th>
                                {{-- <th style="width: 20%;">Expected Date of Investigation Completion</th> --}}
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Complaint Sample Required</td>
                                <td>{{ucfirst( $proposalData['Complaint sample Required']['csr3'] ?? 'N/A') }}</td>
                                {{-- <td>{{ $proposalData['Complaint sample Required']['csr1'] ?? 'N/A' }}</td> --}}
                                <td>{{ $proposalData['Complaint sample Required']['csr2'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Additional Info. From Complaint</td>
                                <td>{{ ucfirst($proposalData['Additional info. From Complainant']['afc3'] ?? 'N/A') }}</td>
                                {{-- <td>{{ $proposalData['Additional info. From Complainant']['afc1'] ?? 'N/A' }}</td> --}}
                                <td>{{ $proposalData['Additional info. From Complainant']['afc2'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Analysis of Complaint Sample</td>
                                <td>{{ucfirst( $proposalData['Analysis of complaint Sample']['acs3'] ?? 'N/A') }}</td>
                                {{-- <td>{{ $proposalData['Analysis of complaint Sample']['acs1'] ?? 'N/A' }}</td> --}}
                                <td>{{ $proposalData['Analysis of complaint Sample']['acs2'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>QRM Approach</td>
                                <td>{{ ucfirst( $proposalData['QRM Approach']['qrm3'] ?? 'N/A') }}</td>
                                {{-- <td>{{ $proposalData['QRM Approach']['qrm1'] ?? 'N/A' }}</td> --}}
                                <td>{{ $proposalData['QRM Approach']['qrm2'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>Others</td>
                                <td>{{ ucfirst($proposalData['Others']['oth3'] ?? 'N/A') }}</td>
                                {{-- <td>{{ $proposalData['Others']['oth1'] ?? 'N/A' }}</td> --}}
                                <td>{{ $proposalData['Others']['oth2'] ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>



                <table>
                    <tr>
                        <th class="w-20">Expected Date of Investigation Completion</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->Expecteddate_of_investigation_completion) ?? 'Not Applicable' }}</td>
                        {{-- <th class="w-20">Repeat Nature</th>
                        <td class="w-80">{!! $data->repeat_nature_gi ?? 'Not Applicable' !!}</td> --}}
                    </tr>
                </table>



             <br>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Acknowledgment Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data->initial_attachment_ca)
                                @foreach (json_decode($data->initial_attachment_ca) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <div class="block">
                <div class="block-head">
                    QA/CQA Head Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Head Comment</th>
                        <td class="w-80">{!! $data->qa_head_comment ?? 'Not Applicable' !!}</td>
                        <!-- Add more rows for the remaining fields in the same format -->
                    </tr>
                </table>

                <div class="border-table">

                    <div class="border-table">
                        <div class="block-head">
                            QA/CQA Head Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data->qa_cqa_he_attach)
                                @foreach (json_decode($data->qa_cqa_he_attach) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    </table>
                </div>
            </div>



            @php
                $investingTeamIndex = 1;
            @endphp
            <div class="block">
                <div class="block-head">
                    Investigation
                </div>

                <div class="border-table">
                    <div class="block-head">
                        Investigation Team
                    </div>

                    <table>
                        <tr class="table_bg">
                            <th class="w-2">Sr.No.</th>
                            <th class="w-30">Name</th>
                            <th class="w-30">Department</th>
                            <th class="w-30">Remarks</th> 
                            {{-- <th class="w-5">Action</th> --}}
                        </tr>

                        <tbody>
                            @php $investingTeamIndex = 1; @endphp
                            @if (!empty($giinvesting) && is_array($giinvesting->data))

                                @foreach ($giinvesting->data as $index => $inves)
                                    <tr>
                                        <td>{{ $investingTeamIndex++ }}</td>
                                        <td class="w-20">
                                            {{  Helpers::getInitiatorName(isset($inves['name_inv_tem'])) ?   Helpers::getInitiatorName($inves['name_inv_tem']) : '' }} </td>
                                        <td class="w-20">
                                            {{ isset($inves['department_inv_tem']) ? $inves['department_inv_tem'] : '' }}
                                        </td>
                                        <td class="w-20">
                                            {{ isset($inves['remarks_inv_tem']) ? $inves['remarks_inv_tem'] : '' }}
                                        </td>
                                        {{-- <td class="w-20"> {{ isset($detail['Action']) ? $detail['Action'] : '' }}
                                        </td> --}}

                                    </tr>
                                @endforeach
                            @else
                                <tr>

                                    <td>1</td>

                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    {{-- <td>Not Applicable</td> --}}

                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>

                <table>
                    

                    <tr>
                        <th class="w-20 align-top">Review Of Batch Manufacturing Record (BMR)</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_batch_manufacturing_record_BMR_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_batch_manufacturing_record_BMR_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Review Of Raw Materials Used In Batch Manufacturing</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_raw_materials_used_in_batch_manufacturing_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_raw_materials_used_in_batch_manufacturing_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="w-20 align-top">Review Of Batch Packing Record (BPR)</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_Batch_Packing_record_bpr_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_Batch_Packing_record_bpr_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Review Of Packing Materials Used In Batch Packing</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_packing_materials_used_in_batch_packing_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_packing_materials_used_in_batch_packing_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                  

                    <tr>
                        <th class="w-20 align-top">Review Of Analytical Data</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_analytical_data_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_analytical_data_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Review of Complaint Sample (if applicable)</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_complaint_sample_if)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_complaint_sample_if !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                   

                    <tr>
                        <th class="w-20 align-top">Review Of Training Record Of Concern Persons</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_training_record_of_concern_persons_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_training_record_of_concern_persons_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                  

                    <tr>
                        <th class="w-20 align-top">Review of Equipment/Instrument qualification/Calibration Record</th>
                        <td class="w-80" colspan="3">
                            @if ($data->rev_eq_inst_qual_calib_record_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->rev_eq_inst_qual_calib_record_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Review of Equipment Break-down and Maintenance Record</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_equipment_break_down_and_maintainance_record_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_equipment_break_down_and_maintainance_record_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    


                    <tr>
                        <th class="w-20 align-top">Review Of Past History Of Product</th>
                        <td class="w-80" colspan="3">
                            @if ($data->review_of_past_history_of_product_gi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->review_of_past_history_of_product_gi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

                    <div class="border-table">
                <div class="block-head">
                    Brain Storming Session/Discussion With Concerned Person
                </div>

                <table>
                    <tr class="table_bg">
                        <th>Sr.No.</th>
                        <th class="w-10">Possibility</th>
                        <th class="w-20">Facts/Controls</th>
                        <th class="w-20">Probable Cause</th>
                        <th class="w-5">Remarks</th>
                        {{-- <th class="w-5">Action</th> --}}
                    </tr>

                    <tbody>
                        @php $productsdetails = 1; @endphp
                        @if (!empty($brain) && is_array($brain->data))

                            @foreach ($brain->data as $index => $detail)
                                <tr>
                                    <td>{{ $productsdetails++ }}</td>
                                    <td class="w-20">
                                        {{ isset($detail['possibility_bssd']) ? $detail['possibility_bssd'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['factscontrols_bssd']) ? $detail['factscontrols_bssd'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['probable_cause_bssd']) ? $detail['probable_cause_bssd'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['remarks_bssd']) ? $detail['remarks_bssd'] : '' }} </td>
                                    {{-- <td class="w-20"> {{ isset($detail['Action']) ? $detail['Action'] : '' }} </td> --}}

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>1</td>

                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                {{-- <td>Not Applicable</td> --}}

                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
             <table>
                   

                    <tr>
                        <th class="w-20 align-top">Conclusion</th>
                        <td class="w-80" colspan="3">
                            @if ($data->conclusion_pi)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->conclusion_pi !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    
                    

                    <tr>
                        <th class="w-20 align-top">Root Cause Analysis</th>
                        <td class="w-80" colspan="3">
                            @if ($data->conclusion_hodsr)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->conclusion_hodsr !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">Other Methodology</th>
                        <td class="w-80" colspan="3">
                            @if ($data->root_cause_analysis_hodsr)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->root_cause_analysis_hodsr !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   

                    <tr>
                        <th class="w-20 align-top">The Probable Root Causes or Root Cause</th>
                        <td class="w-80" colspan="3">
                            @if ($data->the_probable_root)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->the_probable_root !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    

                    <tr>
                        <th class="w-20 align-top">Impact Assessment</th>
                        <td class="w-80" colspan="3">
                            @if ($data->impact_assessment_hodsr)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->impact_assessment_hodsr !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                   
                    <tr>
                        <th class="w-20 align-top">Corrective Action</th>
                        <td class="w-80" colspan="3">
                            @if ($data->corrective_action_hodsr)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->corrective_action_hodsr !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    

                    <tr>
                        <th class="w-20 align-top">Preventive Action</th>
                        <td class="w-80" colspan="3">
                            @if ($data->preventive_action_hodsr)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->preventive_action_hodsr !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    


                    <tr>
                        <th class="w-20 align-top">Summary and Conclusion</th>
                        <td class="w-80" colspan="3">
                            @if ($data->summary_and_conclusion_hodsr)
                                <div class="summernote-content table-responsive" style="overflow-x: auto;">
                                    
                                    {!! $data->summary_and_conclusion_hodsr !!}
                                </div>
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        

            
            <div class="border-table">

            <div class="border-table">
                <div class="block-head">
                Investigation attachment
                </div>
                <table>
                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">attachment</th>
                    </tr>
                    @if ($data->investigation_attach)
                        @foreach (json_decode($data->investigation_attach) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-60">Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>
            </table>
            </div>
            </div>

            
<!-- 
            <div class="border-table">
                <div class="block-head">
                    Report Review (Final Review shall be done after QA Verification)
                </div>

                <table>
                    <tr class="table_bg">
                        <th>Row #</th>
                        <th class="w-10">Name</th>
                        <th class="w-10">Designation</th>
                        <th class="w-20">Department</th>
                        <th class="w-20">Sign</th>
                        <th class="w-5">Date</th>
                        {{-- <th class="w-5">Action</th> --}}
                    </tr>

                    <tbody>
                        @php $productsdetails = 1; @endphp
                        @if (!empty($hodteammembers) && is_array($hodteammembers->data))

                            @foreach ($hodteammembers->data as $index => $detail)
                                <tr>
                                    <td>{{ $productsdetails++ }}</td>
                                    <td class="w-20"> {{ isset($detail['names_tm']) ? $detail['names_tm'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['designation']) ? $detail['designation'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['department_tm']) ? $detail['department_tm'] : '' }} </td>
                                    <td class="w-20"> {{ isset($detail['sign_tm']) ? $detail['sign_tm'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['date_tm']) ? \Carbon\Carbon::parse($detail['date_tm'])->format('j M Y') : '' }}
                                    </td>

                                    {{-- <td class="w-20"> {{ isset($detail['Action']) ? $detail['Action'] : '' }} </td> --}}

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

                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>

            <br>
            <div class="border-table">
                <div class="block-head">
                    Report Approval by Head QA/CQA (Final Approvalshall be done after QA Verification)
                </div>

                <table>
                    <tr class="table_bg">
                        <th>Row #</th>
                        <th class="w-10">Name</th>
                        <th class="w-10">Designation</th>
                        <th class="w-20">Department</th>
                        <th class="w-20">Sign</th>
                        <th class="w-5">Date</th>
                        {{-- <th class="w-5">Action</th> --}}
                    </tr>

                    <tbody>
                        @php $productsdetails = 1; @endphp
                        @if (!empty($hodreportapproval) && is_array($hodreportapproval->data))

                            @foreach ($hodreportapproval->data as $index => $detail)
                                <tr>
                                    <td>{{ $productsdetails++ }}</td>
                                    <td class="w-20"> {{ isset($detail['names_rrv']) ? $detail['names_rrv'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['designation']) ? $detail['designation'] : '' }} </td>
                                    <td class="w-20">
                                        {{ isset($detail['department_rrv']) ? $detail['department_rrv'] : '' }} </td>
                                    <td class="w-20"> {{ isset($detail['sign_rrv']) ? $detail['sign_rrv'] : '' }}
                                    </td>
                                    <td class="w-20"> {{ isset($detail['date_rrv']) ? $detail['date_rrv'] : '' }}
                                    </td>
                                    {{-- <td class="w-20"> {{ isset($detail['Action']) ? $detail['Action'] : '' }} </td> --}}

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

                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
            <br>
            <div class="block">
                
                
                {{-- <div class="report-section">
                    <h3>Proposal to Accomplish Investigation Report</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr. No.</th>
                                <th style="width: 40%;">Requirements</th>
                                <th style="width: 10%;">Yes/No</th>
                                <th style="width: 20%;">Expected Date of Investigation Completion</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Complaint Sample Required</td>
                                <td>{{ $proposalData['Complaint sample Required']['csr3'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['Complaint sample Required']['csr1'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['Complaint sample Required']['csr2'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Additional Info. From Complaint</td>
                                <td>{{ $proposalData['Additional info. From Complainant']['afc3'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['Additional info. From Complainant']['afc1'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['Additional info. From Complainant']['afc2'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Analysis of Complaint Sample</td>
                                <td>{{ $proposalData['Analysis of complaint Sample']['acs3'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['Analysis of complaint Sample']['acs1'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['Analysis of complaint Sample']['acs2'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>QRM Approach</td>
                                <td>{{ $proposalData['QRM Approach']['qrm3'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['QRM Approach']['qrm1'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['QRM Approach']['qrm2'] ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>Others</td>
                                <td>{{ $proposalData['Others']['oth3'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['Others']['oth1'] ?? 'N/A' }}</td>
                                <td>{{ $proposalData['Others']['oth2'] ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}
               

              
                <br>

                <div class="border-table">
                    <div class="block-head">
                        Product Material Details Part 1
                    </div>


                    <table>
                        <tr class="table_bg">
                            <th class="w-10">Row #</th>
                            <th class="w-20">Product Name</th>
                            <th class="w-10">Batch No.</th>
                            <th class="w-10">Mfg. Date</th>
                            <th class="w-10">Exp. Date</th>
                        </tr>

                        <tbody>

                            @php $productsdetails = 1; @endphp
                            @if (!empty($marketrproducts) && is_array($marketrproducts->data))
                                @foreach ($marketrproducts->data as $detail)
                                    <tr>
                                        <td>{{ $productsdetails++ }}</td>


                                        <td class="w-20">
                                            {{ isset($detail['product_name_ca']) ? $detail['product_name_ca'] : '' }}
                                        </td>

                                        <td class="w-20">
                                            {{ isset($detail['batch_no_pmd_ca']) ? $detail['batch_no_pmd_ca'] : '' }}
                                        </td>

                                        <td class="w-20">
                                            {{ isset($detail['mfg_date_pmd_ca']) ? \Carbon\Carbon::parse($detail['mfg_date_pmd_ca'])->format('j M Y') : '' }}
                                        </td>

                                        <td class="w-20">
                                            {{ isset($detail['expiry_date_pmd_ca']) ? \Carbon\Carbon::parse($detail['expiry_date_pmd_ca'])->format('j M Y') : '' }}
                                        </td>


                                        {{-- <td class="w-15">{{ $data->detail && unserialize($data->detail->info_product_name)[$key] ?  unserialize($data->detail->info_product_name)[$key]: "Not Applicable"}}</td>
                                       <td class="w-15">{{ $data->detail && unserialize($data->detail->info_batch_no)[$key] ?  unserialize($data->detail->info_batch_no)[$key]: "Not Applicable"}}</td>
                                       <td class="w-15">{{ $data->detail && unserialize($data->detail->info_mfg_date)[$key] ?  unserialize($data->detail->info_mfg_date)[$key]: "Not Applicable"}}</td>
                                       <td class="w-15">{{ $data->detail && unserialize($data->detail->info_expiry_date)[$key] ?  unserialize($data->detail->info_expiry_date)[$key]: "Not Applicable"}}</td> --}}

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>1</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>

                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>

                <br>

                <div class="border-table">
                    <div class="block-head">
                        Product Material Details Part 2
                    </div>

                    <table>
                        <tr class="table_bg">
                            <th>Row #</th>
                            <th class="w-10">Batch Size</th>
                            <th class="w-20">Pack Profile</th>
                            <th class="10">Released Quantity</th>
                            <th class="w-5">Remarks</th>
                            {{-- <th class="w-5">Action</th> --}}
                        </tr>

                        <tbody>
                            @php $productsdetails = 1; @endphp
                            @if (!empty($marketrproducts) && is_array($marketrproducts->data))

                                @foreach ($marketrproducts->data as $index => $detail)
                                    <tr>
                                        <td>{{ $productsdetails++ }}</td>
                                        <td class="w-20">
                                            {{ isset($detail['batch_size_pmd_ca']) ? $detail['batch_size_pmd_ca'] : '' }}
                                        </td>
                                        <td class="w-20">
                                            {{ isset($detail['pack_profile_pmd_ca']) ? $detail['pack_profile_pmd_ca'] : '' }}
                                        </td>
                                        <td class="w-20">
                                            {{ isset($detail['released_quantity_pmd_ca']) ? $detail['released_quantity_pmd_ca'] : '' }}
                                        </td>
                                        <td class="w-20">
                                            {{ isset($detail['remarks_ca']) ? $detail['remarks_ca'] : '' }} </td>
                                        {{-- <td class="w-20"> {{ isset($detail['Action']) ? $detail['Action'] : '' }}
                                        </td> --}}

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>1</td>

                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    {{-- <td>Not Applicable</td> --}}

                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>

            <br> -->

            
            

          


            <br>

            <div class="block">
                <div class="block-head">
                    CFT Review
                </div>
                <div class="block-head">Production (Table/Capsule/Powder)</div>
                <table>
                    <tr>
                        <th class="w-20">Production Tablet/Capsule/Powder Review Required?</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_Review)
                                {{ucfirst($data1->Production_Table_Review )}}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        {{-- <td class="w-30"> <div> @if ($data1->Production_Review)  {{ $data1->Production_Review }} @else Not Applicable  @endif </div>  </td> --}}
                        <th class="w-20">Production Tablet/Capsule/Powder Person</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_Person)
                                {{ $data1->Production_Table_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Assessment(By Production (Tablet/Capsule/Powder))</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Production_Table_Assessment)
                                {{ strip_tags($data1->Production_Table_Assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <!-- <th class="w-20">Production Feedback</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_Feedback)
                                {{ strip_tags($data1->Production_Table_Feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td> -->
                    </tr>

                    <tr>
                        <th class="w-20">Production Tablet/Capsule/Powder  Review Completed by</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_By)
                                {{ $data1->Production_Table_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Tablet/Capsule/Powder  Review Completed on</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_On)
                                {{ Helpers::getdateFormat($data1->Production_Table_On) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                        Production Tablet/Capsule/Powder Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->Production_Table_Attachment)
                                @foreach (json_decode($data1->Production_Table_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>
<br>

                <div class="block-head">Production Injection</div>
                <table>
                    <tr>
                        <th class="w-20">Production Injection Review Required?</th>
                        <td class="w-30">
                            @if ($data1->Production_Injection_Review)
                                {{ ucfirst($data1->Production_Injection_Review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        {{-- <td class="w-30"> <div> @if ($data1->Production_Review)  {{ $data1->Production_Review }} @else Not Applicable  @endif </div>  </td> --}}
                        <th class="w-20">Production Injection Person</th>
                        <td class="w-30">
                            @if ($data1->Production_Injection_Person)
                                {{ $data1->Production_Injection_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Production Injection)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Production_Injection_Assessment)
                                {{ strip_tags($data1->Production_Injection_Assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Production Injection Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Production_Injection_Feedback)
                                {{ strip_tags($data1->Production_Injection_Feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Production Injection Review Completed by</th>
                        <td class="w-30">
                            @if ($data1->Production_Injection_By)
                                {{ ucfirst($data1->Production_Injection_By) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Injection Review Completed on</th>
                        <td class="w-30">
                            @if ($data1->Production_Injection_On)
                                {{ Helpers::getdateFormat($data1->Production_Injection_On) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                        Production Injection Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->Production_Injection_Attachment)
                                @foreach (json_decode($data1->Production_Injection_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>


                <div class="block-head">Research & Development</div>
                <table>
                    <tr>
                        <th class="w-20">Research & Development Review Required?</th>
                        <td class="w-30">
                            @if ($data1->ResearchDevelopment_Review)
                                {{ ucfirst($data1->ResearchDevelopment_Review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Research & Development Person</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_person)
                                {{ $data1->Production_Injection_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Research & Development)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->ResearchDevelopment_assessment)
                                {{ strip_tags($data1->ResearchDevelopment_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Reasearch & Development Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->ResearchDevelopment_feedback)
                                {{ strip_tags($data1->ResearchDevelopment_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Research & Development Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->ResearchDevelopment_by)
                                {{ucfirst( $data1->ResearchDevelopment_by) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Research & Development Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->ResearchDevelopment_on)
                                {{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
<br>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                        Research & Development Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->ResearchDevelopment_attachment)
                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Human Resource</div>
                <table>
                    <tr>
                        <th class="w-20">Human Resource Review Required?</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_review)
                                {{ ucfirst($data1->Human_Resource_review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Human Resource Person</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_person)
                                {{ $data1->Production_Injection_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Human Resource)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Human_Resource_assessment)
                                {{ strip_tags($data1->Human_Resource_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Humane Resource Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Human_Resource_feedback)
                                {{ strip_tags($data1->Human_Resource_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Human Resource Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_by)
                                {{ $data1->Human_Resource_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Human Resource Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_on)
                                {{ Helpers::getdateFormat($data1->Human_Resource_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                        Human Resource Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->Human_Resource_attachment)
                                @foreach (json_decode($data1->Human_Resource_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>


                <div class="block-head">Corporate Quality Assurance</div>
                <table>
                    <tr>
                        <th class="w-20">Corporate Quality Assurance Review Required?</th>
                        <td class="w-30">
                            @if ($data1->CorporateQualityAssurance_Review)
                                {{ ucfirst($data1->CorporateQualityAssurance_Review )}}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Corporate Quality Assurance Person</th>
                        <td class="w-30">
                            @if ($data1->CorporateQualityAssurance_person)
                                {{ $data1->CorporateQualityAssurance_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Corporate Quality Assurance)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->CorporateQualityAssurance_assessment)
                                {{ strip_tags($data1->CorporateQualityAssurance_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Corporate Quality Assurance Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->CorporateQualityAssurance_feedback)
                                {{ strip_tags($data1->CorporateQualityAssurance_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Corporate Quality Assurance Review  Completed By</th>
                        <td class="w-30">
                            @if ($data1->CorporateQualityAssurance_by)
                                {{ $data1->CorporateQualityAssurance_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Corporate Quality Assurance Review  Completed On</th>
                        <td class="w-30">
                            @if ($data1->CorporateQualityAssurance_on)
                                {{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Corporate Quality Assurance Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->CorporateQualityAssurance_attachment)
                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Stores</div>
                <table>
                    <tr>
                        <th class="w-20">Stores Review Required?</th>
                        <td class="w-30">
                            @if ($data1->Store_Review)
                                {{ ucfirst($data1->Store_Review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Store Person</th>
                        <td class="w-30">
                            @if ($data1->Store_person)
                                {{ $data1->Store_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Store)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Store_assessment)
                                {{ strip_tags($data1->Store_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Store Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Store_feedback)
                                {{ strip_tags($data1->Store_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Store Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->Store_by)
                                {{ $data1->Store_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Store Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->Store_on)
                                {{ Helpers::getdateFormat($data1->Store_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                        Store Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->store_attachment)
                                @foreach (json_decode($data1->store_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Engineering</div>
                <table>
                    <tr>
                        <th class="w-20">Engineering Review Required ?</th>
                        <td class="w-30">
                            @if ($data1->Engineering_review)
                                {{ucfirst( $data1->Engineering_review )}}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Engineering Person</th>
                        <td class="w-30">
                            @if ($data1->Engineering_person)
                                {{ $data1->Engineering_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Engineering)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Engineering_assessment)
                                {{ strip_tags($data1->Engineering_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Engineering Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Engineering_feedback)
                                {{ strip_tags($data1->Engineering_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Engineering Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->Engineering_by)
                                {{ $data1->Engineering_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Engineering Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->Store_on)
                                {{ Helpers::getdateFormat($data1->Store_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Engineering Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->Engineering_attachment)
                                @foreach (json_decode($data1->Engineering_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Regulatory Affair</div>
                <table>
                    <tr>
                        <th class="w-20">Regulatory Affair Review Required?</th>
                        <td class="w-30">
                            @if ($data1->RegulatoryAffair_Review)
                                {{ ucfirst($data1->RegulatoryAffair_Review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Regulatory Affair Person</th>
                        <td class="w-30">
                            @if ($data1->RegulatoryAffair_person)
                                {{ $data1->RegulatoryAffair_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Regulatory Affair)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->RegulatoryAffair_assessment)
                                {{ strip_tags($data1->RegulatoryAffair_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Regulatory Affair Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->RegulatoryAffair_feedback)
                                {{ strip_tags($data1->RegulatoryAffair_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Regulatory Affair Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->RegulatoryAffair_by)
                                {{ $data1->RegulatoryAffair_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Regulatory Affair Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->RegulatoryAffair_on)
                                {{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Regularory Affair Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->RegulatoryAffair_Attachment)
                                @foreach (json_decode($data1->RegulatoryAffair_Attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Quality Assurance</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Assurance Review Required ?</th>
                        <td class="w-30">
                            @if ($data1->Quality_Assurance_Review)
                                {{ ucfirst($data1->Quality_Assurance_Review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Assurance Person</th>
                        <td class="w-30">
                            @if ($data1->QualityAssurance_person)
                                {{ $data1->QualityAssurance_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Quality Assurance)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->QualityAssurance_assessment)
                                {{ strip_tags($data1->QualityAssurance_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Quality Assurance Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->QualityAssurance_feedback)
                                {{ strip_tags($data1->QualityAssurance_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Quality Assurance Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->QualityAssurance_by)
                                {{ $data1->QualityAssurance_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Assurance Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->QualityAssurance_on)
                                {{ Helpers::getdateFormat($data1->QualityAssurance_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Quality Assurance Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->Quality_Assurance_attachment)
                                @foreach (json_decode($data1->Quality_Assurance_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Production (Liquid/Ointment)</div>
                <table>
                    <tr>
                        <th class="w-20">Production Liquid/Ointment Review Required?</th>
                        <td class="w-30">
                            @if ($data1->ProductionLiquid_Review)
                                {{ ucfirst($data1->ProductionLiquid_Review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Liquid/Ointment Person</th>
                        <td class="w-30">
                            @if ($data1->ProductionLiquid_person)
                                {{ $data1->ProductionLiquid_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment(By Production Liquid/Ointment)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->ProductionLiquid_assessment)
                                {{ strip_tags($data1->ProductionLiquid_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Production Liquid Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->ProductionLiquid_feedback)
                                {{ strip_tags($data1->ProductionLiquid_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Production Liquid/Ointment Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->ProductionLiquid_by)
                                {{ $data1->ProductionLiquid_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Liquid/Ointment Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->ProductionLiquid_on)
                                {{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                        Production Liquid/Ointment Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->ProductionLiquid_attachment)
                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Quality Control</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Control Review Required ?</th>
                        <td class="w-30">
                            @if ($data1->Quality_review)
                                {{ ucfirst($data1->Quality_review )}}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Control Person</th>
                        <td class="w-30">
                            @if ($data1->Quality_Control_Person)
                                {{ $data1->Quality_Control_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Quality Control)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Quality_Control_assessment)
                                {{ strip_tags($data1->Quality_Control_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Quality Control Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Quality_Control_feedback)
                                {{ strip_tags($data1->Quality_Control_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Quality Control Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->Quality_Control_by)
                                {{ $data1->Quality_Control_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Control Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->Quality_Control_on)
                                {{ Helpers::getdateFormat($data1->Quality_Control_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Quality Control Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->Quality_Control_attachment)
                                @foreach (json_decode($data1->Quality_Control_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Microbiology</div>
                <table>
                    <tr>
                        <th class="w-20">Microbiology Review  Required?</th>
                        <td class="w-30">
                            @if ($data1->Microbiology_Review)
                                {{ ucfirst($data1->Microbiology_Review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Microbiology Person</th>
                        <td class="w-30">
                            @if ($data1->Microbiology_person)
                                {{ $data1->Microbiology_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment(By Microbiology)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Microbiology_assessment)
                                {{ strip_tags($data1->Microbiology_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Microbiology Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Microbiology_feedback)
                                {{ strip_tags($data1->Microbiology_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Microbiology Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->Microbiology_by)
                                {{ $data1->Microbiology_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Microbiology Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->Microbiology_on)
                                {{ Helpers::getdateFormat($data1->Microbiology_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Microbiology Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->Microbiology_attachment)
                                @foreach (json_decode($data1->Microbiology_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Safety</div>
                <table>
                    <tr>
                        <th class="w-20">Safety Review Required ?</th>
                        <td class="w-30">
                            @if ($data1->Environment_Health_review)
                                {{ ucfirst($data1->Environment_Health_review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Safety Person</th>
                        <td class="w-30">
                            @if ($data1->Environment_Health_Safety_person)
                                {{ $data1->Environment_Health_Safety_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Safety)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Health_Safety_assessment)
                                {{ strip_tags($data1->Health_Safety_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Envinronment Health Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->Health_Safety_feedback)
                                {{ strip_tags($data1->Health_Safety_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Safety Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->Environment_Health_Safety_by)
                                {{ $data1->Environment_Health_Safety_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Safety Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->Environment_Health_Safety_on)
                                {{ $data1->Environment_Health_Safety_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                        Safety Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->Environment_Health_Safety_attachment)
                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

                <br>

                <div class="block-head">Contract Giver</div>
                <table>
                    <tr>
                        <th class="w-20">Contract Giver Review Required?</th>
                        <td class="w-30">
                            @if ($data1->ContractGiver_Review)
                                {{ ucfirst($data1->ContractGiver_Review) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Contract Giver comment update by</th>
                        <td class="w-30">
                            @if ($data1->ContractGiver_person)
                                {{ $data1->Environment_Health_Safety_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impect Assessment (By Contract Giver)</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->ContractGiver_assessment)
                                {{ strip_tags($data1->ContractGiver_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <!-- <tr>
                        <th class="w-20">Contract Giver Feedback</th>
                        <td class="w-80" colspan="3">
                            @if ($data1->ContractGiver_feedback)
                                {{ strip_tags($data1->ContractGiver_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr> -->

                    <tr>
                        <th class="w-20">Contract Giver Review Completed By</th>
                        <td class="w-30">
                            @if ($data1->ContractGiver_by)
                                {{ $data1->ContractGiver_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Contract Giver Review Completed On</th>
                        <td class="w-30">
                            @if ($data1->ContractGiver_on)
                                {{ Helpers::getdateFormat($data1->ContractGiver_on) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Contract Giver Attachments
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->ContractGiver_attachment)
                                @foreach (json_decode($data1->ContractGiver_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table>

            </div>

            <div class="block">
                     <div class="head">
                            <div class="block-head">
                                Other's 1 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 1 Review Required?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_review)
                                                {{ ucfirst($data1->Other1_review )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 1 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_person)
                                                {{ $data1->Other1_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Other's 1 Department</th>
                                    <td class="w-80" colspan="3">
                                        <div>
                                            @if ($data1->Other1_Department_person)
                                                {{Helpers::getInitiatorGroups ($data1->Other1_Department_person) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                 </table>
                                <table>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 1)</th>
                                    <td class="w-80"  colspan="7">
                                        <div>
                                            @if ($data1->Other1_assessment)
                                                {{ $data1->Other1_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                 </table>
                                <table>
                                <!-- <tr>
                                    <th class="w-20">Other's 1 Feedback</th>
                                    <td class="w-80" colspan="3" colspan="5">
                                        <div>
                                            @if ($data1->Other1_feedback)
                                                {{ $data1->Other1_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 1 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_by)
                                                {{ $data1->Other1_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 1 Review Completed On</th>
                                    <td class="w-30" colspan="3">
                                        <div>
                                            @if ($data1->Other1_on)
                                                {{ Helpers::getdateFormat($data1->Other1_on) }}
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
                    <div class="block-head">
                                Other's 1 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">attachment</th>
                                </tr>
                                @if ($data1->Other1_attachment)
                                    @foreach (json_decode($data1->Other1_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>

                        <br>


                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 2 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 2 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_review)
                                                {{ ucfirst($data1->Other2_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 2 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_person)
                                                {{ $data1->Other2_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                 </table>
                                <table>
                                <tr>
                                    <th class="w-20">Other's 2 Department</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other2_Department_person)
                                                {{ $data1->Other2_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
 </table>
                                <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 2)</th>
                                    <td class="w-80"  colspan="3">
                                        <div>
                                            @if ($data1->Other2_Assessment)
                                                {{ $data1->Other2_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                    <!-- <tr>
                                    <th class="w-20">Other's 2 Feedback</th>
                                    <td class="w-80" colspan="3" colspan="5">
                                        <div>
                                            @if ($data1->Other2_feedback)
                                                {{ $data1->Other2_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 2 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_by)
                                                {{ $data1->Other2_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 2 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_on)
                                                {{ Helpers::getdateFormat($data1->Other2_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <div class="border-table">
                        <div class="block-head">

                        Other's 2 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">attachment</th>
                                </tr>
                                @if ($data1->Other2_attachment)
                                    @foreach (json_decode($data1->Other2_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>

                    <br>


                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 3 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 3 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_review)
                                                {{ ucfirst($data1->Other3_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 3 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_person)
                                                {{ $data1->Other3_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                </table>
                                <table>
                                <tr>
                                    <th class="w-20">Other's 3 Department</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other3_Department_person)
                                                {{ $data1->Other3_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                </table>
                                <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 3)</th>
                                    <td class="w-80" colspan="3" colspan="5">
                                        <div>
                                            @if ($data1->Other3_Assessment)
                                                {{ $data1->Other3_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                    </tr>
                                    <!-- <tr>

                                    <th class="w-20">Other's 3 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other3_feedback)
                                                {{ $data1->Other3_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 3 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_by)
                                                {{ $data1->Other3_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 3 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_on)
                                                {{ Helpers::getdateFormat($data1->Other3_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <div class="border-table">
                        <div class="block-head">
                                Other's 3 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">attachment</th>
                                </tr>
                                @if ($data1->Other3_attachment)
                                    @foreach (json_decode($data1->Other3_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>

                    <br>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 4 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 4 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_review)
                                                {{ ucfirst($data1->Other4_review )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 4 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_person)
                                                {{ $data1->Other4_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                </table>
                                <table>
                                <tr>
                                    <th class="w-20">Other's 4 Department</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other4_Department_person)
                                                {{ $data1->Other4_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                 </table>
                            <table>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 4)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other4_Assessment)
                                                {{ $data1->Other4_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr>
                                    <th class="w-20">Other's 4 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other4_feedback)
                                                {{ $data1->Other4_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 4 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_by)
                                                {{ $data1->Other4_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 4 Review Completed On</th>
                                    <td class="w-30" colspan="3">
                                        <div>
                                            @if ($data1->Other4_on)
                                                {{ Helpers::getdateFormat($data1->Other4_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                     <div class="border-table">
                        <div class="block-head">
                                Other's 4 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">attachment</th>
                                </tr>
                                @if ($data1->Other4_attachment)
                                    @foreach (json_decode($data1->Other4_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>

                    <br>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 5 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 5 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_review)
                                                {{ ucfirst($data1->Other5_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 5 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_person)
                                                {{ $data1->Other5_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Other's 5 Department</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Other5_Department_person)
                                                {{ $data1->Other5_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 5)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other5_Assessment)
                                                {{ $data1->Other5_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr>
                                    <th class="w-20">Other's 5 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other5_feedback)
                                                {{ $data1->Other5_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>

                                    <th class="w-20">Other's 5 Review Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_by)
                                                {{ $data1->Other5_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 5 Review Completed On</th>
                                    <td class="w-30" colspan="3">
                                        <div>
                                            @if ($data1->Other5_on)
                                                {{ Helpers::getdateFormat($data1->Other5_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <div class="border-table">
                        <div class="block-head">
                                Other's 5 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">attachment</th>
                                </tr>
                                @if ($data1->Other5_attachment)
                                    @foreach (json_decode($data1->Other5_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>

            <br>



            <div class="block">
                <div class="block-head">
                    All Action Completion Verification by QA/CQA
                </div>
                <table>

                    <tr>
                        <th class="w-20">QA/CQA Comment</th>
                        <td class="w-80">{!! $data->qa_cqa_comments ?? 'Not Applicable' !!}</td>
                        <!-- Add more rows for the remaining fields in the same format -->
                    </tr>
                </table>

                {{-- <table>
                    <div class="border-table">
                        <div class="block-head">
                            QA/CQA Verification Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->qa_cqa_attachments)
                                @foreach (json_decode($data1->qa_cqa_attachments) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table> --}}
                <div class="border-table">

                    <div class="border-table">
                        <div class="block-head">
                            QA/CQA Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data->qa_cqa_attachments)
                                @foreach (json_decode($data->qa_cqa_attachments) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    </table>
                </div>
            </div>


            <div class="block">
                <div class="block-head">
                    QA/CQA Head Approval
                </div>
                <table>

                    <tr>
                        <th class="w-20">QA/CQA Head Approval Comment</th>
                        <td class="w-80">{!! $data->qa_cqa_head_comm ?? 'Not Applicable' !!}</td>
                        <!-- Add more rows for the remaining fields in the same format -->
                    </tr>
                </table>

                <div class="border-table">

                    <div class="border-table">
                        <div class="block-head">
                            QA/CQA  Head Approval Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data->qa_cqa_head_attach)
                                @foreach (json_decode($data->qa_cqa_head_attach) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    </table>
                </div>

            </div>




            <div class="block">
                <div class="block-head">
                    Closure
                </div>
                <table>
                    <tr>
                        <th class="w-20">Closure Comment</th>
                        <td class="w-80">{!! $data->closure_comment_c ?? 'Not Applicable' !!}</td>
                        <!-- Add more rows for the remaining fields in the same format -->
                    </tr>
                    {{-- <tr>
                        <th class="w-20">Closure Attachment</th>
                        <td class="w-80">
                            @if ($data->initial_attachment_c)
                                <a href="{{ asset('upload/' . $data->initial_attachment_c) }}"
                                    target="_blank">{{ $data->initial_attachment_c }}</a>
                            @else
                                Not Attached
                            @endif
                        </td>
                    </tr> --}}
                </table>
                {{--
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Closure Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data1->initial_attachment_c)
                                @foreach (json_decode($data1->initial_attachment_c) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </table> --}}
                <div class="border-table">

                    <div class="border-table">
                        <div class="block-head">
                            Closure Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">attachment</th>
                            </tr>
                            @if ($data->initial_attachment_c)
                                @foreach (json_decode($data->initial_attachment_c) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    </table>
                </div>
            </div>

            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-30">
                            <div>
                                @if ($data->submitted_by)
                                    {{ $data->submitted_by }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                        <th class="w-20">Submit On</th>
                        <td class="w-30">
                            <div>
                                @if ($data->submitted_on)
                                    {{ $data->submitted_on }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                        <th class="w-20">Submit Comment</th>
                        <td class="w-30">
                            <div>
                                @if ($data->submitted_comment)
                                    {{ $data->submitted_comment }}
                                @else
                                    Not Applicable
                                @endif
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Complete Review By</th>
                        <td class="w-30">
                            @if ($data->complete_review_by)
                                {{ $data->complete_review_by }}
                            @else
                                Not Applicable
                            @endif
                         </td>
                        <th class="w-20">Complete Review On</th>
                        <td class="w-30">
                            @if ($data->complete_review_on)
                                {{ $data->complete_review_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Complete Review Comment</th>
                        <td class="w-30">
                            @if ($data->complete_review_Comments)
                                {{ $data->complete_review_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">
                            @if ($data->cancelled_by)
                                {{ $data->cancelled_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-30">
                            @if ($data->cancelled_on)
                                {{ $data->cancelled_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-30">
                            @if ($data->cancelled_comment)
                                {{ $data->cancelled_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Send To CFT Review By</th>
                        <td class="w-30">
                            @if ($data->cft_complate_by)
                                {{ $data->cft_complate_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Send To CFT Review On</th>
                        <td class="w-30">
                            @if ($data->cft_complate_on)
                                {{ $data->cft_complate_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Send To CFT Review Comment</th>
                        <td class="w-30">
                            @if ($data->send_cft_comment)
                                {{ $data->send_cft_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">CFT Review Complete By</th>
                        <td class="w-30">
                            @if ($data->cft_complate_by)
                                {{ $data->cft_complate_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">CFT Review Complete On</th>
                        <td class="w-30">
                            @if ($data->cft_complate_on)
                                {{ $data->cft_complate_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">CFT Review Complete Comment</th>
                        <td class="w-30">
                            @if ($data->cft_complate_comm)
                                {{ $data->cft_complate_comm }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">QA/CQA Verification Complete By :</th>
                        <td class="w-30">
                            @if ($data->qa_cqa_verif_comp_by)
                                {{ $data->qa_cqa_verif_comp_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA/CQA Verification Complete On :</th>
                        <td class="w-30">
                            @if ($data->qa_cqa_verif_comp_on)
                                {{ $data->qa_cqa_verif_comp_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA/CQA Verification Complete Comment</th>
                        <td class="w-30">
                            @if ($data->QA_cqa_verif_Comments)
                                {{ $data->QA_cqa_verif_Comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    {{-- <tr>
                        <th class="w-20">QA Head Approval Completed By</th>
                        <td class="w-80">{{ $data->qA_head_approval_completed_by }}</td>
                        <th class="w-20">QA Head Approval Completed On</th>
                        <td class="w-80">{{ $data->qA_head_approval_completed_on }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Approval Complete By</th>
                        <td class="w-30">
                            @if ($data->approve_plan_by)
                                {{ $data->approve_plan_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Approval Complete On</th>
                        <td class="w-30">
                            @if ($data->approve_plan_on)
                                {{ $data->approve_plan_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Approval Complete Comment</th>
                        <td class="w-30">
                            @if ($data->approve_plan_comment)
                                {{ $data->approve_plan_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">Send Letter By</th>
                        <td class="w-30">
                            @if ($data->send_letter_by)
                                {{ $data->send_letter_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Send Letter On</th>
                        <td class="w-30">
                            @if ($data->send_letter_on)
                                {{ $data->send_letter_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Send Letter Comment</th>
                        <td class="w-30">
                            @if ($data->send_letter_comment)
                                {{ $data->send_letter_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    {{-- <tr>
                        <th class="w-20">Closure Done By</th>
                        <td class="w-80">{{ $data->closed_done_by }}</td>
                        <th class="w-20">Closure Done On</th>
                        <td class="w-80">{{ $data->closed_done_on }}</td>
                    </tr>
                     <tr>
                         <th class="w-20">Comment</th>
                        <td class="w-80">{{ $data->submitted_comment }}</td>
                    </tr> --}}

                </table>
            </div>
        </div>
    </div>
    @endforeach

@foreach($records as $data)

    @if(optional($data->extensions)->count())

        @foreach ($data->extensions as $data)

            <center><h3>Extensions Report</h3></center>

            <div class="inner-block">
                <div class="content-table">
                    <div class="block">
                        <div class="block-head">General Information</div>
                        <table>
                            <tr>
                                <th class="w-20">Record Number</th>
                                <td class="w-30">
                                    @if ($data->record_number)
                                        {{ Helpers::divisionNameForQMS($data->site_location_code) }}/Ext/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Site/Location Code</th>
                                <td class="w-30">
                                    @if ($data->site_location_code)
                                        {{ Helpers::getDivisionName($data->site_location_code) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Initiator</th>
                                <td class="w-30">{{ Helpers::getInitiatorName($data->initiator) }}</td>
                                <th class="w-20">Date of Initiation</th>
                                <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20">Short Description</th>
                                <td class="w-80">
                                    @if ($data->short_description)
                                        {{ $data->short_description }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Extension Number</th>
                                <td class="w-30">
                                    @if ($data->count)
                                        {{ $data->count }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            
                                <th class="w-20">HOD Review</th>
                                <td class="w-30">
                                    @if ($data->reviewers)
                                        {{ Helpers::getInitiatorName($data->reviewers) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20">Parent Record Number</th>
                                <td class="w-30">
                                    @if ($data->related_records)
                                        {{ str_replace(',', ', ', $data->related_records) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                                <th class="w-20">QA/CQA Approval</th>
                                <td class="w-30">
                                    @if ($data->approvers)
                                        {{ Helpers::getInitiatorName($data->approvers) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-20">Current Due Date (Parent)</th>
                                <td class="w-30">
                                    @if ($data->current_due_date)
                                        {{ Helpers::getdateFormat($data->current_due_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                                <th class="w-20">Proposed Due Date</th>
                                <td class="w-30">
                                    @if ($data->proposed_due_date)
                                        {{ Helpers::getdateFormat($data->proposed_due_date) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                                <th class="w-20"> Description</th>
                                <td class="w-80">
                                    @if ($data->description)
                                        {{ $data->description }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                            <tr>    
                                <th class="w-20">Justification / Reason</th>
                                <td class="w-80">
                                    @if ($data->justification_reason)
                                        {{ $data->justification_reason }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">Attachment Extension</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_extension)
                                    @foreach (json_decode($data->file_attachment_extension) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-head">HOD Review</div>

                        <table>
                            <tr>
                                <th class="w-20">HOD Remarks</th>
                                <td class="w-80">
                                    @if ($data->reviewer_remarks)
                                        {{ $data->reviewer_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">HOD Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_reviewer)
                                    @foreach (json_decode($data->file_attachment_reviewer) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                @if ($data->count != 3)  
                    <div class="block">
                        <div class="block-head">QA/CQA Approval</div>

                        <table>
                            <tr>
                                <th class="w-20">QA/CQA Approval Comments </th>
                                <td class="w-80">
                                    @if ($data->approver_remarks)
                                        {{ $data->approver_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="block">
                        <div class="block-head">QA/CQA Approval Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-80">Attachment</th>
                                </tr>
                                @if ($data->file_attachment_approver)
                                    @foreach (json_decode($data->file_attachment_approver) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                @endif
                @if ($data->count == 3)  
                    <div class="block">
                        <div class="block-head">CQA Approval</div>

                        <table>
                            <tr>
                                <th class="w-20">CQA Approval Comments </th>
                                <td class="w-80">
                                    @if ($data->QAapprover_remarks)
                                        {{ $data->QAapprover_remarks }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>                

                    </div>
                    <div class="block">
                        <div class="block-head">CQA Approval Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">S.N.</th>
                                    <th class="w-80">File</th>
                                </tr>
                                @if ($data->QAfile_attachment_approver)
                                    @foreach (json_decode($data->QAfile_attachment_approver) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                @endif

                    <div class="block">
                        <div class="block-head">Activity Log</div>
                        <table>
                            <tr>
                                <th class="w-20">Submit By</th>
                                <td class="w-30">@if ($data->submit_by) {{ $data->submit_by }} @else Not Applicable @endif</td>
                                <th class="w-20">Submit On</th>
                                <td class="w-30">@if ($data->submit_on) {{ $data->submit_on }} @else Not Applicable @endif</td>
                                <th class="w-20">Submit Comment</th>
                                <td class="w-30">@if ($data->submit_comment) {{ $data->submit_comment }} @else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Cancel By</th>
                                <td class="w-30">@if ($data->reject_by) {{ $data->reject_by }} @else Not Applicable @endif</td>
                                <th class="w-20">Cancel On</th>
                                <td class="w-30">@if ($data->reject_on) {{ $data->reject_on }} @else Not Applicable @endif</td>
                                <th class="w-20">Cancel Comment</th>
                                <td class="w-30">@if ($data->reject_comment) {{ $data->reject_comment }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">More Information Required By</th>
                                <td class="w-80">{{ $data->more_info_review_by }}</td>
                                <th class="w-20">More Information Required On</th>
                                <td class="w-80">{{ $data->more_info_review_on }}</td>
                                <th class="w-20">More Information Required Comment</th>
                                <td class="w-80">{{ $data->more_info_review_comment }}</td>
                            </tr> --}}
                            <tr>
                                <th class="w-20">Review By</th>
                                <td class="w-30">@if ($data->submit_by_review) {{ $data->submit_by_review }} @else Not Applicable @endif</td>
                                <th class="w-20">Review On</th>
                                <td class="w-30">@if ($data->submit_on_review) {{ $data->submit_on_review }} @else Not Applicable @endif</td>
                                <th class="w-20">Review Comment</th>
                                <td class="w-30">@if ($data->submit_comment_review) {{ $data->submit_comment_review }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">System By</th>
                                <td class="w-80">{{ $data->submit_by_review }}</td>
                                <th class="w-20">System On</th>
                                <td class="w-80">{{ $data->submit_on_review }}</td>
                                <th class="w-20">System Comment</th>
                                <td class="w-80">{{ $data->submit_comment_review }}</td>
                            </tr> --}}
                            <tr>
                                <th class="w-20">Reject By</th>
                                <td class="w-30">@if ($data->submit_by_inapproved) {{ $data->submit_by_inapproved }} @else Not Applicable @endif</td>
                                <th class="w-20">Reject On</th>
                                <td class="w-30">@if ($data->submit_on_inapproved) {{ $data->submit_on_inapproved }} @else Not Applicable @endif</td>
                                <th class="w-20">Reject Comment</th>
                                <td class="w-30">@if ($data->submit_commen_inapproved) {{ $data->submit_commen_inapproved }} @else Not Applicable @endif</td>
                            </tr>
                            {{-- <tr>
                                <th class="w-20">More Information Required By</th>
                                <td class="w-80">{{ $data->more_info_inapproved_by }}</td>
                                <th class="w-20">More Information Required On</th>
                                <td class="w-80">{{ $data->more_info_inapproved_on }}</td>
                                <th class="w-20">More Information Required Comment</th>
                                <td class="w-80">{{ $data->more_info_inapproved_comment }}</td>
                            </tr> --}}
                            <!-- @if($data->count == 3)
                                <tr>
                                    <th class="w-20">Send for CQA By</th>
                                    <td class="w-80">@if ($data->send_cqa_by) {{ $data->send_cqa_by }} @else Not Applicable @endif</td>
                                    <th class="w-20">Send for CQA On</th>
                                    <td class="w-80">@if ($data->send_cqa_on) {{ $data->send_cqa_on }} @else Not Applicable @endif</td>
                                    <th class="w-20">Send for CQA Comment</th>
                                    <td class="w-80">@if ($data->send_cqa_comment) {{ $data->send_cqa_comment }} @else Not Applicable @endif</td>
                                </tr>
                            @endif -->
                            @if($data->count != 3)
                                <tr>
                                    <th class="w-20">Approved By</th>
                                    <td class="w-30">@if ($data->submit_by_approved) {{ $data->submit_by_approved }} @else Not Applicable @endif</td>
                                    <th class="w-20">Approved On</th>
                                    <td class="w-30">@if ($data->submit_on_approved) {{ $data->submit_on_approved }} @else Not Applicable @endif</td>
                                    <th class="w-20">Approved Comment</th>
                                    <td class="w-30">@if ($data->submit_comment_approved) {{ $data->submit_comment_approved }} @else Not Applicable @endif</td>
                                </tr>
                            @endif

                            @if($data->count == 3)
                                <tr>
                                    <th class="w-20">CQA Approval Complete By</th>
                                    <td class="w-30">@if ($data->cqa_approval_by) {{ $data->cqa_approval_by }} @else Not Applicable @endif</td>
                                    <th class="w-20">CQA Approval Complete On</th>
                                    <td class="w-30">@if ($data->cqa_approval_on) {{ $data->cqa_approval_on }} @else Not Applicable @endif</td>
                                    <th class="w-20">CQA Approval Complete Comment</th>
                                    <td class="w-30">@if ($data->cqa_approval_comment) {{ $data->cqa_approval_comment }} @else Not Applicable @endif</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                </div>
            </div>

        @endforeach

    @endif

@endforeach

@foreach($records as $data)
    
    @if(optional($data->Capa)->count())

        @foreach ($data->Capa as $capa)
        
            <center><h3>Capa Report</h3></center>

            <div class="inner-block">
                <div class="content-table">
                    <div class="block">
                        <div class="block-head">General Information</div>
                        <table>
                            <tr>
                                <th class="w-20">Record Number</th>
                                <td class="w-30">{{ Helpers::divisionNameForQMS($capa->division_id) }}/CAPA/{{ Helpers::year($capa->created_at) }}/{{ str_pad($capa->record, 4, '0', STR_PAD_LEFT) }}</td>
                                <th class="w-20">Site/Location Code</th>
                                <td class="w-30">@if($capa->division_id){{ Helpers::getDivisionName($capa->division_id) }} @else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Initiator</th>
                                <td class="w-30">{{ $capa->originator }}</td>
                                <th class="w-20">Date of Initiation</th>
                                <td class="w-30">{{ Helpers::getdateFormat($capa->intiation_date) }}</td>
                            </tr>
                            <tr>
                                <th class="w-20">Assigned To</th>
                                <td class="w-30">@if($capa->assign_to){{ $capa->assign_to }} @else Not Applicable @endif</td>
                                <th class="w-20">Due Date</th>
                                <td class="w-30">@if($capa->due_date){{ Helpers::getdateFormat($capa->due_date) }} @else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Initiator Department</th>
                                <td class="w-30">@if($capa->initiator_Group){{ $capa->initiator_Group }} @else Not Applicable @endif</td>
                                <th class="w-20">Initiator Department Code</th>
                                <td class="w-30">{{ $capa->initiator_group_code }}</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Short Description</th>
                                <td class="w-80">@if($capa->short_description){{ $capa->short_description }}@else Not Applicable @endif</td>
                            </tr>
                        </table>
                        <table>
                            
                            <tr>
                                <th class="w-20">Initiated Through</th>
                                <td class="w-30">@if($capa->initiated_through){{ $capa->initiated_through }}@else Not Applicable @endif</td>
                                <th class="w-20">Others</th>
                                <td class="w-30">@if($capa->initiated_through_req){{ $capa->initiated_through_req }}@else Not Applicable @endif</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Repeat</th>
                                <td class="w-80">@if($capa->repeat){{ $capa->repeat }}@else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Repeat Nature</th>
                                <td class="w-80">@if($capa->repeat_nature){{ $capa->repeat_nature }}@else Not Applicable @endif</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Problem Description</th>
                                <td class="w-80" colspan="5">@if($capa->problem_description){{ $capa->problem_description }}@else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">CAPA Team</th>
                                <td class="w-80" colspan="5">@if($capa->capa_team){{ $capa->capa_team }}@else Not Applicable @endif</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Reference Records</th>
                                <td class="w-80" colspan="5">@if($capa->parent_record_number_edit){{ $capa->parent_record_number_edit }}@else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Initial Observation</th>
                                <td class="w-80" colspan="5">@if($capa->initial_observation){{ $capa->initial_observation }}@else Not Applicable @endif</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Interim Containment</th>
                                <td class="w-80">@if($capa->interim_containnment){{ str_replace(' ', '-', ucwords(str_replace('-', ' ', $capa->interim_containnment))) }}@else Not Applicable @endif</td>
                            </tr>
                            <tr>
                                <th class="w-20">Containment Comments</th>
                                <td class="w-80">@if($capa->containment_comments){{ $capa->containment_comments }}@else Not Applicable @endif</td>
                            </tr>
                        </table>

                        <div class="block-head">CAPA Attachments</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if($capa->capa_attachment)
                                    @foreach(json_decode($capa->capa_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="block">
                            <div class="block-head">Other Type Details</div>
                            <table>
                                <tr>
                                    <th class="w-20">Investigation Summary</th>
                                    <td class="w-80">@if($capa->investigation){{ $capa->investigation }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th class="w-20">Root Cause</th>
                                    <td class="w-80">@if($capa->rcadetails){{ $capa->rcadetails }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                        </div>

                        <div class="border-table tbl-bottum">
                            <div class="block-head">Product / Material Details</div>
                            <table>
                                <tr class="table_bg">
                                    <th class="w-10">Sr.No.</th>
                                    <th class="w-20">Product / Material Name</th>
                                    <th class="w-20">Product /Material Batch No./Lot No./AR No.</th>
                                    <th class="w-20">Product / Material Manufacturing Date</th>
                                    <th class="w-20">Product / Material Date of Expiry</th>
                                    <th class="w-20">Product Batch Disposition Decision</th>
                                    <th class="w-20">Product Remark</th>
                                    <th class="w-20">Product Batch Status</th>
                                </tr>
                                @if($capa->Material_Details && $capa->Material_Details->material_name)
                                    @foreach(unserialize($capa->Material_Details->material_name) as $key => $materialName)
                                        <tr>
                                            <td class="w-15">{{ $key + 1 }}</td>
                                            <td class="w-15">{{ $materialName ?? 'NA' }}</td>
                                            <td class="w-15">{{ unserialize($capa->Material_Details->material_batch_no)[$key] ?? 'NA' }}</td>
                                            <td class="w-5">{{ unserialize($capa->Material_Details->material_mfg_date)[$key] ?? 'NA' }}</td>
                                            <td class="w-15">{{ unserialize($capa->Material_Details->material_expiry_date)[$key] ?? 'NA' }}</td>
                                            <td class="w-15">{{ unserialize($capa->Material_Details->material_batch_desposition)[$key] ?? 'NA' }}</td>
                                            <td class="w-15">{{ unserialize($capa->Material_Details->material_remark)[$key] ?? 'NA' }}</td>
                                            <td class="w-15">{{ unserialize($capa->Material_Details->material_batch_status)[$key] ?? 'NA' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="border-table tbl-bottum">
                            <div class="block-head">Equipment/Instruments Details</div>
                            <table>
                                <tr class="table_bg">
                                    <th class="w-25">Sr.No.</th>
                                    <th class="w-25">Equipment/Instruments Name</th>
                                    <th class="w-25">Equipment/Instrument ID</th>
                                    <th class="w-25">Equipment/Instruments Comments</th>
                                </tr>
                                @if($capa->Instruments_Details && $capa->Instruments_Details->equipment)
                                    @foreach(unserialize($capa->Instruments_Details->equipment) as $key => $equipment)
                                        <tr>
                                            <td class="w-15">{{ $key + 1 }}</td>
                                            <td class="w-15">{{ $equipment ?? 'Not Applicable' }}</td>
                                            <td class="w-15">{{ unserialize($capa->Instruments_Details->equipment_instruments)[$key] ?? 'Not Applicable' }}</td>
                                            <td class="w-15">{{ unserialize($capa->Instruments_Details->equipment_comments)[$key] ?? 'Not Applicable' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="block-head">Other Type CAPA Details</div>
                        <table>
                            <tr>
                                <th class="w-20">Details</th>
                                <td class="w-80">@if($capa->details_new){{ $capa->details_new }}@else Not Applicable @endif</td>
                            </tr>
                        </table>

                        <div class="block">
                            <div class="block-head">CAPA Details</div>
                            <table>
                                <tr>
                                    <th class="w-20">CAPA Type</th>
                                    <td class="w-80" colspan="3">@if($capa->capa_type){{ $capa->capa_type }}@else Not Applicable @endif</td>
                                </tr>
                                @if($capa->corrective_action)
                                    <tr>
                                        <th class="w-20">Corrective Action</th>
                                        <td class="w-80" colspan="3">@if($capa->corrective_action){{ $capa->corrective_action }}@else Not Applicable @endif</td>
                                    </tr>
                                @endif
                                @if($capa->preventive_action)
                                    <tr>
                                        <th class="w-20">Preventive Action</th>
                                        <td class="w-80" colspan="3">@if($capa->preventive_action){{ $capa->preventive_action }}@else Not Applicable @endif</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="block-head">File Attachment</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if($capa->capafileattachement)
                                    @foreach(json_decode($capa->capafileattachement) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="block">
                            <div class="block-head">HOD Review</div>
                            <table>
                                <tr>
                                    <th class="w-20">HOD Remark</th>
                                    <td class="w-80">@if($capa->hod_remarks){{ $capa->hod_remarks }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                            <div class="block-head">HOD Attachment</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if($capa->hod_attachment)
                                        @foreach(json_decode($capa->hod_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="block">
                            <div class="block-head">QA/CQA Review</div>
                            <table>
                                <tr>
                                    <th class="w-20">QA/CQA Review Comment</th>
                                    <td class="w-80">@if($capa->capa_qa_comments){{ $capa->capa_qa_comments }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                            <div class="block-head">QA/CQA Attachment</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if($capa->qa_attachment)
                                        @foreach(json_decode($capa->qa_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="block">
                            <div class="block-head">QA/CQA Approval</div>
                            <table>
                                <tr>
                                    <th class="w-20">QA/CQA Approval Comment</th>
                                    <td class="w-80">@if($capa->qah_cq_comments){{ $capa->qah_cq_comments }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                            <div class="block-head">QA/CQA Approval Attachment</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if($capa->qah_cq_attachment)
                                        @foreach(json_decode($capa->qah_cq_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="block">
                            <div class="block-head">Initiator CAPA update</div>
                            <table>
                                <tr>
                                    <th class="w-20">Initiator CAPA Update Comment</th>
                                    <td class="w-80">@if($capa->initiator_comment){{ $capa->initiator_comment }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                            <div class="block-head">Initiator CAPA update Attachment</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if($capa->initiator_capa_attachment)
                                        @foreach(json_decode($capa->initiator_capa_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="block">
                            <div class="block-head">HOD Final Review</div>
                            <table>
                                <tr>
                                    <th class="w-20">HOD Final Review Comments</th>
                                    <td class="w-80">@if($capa->hod_final_review){{ $capa->hod_final_review }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                            <div class="block-head">HOD Final Attachment</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if($capa->hod_final_attachment)
                                        @foreach(json_decode($capa->hod_final_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="block">
                            <div class="block-head">QA/CQA Closure Review</div>
                            <table>
                                <tr>
                                    <th class="w-20">QA/CQA Closure Review Comment</th>
                                    <td class="w-80">@if($capa->qa_cqa_qa_comments){{ $capa->qa_cqa_qa_comments }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                            <div class="block-head">QA/CQA Closure Review Attachment</div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if($capa->qa_closure_attachment)
                                        @foreach(json_decode($capa->qa_closure_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="block">
                            <div class="block-head">CAPA Closure</div>
                            <table>
                                <tr>
                                    <th class="w-20">Effectiveness check required</th>
                                    <td class="w-80">@if($capa->effectivness_check){{ $capa->effectivness_check }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th class="w-20">QA/CQA Head Closure Review Comment</th>
                                    <td class="w-80">@if($capa->qa_review){{ $capa->qa_review }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                        </div>

                        <div class="block-head">QA/CQA Head Closure Review Attachment</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if($capa->closure_attachment)
                                    @foreach(json_decode($capa->closure_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-80">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="block">
                            <div class="block-head">Activity Log</div>
                            <table>
                                <tr>
                                    <th class="w-20">Propose Plan By</th>
                                    <td class="w-30">@if($capa->plan_proposed_by){{ $capa->plan_proposed_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">Propose Plan On</th>
                                    <td class="w-30">@if($capa->plan_proposed_on){{ $capa->plan_proposed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Propose Plan Comment</th>
                                    <td colspan="3">@if($capa->comment){{ $capa->comment }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Cancel By</th>
                                    <td>@if($capa->cancelled_by){{ $capa->cancelled_by }}@else Not Applicable @endif</td>
                                    <th>Cancel On</th>
                                    <td>@if($capa->cancelled_on){{ $capa->cancelled_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Cancel Comment</th>
                                    <td colspan="3">@if($capa->cancelled_on_comment){{ $capa->cancelled_on_comment }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>HOD Review Complete By</th>
                                    <td>@if($capa->hod_review_completed_by){{ $capa->hod_review_completed_by }}@else Not Applicable @endif</td>
                                    <th>HOD Review Complete On</th>
                                    <td>@if($capa->hod_review_completed_on){{ $capa->hod_review_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>HOD Review Complete Comment</th>
                                    <td colspan="3">@if($capa->hod_comment){{ $capa->hod_comment }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QA/CQA Review Complete By</th>
                                    <td>@if($capa->qa_review_completed_by){{ $capa->qa_review_completed_by }}@else Not Applicable @endif</td>
                                    <th>QA/CQA Review Complete On</th>
                                    <td>@if($capa->qa_review_completed_on){{ $capa->qa_review_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QA/CQA Review Complete Comment</th>
                                    <td colspan="3">@if($capa->qa_comment){{ $capa->qa_comment }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Approved By</th>
                                    <td>@if($capa->approved_by){{ $capa->approved_by }}@else Not Applicable @endif</td>
                                    <th>Approved On</th>
                                    <td>@if($capa->approved_on){{ $capa->approved_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Approved Comment</th>
                                    <td colspan="3">@if($capa->approved_comment){{ $capa->approved_comment }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Completed By</th>
                                    <td>@if($capa->completed_by){{ $capa->completed_by }}@else Not Applicable @endif</td>
                                    <th>Completed On</th>
                                    <td>@if($capa->completed_on){{ $capa->completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Complete Comment</th>
                                    <td colspan="3">@if($capa->comment){{ $capa->comment }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>HOD Final Review Complete By</th>
                                    <td>@if($capa->hod_final_review_completed_by){{ $capa->hod_final_review_completed_by }}@else Not Applicable @endif</td>
                                    <th>HOD Final Review Complete On</th>
                                    <td>@if($capa->hod_final_review_completed_on){{ $capa->hod_final_review_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>HOD Final Review Complete Comment</th>
                                    <td colspan="3">@if($capa->final_comment){{ $capa->final_comment }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QA/CQA Closure Review Complete By</th>
                                    <td>@if($capa->qa_closure_review_completed_by){{ $capa->qa_closure_review_completed_by }}@else Not Applicable @endif</td>
                                    <th>QA/CQA Closure Review Complete On</th>
                                    <td>@if($capa->qa_closure_review_completed_on){{ $capa->qa_closure_review_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QA/CQA Closure Review Complete Comment</th>
                                    <td colspan="3">@if($capa->qa_closure_comment){{ $capa->qa_closure_comment }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QAH/CQA Head Approval Complete By</th>
                                    <td>@if($capa->qah_approval_completed_by){{ $capa->qah_approval_completed_by }}@else Not Applicable @endif</td>
                                    <th>QAH/CQA Head Approval Complete On</th>
                                    <td>@if($capa->qah_approval_completed_on){{ $capa->qah_approval_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QAH/CQA Head Approval Complete Comment</th>
                                    <td colspan="3">@if($capa->qah_comment){{ $capa->qah_comment }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                        </div>

                    </div> {{-- end block --}}
                </div> {{-- end content-table --}}
            </div> {{-- end inner-block --}}
        @endforeach {{-- end inner foreach capas --}}
    @endif
@endforeach

@foreach($records as $data)

    @if(optional($data->RootCauseAnalysis)->count())

        @foreach ($data->RootCauseAnalysis as $data)

            <center><h3>RootCauseAnalysis Report</h3></center>
            <div class="inner-block">
            <div class="content-table">
                <div class="block">
                    <div class="block-head">
                        General Information
                    </div>
                    <table>
                        <tr> {{ $data->created_at }} added by {{ $data->originator }}
                            <th class="w-20">Record Number</th>
                            <td class="w-30">
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/RCA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                            </td>

                            <th class="w-20">Site/Location Code</th>
                            <td class="w-30">
                                @if ($data->division_code)
                                    {{ $data->division_code }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th class="w-20">Initiator</th>
                            <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>

                            <th class="w-20">Date of Initiation</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>

                        </tr>

                        <tr>

                            <th class="w-20">Initiator Department</th>
                            <td class="w-30">
                                @if ( Helpers::getUsersDepartmentName(Auth::user()->departmentid))
                                    {{  Helpers::getUsersDepartmentName(Auth::user()->departmentid)}}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            <th class="w-20">Initiator Department Code</th>
                            <td class="w-30">
                                @if ($data->initiator_group_code)
                                    {{ $data->initiator_group_code }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        </tr>
                    </table> 
                    <table>   
                        <tr>
                            <th class="w-20">Short Description</th>
                            <td class="w-80" colspan="3">
                                @if ($data->short_description)
                                    {{ $data->short_description }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th class="w-20"> Name Of Responsible Department Head</th>
                            <td class="w-30">
                                @if ($data->assign_to)
                                    {{ Helpers::getInitiatorName($data->assign_to) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                            <th class="w-20">QA Reviewer</th>
                            <td class="w-30">
                                @if ($data->qa_reviewer)
                                    {{ Helpers::getInitiatorName($data->qa_reviewer) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <th class="w-20">Due Date</th>
                            <td class="w-30">
                                @if ($data->due_date)
                                    {{ Helpers::getdateFormat($data->due_date) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            <th class="w-20">Initiated Through</th>
                            <td class="w-30">
                                @if ($data->initiated_through)
                                    {{ $data->initiated_through }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Others</th>
                                <td class="w-80">
                                    @if ($data->initiated_if_other)
                                        {!! $data->initiated_if_other !!}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                                {{-- <th class="w-20">Type</th>
                                <td class="w-30">
                                    @if ($data->Type)
                                        {{ $data->Type }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td> --}}
                            </tr>
                        </table>
                        <table>    

                            <tr>
                                <th class="w-20">Responsible Department</th>
                                <td class="w-80">
                                    @if ($data->department)
                                        {{ $data->department }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>

                    
                    </table>

                    <div class="block-head">
                        Investigation Details
                    </div>
                    <table>
                        <tr>
                            <th class="w-20" >Description</th>
                            <td class="w-80">
                                @if ($data->description)
                                    {{ $data->description }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                    </table>

                    <table>
                        <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">
                                @if ($data->comments)
                                    {{ $data->comments }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                    
                    <div class="border-table">
                        <div class="block-head">
                            Initial Attachment
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->root_cause_initial_attachment)
                                @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
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

            <div class="block">
                <div class="block-head">
                HOD Review
                </div>
                <table>
                    <tr>
                        <th class="w-20" >HOD Review Comment</th>
                        <td class="w-80">
                            @if ($data->hod_comments)
                                {{ $data->hod_comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
                <div class="border-table">
                    <div class="block-head">
                        HOD Review Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->hod_attachments)
                            @foreach (json_decode($data->hod_attachments) as $key => $file)
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

            <div class="block">
                <div class="block-head">
                Initial QA/CQA Review 
                </div>
                <table>
                    <tr>
                        <th class="w-20" >Initial QA/CQA Review Comments</th>
                        <td class="w-80">
                            @if ($data->cft_comments_new)
                                {{ $data->cft_comments_new }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
                
                <div class="border-table">
                    <div class="block-head">
                        Initial QA/CQA Review Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->cft_attchament_new)
                            @foreach (json_decode($data->cft_attchament_new) as $key => $file)
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


            <style>
                .tableFMEA {
                    width: 100%;
                    border-collapse: collapse;
                    font-size: 7px;
                    table-layout: fixed; /* Ensures columns are evenly distributed */
                }

                .thFMEA,
                .tdFMEA {
                    border: 1px solid black;
                    padding: 5px;
                    word-wrap: break-word;
                    text-align: center;
                    vertical-align: middle;
                    font-size: 6px; /* Apply the same font size for all cells */
                }

                /* Rotating specific headers */
                .rotate {
                    transform: rotate(-90deg);
                    white-space: nowrap;
                    width: 10px;
                    height: 100px;
                }

                /* Ensure the "Traceability Document" column fits */
                .tdFMEA:last-child,
                .thFMEA:last-child {
                    width: 80px; /* Allocate more space for "Traceability Document" */
                }

                /* Adjust for smaller screens to fit */
                @media (max-width: 1200px) {
                    .tdFMEA:last-child,
                    .thFMEA:last-child {
                        font-size: 6px;
                        width: 70px; /* Shrink width further for smaller screens */
                    }
                }

            </style>


            <div class="block">
                    <div class="block-head">
                        Investigation & Root Cause
                    </div>
                    <!-- <div class="block-head">
                        Investigation
                    </div> -->

                    <table>
                        <tr>
                            <th class="w-20">Objective</th>
                            <td class="w-80">
                                @if ($data->objective)
                                    {!! strip_tags($data->objective) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>


                

                    <table>
                        <tr>
                            <th class="w-20">Scope</th>
                            <td class="w-80">
                                @if ($data->scope)
                                    {!! strip_tags($data->scope) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    

                    <table>
                        <tr>
                            <th class="w-20">Problem Statement</th>
                            <td class="w-80">
                                @if ($data->problem_statement_rca)
                                    {!! strip_tags($data->problem_statement_rca) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                
                    <table>
                        <tr>
                            <th class="w-20">Background</th>
                            <td class="w-80">
                                @if ($data->requirement)
                                    {!! strip_tags($data->requirement) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                
                    <table>
                        <tr>
                            <th class="w-20">Immediate Action</th>
                            <td class="w-80">
                                @if ($data->immediate_action)
                                    {!! strip_tags($data->immediate_action) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>


                    

                    

                    <table>
                        <tr>
                            <th class="w-20">Investigation Team</th>
                            <td class="w-80">
                                @if ($data->investigation_team)
                                    {{($investigation_teamNamesString) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>        
                            <th class="w-20">Root Cause Methodology</th>
                            <td class="w-80">
                                @if ($data->root_cause_methodology)
                                    {{ is_array($selectedMethodologies) ? implode(', ', $selectedMethodologies) : $selectedMethodologies }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    <br><br>
                    <div class="border-table  tbl-bottum">
                        <div class="block-head">
                            Failure Mode and Effect Analysis
                        </div>
                        <table class="tableFMEA">
                            <thead>
                                <tr class="table_bg" style="text-align: center; vertical-align: middle; padding: 20px;">
                                    <th class="thFMEA" rowspan="2">Sr.No</th>
                                    <th class="thFMEA" colspan="2">Risk Identification</th>
                                    <th class="thFMEA">Risk Analysis</th>
                                    <th class="thFMEA" colspan="4">Risk Evaluation</th>
                                    <th class="thFMEA">Risk Control</th>
                                    <th class="thFMEA" colspan="6">Risk Evaluation</th>

                                    <th class="thFMEA" rowspan="2">Traceability Document</th>
                                    
                                </tr>
                                <tr class="table_bg">
                                    <th class="thFMEA">Activity</th>
                                    <th class="thFMEA">Possible Risk/Failure (Identified Risk)</th>
                                    <th class="thFMEA">Consequences of Risk/Potential Causes</th>
                                    <th class="thFMEA">Severity (S)</th>
                                    <th class="thFMEA">Probability (P)</th>
                                    <th class="thFMEA">Detection (D)</th>
                                    <th class="thFMEA">Risk Level(RPN)</th>
                                    <th class="thFMEA">	Control Measures recommended/ Risk mitigation proposed</th>
                                    <th class="thFMEA">Severity (S)</th>
                                    <th class="thFMEA">Probability (P)</th>
                                    <th class="thFMEA">Detection (D)</th>
                                    <th class="thFMEA">Risk Level(RPN)</th>
                                    <th class="thFMEA">Category of Risk Level (Low, Medium and High)</th>
                                    <th class="thFMEA">Risk Acceptance (Y/N)</th>
                                    <!-- <th class="thFMEA">Others</th>
                                    <th class="thFMEA">Attchment</th> -->
                                    
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @if (!empty($data->risk_factor))
                                @foreach (unserialize($data->risk_factor) as $key => $riskFactor)
                                    <tr class="tr">
                                        <td class="tdFMEA">{{ $key + 1 }}</td>
                                        <td class="tdFMEA">{{ $riskFactor }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->risk_element)[$key] ?? null }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->problem_cause)[$key] ?? null }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->initial_severity)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->initial_detectability)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->initial_probability)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->initial_rpn)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->risk_control_measure)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->residual_severity)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->residual_probability)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->residual_detectability)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->residual_rpn)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->risk_acceptance)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->risk_acceptance2)[$key] }}</td>
                                        <td class="tdFMEA">{{ unserialize($data->mitigation_proposal)[$key] }}</td>
                                        
                                    </tr>
                                @endforeach
                                @else
                                @endif

                            </tbody>
                        </table>

                    </div>
                
                    <div class="block-head">
                        Fishbone or Ishikawa Diagram
                    </div>

                    @if (!empty($data))
                        @php
                            $measurement = !empty($data->measurement) ? unserialize($data->measurement) : [];
                            $materials = !empty($data->materials) ? unserialize($data->materials) : [];
                            $methods = !empty($data->methods) ? unserialize($data->methods) : [];

                            $environment = !empty($data->environment) ? unserialize($data->environment) : [];
                            $manpower = !empty($data->manpower) ? unserialize($data->manpower) : [];
                            $machine = !empty($data->machine) ? unserialize($data->machine) : [];

                            $problem_statement = $data->problem_statement ?? 'N/A';

                            $maxCount = max(count($measurement), count($materials), count($methods));
                            $maxCount2 = max(count($environment), count($manpower), count($machine));
                        @endphp

                        <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;">
                            <!-- Top Table -->
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr valign="top">
                                    <!-- First Table -->
                                    <td style="width: 70%;">
                                        <table style="width: 70%; border-collapse: collapse; text-align: left;">
                                            <thead>
                                                <tr style="color: #007bff;">
                                                    <th style="padding: 10px; border: 1px solid #ddd;">Measurement</th>
                                                    <th style="padding: 10px; border: 1px solid #ddd;">Materials</th>
                                                    <th style="padding: 10px; border: 1px solid #ddd;">Methods</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < $maxCount; $i++)
                                                    <tr>
                                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $measurement[$i] ?? 'N/A' }}</td>
                                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $materials[$i] ?? 'N/A' }}</td>
                                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $methods[$i] ?? 'N/A' }}</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </td>        
                                </tr>
                            </table>

                            <table style="width: 100%; border-collapse: collapse;">
                                <tr >
                                    <td style="width: 70%;">
                                        <div style="width: 100%; height: 2px; background: blue; margin: 20px 0;"></div>
                                    </td>
                                    <td style="width: 30%;">
                                        <div style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #ffffff;">
                                            <strong style="color: #007bff;">Problem Statement:</strong>
                                            <div style="margin-top: 10px;">
                                                {{ $data->problem_statement ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </td>       
                                </tr>
                            </table>


                            <!-- Second Table -->
                            <table style="width: 70%; border-collapse: collapse; text-align: left;">
                                <thead>
                                    <tr style="color: #007bff;">
                                        <th style="padding: 10px; border: 1px solid #ddd;">Mother Environment</th>
                                        <th style="padding: 10px; border: 1px solid #ddd;">Man</th>
                                        <th style="padding: 10px; border: 1px solid #ddd;">Machine</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < $maxCount2; $i++)
                                        <tr>
                                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $environment[$i] ?? 'N/A' }}</td>
                                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $manpower[$i] ?? 'N/A' }}</td>
                                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $machine[$i] ?? 'N/A' }}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>

                        </div>
                    @else
                        <p style="text-align: center; color: red;">No Fishbone data available.</p>
                    @endif



                        <br><br><br><br>
                    

                    <div class="border-table tbl-bottum ">
                        <div class="block-head">
                            Inference
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-5">Sr.No.</th>
                                <th class="w-30">Type</th>
                                <th class="w-30">Remarks</th>
                            </tr>

                            @if (!empty($data->inference_type))
                                @foreach (unserialize($data->inference_type) as $key => $inference_type)
                                    <tr>
                                        <td class="w-10">{{ $key + 1 }}</td>
                                        <td class="w-30">
                                            {{ unserialize($data->inference_type)[$key] ? unserialize($data->inference_type)[$key] : 'Not Applicable' }}
                                        </td>
                                        <td class="w-30">
                                            {{ unserialize($data->inference_remarks)[$key] ? unserialize($data->inference_remarks)[$key] : 'Not Applicable' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            @endif

                        </table>
                    </div>

                    




                    <div class="why-why-chart-container">
                        <div class="block-head">
                            <strong>Why-Why Chart</strong>
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                                <tr class="problem-statement">
                                    <th>Problem Statement :</th>
                                    <td>
                                        {{ $data->why_problem_statement ?? 'Not Applicable' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div>
                            @php
                                $why_data = !empty($data->why_data) ? unserialize($data->why_data) : [];
                            @endphp

                            @if (is_array($why_data) && count($why_data) > 0)
                                @foreach ($why_data as $index => $why)
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th class="why-label">Why {{ $index + 1 }}</th>
                                                <td>{{ $why['question'] ?? 'Not Applicable' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="answer-label">Answer {{ $index + 1 }}</th>
                                                <td>{{ $why['answer'] ?? 'Not Applicable' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            @else
                                <p class="text-muted">No Why-Why Data Available</p>
                            @endif
                        </div>

                        <div id="root-cause-container">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="root-cause">
                                        <th>Root Cause :</th>
                                        <td>
                                            {{ $data->why_root_cause ?? 'Not Applicable' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="block-head">
                        Is/Is Not Analysis
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">What Will Be</th>
                            <td class="w-80">
                                @if ($data->what_will_be)
                                    {{ $data->what_will_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">What Will Not Be </th>
                            <td class="w-80">
                                @if ($data->what_will_not_be)
                                    {{ $data->what_will_not_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">What Will Rationale </th>
                            <td class="w-80">
                                @if ($data->what_rationable)
                                    {{ $data->what_rationable }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Where Will Be</th>
                            <td class="w-80">
                                @if ($data->where_will_be)
                                    {{ $data->where_will_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Where Will Not Be </th>
                            <td class="w-80">
                                @if ($data->where_will_not_be)
                                    {{ $data->where_will_not_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Where Will Rationale </th>
                            <td class="w-80">
                                @if ($data->where_rationable)
                                    {{ $data->where_rationable }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        <tr>
                            <th class="w-20">When Will Be</th>
                            <td class="w-80">
                                @if ($data->when_will_be)
                                    {{ $data->when_will_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">When Will Not Be </th>
                            <td class="w-80">
                                @if ($data->when_will_not_be)
                                    {{ $data->when_will_not_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">When Will Rationale </th>
                            <td class="w-80">
                                @if ($data->when_rationable)
                                    {{ $data->when_rationable }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Why Will Be</th>
                            <td class="w-80">
                                @if ($data->coverage_will_be)
                                    {{ $data->coverage_will_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Why Will Not Be </th>
                            <td class="w-80">
                                @if ($data->coverage_will_not_be)
                                    {{ $data->coverage_will_not_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Why Will Rationale </th>
                            <td class="w-80">
                                @if ($data->coverage_rationable)
                                    {{ $data->coverage_rationable }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Who Will Be</th>
                            <td class="w-80">
                                @if ($data->who_will_be)
                                    {{ $data->who_will_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                        <tr>

                            <th class="w-20">Who Will Not Be </th>
                            <td class="w-80">
                                @if ($data->who_will_not_be)
                                    {{ $data->who_will_not_be }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>

                            <th class="w-20">Who Will Rationale </th>
                            <td class="w-80">
                                @if ($data->who_rationable)
                                    {{ $data->who_rationable }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        </tr>
                    </table>
                </div>


                    <table>
                        <tr>
                            <th class="w-20">Others</th>
                            <td class="w-80">
                                @if ($data->root_cause_Others)
                                    {!! strip_tags($data->root_cause_Others) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>


                    <div class="border-table">
                        <div class="block-head">
                            Other Attachment
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->investigation_attachment)
                                @foreach (json_decode($data->investigation_attachment) as $key => $file)
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

                    

                    <table>
                        <tr>
                            <th class="w-20">Root Cause</th>
                            <td class="w-80">
                                @if ($data->root_cause)
                                    {!! strip_tags($data->root_cause) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    

                    <table>
                        <tr>
                            <th class="w-20">Impact / Risk Assessment</th>
                            <td class="w-80">
                                @if ($data->impact_risk_assessment)
                                    {!! strip_tags($data->impact_risk_assessment) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>


                    
                    <table>
                        <tr>
                            <th class="w-20">CAPA</th>
                            <td class="w-80">
                                @if ($data->capa)
                                    {!! strip_tags($data->capa) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    

                    <table>
                        <tr>
                            <th class="w-20">Investigation Summary</th>
                            <td class="w-80">
                                @if ($data->investigation_summary_rca)
                                    {!! strip_tags($data->investigation_summary_rca) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
            
            
            <div class="border-table">
                <div class="block-head">
                    Investigation Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->root_cause_initial_attachment_rca)
                        @foreach (json_decode($data->root_cause_initial_attachment_rca) as $key => $file)
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
            </div><br>





                        

                <div class="block">
                    <div class="block-head">
                        HOD Final Review
                    </div>

                    <table>
                        <tr>
                            <th class="w-20"> HOD Final Review Comments</th>
                            <td class="w-80">
                                @if ($data->hod_final_comments)
                                    {!! strip_tags($data->hod_final_comments) !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="border-table">
                        <div class="block-head">
                            HOD Final Review Attachment

                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->hod_final_attachments)
                                @foreach (json_decode($data->hod_final_attachments) as $key => $file)
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


                
            <div class="block">
                <div class="block-head">
                    QA/CQA Final Review
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Final Review Comments</th>
                        <td class="w-80">
                            @if ($data->qa_final_comments)
                                {{ strip_tags($data->qa_final_comments) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                
                <div class="border-table">
                    <div class="block-head">
                        QA/CQA Final Review Attachment

                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->qa_final_attachments)
                            @foreach (json_decode($data->qa_final_attachments) as $key => $file)
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


                
            <div class="block">
                <div class="block-head">
                    QAH/CQAH/Designee Final Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">QAH/CQAH/Designee Final Approval Comments</th>
                        <td class="w-80">
                            @if ($data->qah_final_comments)
                                {{ strip_tags($data->qah_final_comments) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="border-table">
                    <div class="block-head">
                        QAH/CQAH/Designee Final Approval Attachments

                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->qah_final_attachments)
                            @foreach (json_decode($data->qah_final_attachments) as $key => $file)
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
                    



                        {{-- <div class="inner-block">
                            <label
                                class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                                Root Cause Methodology </label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->root_cause_methodology)
                                    {{ $data->root_cause_methodology }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div>
                        <div class="inner-block">
                            <label
                                class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                                Root Cause Description</label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->root_cause_description)
                                    {{ $data->root_cause_description }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div>
                        <div class="inner-block">
                            <label
                                class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                                Investigation Summary</label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->investigation_summary)
                                    {{ $data->investigation_summary }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div> --}}
                        <!-- <tr>
                                    <th class="w-20">Attachments</th>
                                    <td class="w-80">
                        @if ($data->attachments)
                        <a href="{{ asset('upload/document/', $data->attachments) }}">{{ $data->attachments }}
                        @else
                        Not Applicable
                        @endif
                        </td>
                        </tr> -->
                        {{-- <tr>
                                    <th class="w-20">Comments</th>
                                    <td class="w-80">@if ($data->comments){{ $data->comments }}@else Not Applicable @endif</td>
                                </tr>
                            --}}
                        </table>
                        {{-- <div class="border-table tbl-bottum ">
                            <div class="block-head">
                                Root Cause
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-10">Sr.No.</th>
                                    <th class="w-30">Root Cause Category</th>
                                    <th class="w-30">Root Cause Sub-Category</th>
                                    <th class="w-30">Probability</th>
                                    <th class="w-30">Remarks</th>
                                </tr>
                                {{-- @if ($data->root_cause_initial_attachment)
                                        @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                        @else --}}
                                {{-- @if (!empty($data->Root_Cause_Category))
                                    @foreach (unserialize($data->Root_Cause_Category) as $key => $Root_Cause_Category)
                                        <tr>
                                            <td class="w-10">{{ $key + 1 }}</td>
                                            <td class="w-30">
                                                {{ unserialize($data->Root_Cause_Category)[$key] ? unserialize($data->Root_Cause_Category)[$key] : '' }}
                                            </td>
                                            <td class="w-30">
                                                {{ unserialize($data->Root_Cause_Sub_Category)[$key] ? unserialize($data->Root_Cause_Sub_Category)[$key] : '' }}
                                            </td>
                                            <td class="w-30">
                                                {{ unserialize($data->Probability)[$key] ? unserialize($data->Probability)[$key] : '' }}
                                            </td>
                                            <td class="w-30">{{ unserialize($data->Remarks)[$key] ?? null }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                @endif

                            </table>
                        </div> --}} 
                        
        
                    <div class="block">
                        <div class="block-head">
                            Activity log
                        </div>
                        <table>
            
                                            <tr>
                                                <th class="w-20">Acknowledge By</th>
                                                <td class="w-30">
                                                    @if ($data->acknowledge_by)
                                                        {{ $data->acknowledge_by }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20">Acknowledge On</th>
                                                <td class="w-30">
                                                    @if ($data->acknowledge_on)
                                                        {{ Helpers::getdateFormat($data->acknowledge_on) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                        
                                                <th class="w-20"> Acknowledge Comment</th>
                                                <td class="w-30">
                                                    @if ($data->ack_comments)
                                                        {{ $data->ack_comments }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                            </tr>
            
                                            {{-- <tr>
                                                    <th class="w-20"> More Info Required By
                                                    </th>
                                                    <td class="w-30">@if($data->More_Info_ack_by){{ $data->More_Info_ack_by }}@else Not Applicable @endif</td>
                                                    <th class="w-20">
                                                        More Info Required On</th>
                                                    <td class="w-30">@if($data->More_Info_ack_on){{ $data->More_Info_ack_on }}@else Not Applicable @endif</td>
                                                    <th class="w-20">
                                                        Comment</th>
                                                    <td class="w-30">@if($data->More_Info_ack_comment){{ $data->More_Info_ack_comment }}@else Not Applicable @endif</td>
                                                </tr> --}}
            
                                                                                
                                        <tr>
                                            <th class="w-20">HOD Review Complete By</th>
                                            <td class="w-30">
                                                @if ($data->HOD_Review_Complete_By)
                                                    {{ $data->HOD_Review_Complete_By }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <th class="w-20">HOD Review Complete On</th>
                                            <td class="w-30">
                                                @if ($data->HOD_Review_Complete_On)
                                                    {{ Helpers::getdateFormat($data->HOD_Review_Complete_On) }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            <th class="w-20">HOD Review Complete Comment</th>
                                            <td class="w-30">
                                                @if ($data->HOD_Review_Complete_Comment)
                                                    {{ $data->HOD_Review_Complete_Comment }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>
                                            {{-- <th class="w-20">QA Review Complete Comment</th>
                                                    <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td> --}}
                                        </tr>
                                        {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_hrc_by){{ $data->More_Info_hrc_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_hrc_on){{ $data->More_Info_hrc_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_hrc_comment){{ $data->More_Info_hrc_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}

                                        <tr>
                                                <th class="w-20">QA/CQA Review Complete By</th>
                                                <td class="w-30">
                                                    @if ($data->QQQA_Review_Complete_By)
                                                        {{ $data->QQQA_Review_Complete_By }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20">QA/CQA Review Complete On</th>
                                                <td class="w-30">
                                                    @if ($data->QQQA_Review_Complete_On)
                                                        {{ Helpers::getdateFormat($data->QQQA_Review_Complete_On) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20">QA/CQA Review Complete Comment</th>
                                                <td class="w-30">
                                                    @if ($data->QAQQ_Review_Complete_comment)
                                                        {{ $data->QAQQ_Review_Complete_comment }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                            </tr>
                                        {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_qac_by){{ $data->More_Info_qac_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_qac_on){{ $data->More_Info_qac_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_qac_comment){{ $data->More_Info_qac_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
            
                                
                                            <tr>
                                                <th class="w-20">Submit By</th>
                                                <td class="w-30">
                                                    @if ($data->submitted_by)
                                                        {{ $data->submitted_by }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20">Submit On</th>
                                                <td class="w-30">
                                                    @if ($data->submitted_on)
                                                        {{ Helpers::getdateFormat($data->submitted_on) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20">Submit Comment</th>
                                                <td class="w-30">
                                                    @if ($data->qa_comments_new)
                                                        {{ $data->qa_comments_new }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                            </tr>
            
                                                {{-- <tr>
                                                    <th class="w-20"> More Info Required By
                                                    </th>
                                                    <td class="w-30">@if($data->More_Info_sub_by){{ $data->More_Info_sub_by }}@else Not Applicable @endif</td>
                                                    <th class="w-20">
                                                        More Info Required On</th>
                                                    <td class="w-30">@if($data->More_Info_sub_on){{ $data->More_Info_sub_on }}@else Not Applicable @endif</td>
                                                    <th class="w-20">
                                                        Comment</th>
                                                    <td class="w-30">@if($data->More_Info_sub_comment){{ $data->More_Info_sub_comment }}@else Not Applicable @endif</td>
                                                </tr> --}}
                                            <tr>
                                                <th class="w-20">HOD Final Review Complete By</th>
                                                <td class="w-30">
                                                    @if ($data->HOD_Final_Review_Complete_By)
                                                    {{ $data->HOD_Final_Review_Complete_By }}
                                                @else
                                                    Not Applicable
                                                @endif
                                                </td>
                                                <th class="w-20">HOD Final Review Complete On</th>
                                                <td class="w-30">
                                                    @if ($data->HOD_Final_Review_Complete_On)
                                                    {{ $data->HOD_Final_Review_Complete_On }}
                                                @else
                                                    Not Applicable
                                                @endif
                                                </td>
                                                <th class="w-20">
                                                    HOD Final Review Complete Comment</th>
                                                <td class="w-30">
                                                    @if ($data->HOD_Final_Review_Complete_Comment)
                                                    {{ $data->HOD_Final_Review_Complete_Comment }}
                                                @else
                                                    Not Applicable
                                                @endif
                                                </td>
                                            </tr>
                                            
                                            {{-- <tr>
                                                    <th class="w-20">More Info Required By
                                                    </th>
                                                    <td class="w-30"> @if($data->More_Info_hfr_by){{ $data->More_Info_hfr_by }}@else Not Applicable @endif</td>
                                                    <th class="w-20">
                                                        More Info Required On</th>
                                                    <td class="w-30">@if($data->More_Info_hfr_on){{ $data->More_Info_hfr_on }}@else Not Applicable @endif</td>
                                                    <th class="w-20">
                                                        Comment</th>
                                                    <td class="w-30">@if($data->More_Info_hfr_comment){{ $data->More_Info_hfr_comment }}@else Not Applicable @endif</td>
                                                </tr> --}}
                                            <tr>
                                                <th class="w-20"> FinalQA/CQA Review Complete By</th>
                                                <td class="w-30">
                                                    @if ($data->Final_QA_Review_Complete_By)
                                                        {{ $data->Final_QA_Review_Complete_By }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20"> FinalQA/CQA Review Complete On</th>
                                                <td class="w-30">
                                                    @if ($data->Final_QA_Review_Complete_On)
                                                        {{ Helpers::getdateFormat($data->Final_QA_Review_Complete_On) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20"> FinalQA/CQA Review Completed Comment</th>
                                                <td class="w-30">
                                                    @if ($data->evalution_Closure_comment)
                                                        {{ $data->Final_QA_Review_Complete_Comment }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                    <th class="w-20">More information Required By</th>
                                                    <td class="w-30"> @if ($data->qA_review_complete_by) {{ $data->qA_review_complete_by }} @else Not Applicable @endif</td>
                                                    <th class="w-20">More information Required On</th>
                                                    <td class="w-30"> @if ($data->qA_review_complete_on) {{ Helpers::getdateFormat($data->qA_review_complete_on) }} @else Not Applicable @endif</td>
                                                    <th class="w-20">More information Required Comment</th>
                                                <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td>
            
                                                </tr> --}}
                                            <tr>
                                                <th class="w-20">QAH/CQAH Closure By</th>
                                                <td class="w-30">
                                                    @if ($data->evaluation_complete_by)
                                                        {{ $data->evaluation_complete_by }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20">QAH/CQAH Closure On</th>
                                                <td class="w-30">
                                                    @if ($data->evaluation_complete_on)
                                                        {{ Helpers::getdateFormat($data->evaluation_complete_on) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <th class="w-20">
                                                    QAH/CQAH Closure Comment</th>
                                                <td class="w-30">
                                                    @if ($data->Final_QA_Review_Complete_Comment)
                                                        {{ $data->evalution_Closure_comment }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="w-20">Cancel By
                                                </th>
                                                <td class="w-30">
                                                    @if ($data->cancelled_by)
                                                        {{ $data->cancelled_by }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                <th class="w-20">
                                                    Cancel On</th>
                                                <td class="w-30">
                                                    @if ($data->cancelled_on)
                                                        {{ $data->cancelled_on }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                <th class="w-20">
                                                    Cancel comment</th>
                                                <td class="w-30">
                                                    @if ($data->cancel_comment)
                                                        {{ $data->cancel_comment }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                            </tr>
            
                        </table>
                    </div>
                </div>

                        {{-- <tr>
                            <th class="w-20">Investigation Tool</th>
                            <td class="w-80">
                                @if ($data->investigation_tool)
                                    {{ $data->investigation_tool }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr> --}}
                        {{-- <tr>
                            <th class="w-20">Root Cause</th>
                            <td class="w-80">
                                @if ($data->root_cause)
                                    {{ $data->root_cause }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Impact / Risk Assessment</th>
                            <td class="w-80">
                                @if ($data->impact_risk_assessment)
                                    {{ $data->impact_risk_assessment }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">CAPA</th>
                            <td class="w-80">
                                @if ($data->capa)
                                    {{ $data->capa }}
                            @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Investigation Summary</th>
                            <td class="w-80">
                                @if ($data->investigation_summary_rca)
                                    {{ $data->investigation_summary_rca }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>



                    </table>
                    
                </div>

            
            
            
                <div class="block">
                    <div class="block-head">
                        QA/CQA Final Review
                    </div>
                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                            QA/CQA Final Review Comments</label>
                        <span style="font-size: 0.8rem; margin-left: 60px;">
                            @if ($data->qa_final_comments)
                                {{ $data->qa_final_comments }}
                            @else
                                Not Applicable
                            @endif
                        </span>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            QA/CQA Final Review Attachment

                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->qa_final_attachments)
                                @foreach (json_decode($data->qa_final_attachments) as $key => $file)
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
                <div class="block">
                    <div class="block-head">
                        QAH/CQAH Final Review
                    </div>
                    <div class="inner-block">
                        <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                            QAH/CQAH Final Review Comments</label>
                        <span style="font-size: 0.8rem; margin-left: 60px;">
                            @if ($data->qah_final_comments)
                                {{ $data->qah_final_comments }}
                            @else
                                Not Applicable
                            @endif
                        </span>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            QAH/CQAH Final Review Attachment

                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Batch No</th>
                            </tr>
                            @if ($data->qah_final_attachments)
                                @foreach (json_decode($data->qah_final_attachments) as $key => $file)
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

                </div>--}}
             
            </div>
            </div>
        @endforeach

    @endif

@endforeach


@foreach($records as $data)

    @if(optional($data->ActionItem)->count())

        @foreach ($data->ActionItem as $data)
         <center><h3>ActionItem Report</h3></center>
        <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/AI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($data->division_id)
                                {{ Helpers::getDivisionName($data->division_id) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Parent Record Number</th>
                        <td class="w-30">
                            @if ($data->parent_record_number)
                                {{ $data->parent_record_number }}
                            @elseif($data->parent_record_number_edit)
                                {{ $data->parent_record_number_edit }}
                                @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Short Description</th>
                            <td class="w-80">
                                @if ($data->short_description)
                                    {{ $data->short_description }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>



                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Action Item Related Records</th>
                            <td class="w-30">
                                @if ($data->related_records)
                                    {{ str_replace(',', ', ', $data->related_records) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        {{-- <tr>
                            <th class="w-20">HOD Persons</th>
                            <td class="w-80">
                                @if ($data->hod_preson)
                                    {{ $data->hod_preson }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr> --}}

                            <th class="w-20">HOD Persons</th>
                            <td class="w-30">
                                @if ($data->hod_preson)
                                    {{ $data->hod_preson }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    {{-- <div class="other-container ">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-left">
                                        <div class="bold">Description</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="custom-procedure-block" style="margin-left: 12px">
                            <div class="custom-container">
                                <div class="custom-table-wrapper" id="custom-table2">
                                    <div class="custom-procedure-content">
                                        <div class="custom-content-wrapper">
                                            <div class="table-containers">
                                                {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="other-container">
                        <table style="width:100%; border-collapse: collapse;">
                                <tr>
                                    <th class="w-20">
                                        <strong>Description</strong>
                                    </th>
                                    <td class="w-80">
                                        {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Responsible Department</th>
                            <td class="w-80">
                                @if ($data->departments)
                                    {{ $data->departments }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="block-head">
                    File Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->file_attach)
                            @php $files = json_decode($data->file_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>



            <div class="block-head">
                Acknowledge
            </div>
            <table>
                <tr>
                    <th class="w-20">Acknowledge Comment</th>
                    <td class="w-80">
                        @if ($data->acknowledge_comments)
                            {{ $data->acknowledge_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>


            <div class="block-head">
                Acknowledge Attachment
            </div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20"> Sr.No.</th>
                        <th class="w-60">Attachment </th>
                    </tr>
                    @if ($data->acknowledge_attach)
                        @php $files = json_decode($data->acknowledge_attach); @endphp
                        @if (count($files) > 0)
                            @foreach ($files as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-60">Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>


            <div class="block-head">
                Post Completion
            </div>
            <table>
                <tr>
                    <th class="w-20">Action Taken</th>
                    <td class="w-80">
                        @if ($data->action_taken)
                            {{ $data->action_taken }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th class="w-20">Actual Start Date</th>
                    <td class="w-30">
                        @if ($data->start_date)
                            {{ Helpers::getdateFormat($data->start_date) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Actual End Date</th>
                    <td class="w-30">
                        @if ($data->end_date)
                            {{ Helpers::getdateFormat($data->end_date) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="block">
                <table>
                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-80">
                            @if ($data->comments)
                                {{ $data->comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="block-head">
                Completion Attachment
            </div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20"> Sr.No.</th>
                        <th class="w-60">Attachment </th>
                    </tr>
                    @if ($data->Support_doc)
                        @php $files = json_decode($data->Support_doc); @endphp
                        @if (count($files) > 0)
                            @foreach ($files as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-60">Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>


            <div class="block-head">
            QA/CQA Verification
            </div>
            <table>
                <tr>
                    <th class="w-20">QA/CQA Verification Comments</th>
                    <td class="w-80">
                        @if ($data->qa_comments)
                            {{ $data->qa_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>


            <div class="block-head">
                    QA/CQA Verification Attachment
            </div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20"> Sr.No.</th>
                        <th class="w-60">Attachment </th>
                    </tr>
                    @if ($data->final_attach)
                        @php $files = json_decode($data->final_attach); @endphp
                        @if (count($files) > 0)
                            @foreach ($files as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-60">Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>

            <div class="block" style="margin-top: 15px;">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-10">Submit By</th>
                        <td class="w-20">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Submit On</th>
                        <td class="w-20">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Submit Comment</th>
                        <td class="w-30">@if($data->submitted_comment){{ $data->submitted_comment }}@else Not Applicable @endif</td>
                    </tr>


                    

                    <!-- </table>
                    <div class="block-head">
                        Cancel
                    </div>
                    <table> -->

                    <tr>
                        <th class="w-10">Cancel By</th>
                        <td class="w-20">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Cancel On</th>
                        <td class="w-20">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Cancel Comment</th>
                        <td class="w-30">@if($data->cancelled_comment){{ $data->cancelled_comment }}@else Not Applicable @endif</td>
                    </tr>

                    <!-- </table>
                    <div class="block-head">
                        Acknowledge Complete
                    </div>
                    <table> -->

                    <tr>
                        <th class="w-10">Acknowledge Complete By</th>
                        <td class="w-20">@if($data->acknowledgement_by){{ $data->acknowledgement_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Acknowledge Complete On</th>
                        <td class="w-20">@if($data->acknowledgement_on){{ $data->acknowledgement_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Acknowledge Complete Comment</th>
                        <td class="w-30">@if($data->acknowledgement_comment){{ $data->acknowledgement_comment }}@else Not Applicable @endif</td>
                    </tr>
                    <!-- </table>
                    <div class="block-head">
                        Complete
                    </div>
                    <table> -->
                    <tr>
                        <th class="w-10">Complete By</th>
                        <td class="w-20">@if($data->work_completion_by){{ $data->work_completion_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Complete On</th>
                        <td class="w-20">@if($data->work_completion_on){{ $data->work_completion_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Complete Comment</th>
                        <td class="w-30">@if($data->work_completion_comment){{ $data->work_completion_comment }}@else Not Applicable @endif</td>
                    </tr>
                    <!-- </table>
                    <div class="block-head">
                    Verification Complete
                    </div>
                    <table> -->
                    <tr>
                        <th class="w-10">Verification Complete By</th>
                        <td class="w-20">@if($data->qa_varification_by){{ $data->qa_varification_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Verification Complete On</th>
                        <td class="w-20">@if($data->qa_varification_on){{ $data->qa_varification_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Verification Complete Comment</th>
                        <td class="w-30">@if($data->qa_varification_comment){{ $data->qa_varification_comment }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
        @endforeach

    @endif

@endforeach

</body>

</html>
