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

    footer {
        width: 100%;
        /* position: fixed; */
        display: block;
        bottom: 0;
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
        border-bottom: 2px solid black;
        margin-bottom: 10px;
    }

    .inner-block th,
    .inner-block td {
        vertical-align: baseline;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    @if ($changeControlData)
                        Change Control Parent with Immediate Child
                    @elseif ($actionItemData)
                        Change Control Action Item
                    @elseif ($extensionData)
                        Change Control Extension
                    @endif
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
                    <strong>Change Control No.</strong>
                </td>
                <td class="w-40">
                    CC/P1/QC01/2015/007
                </td>
                <td class="w-30">
                    <strong>PR No.</strong> 2344
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
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Date Initiation</th>
                        <td class="w-30">23-12-2302</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">Quality Control - Plant 1</td>
                        <th class="w-20">Initiator Group Code</th>
                        <td class="w-30">QC01</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut cum delectus hic facere ratione
                            aliquid error vel? Vel, omnis veritatis.
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80" colspan="3">23-02-2023 11:00</td>
                    </tr>
                    <tr>
                        <th class="w-20">Nature of Change</th>
                        <td class="w-30">Document Change</td>
                        <th class="w-20">If Others</th>
                        <td class="w-30">NA</td>
                    </tr>
                    <tr>
                        <th class="w-20">Supporting Documents</th>
                        <td class="w-80" colspan="3">Document_Name.pdf</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Change Details
                </div>
                <div class="border-table">
                    <table>
                        <tr>
                            <th class="w-25">Current Document No.</th>
                            <th class="w-25">Current Version No.</th>
                            <th class="w-25">New Document No.</th>
                            <th class="w-25">New Version No.</th>
                        </tr>
                        <tr>
                            <td class="w-25">Revision of FP SPC STPs Annexure 1</td>
                            <td class="w-25">01</td>
                            <td class="w-25">Revision of FP SPC STPs Annexure II</td>
                            <td class="w-25">02</td>
                        </tr>
                    </table>
                </div>
                <table>
                    <tr>
                        <th class="w-20">Current Change</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Proposed Change</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Reason For Change</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Supervisor Comments</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Any Other Comments</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        QA Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Type of Change</th>
                            <td class="w-80">Minor</td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Review Comments</th>
                            <td>
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Related Records</th>
                            <td class="w-80">NA</td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Attachments</th>
                            <td class="w-80">NA</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Evaluation
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">QA Evaluation Comments</th>
                            <td>
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Evaluation Attachments</th>
                            <td class="w-80">NA</td>
                        </tr>
                        <tr>
                            <th class="w-20">Training Required</th>
                            <td class="w-80">Yes</td>
                        </tr>
                        <tr>
                            <th class="w-20">Training Comments</th>
                            <td>
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Additional Information
                </div>
                <table>
                    <tr>
                        <th class="w-50" colspan="2">Is Group Review Required</th>
                        <td class="w-50" colspan="2">Yes</td>
                    </tr>
                    <tr>
                        <th class="w-20">Production</th>
                        <td class="w-30">Yes</td>
                        <th class="w-20">Production Person</th>
                        <td class="w-30">Piyush Sahu</td>
                    </tr>
                    <tr>
                        <th class="w-20">Quality Approver</th>
                        <td class="w-30">Yes</td>
                        <th class="w-20">Quality Approver Person</th>
                        <td class="w-30">Piyush Sahu</td>
                    </tr>
                    <tr>
                        <th class="w-20">CFT</th>
                        <td class="w-30">Yes</td>
                        <th class="w-20">CFT Person</th>
                        <td class="w-30">Piyush Sahu</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-30">Yes</td>
                        <th class="w-20">Others Person</th>
                        <td class="w-30">Piyush Sahu</td>
                    </tr>
                    <tr>
                        <th class="w-20">Addition Attachments</th>
                        <td class="w-80" colspan="3">Document_Name.pdf</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        Group Comments
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">QA Comments</th>
                            <td class="w-80">
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">QA Head Designee Comments</th>
                            <td class="w-80">
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Warehouse Comments</th>
                            <td class="w-80">
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Engineering Comments</th>
                            <td class="w-80">
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Instrumentation Comments</th>
                            <td class="w-80">
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Validation Comments</th>
                            <td class="w-80">
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Others Comments</th>
                            <td class="w-80">
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Group Comments</th>
                            <td class="w-80">
                                <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                                <div>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                    laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20">Group Attachments</th>
                            <td class="w-80" colspan="3">Document_Name.pdf</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Risk Assessment
                </div>
                <table>
                    <tr>
                        <th class="w-20">Risk Identification</th>
                        <td class="w-80" colspan="3">
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Severity</th>
                        <td class="w-30">Negligible</td>
                        <th class="w-20">Occurance</th>
                        <td class="w-30">Rare</td>
                    </tr>
                    <tr>
                        <th class="w-20">Detection</th>
                        <td class="w-30">Rare</td>
                        <th class="w-20">RPN</th>
                        <td class="w-30">10</td>
                    </tr>
                    <tr>
                        <th class="w-20">Risk Evaluation</th>
                        <td class="w-80" colspan="3">
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Mitigation Action</th>
                        <td class="w-80" colspan="3">
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    QA Approval Comments
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Approval Comments</th>
                        <td class="w-80">
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Training Feedback</th>
                        <td class="w-80">
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Training Attachments</th>
                        <td class="w-80">
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Child Records
                </div>
                <div class="border-table">
                    <table>
                        <tr>
                            <th>PR ID</th>
                            <th>Project</th>
                            <th>Date Of Initiation</th>
                            <th>Due Date</th>
                            <th>PR State</th>
                            <th>Assigned To</th>
                        </tr>
                        <tr>
                            <td rowspan="2">2344</td>
                            <td>Extension</td>
                            <td>23-12-2023 11:00</td>
                            <td>23-12-2023</td>
                            <td>Closed Done</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td colspan="4">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus natus sequi modi
                                error ullam quae maxime similique, molestiae quo tempora!
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Change Closure
                </div>
                <div class="border-table">
                    <table>
                        <tr>
                            <th>Affected Documents</th>
                            <th>Document Name</th>
                            <th>Document No.</th>
                            <th>Version No.</th>
                            <th>Implementation Date</th>
                            <th>New Document No.</th>
                            <th>New Version No.</th>
                        </tr>
                        <tr>
                            <td>Specification</td>
                            <td>SPC & STP</td>
                            <td>As per Attached Annexure</td>
                            <td>As per Attached Annexure</td>
                            <td>07 Apr 2016</td>
                            <td>As per Attached Annexure</td>
                            <td>As per Attached Annexure</td>
                        </tr>
                    </table>
                </div>
                <table>
                    <tr>
                        <th class="w-20">QA Closure Comments</th>
                        <td class="w-80">
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">List Of Attachments</th>
                        <td class="w-80">Document_Name.pdf</td>
                    </tr>
                    <tr>
                        <th class="w-20">Effectivess Check Required?</th>
                        <td class="w-80">Yes</td>
                    </tr>
                    <tr>
                        <th class="w-20">Effectiveness Check Creation Date</th>
                        <td class="w-80">12-12-2023</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submitted By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Submitted On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">Supervisor Reviewed By(QA)</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Supervisor Reviewed On(QA)</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Information Req. By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">More Information Req. On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Review Completed By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">QA Review Completed On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Info Req. By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">More Info Req. On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">CFT Reviewed By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">CFT Reviewed On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">CFT Review Completed By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">CFT Review Completed On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">Training Completed By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Training Completed On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">Change Implemented By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Change Implemented On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA More Information Required By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">QA More Information Required On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Final Review Completed By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">QA Final Review Completed On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Change Control Action Item
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
                    <strong>Change Control No.</strong>
                </td>
                <td class="w-40">
                    CC/P1/QC01/2015/007
                </td>
                <td class="w-30">
                    <strong>PR No.</strong> 2344
                </td>
            </tr>
        </table>
    </header> --}}

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr>
                        <th class="w-20">Originator</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Date Opened</th>
                        <td class="w-30">23-12-2302</td>
                    </tr>
                    <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">23-12-2302</td>
                    </tr>
                    <tr>
                        <th class="w-20">Title</th>
                        <td class="w-80" colspan="3">
                            Lorem ipsum dolor sit amet.
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Responsible Department</th>
                        <td class="w-80" colspan="3">
                            Lorem ipsum dolor sit amet.
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Quality Reviewer</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Original Due Date</th>
                        <td class="w-30">23-12-2302</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Tasks Details
                </div>
                <table>
                    <tr>
                        <th class="w-20">Action Taken</th>
                        <td class="w-80">Example</td>
                    </tr>
                    <tr>
                        <th class="w-20">Deviation Attachment</th>
                        <td class="w-80">Document_Name.pdf</td>
                    </tr>
                    <tr>
                        <th class="w-20">Parent ID</th>
                        <td class="w-80">Example</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Effectivess Check and Verification
                </div>
                <table>
                    <tr>
                        <th class="w-20">Quality Verification Comments</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Addendum Comments</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Addendum Attachment</th>
                        <td class="w-80">Document_Name.pdf</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Reference Info/Comments
                </div>
                <table>
                    <tr>
                        <th class="w-20">Comments</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Attachments</th>
                        <td class="w-80">Document_Name.pdf</td>
                    </tr>
                    <tr>
                        <th class="w-20">Reference Record</th>
                        <td class="w-80">Document_Name.pdf</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Change Control Extension
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
                    <strong>Change Control No.</strong>
                </td>
                <td class="w-40">
                    CC/P1/QC01/2015/007
                </td>
                <td class="w-30">
                    <strong>PR No.</strong> 2344
                </td>
            </tr>
        </table>
    </header> --}}

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr>
                        <th class="w-20">Originator</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">23-12-2302</td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">
                            Lorem ipsum dolor sit amet.
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Justification for Extension</th>
                        <td class="w-80" colspan="3">
                            Lorem ipsum dolor sit amet.
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Extension Attachments</th>
                        <td class="w-30">Document_Name.pdf</td>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">23-12-2302</td>
                    </tr>
                    <tr>
                        <th class="w-20">Review Due Date</th>
                        <td class="w-30">23-12-2302</td>
                        <th class="w-20">Approver</th>
                        <td class="w-30">Example</td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    QA Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">Approver Comments</th>
                        <td>
                            <div><strong>12-29-2015 01:53 PM added by Vikas Prajapati</strong></div>
                            <div>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum incidunt sed
                                laboriosam, velit deleniti minima nobis et possimus consectetur suscipit.
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submitted By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Submitted On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">Etension Approved By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Extension Approved On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                    <tr>
                        <th class="w-20">Rejected By</th>
                        <td class="w-30">Piyush Sahu</td>
                        <th class="w-20">Rejected On</th>
                        <td class="w-30">12-12-2203</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> 23-12-2023
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> Anshul Patel
                </td>
                <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
