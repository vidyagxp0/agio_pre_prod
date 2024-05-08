<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexo - Software</title>
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
                   ExternamlAudit Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://dms.mydemosoftware.com/user/images/logo1.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>External Audit No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
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
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->Initiator_Group){{ $data->Initiator_Group }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">@if($data->division_id){{ $data->division_id }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">
                            @if($data->short_description){{ $data->short_description }}@else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80" colspan="3"> @if($data->due_date){{ $data->due_date }} @else Not Applicable @endif</td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-80" colspan="3"> @if($data->division_code){{ $data->division_code }} @else Not Applicable @endif</td>
                        <th class="w-20">Severity Level</th>
                        <td class="w-80" colspan="3"> @if($data->severity_level){{ $data->severity_level }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80" colspan="3"> @if($data->others){{ $data->others }} @else Not Applicable @endif</td>
                        <th class="w-20">Description</th>
                        <td class="w-80" colspan="3"> @if($data->initial_comments){{ $data->initial_comments }} @else Not Applicable @endif</td>
                        <th class="w-20">External Agencies</th>
                        <td class="w-80" colspan="3"> @if($data->external_agencies){{ $data->external_agencies }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit type</th>
                        <td class="w-30">@if($data->type_of_audit){{ $data->type_of_audit }}@else Not Applicable @endif</td>
                        <th class="w-20">If Others</th>
                        <td class="w-30">@if($data->if_other){{ $data->if_other }}@else Not Applicable @endif</td>
                    </tr>
                    {{--  <tr>
                        <th class="w-20">Supporting Documents</th>
                        <td class="w-80" colspan="3">Document_Name.pdf</td>
                    </tr>  --}}
                </table>
            </div>

            <div class="block">
                <div class="head">

                    <table>
                        <tr>
                            <th class="w-20">Initial Comments</th>
                            <td class="w-80">@if($data->initial_comments){{ $data->initial_comments }}@else Not Applicable @endif</td>
                        </tr>

                        <tr>
                            <th class="w-20">Auditee/Supplier</th>
                            <td class="w-80">@if($data->auditee){{ $data->auditee }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Contact Person
                            </th>
                            <td class="w-80">@if($data->contact_person){{ $data->contact_person }}@else Not Applicable @endif</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Auditee Details
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Other Contacts</th>
                            <td class="w-80">@if($data->other_contacts){{ $data->other_contacts }}@else Not Applicable @endif</td>

                        </tr>
                        <tr>
                            <th class="w-20">zone</th>
                            <td class="w-80">@if($data->zone){{ $data->zone }}@else Not Applicable @endif</td>

                        </tr>
                        <tr>
                            <th class="w-20">Country</th>
                            <td class="w-80"> {{ $data->country }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Address</th>

                                <td class="w-80"> {{ $data->addres }}</td>

                        </tr>
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Regulatory History
                </div>
                <table>
                    <tr>
                        <th class="w-50" colspan="2">Regulatory History
                        </th>
                        <td class="w-50" colspan="2">@if($data->regulatory_history){{ $data->regulatory_history }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Manufacturing Sities
                        </th>
                        <td class="w-30">@if($data->manufacturing_sities){{ $data->manufacturing_sities }}@else Not Applicable @endif</td>
                        <th class="w-20">Quality Management
                        </th>
                        <td class="w-30">@if($data->quality_management){{ $data->quality_management }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Business History
                        </th>
                        <td class="w-30">@if($data->business_history){{ $data->business_history }}@else Not Applicable @endif</td>
                        <th class="w-20">Performance History
                        </th>
                        <td class="w-30">@if($data->performance_history){{ $data->performance_history }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Compliance Risk</th>
                        <td class="w-30">@if($data->compliance_risk){{ $data->compliance_risk }}@else Not Applicable @endif</td>
                        <th class="w-20">Last Audit Date</th>
                        <td class="w-30">@if($data->last_audit_date){{ $data->last_audit_date }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Next Audit Date</th>
                        <td class="w-30">@if($data->next_audit_date){{ $data->next_audit_date }}@else Not Applicable @endif</td>
                        <th class="w-20">Audit Frequency</th>
                        <td class="w-30">@if($data->audit_frequency){{ $data->audit_frequency }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Last Audit Result</th>
                        <td class="w-80" colspan="3">@if($data->last_audit_result){{ $data->last_audit_result }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Audit Information
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Facility Type</th>
                            <td class="w-80">

                                <div>
                                    @if($data->facility_type){{ $data->facility_type }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Number of Employess</th>
                            <td class="w-80">
                                <div>
                                    @if($data->number_of_employess){{ $data->number_of_employess }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Access to Technical Support
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->access_to_technical_support){{ $data->access_to_technical_support }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Services Supported
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->services_supported){{ $data->services_supported }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Reliabillty
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->reliabillty){{ $data->reliabillty }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Revenue
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->revenue){{ $data->revenue }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Client Base
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->client_base){{ $data->client_base }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Previous Audit Results
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->previous_audit_results){{ $data->previous_audit_results }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Risk Ram Total
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->risk_ram_total){{ $data->risk_ram_total }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">
                                Risk Median
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->risk_median){{ $data->risk_median }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">
                                Risk Average
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->risk_average){{ $data->risk_average }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">
                                Risk Assessment Total
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($data->risk_assessment_total){{ $data->risk_assessment_total }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submitted By
                        </th>
                        <td class="w-30">{{ $data->submitted_by }}</td>
                        <th class="w-20">Submitted On</th>
                        <td class="w-30">{{ $data->submitted_on }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Closed By</th>
                        <td class="w-30">{{ $data->closed_by }}</td>
                        <th class="w-20">Closed On</th>
                        <td class="w-30">{{ $data->closed_on }}</td>
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
                <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
