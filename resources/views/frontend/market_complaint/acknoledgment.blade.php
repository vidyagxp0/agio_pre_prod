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
                    Complaint Acknoledgment Report
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
                    <strong>MarketComplaint No.</strong>
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





    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    Product Material Detail
                </div>

                <div style="font-weight: 200">Product Material Detail</div>

                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th style="width: 50px;">Sr. No</th>
                            <th class="w-20">Product Name</th>
                            <th class="w-20">Batch No.</th>
                            <th class="w-20">Mfg. Date</th>
                            <th class="w-20">Exp. Date</th>
                            <th class="w-20">Batch Size</th>
                            <th class="w-20">Pack Profile</th>
                            <th class="w-20">Released Quantity</th>
                            <th class="w-20">Remarks</th>
                        </tr>
                        @if ($product_materialDetails && is_array($product_materialDetails->data))
                            @foreach ($product_materialDetails->data as $item)
                                <tr>
                                    <td class="w-20">{{ $loop->index + 1 }}</td>
                                    <td class="w-20">
                                        {{ isset($item['product_name_ca']) ? $item['product_name_ca'] : '' }} </td>
                                    <td class="w-20">
                                        {{ isset($item['batch_no_pmd_ca']) ? $item['batch_no_pmd_ca'] : '' }}</td>
                                    <td class="w-20">
                                        {{ isset($item['mfg_date_pmd_ca']) ? $item['mfg_date_pmd_ca'] : '' }}</td>
                                    <td class="w-20">
                                        {{ isset($item['expiry_date_pmd_ca']) ? $item['expiry_date_pmd_ca'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($item['batch_size_pmd_ca']) ? $item['batch_size_pmd_ca'] : '' }}</td>
                                    <td class="w-20">
                                        {{ isset($item['pack_profile_pmd_ca']) ? $item['pack_profile_pmd_ca'] : '' }}
                                    </td>
                                    <td class="w-20">
                                        {{ isset($item['released_quantity_pmd_ca']) ? $item['released_quantity_pmd_ca'] : '' }}
                                    </td>
                                    <td class="w-20">{{ isset($item['remarks_ca']) ? $item['remarks_ca'] : '' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
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

            <div style="font-weight: 200">Auditors Roles(Names)</div>

            {{-- <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th style="width: 50px;">Sr. No</th>
                        <th class="width: 20">Sr. No.</th>
                        <th class="width: 20">Requirements</th>
                        <th class="width: 20">Yes/No</th>
                        <th class="width: 20">Expected date of investigation completion</th>
                        <th>Remarks</th>
                    </tr>
                    @if ($proposalData && is_array($proposalData->data))
                        @foreach ($proposalData->data as $item)
                            <tr>
                                <td class="w-20">{{ $loop->index + 1 }}</td>
                                <td class="w-20">{{ $item['csr1_yesno'] ?? '' }}</td>
                                <td class="w-20">{{ $item['name'] ?? '' }}</td>
                                <td class="w-20">{{ $item['csr2'] ?? '' }}</td>
                                <td class="w-20">{{ $item['remarks'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                            <td>Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div> --}}

        </div>

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

            <tr>
                <th class="w-20">Initial Attachment</th>
                <td class="w-80">
                    @if ($data->initial_attachment_ca)
                        <a href="{{ asset('upload/' . $data->initial_attachment_ca) }}"
                            target="_blank">{{ $data->initial_attachment_ca }}</a>
                    @else
                        Not Attached
                    @endif
                </td>
            </tr>
        </table>
    </div>

    </div>
    </div>
    <div class="block">
        <div class="block-head">
            <table>
                <tr>
                    <th class="w-20">Initiator Name</th>
                    <td class="w-80">{{ $data->originator }}</td>
                    {{-- <th class="w-20">Date Initiation</th>
                    <td class="w-80">{{ Helpers::getdateFormat($data->created_at) }}</td> --}}
                </tr>
            </table>
        </div>
    </div>

    <div class="block">
        <div class="block-head">
            <table>
                <tr>
                    <th class="w-20">QA/CQA Head Review by</th>
                    <td class="w-80">{{ $data->originator }}</td>
                    {{-- <th class="w-20">Date Initiation</th>
                    <td class="w-80">{{ Helpers::getdateFormat($data->created_at) }}</td> --}}
                </tr>
            </table>
        </div>
    </div>

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
</body>

</html>
