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
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    General Information & Complaint Acknowledgement Report
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
            <tr>
                <td class="w-80">
                    <strong>Market Complaint No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/MC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-80">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-80">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-80">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

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
                        <td class="w-80">{{ $data->originator }}</td>
                        <th class="w-20">Date Of Initiation</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>


                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">{{ $data->description_gi ?? 'Not Applicable' }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->due_date_gi) ?? 'Not Applicable' }}</td>
                        {{-- <th class="w-20">Repeat Nature</th>
                        <td class="w-80">{!! $data->repeat_nature_gi ?? 'Not Applicable' !!}</td> --}}
                    </tr>

                    <tr>
                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->initiator_group)
                                {{ $data->initiator_group }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-30">
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
                                <th class="w-60">attachment</th>
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
                        <td class="w-80">{{ $data->complainant_gi ?? 'Not Applicable' }}</td>
                       
                        <th class="w-20">Complaint Reported On</th>
                        <td class="w-80">
                            {{ Helpers::getdateFormat($data->complaint_reported_on_gi) ?? 'Not Applicable' }}</td>
                       
                    </tr>
                    <tr>
                        <th class="w-20">Details of Nature of Market Complaint</th>
                        <td class="w-80" colspan='5'>{!! $data->details_of_nature_market_complaint_gi ?? 'Not Applicable' !!}</td>
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
                        <td class="w-80">{{ $data->categorization_of_complaint_gi ?? 'Not Applicable' }}</td>

                    
                        
                    <th class="w-20">Is Repeat</th>
                        <td class="w-80">{{ ucfirst($data->is_repeat_gi ?? 'Not Applicable') }}</td>

                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80" colspan="5">{{ $data->repeat_nature_gi ?? 'Not Applicable' }}</td>
                    </tr>
                   


                </table>



                <table>
                   
                </table>



                <table>
                    <tr>
                        <th class="w-20">Review Of Complaint Sample</th>
                        <td class="w-80">{!! $data->review_of_complaint_sample_gi ?? 'Not Applicable' !!}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Review Of Control Sample</th>
                        <td class="w-80">{!! $data->review_of_control_sample_gi ?? 'Not Applicable' !!}</td>
                    </tr>

                    
                </table>
                <table>
                    <tr>
                        <th class="w-20">Review of Stability Study Program and Samples</th>
                        <td class="w-80">{!! $data->review_of_stability_study_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review of Product Manufacturing and Analytical Process</th>
                        <td class="w-80">{!! $data->review_of_product_manu_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Additional Information if Require</th>
                        <td class="w-80">{!! $data->additional_inform ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Type of Market Complaints</th>
                        <td class="w-80">{!! $data->probable_root_causes_complaint_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-80">{!! $data->in_case_Invalide_com ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
            </div>
            
            

           
            <br>

            <div class="block-head">
            Complaint Acknowledgement
            </div>
              
            <table>
                    <tr>
                        <th class="w-20">Manufacturer Name & Address</th>
                        <td class="w-80">{!! $data->manufacturer_name_address_ca ?? 'Not Applicable' !!}</td>
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
                        <th class="w-10">Dispatch Quantity</th>
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
                        <th class="w-20">Complaint Sample Status</th>
                        <td class="w-80">{!! $data->complaint_sample_status_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Brief Description of Complaint</th>
                        <td class="w-80">{!! $data->brief_description_of_complaint_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Batch Record Review Observation</th>
                        <td class="w-80">{!! $data->batch_record_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Analytical Data Review Observation</th>
                        <td class="w-80">{!! $data->analytical_data_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Retention Sample Review Observation</th>
                        <td class="w-80">{!! $data->retention_sample_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Stablity Study Data Review</th>
                        <td class="w-80">{!! $data->stability_study_data_review_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QMS Events(if Any) Review Observation</th>
                        <td class="w-80">{!! $data->qms_events_ifany_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeated Complaints/Queries For Product</th>
                        <td class="w-80">{!! $data->repeated_complaints_queries_for_product_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Interpretation on Complaint sample(if recieved)</th>
                        <td class="w-80">{!! $data->interpretation_on_complaint_sample_ifrecieved_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Comments (if any)</th>
                        <td class="w-80">{!! $data->comments_ifany_ca ?? 'Not Applicable' !!}</td>
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

                <br>

              
          

            
        </div>
    </div>



</body>

</html>
