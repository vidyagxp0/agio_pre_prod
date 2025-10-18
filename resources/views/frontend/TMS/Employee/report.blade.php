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
    @page {
        margin: 160px 35px 100px;
        /* top header, side margin, bottom footer */
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

    header,
    footer {
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

    th,
    td {
        padding: 6px 10px;
        font-size: 10.5px;
        border: 1px solid #ccc;
        text-align: left;
        vertical-align: top;
    }

    th {
        white-space: normal !important;
        word-wrap: break-word;
        background-color: #f2f2f2;
        font-weight: 600;
    }

    .section-gap {
        margin-top: 20px;
    }

    .no-border th,
    .no-border td {
        border: none !important;
    }

    /* .w-5 { width: 5%; } */
    .w-5 {
        width: 6%;
    }

    .w-6 {
        width: 7%;
    }

    .w-8 {
        width: 8%;
    }

    .w-10 {
        width: 10%;
    }

    .w-20 {
        width: 20%;
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

    .w-100 {
        width: 100%;
    }

    .text-center {
        text-align: center;
    }

    .border-table {
        overflow-x: auto;
    }

    table th,
    table td {
        word-wrap: break-word;
    }
</style>
<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                <h1>Employee Report </h1>
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="http://agio_pre_prod.test/user/images/agio.jpg" alt=""
                            class="w-30">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Employee ID.</strong>
                </td>
                <td class="w-30">
                    {{ $data->full_employee_id }}
                </td>
                <td class="w-30">
                    <strong>Employee Name.</strong>
                </td>
                <td class="w-30">
                    {{ $data->employee_name }}
                </td>

            </tr>
        </table>
    </header>

   <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed By:</strong> {{ Auth::user()->name }}
                </td>
                <td class="w-30">
                  <strong>Printed On:</strong> {{ now()->format('d-M-Y | h:i A') }}

                </td>
            </tr>

        </table>
        <table>

        </table>

    </footer>
    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>

                <table>
                    <tr>
                        <th class="w-20">Site Division/Project</th>

                        <td class="w-80">
                            @if ($data->site_division)
                                {{ $data->site_division }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Joining Date</th>
                        <td class="w-80">
                            @if ($data->joining_date)
                                {{ Helpers::getdateFormat($data->joining_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    @php
                    // Define a mapping of short codes to full names
                    $prefixMap = [
                    'PW' => 'Permanent Workers',
                    'PS' => 'Permanent Staff',
                    'OS' => 'Others Separately',
                    ];

                    // Get the full names using the prefix map
                    // $lastPrefixFullName = $prefixMap[$lastDocument->prefix] ?? 'N/A';
                    $currentPrefixFullName = $prefixMap[$data->prefix] ?? 'N/A';
                    @endphp


                    <tr>
                        <th class="w-20">Prefix</th>
                        <td class="w-30">
                            @if ($data->prefix)
                                {{ $prefixMap[$data->prefix] ?? 'Not Applicable' }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Employee ID</th>
                        <td class="w-30">
                            @if ($data->full_employee_id)
                                {{ $data->full_employee_id }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Employee Name</th>
                        <td class="w-30">
                            @if ($data->employee_name)
                                {{ $data->employee_name }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Gender</th>
                        <td class="w-30">
                            @if ($data->gender)
                                {{ $data->gender }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Department Name</th>
                        <td class="w-30">
                            @if ($data->department)
                                {{ Helpers::getFullDepartmentName($data->department) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Qualification</th>
                        <td class="w-30">
                            @if ($data->qualification)
                                {{ $data->qualification }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Experience (No. of Years)</th>
                        <td class="w-30">
                            @if ($data->experience)
                                {{ $data->experience }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Designation</th>
                        <td class="w-30">
                            @if ($data->job_title)
                                {{ $data->job_title }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Other Department</th>
                        <td class="w-30">
                            @if ($data->other_department)
                                {{ $data->other_department }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Other Designation</th>
                        <td class="w-30">
                            @if ($data->other_designation)
                                {{ $data->other_designation }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Attached CV</th>
                        <td class="w-30">
                            @if ($data->attached_cv)
                                {{ $data->attached_cv }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Certification/Qualification</th>
                        <td class="w-30">
                            @if ($data->certification)
                                {{ $data->certification }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Medical Checkup Report</th>
                        <td class="w-30">
                            @if ($data->has_additional_document)
                                {{ $data->has_additional_document }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Medical Checkup Attachment</th>
                        <td class="w-30">
                            @if ($data->additional_document)
                                {{ $data->additional_document }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

            </div>
        </div>
    </div>


    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    Employee Address Details
                </div>

                <table>
                    <tr>
                        <th class="w-20">Country</th>
                        <td class="w-30">
                            @if ($data->country)
                                {{ $data->country }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">State</th>
                        <td class="w-30">
                            @if ($data->state)
                                {{ $data->state }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">City</th>
                        <td class="w-30">
                            @if ($data->city)
                                {{ $data->city }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Building</th>
                        <td class="w-30">
                            @if ($data->building)
                                {{ $data->building }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Floor</th>
                        <td class="w-30">
                            @if ($data->floor)
                                {{ $data->floor }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Room</th>
                        <td class="w-30">
                            @if ($data->room)
                                {{ $data->room }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Picture</th>
                        <td class="w-30">
                            @if ($data->picture)
                                {{ $data->picture }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Specimen Signature</th>
                        <td class="w-30">
                            @if ($data->specimen_signature)
                                {{ $data->specimen_signature }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        {{-- <th class="w-20">HOD</th>
                        <td class="w-30">
                            @if ($data->hod)
                                {{ $data->hod }}
                            @else
                                Not Applicable
                            @endif
                        </td> --}}

                        <th class="w-20">Comments</th>
                        <td class="w-30">
                            @if ($data->comment)
                                {{ $data->comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">File Attachment</th>
                        <td class="w-30">
                            @if ($data->file_attachment)
                                {{ $data->file_attachment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Remark</th>
                        <td class="w-30">
                            @if ($data->induction_comment)
                                {{ $data->induction_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Attachment</th>
                        <td class="w-30">
                            @if ($data->induction_attachment)
                                {{ $data->induction_attachment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

            </div>
        </div>
    </div>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class ="w-20">Activate By</th>
                        <td class="w-30">
                            @if ($data->activated_by)
                                {{ $data->activated_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Activate On</th>
                        <td class="w-30">
                            @if ($data->activated_on)
                                {{ $data->activated_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Activate Comment</th>
                        <td class="w-30">
                            @if ($data->activated_comment)
                                {{ $data->activated_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class ="w-20">Send induction-Training By</th>
                        <td class="w-30">
                            @if ($data->retired_by)
                                {{ $data->retired_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Send induction-Training On</th>
                        <td class="w-30">
                            @if ($data->retired_on)
                                {{ $data->retired_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Send induction-Training Comment</th>
                        <td class="w-30">
                            @if ($data->retired_comment)
                                {{ $data->retired_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class ="w-20">Complete By</th>
                        <td class="w-30">
                            @if ($data->complete_by)
                                {{ $data->complete_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Complete On</th>
                        <td class="w-30">
                            @if ($data->complete_on)
                                {{ $data->complete_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Complete Comment</th>
                        <td class="w-30">
                            @if ($data->complete_comment)
                                {{ $data->complete_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>




</body>

</html>
