<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexo - Software</title>
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
    <table style="width: 750px;">
        <!-- TABLE HEADER -->
        <thead align="left" style="display: table-header-group">
            <tr>
                <th>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 150px; vertical-align: middle">
                                <img src="{{ asset('user/images/logo.png') }}" alt="..."
                                    style="width: 150px; padding:8px;">
                            </td>
                            <td>&nbsp;</td>
                            <td style="width: 150px; vertical-align: middle">
                                <img src="{{ asset('user/images/customer.png') }}" alt="..."
                                    style="width: 150px; padding:8px;">
                            </td>
                            <td>&nbsp;</td>
                            <td style="width: 150px; vertical-align: middle">
                                <img src="{{ asset('user/images/logo1.png') }}" alt="..."
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
                <td class="report-chart" id="report-chart-1">
                    <div style="text-align: center; font-size: 1.3rem; font-weight: bold;">
                        Internal Audit Dashbaord
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart" id="report-chart-3">
                    <div style="text-align: center; font-size: 1.3rem; font-weight: bold;">
                        Internal Audit - Status Distribution
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart" id="report-chart-5">
                    <div style="text-align: center; font-size: 1.3rem; font-weight: bold;">
                        Internal Audit Distribution
                    </div>
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
                <td class="report-chart" id="report-chart-2">
                    <div style="text-align: center; font-size: 1.3rem; font-weight: bold;">
                        External Audit Dashboard
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart" id="report-chart-4">
                    <div style="text-align: center; font-size: 1.3rem; font-weight: bold;">
                        External Audit - Status Distribution
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
            <tr>
                <td class="report-chart" id="report-chart-6">
                    <div style="text-align: center; font-size: 1.3rem; font-weight: bold;">
                        External Audit Distribution
                    </div>
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

    <script>
        let options = {
            series: [{
                name: 'Critical',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 45, 48]
            }, {
                name: 'Major',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 57, 56]
            }, {
                name: 'Minor',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41, 57, 56]
            }, {
                name: 'Recommendation',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 101, 98]
            }],
            chart: {
                type: 'bar',
                height: 450
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11'],
            },
            yaxis: {
                title: {
                    text: 'No. of Findings'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };
        let chart1 = new ApexCharts(document.querySelector("#report-chart-1"), options);
        chart1.render();
        let chart2 = new ApexCharts(document.querySelector("#report-chart-2"), options);
        chart2.render();
    </script>

    <script>
        let pieOptions = {
            series: [11, 5, 7, 18, 9, 16, 34],
            chart: {
                width: 600,
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 270
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
            },
            legend: {
                formatter: function(val, opts) {
                    const customLabels = ['Opened', 'Closed-Cancelled', 'Audit Preparation', 'Pending Audit',
                        'Pending Response', 'CAPA Execution in Progress', 'Closed Done'
                    ]
                    return customLabels[opts.seriesIndex] + " - " + opts.w.globals.series[opts.seriesIndex] + "%"
                }
            },
            title: {
                text: ''
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        let chart3 = new ApexCharts(document.querySelector("#report-chart-3"), pieOptions);
        chart3.render();
    </script>

    <script>
        let pieOptions2 = {
            series: [2, 12, 5, 18, 7, 44],
            chart: {
                width: 500,
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 270
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
            },
            legend: {
                formatter: function(val, opts) {
                    const customLabels = ['Opened', 'Closed-Cancelled', 'Audit Preparation', 'Pending Audit',
                        'Pending Response', 'Closed Done'
                    ]
                    return customLabels[opts.seriesIndex] + " - " + opts.w.globals.series[opts.seriesIndex] + "%"
                }
            },
            title: {
                text: ''
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        let chart4 = new ApexCharts(document.querySelector("#report-chart-4"), pieOptions2);
        chart4.render();
    </script>

    <script>
        let options5 = {
            series: [{
                name: 'line',
                type: 'line',
                data: [{
                    x: new Date(1538778600000),
                    y: 6604
                }, {
                    x: new Date(1538782200000),
                    y: 6602
                }, {
                    x: new Date(1538814600000),
                    y: 6607
                }, {
                    x: new Date(1538884800000),
                    y: 6620
                }]
            }, {
                name: 'candle',
                type: 'candlestick',
                data: [{
                        x: new Date(1538778600000),
                        y: [6629.81, 6650.5, 6623.04, 6633.33]
                    },
                    {
                        x: new Date(1538780400000),
                        y: [6632.01, 6643.59, 6620, 6630.11]
                    },
                    {
                        x: new Date(1538782200000),
                        y: [6630.71, 6648.95, 6623.34, 6635.65]
                    },
                    {
                        x: new Date(1538784000000),
                        y: [6635.65, 6651, 6629.67, 6638.24]
                    },
                    {
                        x: new Date(1538785800000),
                        y: [6638.24, 6640, 6620, 6624.47]
                    },
                    {
                        x: new Date(1538787600000),
                        y: [6624.53, 6636.03, 6621.68, 6624.31]
                    },
                    {
                        x: new Date(1538789400000),
                        y: [6624.61, 6632.2, 6617, 6626.02]
                    },
                    {
                        x: new Date(1538791200000),
                        y: [6627, 6627.62, 6584.22, 6603.02]
                    },
                    {
                        x: new Date(1538793000000),
                        y: [6605, 6608.03, 6598.95, 6604.01]
                    },
                    {
                        x: new Date(1538794800000),
                        y: [6604.5, 6614.4, 6602.26, 6608.02]
                    },
                    {
                        x: new Date(1538796600000),
                        y: [6608.02, 6610.68, 6601.99, 6608.91]
                    },
                    {
                        x: new Date(1538798400000),
                        y: [6608.91, 6618.99, 6608.01, 6612]
                    },
                    {
                        x: new Date(1538800200000),
                        y: [6612, 6615.13, 6605.09, 6612]
                    },
                    {
                        x: new Date(1538802000000),
                        y: [6612, 6624.12, 6608.43, 6622.95]
                    },
                    {
                        x: new Date(1538803800000),
                        y: [6623.91, 6623.91, 6615, 6615.67]
                    },
                    {
                        x: new Date(1538805600000),
                        y: [6618.69, 6618.74, 6610, 6610.4]
                    },
                    {
                        x: new Date(1538807400000),
                        y: [6611, 6622.78, 6610.4, 6614.9]
                    },
                    {
                        x: new Date(1538809200000),
                        y: [6614.9, 6626.2, 6613.33, 6623.45]
                    },
                    {
                        x: new Date(1538811000000),
                        y: [6623.48, 6627, 6618.38, 6620.35]
                    },
                    {
                        x: new Date(1538812800000),
                        y: [6619.43, 6620.35, 6610.05, 6615.53]
                    },
                    {
                        x: new Date(1538814600000),
                        y: [6615.53, 6617.93, 6610, 6615.19]
                    },
                    {
                        x: new Date(1538816400000),
                        y: [6615.19, 6621.6, 6608.2, 6620]
                    },
                    {
                        x: new Date(1538818200000),
                        y: [6619.54, 6625.17, 6614.15, 6620]
                    },
                    {
                        x: new Date(1538820000000),
                        y: [6620.33, 6634.15, 6617.24, 6624.61]
                    },
                    {
                        x: new Date(1538821800000),
                        y: [6625.95, 6626, 6611.66, 6617.58]
                    },
                    {
                        x: new Date(1538823600000),
                        y: [6619, 6625.97, 6595.27, 6598.86]
                    },
                    {
                        x: new Date(1538825400000),
                        y: [6598.86, 6598.88, 6570, 6587.16]
                    },
                    {
                        x: new Date(1538827200000),
                        y: [6588.86, 6600, 6580, 6593.4]
                    },
                    {
                        x: new Date(1538829000000),
                        y: [6593.99, 6598.89, 6585, 6587.81]
                    },
                    {
                        x: new Date(1538830800000),
                        y: [6587.81, 6592.73, 6567.14, 6578]
                    },
                    {
                        x: new Date(1538832600000),
                        y: [6578.35, 6581.72, 6567.39, 6579]
                    },
                    {
                        x: new Date(1538834400000),
                        y: [6579.38, 6580.92, 6566.77, 6575.96]
                    },
                    {
                        x: new Date(1538836200000),
                        y: [6575.96, 6589, 6571.77, 6588.92]
                    },
                    {
                        x: new Date(1538838000000),
                        y: [6588.92, 6594, 6577.55, 6589.22]
                    },
                    {
                        x: new Date(1538839800000),
                        y: [6589.3, 6598.89, 6589.1, 6596.08]
                    },
                    {
                        x: new Date(1538841600000),
                        y: [6597.5, 6600, 6588.39, 6596.25]
                    },
                    {
                        x: new Date(1538843400000),
                        y: [6598.03, 6600, 6588.73, 6595.97]
                    },
                    {
                        x: new Date(1538845200000),
                        y: [6595.97, 6602.01, 6588.17, 6602]
                    },
                    {
                        x: new Date(1538847000000),
                        y: [6602, 6607, 6596.51, 6599.95]
                    },
                    {
                        x: new Date(1538848800000),
                        y: [6600.63, 6601.21, 6590.39, 6591.02]
                    },
                    {
                        x: new Date(1538850600000),
                        y: [6591.02, 6603.08, 6591, 6591]
                    },
                    {
                        x: new Date(1538852400000),
                        y: [6591, 6601.32, 6585, 6592]
                    },
                    {
                        x: new Date(1538854200000),
                        y: [6593.13, 6596.01, 6590, 6593.34]
                    },
                    {
                        x: new Date(1538856000000),
                        y: [6593.34, 6604.76, 6582.63, 6593.86]
                    },
                    {
                        x: new Date(1538857800000),
                        y: [6593.86, 6604.28, 6586.57, 6600.01]
                    },
                    {
                        x: new Date(1538859600000),
                        y: [6601.81, 6603.21, 6592.78, 6596.25]
                    },
                    {
                        x: new Date(1538861400000),
                        y: [6596.25, 6604.2, 6590, 6602.99]
                    },
                    {
                        x: new Date(1538863200000),
                        y: [6602.99, 6606, 6584.99, 6587.81]
                    },
                    {
                        x: new Date(1538865000000),
                        y: [6587.81, 6595, 6583.27, 6591.96]
                    },
                    {
                        x: new Date(1538866800000),
                        y: [6591.97, 6596.07, 6585, 6588.39]
                    },
                    {
                        x: new Date(1538868600000),
                        y: [6587.6, 6598.21, 6587.6, 6594.27]
                    },
                    {
                        x: new Date(1538870400000),
                        y: [6596.44, 6601, 6590, 6596.55]
                    },
                    {
                        x: new Date(1538872200000),
                        y: [6598.91, 6605, 6596.61, 6600.02]
                    },
                    {
                        x: new Date(1538874000000),
                        y: [6600.55, 6605, 6589.14, 6593.01]
                    },
                    {
                        x: new Date(1538875800000),
                        y: [6593.15, 6605, 6592, 6603.06]
                    },
                    {
                        x: new Date(1538877600000),
                        y: [6603.07, 6604.5, 6599.09, 6603.89]
                    },
                    {
                        x: new Date(1538879400000),
                        y: [6604.44, 6604.44, 6600, 6603.5]
                    },
                    {
                        x: new Date(1538881200000),
                        y: [6603.5, 6603.99, 6597.5, 6603.86]
                    },
                    {
                        x: new Date(1538883000000),
                        y: [6603.85, 6605, 6600, 6604.07]
                    },
                    {
                        x: new Date(1538884800000),
                        y: [6604.98, 6606, 6604.07, 6606]
                    },
                ]
            }],
            chart: {
                height: 350,
                type: 'line',
            },
            title: {
                text: 'CandleStick Chart',
                align: 'left'
            },
            stroke: {
                width: [3, 1]
            },
            tooltip: {
                shared: true,
                custom: [function({
                    seriesIndex,
                    dataPointIndex,
                    w
                }) {
                    return w.globals.series[seriesIndex][dataPointIndex]
                }, function({
                    seriesIndex,
                    dataPointIndex,
                    w
                }) {
                    let o = w.globals.seriesCandleO[seriesIndex][dataPointIndex]
                    let h = w.globals.seriesCandleH[seriesIndex][dataPointIndex]
                    let l = w.globals.seriesCandleL[seriesIndex][dataPointIndex]
                    let c = w.globals.seriesCandleC[seriesIndex][dataPointIndex]
                    return (
                        ''
                    )
                }]
            },
            xaxis: {
                type: 'datetime'
            }
        };
        let chart5 = new ApexCharts(document.querySelector("#report-chart-5"), options5);
        chart5.render();
    </script>

    <script>
        let options6 = {
            series: [{
                    type: 'rangeArea',
                    name: 'Team B Range',

                    data: [{
                            x: 'Jan',
                            y: [1100, 1900]
                        },
                        {
                            x: 'Feb',
                            y: [1200, 1800]
                        },
                        {
                            x: 'Mar',
                            y: [900, 2900]
                        },
                        {
                            x: 'Apr',
                            y: [1400, 2700]
                        },
                        {
                            x: 'May',
                            y: [2600, 3900]
                        },
                        {
                            x: 'Jun',
                            y: [500, 1700]
                        },
                        {
                            x: 'Jul',
                            y: [1900, 2300]
                        },
                        {
                            x: 'Aug',
                            y: [1000, 1500]
                        }
                    ]
                },

                {
                    type: 'rangeArea',
                    name: 'Team A Range',
                    data: [{
                            x: 'Jan',
                            y: [3100, 3400]
                        },
                        {
                            x: 'Feb',
                            y: [4200, 5200]
                        },
                        {
                            x: 'Mar',
                            y: [3900, 4900]
                        },
                        {
                            x: 'Apr',
                            y: [3400, 3900]
                        },
                        {
                            x: 'May',
                            y: [5100, 5900]
                        },
                        {
                            x: 'Jun',
                            y: [5400, 6700]
                        },
                        {
                            x: 'Jul',
                            y: [4300, 4600]
                        },
                        {
                            x: 'Aug',
                            y: [2100, 2900]
                        }
                    ]
                },

                {
                    type: 'line',
                    name: 'Team B Median',
                    data: [{
                            x: 'Jan',
                            y: 1500
                        },
                        {
                            x: 'Feb',
                            y: 1700
                        },
                        {
                            x: 'Mar',
                            y: 1900
                        },
                        {
                            x: 'Apr',
                            y: 2200
                        },
                        {
                            x: 'May',
                            y: 3000
                        },
                        {
                            x: 'Jun',
                            y: 1000
                        },
                        {
                            x: 'Jul',
                            y: 2100
                        },
                        {
                            x: 'Aug',
                            y: 1200
                        },
                        {
                            x: 'Sep',
                            y: 1800
                        },
                        {
                            x: 'Oct',
                            y: 2000
                        }
                    ]
                },
                {
                    type: 'line',
                    name: 'Team A Median',
                    data: [{
                            x: 'Jan',
                            y: 3300
                        },
                        {
                            x: 'Feb',
                            y: 4900
                        },
                        {
                            x: 'Mar',
                            y: 4300
                        },
                        {
                            x: 'Apr',
                            y: 3700
                        },
                        {
                            x: 'May',
                            y: 5500
                        },
                        {
                            x: 'Jun',
                            y: 5900
                        },
                        {
                            x: 'Jul',
                            y: 4500
                        },
                        {
                            x: 'Aug',
                            y: 2400
                        },
                        {
                            x: 'Sep',
                            y: 2100
                        },
                        {
                            x: 'Oct',
                            y: 1500
                        }
                    ]
                }
            ],
            chart: {
                height: 350,
                type: 'rangeArea',
                animations: {
                    speed: 500
                }
            },
            colors: ['#d4526e', '#33b2df', '#d4526e', '#33b2df'],
            dataLabels: {
                enabled: false
            },
            fill: {
                opacity: [0.24, 0.24, 1, 1]
            },
            forecastDataPoints: {
                count: 2
            },
            stroke: {
                curve: 'straight',
                width: [0, 0, 2, 2]
            },
            legend: {
                show: true,
                customLegendItems: ['Team B', 'Team A'],
                inverseOrder: true
            },
            title: {
                text: 'Range Area with Forecast Line (Combo)'
            },
            markers: {
                hover: {
                    sizeOffset: 5
                }
            }
        };
        let chart6 = new ApexCharts(document.querySelector("#report-chart-6"), options6);
        chart6.render();
    </script>
</body>

</html>
