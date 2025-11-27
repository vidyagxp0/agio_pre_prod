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
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png" alt=""
                            style="max-height: 55px; max-width: 40px;">
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
                    {{ \App\Models\Employee::find($data->name_employee)?->employee_name ?? 'Employee not found' }}
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
                                {{ \App\Models\Employee::find($data->name_employee)?->employee_name ?? 'Employee not found' }}
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
                                {{ Helpers::getFullDepartmentName($data->new_department) }}
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
                </table>

                <div class="block">
                    <div class="block-head">
                     Job Responsibilities
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20" style="width: 25px;">Sr No.</th>
                                <th class="w-20">Job Responsibilities</th>
                                <th class="w-20">Remarks</th>
                            </tr>
                            @if ($employee_grid_data && is_array($employee_grid_data->data))
                                @foreach ($employee_grid_data->data as $grid_Data)
                                <tr>
                                    <td class="w-20">{{ $loop->index + 1 }}</td>
                                    <td class="w-20">
                                        {{ isset($grid_Data['job']) ? $grid_Data['job'] : '' }}
                                    </td>
                                    <td>
                                        {{ isset($grid_Data['remarks']) ? $grid_Data['remarks'] : '' }} 
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="block-head">
                  Employee Remarks
                </div>
                <table>
                    <tr>
                        <th class="w-20">Remark</th>

                        <td class="w-80" colspan="3">
                            @if ($data->qa_review)
                                {{ $data->qa_review }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Attachment</th>
                        <td class="w-80">
                            @if ($data->qa_review_attachment)
                                {{ $data->qa_review_attachment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                  QA/CQA Approval
                </div>
                <table>
                    <tr>
                        <th class="w-20">Remark</th>

                        <td class="w-80" colspan="3">
                            @if ($data->qa_cqa_comment)
                                {{ $data->qa_cqa_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Attachment</th>
                        <td class="w-80">
                            @if ($data->qa_cqa_attachment)
                                {{ $data->qa_cqa_attachment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                  Responsible Person Accept Remarks
                </div>
                <table>
                    <tr>
                        <th class="w-20">Remark</th>

                        <td class="w-80" colspan="3">
                            @if ($data->responsible_person_comment)
                                {{ $data->responsible_person_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Attachment</th>
                        <td class="w-80">
                            @if ($data->responsible_person_attachment)
                                {{ $data->responsible_person_attachment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                  Respected Department Remarks
                </div>
                <table>
                    <tr>
                        <th class="w-20">Remark</th>

                        <td class="w-80" colspan="3">
                            @if ($data->respected_department_comment)
                                {{ $data->respected_department_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Attachment</th>
                        <td class="w-80">
                            @if ($data->respected_department_attachment)
                                {{ $data->respected_department_attachment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
            </div>

            <div class="block">
                <div class="block-head">
                  QA JD Number Remarks
                </div>
                <table>
                    <tr>
                        <th class="w-20">Remark</th>

                        <td class="w-80" colspan="3">
                            @if ($data->final_review_comment)
                                {{ $data->final_review_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Attachment</th>
                        <td class="w-80">
                            @if ($data->final_review_attachment)
                                {{ $data->final_review_attachment }}
                            @else
                                Not Applicable
                            @endif
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
                        <th class="w-20">Submit By</th>
                        <td class="w-80">
                            @if ($data->submit_by)
                                {{ $data->submit_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Submit On</th>
                        <td class="w-80">
                            @if ($data->submit_on)
                                {{ $data->submit_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Submit Comment</th>
                        <td class="w-80">
                            @if ($data->submit_comment)
                                {{ $data->submit_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Accept JD Complete By</th>
                        <td class="w-80">
                            @if ($data->accept_JD_Complete_by)
                                {{ $data->accept_JD_Complete_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Accept JD Complete On</th>
                        <td class="w-80">
                            @if ($data->accept_JD_Complete_on)
                                {{ $data->accept_JD_Complete_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Accept JD Complete Comment</th>
                        <td class="w-80">
                            @if ($data->accept_JD_Complete_comment)
                                {{ $data->accept_JD_Complete_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Accept By</th>
                        <td class="w-80">
                            @if ($data->accept_by)
                                {{ $data->accept_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Accept On</th>
                        <td class="w-80">
                            @if ($data->accept_on)
                                {{ $data->accept_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Accept Comment</th>
                        <td class="w-80">
                            @if ($data->accept_comment)
                                {{ $data->accept_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Approval Complete By</th>
                        <td class="w-80">
                            @if ($data->approval_Complete_by)
                                {{ $data->approval_Complete_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Approval Complete On</th>
                        <td class="w-80">
                            @if ($data->approval_Complete_on)
                                {{ $data->approval_Complete_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Approval Complete Comment</th>
                        <td class="w-80">
                            @if ($data->approval_Complete_comment)
                                {{ $data->approval_Complete_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Send To QA By</th>
                        <td class="w-80">
                            @if ($data->send_to_QA_by)
                                {{ $data->send_to_QA_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Send To QA On</th>
                        <td class="w-80">
                            @if ($data->send_to_QA_on)
                                {{ $data->send_to_QA_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Send To QA Comment</th>
                        <td class="w-80">
                            @if ($data->send_to_QA_comment)
                                {{ $data->send_to_QA_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Closure By</th>
                        <td class="w-80">
                            @if ($data->closure_by)
                                {{ $data->closure_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Closure On</th>
                        <td class="w-80">
                            @if ($data->closure_on)
                                {{ $data->closure_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Closure Comment</th>
                        <td class="w-80">
                            @if ($data->closure_comment)
                                {{ $data->closure_comment }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Reject By</th>
                        <td class="w-80">
                            @if ($data->reject_by)
                                {{ $data->reject_by }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Reject On</th>
                        <td class="w-80">
                            @if ($data->reject_on)
                                {{ $data->reject_on }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Reject Comment</th>
                        <td class="w-80">
                            @if ($data->reject_comment)
                                {{ $data->reject_comment }}
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
