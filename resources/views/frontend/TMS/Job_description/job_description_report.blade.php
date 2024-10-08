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
                    Job Description Report
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
                <td class="w-30">
                    <strong>Employee ID.</strong>
                </td>
                <td class="w-30">
                    {{ $data->employee_id }}
                </td>
                <td class="w-30">
                    <strong>Employee Name.</strong>
                </td>
                <td class="w-30">
                    {{ $data->name_employee }}
                </td>

            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>

            </tr>
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
                        <th class="w-20">Name of Employee</th>

                        <td class="w-80">
                            @if ($data->name_employee)
                                {{ $data->name_employee }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Job Description Number</th>
                        <td class="w-80">
                            @if ($data->job_description_no)
                                {{ $data->job_description_no }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    {{-- @php
                    // Define a mapping of short codes to full names
                    $prefixMap = [
                    'PW' => 'Permanent Workers',
                    'PS' => 'Permanent Staff',
                    'OS' => 'Others Separately',
                    ];

                    // Get the full names using the prefix map
                    // $lastPrefixFullName = $prefixMap[$lastDocument->prefix] ?? 'N/A';
                    $currentPrefixFullName = $prefixMap[$data->prefix] ?? 'N/A';
                    @endphp --}}


                    <tr>
                        <th class="w-20">Effective Date</th>
                        <td class="w-30">
                            @if ($data->effective_date)
                                {{ Helpers::getdateFormat($data->effective_date)}}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Employee ID</th>
                        <td class="w-30">
                            @if ($data->employee_id)
                                {{ $data->employee_id }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Department</th>
                        <td class="w-30">
                            @if ($data->new_department)
                                {{ $data->new_department }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Designation</th>
                        <td class="w-30">
                            @if ($data->designation)
                                {{ $data->designation }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Qualification</th>
                        <td class="w-30">
                            @if ($data->qualification)
                                {{ $data->qualification }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">OutSide Experience In Years</th>
                        <td class="w-30">
                            @if ($data->total_experience)
                                {{ $data->total_experience }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Date of Joining</th>
                        <td class="w-30">
                            @if ($data->date_joining)
                                {{ Helpers::getdateFormat($data->date_joining) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Experience With Agio Pharma</th>
                        <td class="w-30">
                            @if ($data->experience_with_agio)
                                {{ $data->experience_with_agio }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Total Years of Experience</th>
                        <td class="w-30">
                            @if ($data->experience_if_any)
                                {{ $data->experience_if_any }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Job Description Status</th>
                        <td class="w-30">
                            @if ($data->jd_type)
                                {{ $data->jd_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class ="w-20">Reason for Revision</th>
                        <td class="w-30">
                            @if ($data->reason_for_revision)
                                {{ $data->reason_for_revision }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class ="w-20">Delegate</th>
                        <td class="w-30">
                            @if ($data->delegate)
                                {{ $data->delegate }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    {{-- <tr>
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
                    </tr> --}}

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


    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>

            </tr>
        </table>
    </footer>

</body>

</html>
