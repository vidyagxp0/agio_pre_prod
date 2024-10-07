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
                    Market Complaint Report
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
                        <th class="w-20">Division Code</th>
                        <td class="w-30"> {{ Helpers::getDivisionName(session()->get('division')) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-80">{{ $data->originator }}</td>
                        <th class="w-20">Date Of Initiation</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->initiator_group)
                                {{ Helpers::getFullDepartmentName($data->initiator_group) }}
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
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80">{{ Helpers::getdateFormat($data->due_date_gi) ?? 'Not Applicable' }}</td>
                        {{-- <th class="w-20">Repeat Nature</th>
                        <td class="w-80">{!! $data->repeat_nature_gi ?? 'Not Applicable' !!}</td> --}}
                    </tr>

                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">{{ $data->description_gi ?? 'Not Applicable' }}</td>
                    </tr>

                    <tr>

                        <th class="w-20">Is Repeat</th>
                        <td class="w-80">{{ $data->is_repeat_gi ?? 'Not Applicable' }}</td>

                        <th class="w-20">Complaint</th>
                        <td class="w-80">{{ $data->complainant_gi ?? 'Not Applicable' }}</td>

                    </tr>
                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">{{ $data->repeat_nature_gi ?? 'Not Applicable' }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Complaint Reported On</th>
                        <td class="w-80">
                            {{ Helpers::getdateFormat($data->complaint_reported_on_gi) ?? 'Not Applicable' }}</td>
                        <th class="w-20">Categorization Of Complaint</th>
                        <td class="w-80">{{ $data->categorization_of_complaint_gi ?? 'Not Applicable' }}</td>

                    </tr>


                </table>



                <table>
                    <tr>
                        <th class="w-20">Details Of Nature Market Complaint</th>
                        <td class="w-80">{!! $data->details_of_nature_market_complaint_gi ?? 'Not Applicable' !!}</td>
                    </tr>
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

                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Information Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

            </div>


            <div class="border-table">
                <div class="block-head">
                    Product Details Part 1
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

            <div class="border-table">
                <div class="block-head">
                    Product Details Part 2
                </div>

                <table>
                    <tr class="table_bg">
                        <th>Row #</th>
                        <th class="w-10">Batch Size</th>
                        <th class="w-20">Pack Size</th>
                        <th class="10">Dispatch Quantity</th>
                        <th class="w-5">Remarks</th>
                        {{-- <th class="w-5">Action</th> --}}
                    </tr>

                    <tbody>
                        @php $productsdetails = 1; @endphp
                        @if (!empty($prductgigrid) && is_array($prductgigrid->data))

                            @foreach ($prductgigrid->data as $index => $detail)
                                <tr>
                                    <td>{{ $productsdetails++ }}</td>
                                    <td class="w-20">
                                        {{ isset($detail['info_batch_size']) ? $detail['info_batch_size'] : '' }} </td>
                                    <td class="w-20">
                                        {{ isset($detail['info_pack_size']) ? $detail['info_pack_size'] : '' }} </td>
                                    <td class="w-20">
                                        {{ isset($detail['info_dispatch_quantity']) ? $detail['info_dispatch_quantity'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($detail['info_remarks']) ? $detail['info_remarks'] : '' }} </td>
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


            <div class="border-table">
                <div class="block-head">
                    Traceability
                </div>

                <table>
                    <tr class="table_bg">
                        <th>Row #</th>
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

            <div class="block">
                <div class="block-head">
                    Complaint Acknowledgement
                </div>
                <table>
                    <tr>
                        <th class="w-20">Manufacturer Name Address</th>
                        <td class="w-80">{!! $data->manufacturer_name_address_ca ?? 'Not Applicable' !!}</td>
                    </tr>
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
                        <th class="w-20">Stability Study Data Review</th>
                        <td class="w-80">{!! $data->stability_study_data_review_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QMS Events If Any Review Observation</th>
                        <td class="w-80">{!! $data->qms_events_ifany_review_observation_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Repeated Complaints Queries For Product</th>
                        <td class="w-80">{!! $data->repeated_complaints_queries_for_product_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Interpretation on Complaint Sample If Received</th>
                        <td class="w-80">{!! $data->interpretation_on_complaint_sample_ifrecieved_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Comments (if any)</th>
                        <td class="w-80">{!! $data->comments_ifany_ca ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
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
                <div class="border-table">
                    <div class="block-head">
                        Proposal to Accomplish Investigation Report
                    </div>

                    <table>


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

                </div>





                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Acknowledgment Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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
                            <th class="w-3">Row #</th>
                            <th class="w-10">Name</th>
                            <th class="w-20">Department</th>
                            <th class="w-5">Remarks</th>
                            {{-- <th class="w-5">Action</th> --}}
                        </tr>

                        <tbody>
                            @php $investingTeamIndex = 1; @endphp
                            @if (!empty($giinvesting) && is_array($giinvesting->data))

                                @foreach ($giinvesting->data as $index => $inves)
                                    <tr>
                                        <td>{{ $investingTeamIndex++ }}</td>
                                        <td class="w-20">
                                            {{ isset($inves['name_inv_tem']) ? $inves['name_inv_tem'] : '' }} </td>
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
                        <th class="w-20">Review Of Batch Manufacturing Record (BMR)</th>
                        <td class="w-80">{!! $data->review_of_batch_manufacturing_record_BMR_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Raw Materials Used In Batch Manufacturing</th>
                        <td class="w-80">{!! $data->review_of_raw_materials_used_in_batch_manufacturing_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Batch Packing Record (BPR)</th>
                        <td class="w-80">{!! $data->review_of_Batch_Packing_record_bpr_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Packing Materials Used In Batch Packing</th>
                        <td class="w-80">{!! $data->review_of_packing_materials_used_in_batch_packing_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Analytical Data</th>
                        <td class="w-80">{!! $data->review_of_analytical_data_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Training Record Of Concern Persons</th>
                        <td class="w-80">{!! $data->review_of_training_record_of_concern_persons_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Equipment/Instrument Qualification & Calibration Record</th>
                        <td class="w-80">{!! $data->rev_eq_inst_qual_calib_record_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Equipment Breakdown And Maintenance Record</th>
                        <td class="w-80">{!! $data->review_of_equipment_break_down_and_maintainance_record_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Of Past History Of Product</th>
                        <td class="w-80">{!! $data->review_of_past_history_of_product_gi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Conclusion</th>
                        <td class="w-80">{!! $data->conclusion_pi ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Other Methodology</th>
                        <td class="w-80">{!! $data->root_cause_analysis_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Root Cause Analysis</th>
                        <td class="w-80">{!! $data->conclusion_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">The Probable Root Causes or Root Cause</th>
                        <td class="w-80">{!! $data->the_probable_root ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Impact Assessment</th>
                        <td class="w-80">{!! $data->impact_assessment_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Corrective Action</th>
                        <td class="w-80">{!! $data->corrective_action_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Preventive Action</th>
                        <td class="w-80">{!! $data->preventive_action_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Summary and Conclusion</th>
                        <td class="w-80">{!! $data->summary_and_conclusion_hodsr ?? 'Not Applicable' !!}</td>
                    </tr>
                </table>
            </div>

            <div class="border-table">
                <div class="block-head">
                    Brain Storming Session/Discussion With Concerned Person
                </div>

                <table>
                    <tr class="table_bg">
                        <th>Row #</th>
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




            <div class="block">
                <div class="block-head">
                    CFT Review
                </div>
                <div class="block-head">Production (Table/Capsule/Powder)</div>
                <table>
                    <tr>
                        <th class="w-20">Production Review Required</th>
                        <td class="w-30">
                            @if ($data1->Production_Review)
                                {{ $data1->Production_Table_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        {{-- <td class="w-30"> <div> @if ($data1->Production_Review)  {{ $data1->Production_Review }} @else Not Applicable  @endif </div>  </td> --}}
                        <th class="w-20">Production Person</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_Person)
                                {{ $data1->Production_Table_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Production Assesment</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_Assessment)
                                {{ strip_tags($data1->Production_Table_Assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Feedback</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_Feedback)
                                {{ strip_tags($data1->Production_Table_Feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production by</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_By)
                                {{ $data1->Production_Table_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production on</th>
                        <td class="w-30">
                            @if ($data1->Production_Table_On)
                                {{ $data1->Production_Table_On }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Table Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Production Injection</div>
                <table>
                    <tr>
                        <th class="w-20">Production Injection Review</th>
                        <td class="w-30">
                            @if ($data1->Production_Injection_Review)
                                {{ $data1->Production_Injection_Review }}
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
                        <th class="w-20">Production Injection Assesment</th>
                        <td class="w-80">
                            @if ($data1->Production_Injection_Assessment)
                                {{ strip_tags($data1->Production_Injection_Assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Injection Feedback</th>
                        <td class="w-80">
                            @if ($data1->Production_Injection_Feedback)
                                {{ strip_tags($data1->Production_Injection_Feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Production Injection by</th>
                        <td class="w-30">
                            @if ($data1->Production_Injection_By)
                                {{ $data1->Production_Injection_By }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Injection on</th>
                        <td class="w-30">
                            @if ($data1->Production_Injection_On)
                                {{ $data1->Production_Injection_On }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Injection Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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


                <div class="block-head">Research & Development</div>
                <table>
                    <tr>
                        <th class="w-20">Research Development Required </th>
                        <td class="w-30">
                            @if ($data1->ResearchDevelopment_Review)
                                {{ $data1->ResearchDevelopment_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Reasearch & Developmemt Person</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_person)
                                {{ $data1->Production_Injection_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Research Development)</th>
                        <td class="w-80">
                            @if ($data1->ResearchDevelopment_assessment)
                                {{ strip_tags($data1->ResearchDevelopment_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Reasearch & Development Feedback</th>
                        <td class="w-80">
                            @if ($data1->ResearchDevelopment_feedback)
                                {{ strip_tags($data1->ResearchDevelopment_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Reasearch & Development Completed by</th>
                        <td class="w-30">
                            @if ($data1->ResearchDevelopment_by)
                                {{ $data1->ResearchDevelopment_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Reasearch & Development Completed on</th>
                        <td class="w-30">
                            @if ($data1->ResearchDevelopment_on)
                                {{ $data1->ResearchDevelopment_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Reasearch & Development Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Human Resource</div>
                <table>
                    <tr>
                        <th class="w-20">Human Resource Reveiw</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_review)
                                {{ $data1->Human_Resource_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Humane Resource Person</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_person)
                                {{ $data1->Production_Injection_Person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Impact Assessment (By Humane Resource)</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_assessment)
                                {{ strip_tags($data1->Human_Resource_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Humane Resource Feedback</th>
                        <td class="w-80">
                            @if ($data1->Human_Resource_feedback)
                                {{ strip_tags($data1->Human_Resource_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Humane Resource Completed by</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_by)
                                {{ $data1->Human_Resource_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Humane Resource Completed on</th>
                        <td class="w-30">
                            @if ($data1->Human_Resource_on)
                                {{ $data1->Human_Resource_on }}
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Corporate Quality Assurance</div>
                <table>
                    <tr>
                        <th class="w-20">Corporate Quality Assurance Reveiw</th>
                        <td class="w-30">
                            @if ($data1->CorporateQualityAssurance_Review)
                                {{ $data1->CorporateQualityAssurance_Review }}
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
                        <td class="w-80">
                            @if ($data1->CorporateQualityAssurance_assessment)
                                {{ strip_tags($data1->CorporateQualityAssurance_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Corporate Quality Assurance Feedback</th>
                        <td class="w-80">
                            @if ($data1->CorporateQualityAssurance_feedback)
                                {{ strip_tags($data1->CorporateQualityAssurance_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Corporate Quality Assurance Completed by</th>
                        <td class="w-30">
                            @if ($data1->CorporateQualityAssurance_by)
                                {{ $data1->CorporateQualityAssurance_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Corporate Quality Assurance on</th>
                        <td class="w-30">
                            @if ($data1->CorporateQualityAssurance_on)
                                {{ $data1->CorporateQualityAssurance_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Corporate Quality Assurance Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Stores</div>
                <table>
                    <tr>
                        <th class="w-20">Store Reveiw</th>
                        <td class="w-30">
                            @if ($data1->Store_Review)
                                {{ $data1->Store_Review }}
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
                        <td class="w-80">
                            @if ($data1->Store_assessment)
                                {{ strip_tags($data1->Store_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Store Feedback</th>
                        <td class="w-80">
                            @if ($data1->Store_feedback)
                                {{ strip_tags($data1->Store_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Store Completed by</th>
                        <td class="w-30">
                            @if ($data1->Store_by)
                                {{ $data1->Store_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Store Assurance on</th>
                        <td class="w-30">
                            @if ($data1->Store_on)
                                {{ $data1->Store_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Store
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Engineering</div>
                <table>
                    <tr>
                        <th class="w-20">Engineering Review</th>
                        <td class="w-30">
                            @if ($data1->Engineering_review)
                                {{ $data1->Engineering_review }}
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
                        <th class="w-20">Engineering Assessment (By Engineering)</th>
                        <td class="w-80">
                            @if ($data1->Engineering_assessment)
                                {{ strip_tags($data1->Engineering_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Engineering Feedback</th>
                        <td class="w-80">
                            @if ($data1->Engineering_feedback)
                                {{ strip_tags($data1->Engineering_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Engineering Completed by</th>
                        <td class="w-30">
                            @if ($data1->Engineering_by)
                                {{ $data1->Engineering_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Engineering Completed on</th>
                        <td class="w-30">
                            @if ($data1->Store_on)
                                {{ $data1->Store_on }}
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Regulatory Affair</div>
                <table>
                    <tr>
                        <th class="w-20">Regulatory affair Review</th>
                        <td class="w-30">
                            @if ($data1->RegulatoryAffair_Review)
                                {{ $data1->RegulatoryAffair_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Regularory Affair Person</th>
                        <td class="w-30">
                            @if ($data1->RegulatoryAffair_person)
                                {{ $data1->RegulatoryAffair_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Regulatory Affair Assessment</th>
                        <td class="w-80">
                            @if ($data1->RegulatoryAffair_assessment)
                                {{ strip_tags($data1->RegulatoryAffair_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Regulatory Affair Feedback</th>
                        <td class="w-80">
                            @if ($data1->RegulatoryAffair_feedback)
                                {{ strip_tags($data1->RegulatoryAffair_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Regulatory Affair Completed by</th>
                        <td class="w-30">
                            @if ($data1->RegulatoryAffair_by)
                                {{ $data1->RegulatoryAffair_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Regulatory Affair Completed on</th>
                        <td class="w-30">
                            @if ($data1->RegulatoryAffair_on)
                                {{ $data1->RegulatoryAffair_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Regularory Affair Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Quality Assurance</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Assurance Review</th>
                        <td class="w-30">
                            @if ($data1->Quality_Assurance_Review)
                                {{ $data1->Quality_Assurance_Review }}
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
                        <th class="w-20">Quality Assurance Assessment (By Quality assurance)</th>
                        <td class="w-80">
                            @if ($data1->QualityAssurance_assessment)
                                {{ strip_tags($data1->QualityAssurance_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Quality Assurance Feedback</th>
                        <td class="w-80">
                            @if ($data1->QualityAssurance_feedback)
                                {{ strip_tags($data1->QualityAssurance_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Quality Assurance Completed by</th>
                        <td class="w-30">
                            @if ($data1->QualityAssurance_by)
                                {{ $data1->QualityAssurance_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Quality Assurance Completed on</th>
                        <td class="w-30">
                            @if ($data1->QualityAssurance_on)
                                {{ $data1->QualityAssurance_on }}
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Production (Liquid/Ointment)</div>
                <table>
                    <tr>
                        <th class="w-20">Production Liquid Review</th>
                        <td class="w-30">
                            @if ($data1->ProductionLiquid_Review)
                                {{ $data1->ProductionLiquid_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Liquid Person</th>
                        <td class="w-30">
                            @if ($data1->ProductionLiquid_person)
                                {{ $data1->ProductionLiquid_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Liquid Assessment (By Production Liquid)</th>
                        <td class="w-80">
                            @if ($data1->ProductionLiquid_assessment)
                                {{ strip_tags($data1->ProductionLiquid_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Production Liquid Feedback</th>
                        <td class="w-80">
                            @if ($data1->ProductionLiquid_feedback)
                                {{ strip_tags($data1->ProductionLiquid_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Production Liquid Completed by</th>
                        <td class="w-30">
                            @if ($data1->ProductionLiquid_by)
                                {{ $data1->ProductionLiquid_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Liquid Completed on</th>
                        <td class="w-30">
                            @if ($data1->ProductionLiquid_on)
                                {{ $data1->ProductionLiquid_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Production Liquid Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Quality Control</div>
                <table>
                    <tr>
                        <th class="w-20">Quality Control Review</th>
                        <td class="w-30">
                            @if ($data1->Quality_review)
                                {{ $data1->Quality_review }}
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
                        <th class="w-20">Quality Control Assessment (By Quality Control)</th>
                        <td class="w-80">
                            @if ($data1->Quality_Control_assessment)
                                {{ strip_tags($data1->Quality_Control_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Quality Control Feedback</th>
                        <td class="w-80">
                            @if ($data1->Quality_Control_feedback)
                                {{ strip_tags($data1->Quality_Control_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Quality Control Completed by</th>
                        <td class="w-30">
                            @if ($data1->Quality_Control_by)
                                {{ $data1->Quality_Control_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Production Liquid Completed on</th>
                        <td class="w-30">
                            @if ($data1->Quality_Control_on)
                                {{ $data1->Quality_Control_on }}
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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


                <div class="block-head">Microbiology</div>
                <table>
                    <tr>
                        <th class="w-20">Microbiology Review</th>
                        <td class="w-30">
                            @if ($data1->Microbiology_Review)
                                {{ $data1->Microbiology_Review }}
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
                        <th class="w-20">Microbiology Assessment (By Quality Control)</th>
                        <td class="w-80">
                            @if ($data1->Microbiology_assessment)
                                {{ strip_tags($data1->Microbiology_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Microbiology Feedback</th>
                        <td class="w-80">
                            @if ($data1->Microbiology_feedback)
                                {{ strip_tags($data1->Microbiology_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Microbiology Completed by</th>
                        <td class="w-30">
                            @if ($data1->Microbiology_by)
                                {{ $data1->Microbiology_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Microbiology Completed on</th>
                        <td class="w-30">
                            @if ($data1->Microbiology_on)
                                {{ $data1->Microbiology_on }}
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                <div class="block-head">Safety</div>
                <table>
                    <tr>
                        <th class="w-20">Environment Health Review</th>
                        <td class="w-30">
                            @if ($data1->Environment_Health_review)
                                {{ $data1->Environment_Health_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Environment Health Person</th>
                        <td class="w-30">
                            @if ($data1->Environment_Health_Safety_person)
                                {{ $data1->Environment_Health_Safety_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Envinronment Helath Assessment</th>
                        <td class="w-80">
                            @if ($data1->Health_Safety_assessment)
                                {{ strip_tags($data1->Health_Safety_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Envinronment Health Feedback</th>
                        <td class="w-80">
                            @if ($data1->Health_Safety_feedback)
                                {{ strip_tags($data1->Health_Safety_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Environment Health Completed by</th>
                        <td class="w-30">
                            @if ($data1->Environment_Health_Safety_by)
                                {{ $data1->Environment_Health_Safety_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Environment Health Completed on</th>
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
                            Environment Helath Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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


                <div class="block-head">Contract Giver/Other</div>
                <table>
                    <tr>
                        <th class="w-20">Contract Giver Review</th>
                        <td class="w-30">
                            @if ($data1->ContractGiver_Review)
                                {{ $data1->ContractGiver_Review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Contract Giver Person</th>
                        <td class="w-30">
                            @if ($data1->ContractGiver_person)
                                {{ $data1->Environment_Health_Safety_person }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20"> Contract Giver Assessment</th>
                        <td class="w-80">
                            @if ($data1->ContractGiver_assessment)
                                {{ strip_tags($data1->ContractGiver_assessment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Contract Giver Feedback</th>
                        <td class="w-80">
                            @if ($data1->ContractGiver_feedback)
                                {{ strip_tags($data1->ContractGiver_feedback) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Contract Giver Completed by</th>
                        <td class="w-30">
                            @if ($data1->ContractGiver_by)
                                {{ $data1->ContractGiver_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Contract Giver Completed on</th>
                        <td class="w-30">
                            @if ($data1->ContractGiver_on)
                                {{ $data1->ContractGiver_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <div class="border-table">
                        <div class="block-head">
                            Contract Giver Attachment
                        </div>
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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

                                    <th class="w-20">Other's 1 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_review)
                                                {{ $data1->Other1_review }}
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
                                    <th class="w-20">Other's 1 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_Department_person)
                                                {{ $data1->Other1_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 1)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other1_assessment)
                                                {{ $data1->Other1_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>    
                                    <th class="w-20">Other's 1 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other1_feedback)
                                                {{ $data1->Other1_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                    <th class="w-20"> Other's 1 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_on)
                                                {{ $data1->Other1_on }}
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
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other1_attachment)
                                    @foreach (json_decode($data1->Other1_attachment) as $key => $file)
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
                                Other's 2 ( Additional Person Review From Departments If Required)
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Other's 2 Review Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_review)
                                                {{ $data1->Other2_review }}
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
                                    <th class="w-20">Other's 2 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_Department_person)
                                                {{ $data1->Other2_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 2)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other2_Assessment)
                                                {{ $data1->Other2_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    </tr>
                                    <tr> 
                                    <th class="w-20">Other's 2 Feedback</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other2_feedback)
                                                {{ $data1->Other2_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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
                                                {{ $data1->Other2_on }}
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
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other2_attachment)
                                    @foreach (json_decode($data1->Other2_attachment) as $key => $file)
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
                                                {{ $data1->Other3_review }}
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
                                    <th class="w-20">Other's 3 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_Department_person)
                                                {{ $data1->Other3_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <th class="w-20">Impact Assessment (By Other's 3)</th>
                                    <td class="w-80" colspan="5">
                                        <div>
                                            @if ($data1->Other3_Assessment)
                                                {{ $data1->Other3_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                    </tr>
                                    <tr> 

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
                                </tr>
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
                                                {{ $data1->Other3_on }}
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
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other3_attachment)
                                    @foreach (json_decode($data1->Other3_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">4</td>
                                        <td class="w-20">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
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
                                                {{ $data1->Other4_review }}
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
                                    <th class="w-20">Other's 4 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_Department_person)
                                                {{ $data1->Other4_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

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
                                    <tr> 
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
                                </tr>
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
                                    <th class="w-20"> Other's 4 Review Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_on)
                                                {{ $data1->Other4_on }}
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
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other4_attachment)
                                    @foreach (json_decode($data1->Other4_attachment) as $key => $file)
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
                                                {{ $data1->Other5_review }}
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
                                    <th class="w-20">Other's 5 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_Department_person)
                                                {{ $data1->Other5_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

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
                                    <tr> 
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
                                </tr>
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
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_on)
                                                {{ $data1->Other5_on }}
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
                                    <th class="w-20">S.N.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other5_attachment)
                                    @foreach (json_decode($data1->Other5_attachment) as $key => $file)
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Batch No</th>
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
                        <td class="w-80">{{ $data->submitted_by }}</td>
                        <th class="w-20">Submit On</th>
                        <td class="w-80">{{ $data->submitted_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Submit Comment</th>
                        <td class="w-80">{{ $data->submitted_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Complete Review By :</th>
                        <td class="w-80">{{ $data->complete_review_by }}</td>
                        <th class="w-20">Complete Review On :</th>
                        <td class="w-80">{{ $data->complete_review_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Complete Review Comment</th>
                        <td class="w-80">{{ $data->complete_review_Comments }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-80">{{ $data->cancelled_by }}</td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-80">{{ $data->cancelled_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-80">{{ $data->cancelled_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Send To CFT  By</th>
                        <td class="w-80">{{ $data->cft_complate_by }}</td>
                        <th class="w-20">Send To CFT  On</th>
                        <td class="w-80">{{ $data->cft_complate_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Send To CFT Review Comment</th>
                        <td class="w-80">{{ $data->send_cft_comment }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CFT Review Complete By</th>
                        <td class="w-80">{{ $data->cft_complate_by }}</td>
                        <th class="w-20">CFT Review Complete On</th>
                        <td class="w-80">{{ $data->cft_complate_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">CFT Review Complete Comment</th>
                        <td class="w-80">{{ $data->cft_complate_comm }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA/CQA Verification Complete By :</th>
                        <td class="w-80">{{ $data->qa_cqa_verif_comp_by }}</td>
                        <th class="w-20">QA/CQA Verification Complete On :</th>
                        <td class="w-80">{{ $data->qa_cqa_verif_comp_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA/CQA Verification Complete Comment</th>
                        <td class="w-80">{{ $data->QA_cqa_verif_Comments }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">QA Head Approval Completed By</th>
                        <td class="w-80">{{ $data->qA_head_approval_completed_by }}</td>
                        <th class="w-20">QA Head Approval Completed On</th>
                        <td class="w-80">{{ $data->qA_head_approval_completed_on }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Approval Complete By</th>
                        <td class="w-80">{{ $data->approve_plan_by }}</td>
                        <th class="w-20">Approval Complete On</th>
                        <td class="w-80">{{ $data->approve_plan_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Approval Comment</th>
                        <td class="w-80">{{ $data->approve_plan_comment }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Send Letter By</th>
                        <td class="w-80">{{ $data->send_letter_by }}</td>
                        <th class="w-20">Send Letter On</th>
                        <td class="w-80">{{ $data->send_letter_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Send Letter Comment</th>
                        <td class="w-80">{{ $data->send_letter_comment }}</td>
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



</body>

</html>
