<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>vidyaGxP Dashbaord Report</title>
</head>

<body style="margin: 0px">
    <style>
        table.bordered td,
        table.bordered th {
            border: 1px solid #000;
            padding: 8px;
        }

        table.bordered th.main-head {
            text-align: left;
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
                            <td style="color: white; padding: 8px; font-size: 1.2rem;">QMS Dashbaord</td>
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
                            <td style="padding: 8px; font-size: 0.8rem; width:250px;">Printed by : Amit Guru</td>
                            <td style="padding: 8px; font-size: 0.8rem; text-align: center; width:250px;">
                                Printed on :
                                <script>
                                    let currentDate = new Date();
                                    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                                        "November", "December"
                                    ];
                                    let monthName = months[currentDate.getMonth()];
                                    let day = currentDate.getDate();
                                    let year = currentDate.getFullYear();
                                    let hours = currentDate.getHours();
                                    let minutes = currentDate.getMinutes();
                                    let period = (hours >= 12) ? "PM" : "AM";
                                    hours = (hours % 12) || 12;
                                    day = day < 10 ? '0' + day : day;
                                    minutes = minutes < 10 ? '0' + minutes : minutes;
                                    let data = monthName + ' ' + day + ', ' + year + ' ' + hours + ':' + minutes + period;
                                    document.write(data);
                                </script>
                            </td>
                            <td style="padding: 8px; font-size: 0.8rem; text-align: right; width:250px;">Page 1 of 10
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tfoot>

        <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">Internal Audit</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>Internal Audit</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>Internal Audit</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>Internal Audit</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
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
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">External Audit</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>External Audit</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>External Audit</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>External Audit</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
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
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">CAPA</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>CAPA</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>CAPA</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>CAPA</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
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
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">Audit Program</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>Audit Program</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>Audit Program</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>Audit Program</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
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
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">Lab Incident</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>Lab Incident</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>Lab Incident</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>Lab Incident</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
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
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">Change Control</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>Change Control</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>Change Control</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>Change Control</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
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
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">Risk Assessment</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>Risk Assessment</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>Risk Assessment</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>Risk Assessment</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
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
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">Root Cause Analysis</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>Root Cause Analysis</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>Root Cause Analysis</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>Root Cause Analysis</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
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
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">Management Review</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>Management Review</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>Management Review</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>Management Review</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
        </tbody>

        {{-- <tbody>
            <tr>
                <td>
                    <table class="bordered" style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">

                        <thead style="display: table-header-group">
                            <tr style="font-size: 1.2rem;">
                                <th class="main-head" colspan="8">New Document</th>
                            </tr>
                            <tr style="background: #d7d9db;">
                                <th>Record</th>
                                <th>Division</th>
                                <th>Process</th>
                                <th>Short Description</th>
                                <th>Date Opened</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Global</td>
                                <td>Risk Assessment</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>Jordan</td>
                                <td>Risk Assessment</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                            <tr>
                                <td>0002</td>
                                <td>QMS-EMEA</td>
                                <td>Risk Assessment</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                                <td>13 December, 2023</td>
                                <td>Amit Guru</td>
                                <td>13 December, 2023</td>
                                <td>Under Review</td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px">&nbsp;</td>
            </tr>
        </tbody> --}}

    </table>
</body>

</html>
