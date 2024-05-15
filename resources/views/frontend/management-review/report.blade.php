{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body style="margin: 0px">
    <style>
        table.bordered td,
        table.bordered th {
            border: 1px solid #000;
            padding: 8px;
        }

        table.bordered th.main-head {
            border: 1px solid #fff;
            padding: 8px;
            text-align: left;
        }

        .report-chart {
            max-width: 650px;
            margin: 35px auto;
            background: #dbdbdb;
            padding: 10px 0px;
        }
    </style>
    <table style="width: 700px;">
        <!-- TABLE HEADER -->
        <thead align="left" style="display: table-header-group">
            <tr>
                <th>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 150px; vertical-align: middle">
                                <img src="https://dms.mydemosoftware.com/user/images/logo1.png" alt="..."
                                    style="width: 150px; padding:8px;">
                            </td>
                            <td>&nbsp;</td>
                            <td style="width: 150px; vertical-align: middle">
                                <img src="https://dms.mydemosoftware.com/user/images/customer.png" alt="..."
                                    style="width: 150px; padding:8px;">
                            </td>
                            <td>&nbsp;</td>
                            <td style="width: 150px; vertical-align: middle">
                                <img src="https://dms.mydemosoftware.com/user/images/logo.png" alt="..."
                                    style="width: 150px; padding:8px;">
                            </td>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%;">
                        <tr style="background: #4274da;">
                            <td style="color: white; padding: 8px; font-size: 1.2rem;">Management Review Report</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </thead>

        <!-- TABLE FOOTER -->
        <tfoot align="left" style="display: table-footer-group">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%; border-top: 1px solid black;">
                        <tr>
                            <td style="padding: 8px; font-size: 0.8rem;">Printed by : Amit Guru</td>
                            <td style="padding: 8px; font-size: 0.8rem; text-align: center;">Printed on : 12 Dec, 2023</td>
                            <td style="padding: 8px; font-size: 0.8rem; text-align: right;">Page 1 of 10</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tfoot>

        <!-- TABLE CONTENT -->
        <tbody>
            <tr>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <td style="padding: 8px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px">
                                    Period : 6 Months
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px">
                                    Report Number : CNX - 0004
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="8">[A] Internal Audit</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Audit Type</th>
                                <th>Audit Date</th>
                                <th colspan="6">Findings</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="background: #d7d9db;">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Critical</td>
                                <td>Major</td>
                                <td>Minor</td>
                                <td>Recommendation</td>
                                <td>CAPA Details</td>
                                <td>Closure Details</td>
                            </tr>
                            @foreach ($managementReview->internalAudit as $temp)
                            <tr>
                                <td>{{ $temp->audit_type }}</td>
                                <td>{{Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart">
                   <img src="https://dms.mydemosoftware.com/user/reportChart/r2.PNG" width="100%">
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart">
                    <img src="https://dms.mydemosoftware.com/user/reportChart/r1.PNG" width="100%">
                 </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart">
                    <img src="https://dms.mydemosoftware.com/user/reportChart/r3.PNG" width="100%">
                 </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="8">[B] External Audit</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Audit Type</th>
                                <th>Audit Date</th>
                                <th colspan="6">Findings</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="background: #d7d9db;">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Critical</td>
                                <td>Major</td>
                                <td>Minor</td>
                                <td>Recommendatio</td>
                                <td>CAPA Details</td>
                                <td>Closure Details</td>
                            </tr>
                            @foreach ($managementReview->externalAudit as $temp)
                            <tr>
                                <td>{{$temp->type_of_audit}}</td>
                                <td>{{ Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart">
                    <img src="https://dms.mydemosoftware.com/user/reportChart/r4.PNG" width="100%">
                 </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart">
                    <img src="https://dms.mydemosoftware.com/user/reportChart/r5.PNG" width="100%">
                 </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart">
                    <img src="https://dms.mydemosoftware.com/user/reportChart/r6.PNG" width="100%">
                 </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="9">[C] Action Item Details</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Record Number</th>
                                <th>Short Description</th>
                                <th>CAPA Type (Corrective Action / Preventive Action)</th>
                                <th>Date Opened</th>
                                <th>Site / Division</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($managementReview->actionItem)>0)
                            @foreach ($managementReview->actionItem as $temp)
                            <tr>
                                <td>{{ str_pad($temp->record, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $temp->description }}</td>
                                <td>{{ $temp->action_taken }}</td>
                                <td>{{ Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>{{ $temp->site }}</td>
                                <td>{{ $temp->due_date }}</td>
                                <td>{{ $temp->status }}</td>
                                <td>{{ $temp->assign_to }}</td>
                                <td>{{ $temp->updated_at }}</td>

                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            @else
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            @endif
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group;">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" style="border-bottom: 1px solid #000;">
                                    [D] Suitability of Policies and Procedure
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio earum cumque itaque.
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="5">
                                    [E] Status of Actions from Previous Management Reviews
                                </th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Action Item Details</th>
                                <th>Owner</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="7">[F] Outcome of Recent Internal Audits</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Month</th>
                                <th>Sites Audited</th>
                                <th>Critical</th>
                                <th>Major</th>
                                <th>Minor</th>
                                <th>Recommendation</th>
                                <th>CAPA Details, if any</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="7">[G] Outcome of Recent External Audits</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Month</th>
                                <th>Sites Audited</th>
                                <th>Critical</th>
                                <th>Major</th>
                                <th>Minor</th>
                                <th>Recommendation</th>
                                <th>CAPA Details, if any</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="9">[H] CAPA Details</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Record Number</th>
                                <th>Short Description</th>
                                <th>CAPA Type (Corrective Action / Preventive Action)</th>
                                <th>Date Opened</th>
                                <th>Site / Division</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($managementReview->capa as $temp)
                            <tr>
                                <td>{{ Helpers::record($temp->record) }}</td>
                                <td>{{ $temp->short_description }}</td>
                                <td>{{ $temp->corrective_action }} {{ $temp->preventive_action }}</td>
                                <td>{{ Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>{{ Helpers::getDivisionName($temp->division_id) }}</td>
                                <td>{{ $temp->due_date }}</td>
                                <td>{{ $temp->status }}</td>
                                <td>{{ Helpers::getInitiatorName($temp->assign_id) }}</td>
                                @if($temp->stage == 6)
                                <td> Document not close yet </td>
                                @else
                                <td>{{ Helpers::getdateFormat($temp->updated_at) }}</td>
                                @endif
                            </tr>
                            @endforeach

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="8">[I] Root Cause Analysis Details</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Record Number</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Site / Division</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($managementReview->rootCause as $temp)
                            <tr>
                                <td>{{ Helpers::record($temp->record) }}</td>
                                <td>{{ $temp->short_description }}</td>
                                <td>{{ Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>{{ Helpers::getDivisionName($temp->division_id) }}</td>
                                <td>{{ $temp->due_date }}</td>
                                <td>{{ $temp->status }}</td>
                                <td>{{ Helpers::getInitiatorName($temp->assign_id) }}</td>
                                @if($temp->stage == 6)
                                <td> Document not close yet </td>
                                @else
                                <td>{{ Helpers::getdateFormat($temp->updated_at) }}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="8">[J] Lab Incident Details</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Record Number</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Site / Division</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($managementReview->LabIncident as $temp)
                            <tr>
                                <td>{{ Helpers::record($temp->record) }}</td>
                                <td>{{ $temp->short_description }}</td>
                                <td>{{ Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>{{ Helpers::getDivisionName($temp->division_id) }}</td>
                                <td>{{ $temp->due_date }}</td>
                                <td>{{ $temp->status }}</td>
                                <td>{{ Helpers::getInitiatorName($temp->assign_id) }}</td>
                                @if($temp->stage == 6)
                                <td> Document not close yet </td>
                                @else
                                <td>{{ Helpers::getdateFormat($temp->updated_at) }}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="9">[K] Risk Assessment Details</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Record Number</th>
                                <th>Short Description</th>
                                <th>Risk Category</th>
                                <th>Date Opened</th>
                                <th>Site / Division</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($managementReview->riskAnalysis as $temp)
                            <tr>
                                <td>{{ Helpers::record($temp->record) }}</td>
                                <td>{{ $temp->short_description }}</td>
                                <td>{{ $temp->type }}</td>
                                <td>{{ Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>{{ Helpers::getDivisionName($temp->division_id) }}</td>
                                <td>{{ $temp->due_date }}</td>
                                <td>{{ $temp->status }}</td>
                                <td>{{ Helpers::getInitiatorName($temp->assign_id) }}</td>
                                @if($temp->stage == 6)
                                <td> Document not close yet </td>
                                @else
                                <td>{{ Helpers::getdateFormat($temp->updated_at) }}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="9">[L] Change Control Details</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Record Number</th>
                                <th>Short Description</th>
                                <th>Change Type</th>
                                <th>Date Opened</th>
                                <th>Site / Division</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($managementReview->changeControl as $temp)
                            <tr>
                                <td>{{ Helpers::record($temp->record) }}</td>
                                <td>{{ $temp->short_description }}</td>
                                <td>{{ $temp->type_chnage }}</td>
                                <td>{{ Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>{{ Helpers::getDivisionName($temp->division_id) }}</td>
                                <td>{{ $temp->due_date }}</td>
                                <td>{{ $temp->status }}</td>
                                <td>{{ Helpers::getInitiatorName($temp->assign_id) }}</td>
                                @if($temp->stage == 6)
                                <td> Document not close yet </td>
                                @else
                                <td>{{ Helpers::getdateFormat($temp->updated_at) }}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="11">[M] Assessment by External Bodies</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>External Body</th>
                                <th>Short Description</th>
                                <th>Type</th>
                                <th>Site / Division</th>
                                <th>Assessment Date</th>
                                <th>Assessment Details</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                                <th>Related Documents</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="10">[N] Issues other than Audits</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Short Description</th>
                                <th>Severity (Critical / Major / Minor)</th>
                                <th>Site / Division</th>
                                <th>Issue Reporting Date</th>
                                <th>CAPA Details if any</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                                <th>Related Documents</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="9">[O] Customer/Personnel Feedback</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Feedback From (Customer / Personnel)</th>
                                <th>Feedback Reporting Date</th>
                                <th>Site / Division</th>
                                <th>Short Description</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                                <th>Related Documents</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head" colspan="8">[P] Effectiveness Check Details</th>
                            </tr>
                            <tr style="background: #4274da; color: white;">
                                <th>Record Number</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Site / Division</th>
                                <th>Date Due</th>
                                <th>Current Status</th>
                                <th>Person Responsible</th>
                                <th>Date Closed</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($managementReview->changeControl as $temp)
                            <tr>
                                <td>{{ Helpers::record($temp->record) }}</td>
                                <td>{{ $temp->short_description }}</td>
                                <td>{{ Helpers::getdateFormat($temp->created_at) }}</td>
                                <td>{{ Helpers::getDivisionName($temp->division_id) }}</td>
                                <td>{{ $temp->due_date }}</td>
                                <td>{{ $temp->status }}</td>
                                <td>{{ Helpers::getInitiatorName($temp->originator) }}</td>
                                @if($temp->stage == 6)
                                <td> Document not close yet </td>
                                @else
                                <td>{{ Helpers::getdateFormat($temp->updated_at) }}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head">[Q] Comments</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr></tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1rem;">
                                <th class="main-head">[R] Summary & Recommendations</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr></tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody>

    </table>


</body>

</html> --}}
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
                    Management Review  Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://dms.mydemosoftware.com/user/images/logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Management Audit No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($managementReview->division_id) }}/MR/{{ Helpers::year($managementReview->created_at) }}/{{ str_pad($managementReview->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($managementReview->record, 4, '0', STR_PAD_LEFT) }}
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
                    <tr>  {{ $managementReview->created_at }} added by {{ $managementReview->originator}}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($managementReview->initiator_id) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">@if($managementReview->record){{ $managementReview->record }} @else Not Applicable @endif</td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($managementReview->division_code){{ $managementReview->division_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <!-- <td class="w-30">@if($managementReview->initiator_Group){{ $managementReview->initiator_Group }} @else Not Applicable @endif</td> -->
                        <td class="w-30">{{ Helpers::getInitiatorName($managementReview->initiator_Group) }}</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">@if($managementReview->initiator_group_code){{ $managementReview->initiator_group_code }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($managementReview->assign_to){{ Helpers::getInitiatorName($managementReview->assign_to) }} @else Not Applicable @endif</td>
                        
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30">
                            @if($managementReview->short_description){{ $managementReview->short_description }}@else Not Applicable @endif
                        </td>
                        <th class="w-20">Priority Level</th>
                        <td class="w-30">
                            @if($managementReview->priority_level){{ $managementReview->priority_level }}@else Not Applicable @endif
                        </td>
                        <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($managementReview->due_date){{ $managementReview->due_date }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Type</th>
                        <td class="w-30">@if($managementReview->type){{ $managementReview->type }}@else Not Applicable @endif</td>
                        
                    </tr>
                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-30">@if($managementReview->description){{ $managementReview->description }}@else Not Applicable @endif</td>
                            <th class="w-30"> Schedule Start Date</th>
                        <td class="w-20">@if($managementReview->start_date){{ $managementReview->start_date }}@else Not Applicable @endif</td>
                        <th class="w-30"> Schedule End Date</th>
                        <td class="w-20">@if($managementReview->end_date){{ $managementReview->end_date }}@else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        
                        <th class="w-20">Attendess</th>
                        <td class="w-30">@if($managementReview->attendees){{ $managementReview->attendees }}@else Not Applicable @endif</td>
                        

                    </tr>

                </table>
                <div class="border-table">
                    <div class="block-head">
                        File Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($managementReview->inv_attachment)
                            @foreach(json_decode($managementReview->inv_attachment) as $key => $file)
                        <tr>
                            <td class="w-20">{{ $key + 1 }}</td>
                            <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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


            {{-- <div class="block">
                {{-- <div class="head">
                    <div class="block-head">
                       
                    </div>
                    <table>
                        <tr>
                            <

                        </tr>

                        <tr>
                            <th class="w-20">Operations </th>
                            <td class="w-80"> @if($managementReview->Operations){{ $managementReview->Operations }}@else Not Applicable @endif</td>
                        </tr>
                        <tr>
                            <th class="w-20">Comments(If Any)</th>
                            <td class="w-30">
                                @if($managementReview->if_comments)
                                    @foreach (explode(',', $managementReview->if_comments) as $Key => $value)

                                    <li>{{ $value }}</li>
                                    @endforeach
                                @else
                                  Not Applicable
                                @endif</td>
                                <th class="w-20">Product/Material Name</th>
                                <td class="w-80">
                                    @if($managementReview->material_name)
                                        @foreach (explode(',', $managementReview->material_name) as $Key => $value)
                                        <li>{{ $value }}</li>
                                        @endforeach
                                    @else
                                      Not Applicable
                                    @endif</td>


                        </tr>

                    </table>
                </div> --}}
            {{-- </div>  --}}
            <div class="block">
                <div class="block-head">
                    Operational planning and control
                </div>
                <table>
                 <tr>
                        <th class="w-20">Operations </th>
                        <td class="w-30">@if($managementReview->Operations){{ $managementReview->Operations }}@else Not Applicable @endif</td>
                        <th class="w-20">Requirements for Products and Services
                        </th>
                        <td class="w-30">@if($managementReview->requirement_products_services){{ $managementReview->requirement_products_services }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Design and Development of Products and Services</th>
                        <td class="w-30">@if($managementReview->design_development_product_services){{($managementReview->design_development_product_services)}} @else Not Applicable @endif</td>
                        <th class="w-20">Control of Externally Provided Processes, Products and Services</th>
                        <td class="w-30">@if($managementReview->control_externally_provide_services){{ $managementReview->control_externally_provide_services }}@else Not Applicable @endif</td>
                    </tr> 
                     <tr>  
                        <th class="w-20">Production and Service Provision</th>
                        <td class="w-30">@if($managementReview->production_service_provision){{ $managementReview->production_service_provision }}@else Not Applicable @endif</td>
                        <th class="w-20">Release of Products and Services</th>
                        <td class="w-30">@if($managementReview->release_product_services){{ $managementReview->release_product_services }}@else Not Applicable @endif</td>
                    </tr>
                        <th class="w-20">Control of Non-conforming Outputs </th>
                        <td class="w-30">@if($managementReview->control_nonconforming_outputs){{ $managementReview->control_nonconforming_outputs }}@else Not Applicable @endif</td>
                    </tr>

                    <tr>
                        <th class="w-20">Audit team</th>
                        <td class="w-30">
                            @if($managementReview->Audit_team)
                            @foreach (explode(',', $managementReview->Audit_team) as $Key => $value)
                                <li>{{ Helpers::getInitiatorName($value) }}</li>
                            @endforeach
                            @else Not Applicable
                            @endif
                        </td>
                        {{-- <th class="w-20">Auditee</th> --}}
                        {{-- <td class="w-30">
                            @if($managementReview->Auditee)
                            @foreach (explode(',', $managementReview->Auditee) as $Key => $value)
                                <li>{{ Helpers::getInitiatorName($value) }}</li>
                            @endforeach
                            @else Not Applicable
                            @endif
                        </td> --}}

                    </tr>
                    {{-- <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-30">@if($managementReview->Comments){{ $managementReview->Comments }}@else Not Applicable @endif</td>
                        <th class="w-20">Audit Category</th>
                        <td class="w-30">@if($managementReview->Audit_Category){{ $managementReview->Audit_Category }}@else Not Applicable @endif</td>
                    </tr>    --}}
                   {{-- <tr>
                        <th class="w-20">Supplier/Vendor/Manufacturer Site</th>
                        <td class="w-30">@if($managementReview->Supplier_Site){{ $managementReview->Supplier_Site }}@else Not Applicable @endif</td>
                        <th class="w-20">Supplier/Vendor/Manufacturer Details</th>
                        <td class="w-30">@if($managementReview->Supplier_Details){{ $managementReview->Supplier_Details}}@else Not Applicable @endif</td>
                    </tr> --}}
                </table>
            </div>
             <div class="border-table">
                {{-- <div class="block-head">
                    File Attachment
                </div> --}}
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                        @if($managementReview->file_attachment)
                        @foreach(json_decode($managementReview->file_attachment) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                        @else
                    <tr>
                        <td class="w-20">1</td>
                        <td class="w-20">Not Applicable</td>
                    </tr>
                    @endif

             </table>
            </div> -
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Meetings and summary
                    </div>
                    <table>
                   
                        <tr>
                            <th class="w-20">Risk & Opportunities</th>
                            <td class="w-30">
                                <div>
                                    @if($managementReview->risk_opportunities){{ $managementReview->risk_opportunities }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">External Supplier Performance</th>
                            <td class="w-30">
                                <div>
                                    @if($managementReview->external_supplier_performance){{ $managementReview->external_supplier_performance }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Customer Satisfaction Level
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($managementReview->customer_satisfaction_level){{ $managementReview->customer_satisfaction_level }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">Budget Estimatesn</th>
                            <td class="w-30">
                                    <div>
                                        @if($managementReview->budget_estimates){{ $managementReview->budget_estimates }}@else Not Applicable @endif
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <th class="w-20">Completion of Previous Tasks</th>
                            <td class="w-30">
                                <div>
                                    @if($managementReview->completion_of_previous_tasks){{ $managementReview->completion_of_previous_tasks }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">Production
                            </th>
                            <td class="w-30">
                                <div>
                                    @if($managementReview->production_new){{ $managementReview->production_new }}@else Not Applicable @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Plans

                            </th>
                            <td class="w-80">
                                <div>
                                    @if($managementReview->plans_new){{ $managementReview->plans_new }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">Forecast</th>
                            <td class="w-30">
                                    <div>
                                        @if($managementReview->forecast_new){{ $managementReview->forecast_new }}@else Not Applicable @endif
                                    </div>
                                </td>
                                <th class="w-20">Any Additional Support Required
                                </th>
                            <td class="w-30">
                                    <div>
                                        @if($managementReview->additional_suport_required){{ $managementReview->additional_suport_required }}@else Not Applicable @endif
                                    </div>
                                </td>
                        </tr>



                    </table>
                </div>
                <div class="border-table">
                    <div class="block-head">
                        File Attachment, if any
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($managementReview->file_attchment_if_any)
                            @foreach(json_decode($managementReview->file_attchment_if_any) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
                    Closure
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Next Management Review Date
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($managementReview->next_managment_review_date){{ $managementReview->next_managment_review_date }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">Summary & Recommendation</th>
                            <td class="w-30">
                                    <div>
                                        @if($managementReview->summary_recommendation){{ $managementReview->summary_recommendation }}@else Not Applicable @endif
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <th class="w-20">Conclusion
                            </th>
                            <td class="w-80">
                                <div>
                                    @if($managementReview->conclusion_new){{ $managementReview->conclusion_new }}@else Not Applicable @endif
                                </div>
                            </td>
                            <th class="w-20">Due Date Extension Justification</th>
                            <td class="w-30">
                                    <div>
                                        @if($managementReview->due_date_extension){{ $managementReview->due_date_extension }}@else Not Applicable @endif
                                    </div>
                                </td>
                        </tr>
                   </table>
            </div>
        </div>
    </div>
    
                
                <div class="border-table">
                    <div class="block-head">
                        Closure Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($managementReview->closure_attachments)
                            @foreach(json_decode($managementReview->closure_attachments) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
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
                {{-- <div class="border-table">
                    <div class="block-head">
                        Audit Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($managementReview->myfile)
                            @foreach(json_decode($managementReview->myfile) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                        @endif
                         </table>
                </div> --}}
            </div>



            
            <div class="block">
                <div class="head">
                    <div class="block-head">
                     Activity log
                    </div>
                    <table>

                    <tr>
                        <th class="w-20">Completed By</th>
                        <td class="w-30">{{ $managementReview->completed_by }}</td>
                        <th class="w-20">Completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Submited By</th>
                        <td class="w-30">{{ $managementReview->Submited_by }}</td>
                        <th class="w-20">Submited On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->Submited_on) }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">Audit preparation completed by</th>
                        <td class="w-30">{{ $managementReview->audit_preparation_completed_by }}</td>
                        <th class="w-20">Audit preparation completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->audit_preparation_completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit preparation completed by</th>
                        <td class="w-30">{{ $managementReview->audit_preparation_completed_by }}</td>
                        <th class="w-20">Audit preparation completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->audit_preparation_completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $managementReview->audit_mgr_more_info_reqd_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->audit_mgr_more_info_reqd_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Observation Submitted By</th>
                        <td class="w-30">{{ $managementReview->audit_observation_submitted_by }}</td>
                        <th class="w-20">Supervisor Reviewed On(QA)</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->audit_observation_submitted_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Lead More Info Reqd By
                        </th>
                        <td class="w-30">{{ $managementReview->audit_lead_more_info_reqd_by }}</td>
                        <th class="w-20">More Information Req. On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->audit_lead_more_info_reqd_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Audit Response Completed By</th>
                        <td class="w-30">{{ $managementReview->audit_response_completed_by }}</td>
                        <th class="w-20">QA Review Completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->audit_response_completed_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Response Feedback Verified By</th>
                        <td class="w-30">{{ $managementReview->response_feedback_verified_by }}</td>
                        <th class="w-20">
                            Response Feedback Verified On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($managementReview->response_feedback_verified_on) }}</td>
                    </tr> --}}


                </table>
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
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

</body>

</html>

