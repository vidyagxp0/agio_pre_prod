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
<header>
    <table>
        <tr>
            <td class="w-70 head">
                Trainer Qualification Report
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
                {{ $data->employee_name }}
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

<br>
<div class="inner-block">
    <div class="content-table">
        <div class="block">
            <div class="block-head">
                Trainer Information
            </div>
            <br>
            <table>
                <tr>
                    <th class="w-20">Trainer Name</th>
                    <td class="w-30">
                        @if ($data->trainer_name)
                            {{ $data->trainer_name }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Name of Employee</th>
                    <td class="w-30">
                        @if ($data->employee_name)
                            {{ $data->employee_name }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Employee ID</th>
                    <td class="w-30">
                        @if ($data->employee_id)
                            {{ $data->employee_id }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Department</th>
                    <td class="w-30">
                        @if ($data->department)
                            {{ $data->department }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Designation</th>
                    <td class="w-30">
                        @if ($data->designation)
                            {{ $data->designation }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Experience (No. of Years)</th>
                    <td class="w-30">
                        @if ($data->experience)
                            {{ $data->experience }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">HOD</th>
                    <td class="w-30">
                        @if ($data->hod)
                            {{ $data->hod }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Qualification</th>
                    <td class="w-30">
                        @if ($data->qualification)
                            {{ $data->qualification }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Schedule Training date</th>
                    <td class="w-30">
                        @if ($data->training_date)
                            {{ Helpers::getdateFormat($data->training_date) }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Topic of Training</th>
                    <td class="w-30">
                        @if ($data->topic)
                            {{ $data->topic }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Type of Training</th>
                    <td class="w-30">
                        @if ($data->type)
                            {{ $data->type }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Evaluation Required </th>
                    <td class="w-30">
                        @if ($data->evaluation)
                            {{ $data->evaluation }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Site Division/Project</th>
                    <td class="w-30">
                        @if ($data->site_code)
                            {{ $data->site_code }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Initiator</th>
                    <td class="w-30">
                        @if ($data->initiator)
                            {{ $data->initiator }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Date of Initiation</th>
                    <td class="w-30">
                        @if ($data->date_of_initiation)
                            {{ Helpers::getdateFormat($data->date_of_initiation) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Evaluation Through</th>
                    <td class="w-30">
                        @if ($data->evaluation_through)
                            {{ $data->evaluation_through }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    
                </tr>
                <tr>
                    <th class="w-20">Short Description</th>
                    <td class="w-30" colspan="3">
                        @if ($data->short_description)
                            {{ $data->short_description }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>

                    <th class="w-20">Description</th>
                    <td class="w-30">
                        @if ($data->description)
                            {{ $data->description }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Qualification Status</th>
                    <td class="w-30">
                        @if ($data->trainer)
                            {{ $data->trainer }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Qualification Comments</th>
                    <td class="w-30" colspan="3">
                        @if ($data->qualification_comments)
                            {{ $data->qualification_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20"> Assigned To</th>
                    <td class="w-30">
                        @if ($data->assigned_to)
                            {{ Helpers::getInitiatorName($data->assigned_to) }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Initial Attachment</th>
                    <td class="w-30">
                        @if ($data->initial_attachment)
                            {{ $data->initial_attachment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
        </div>

        {{-- <div class="block">
            <div class="block-head">
                List of Attachments
            </div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20" style="width: 25px;">Sr No.</th>
                        <th class="w-20">Title of Document</th>
                        <th class="w-20">Supporting Document</th>
                        <th class="w-20">Remarks</th>
                    </tr>
                    @if ($trainer_list && is_array($trainer_list->data))
                        @foreach ($trainer_list->data as $grid_Data)
                            <tr>
                                <td class="w-20">{{ $loop->index + 1 }}</td>
                                <td class="w-20">
                                    {{ isset($grid_Data['title_of document']) ? $grid_Data['title_of document'] : '' }}
                                </td>
                                <td>
                                    {{ isset($grid_Data['supporting_document']) ? $grid_Data['supporting_document'] : '' }}
                                </td>
                                <td>
                                    {{ isset($grid_Data['remarks']) ? $grid_Data['remarks'] : '' }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div> --}}
        <br><br>
        <div class="block">
            <div class="block-head">
                Evaluation Criteria
            </div>
            <div class="col-12">
                <div class="group-input">
                    <div class="why-why-chart">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 7%;">Sr. No.</th>
                                    <th style="width: 50%;">Evaluation Criteria</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Clarity Of Objectives</td>
                                    <td>

                                        @if ($data->evaluation_criteria_1)
                                            {{ $data->evaluation_criteria_1 }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Delivery & Knowledge Of Content</td>
                                    <td>

                                        @if ($data->evaluation_criteria_2)
                                            {{ $data->evaluation_criteria_2 }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>


                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Oral & Written Languagee (Speaking
                                        Style Was Clear, Easily understood , Pleasant to hear)</td>
                                    <td>

                                        @if ($data->evaluation_criteria_3)
                                            {{ $data->evaluation_criteria_3 }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>


                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Is Research Up to Date?</td>
                                    <td>

                                        @if ($data->evaluation_criteria_4)
                                            {{ $data->evaluation_criteria_4 }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>


                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Interactions With Participants</td>
                                    <td>

                                        @if ($data->evaluation_criteria_5)
                                            {{ $data->evaluation_criteria_5 }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>


                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Response To Participants</td>
                                    <td>

                                        @if ($data->evaluation_criteria_6)
                                            {{ $data->evaluation_criteria_6 }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>


                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Discussion Techniques</td>
                                    <td>

                                        @if ($data->evaluation_criteria_7)
                                            {{ $data->evaluation_criteria_7 }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Managed Pace Of The Training Well /
                                        Created a Comfortable learning environment</td>
                                    <td>

                                        @if ($data->evaluation_criteria_8)
                                            {{ $data->evaluation_criteria_8 }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>


                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="inner-block">
    <div class="content-table">
        <div class="block">
            <div class="block-head">
                Questionaries
            </div>
            <div class="block">
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20" style="width: 25px;">Sr No.</th>
                            <th class="w-20">Questions</th>
                            <th class="w-20">Answer Fillup by Employee</th>
                            <th class="w-20">Comments</th>
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
                                    <td>
                                        {{ isset($grid_Data['comments']) ? $grid_Data['comments'] : '' }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="inner-block">
    <div class="content-table">
        <div class="block">
            <div class="block-head">
                HOD Evaluation
            </div>
            <table>
                <tr>
                    <th class="w-20">Remarks</th>
                    <td class="w-30">
                        @if ($data->hod_comment)
                            {{ $data->hod_comment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">HOD Evaluation Attachment</th>
                    <td class="w-30">
                        @if ($data->hod_attachment)
                            {{ $data->hod_attachment }}
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
                QA/CQA Head Approval
            </div>
            <table>
                <tr>
                    <th class="w-20">Remarks</th>
                    <td class="w-30">
                        @if ($data->qa_final_comment)
                            {{ $data->qa_final_comment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">QA/CQA Attachment</th>
                    <td class="w-30">
                        @if ($data->qa_final_attachment)
                            {{ $data->qa_final_attachment }}
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
                    <th class="w-20">Submit By</th>
                    <td class="w-80">
                        @if ($data->sbmitted_by)
                            {{ $data->sbmitted_by }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Submit On</th>
                    <td class="w-80">
                        @if ($data->sbmitted_on)
                            {{ $data->sbmitted_on }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Submit Comment</th>
                    <td class="w-80">
                        @if ($data->sbmitted_comment)
                            {{ $data->sbmitted_comment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Update Complete By</th>
                    <td class="w-80">
                        @if ($data->update_complete_by)
                            {{ $data->update_complete_by }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Update Complete On</th>
                    <td class="w-80">
                        @if ($data->update_complete_on)
                            {{ $data->update_complete_on }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Update Complete Comment</th>
                    <td class="w-80">
                        @if ($data->update_complete_comment)
                            {{ $data->update_complete_comment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Answer Complete By</th>
                    <td class="w-80">
                        @if ($data->answer_complete_by)
                            {{ $data->answer_complete_by }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Answer Complete On</th>
                    <td class="w-80">
                        @if ($data->answer_complete_on)
                            {{ $data->answer_complete_on }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Answer Complete Comment</th>
                    <td class="w-80">
                        @if ($data->answer_complete_comment)
                            {{ $data->answer_complete_comment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Evaluation Complete By</th>
                    <td class="w-80">
                        @if ($data->evaluation_complete_by)
                            {{ $data->evaluation_complete_by }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Evaluation Complete On</th>
                    <td class="w-80">
                        @if ($data->evaluation_complete_on)
                            {{ $data->evaluation_complete_on }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Evaluation Complete Comment</th>
                    <td class="w-80">
                        @if ($data->evaluation_complete_comment)
                            {{ $data->evaluation_complete_comment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Qualified By</th>
                    <td class="w-80">
                        @if ($data->qualified_by)
                            {{ $data->qualified_by }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Qualified On</th>
                    <td class="w-80">
                        @if ($data->qualified_on)
                            {{ $data->qualified_on }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Qualified Comment</th>
                    <td class="w-80">
                        @if ($data->qualified_comment)
                            {{ $data->qualified_comment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Reject By</th>
                    <td class="w-80">
                        @if ($data->rejected_by)
                            {{ $data->rejected_by }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Reject On</th>
                    <td class="w-80">
                        @if ($data->rejected_on)
                            {{ $data->rejected_on }}
                        @else
                            Not Applicable
                        @endif
                    </td>

                    <th class="w-20">Reject Comment</th>
                    <td class="w-80">
                        @if ($data->rejected_comment)
                            {{ $data->rejected_comment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
