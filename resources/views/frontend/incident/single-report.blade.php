<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VidyaGxP - Software</title>
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
                    Incident Single Report
                </td>

                    <td class="w-30">
                        <div class="logo">
                            <img src="https://navin.mydemosoftware.com/public/user/images/logo.png" alt="" class="w-100">
                        </div>
                    </td>

            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong> Incident No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/INC/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
                    <tr>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30"> {{ Helpers::getDivisionName($data->division_id) }}</td>

                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ $data->created_at ? $data->created_at->format('d-M-Y') : '' }} </td>

                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ $data->due_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Department</th>
                        <td class="w-80">
                            @if ($data->Initiator_Group)
                            {{($data->Initiator_Group) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

                    <table>
                        <tr>
                            <th class="w-20">Equipment Name</th>
                            <td class="w-30">
                                @if ($data->equipment_name)
                                    {{ $data->equipment_name }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            <th class="w-20">Instrument Name</th>
                            <td class="w-30">
                                @if ($data->instrument_name)
                                    {{ $data->instrument_name }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th class="w-20">facility_name </th>
                            <td class="w-30">
                                @if ($data->inc_facility_name)
                                    {{ $data->inc_facility_name }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            <th class="w-20"> Incident Observed On (Time)</th>
                            <td class="w-30">
                                @if ($data->incident_time)
                                    {{ $data->incident_time }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        </tr>
                    </table>

                <table>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20"> Repeat Incident?</th>
                        <td class="w-30">
                            @if ($data->short_description_required)
                                {{ $data->short_description_required }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20"> Repeat Nature</th>
                        <td class="w-30">
                            @if ($data->nature_of_repeat)
                                {{ $data->nature_of_repeat }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20"> Incident Observed On</th>
                        <td class="w-30">
                            @if ($data->incident_date)
                                {{ $data->incident_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20"> Incident Observed On (Time)</th>
                        <td class="w-30">
                            @if ($data->incident_time)
                                {{ $data->incident_time }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20"> Delay Justification</th>
                        <td class="w-30"></td>
                        <th class="w-20">Incident Observed by</th>
                        @php
                            $facilityIds = explode(',', $data->Facility);
                            $users = $facilityIds ? DB::table('users')->whereIn('id', $facilityIds)->get() : [];
                        @endphp

                        <td>
                            @if ($facilityIds && count($users) > 0)
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20"> Department Head</th>
                        <td class="w-30">
                            @if ($data->department_head)
                                {{ $data->department_head }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20"> QA Reviewer</th>
                        <td class="w-30">
                            @if ($data->qa_reviewer)
                                {{ $data->qa_reviewer }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Incident Reported On </th>
                        <td class="w-30">
                            @if ($data->incident_reported_date)
                                {{ $data->incident_reported_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Incident Related To</th>
                        <td class="w-30">
                            @if ($data->audit_type)
                                {{ $data->audit_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>

                        <th class="w-20"> Others</th>
                        <td class="w-30">
                            @if ($data->others)
                                {{ $data->others }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Facility/ Equipment/ Instrument/ System Details Required?</th>
                        <td class="w-30">
                            @if ($data->Facility_Equipment)
                                {{ $data->Facility_Equipment }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Document Details Required?</th>
                        <td class="w-30">
                            @if ($data->Document_Details_Required)
                                {{ $data->Document_Details_Required }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Description of Incident</th>
                        <td class="w-80">
                            @if ($data->Description_incident)
                                {{ strip_tags($data->Description_incident) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Immediate Action (if any)</th>
                        <td class="w-80">
                            @if ($data->Immediate_Action)
                                {{ strip_tags($data->Immediate_Action) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Preliminary Impact of Incident</th>
                        <td class="w-80">
                            @if ($data->Preliminary_Impact)
                                {{ strip_tags($data->Preliminary_Impact) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>


               
               

             

                <div class="border-table">
                    <div class="block-head">
                        Initial Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->Audit_file)
                            @foreach (json_decode($data->Audit_file) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
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
                        HOD Review
                    </div>
                    <table>
                        <tr>
                            <th class="w-30">HOD Remarks</th>
                            <td class="w-80">
                                @if ($data->HOD_Remarks)
                                    {{ strip_tags($data->HOD_Remarks) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="border-table">
                        <div class="block-head">
                            HOD Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">S.N.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->Audit_file)
                                @foreach (json_decode($data->Audit_file) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
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
            </div>
        </div>

        <div class="block">
            <div class="block-head">
                QA Initial Review
            </div>
            <table>
                <tr>
                    <th class="w-20">QRM Required ?</th>
                    <td class="w-80">
                        @if ($data->qrm_required)
                            {{ $data->qrm_required }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Investigation Required? *                    </th>
                    <td class="w-80">
                        @if ($data->Investigation_required)
                            {{ $data->Investigation_required }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Initial Incident category</th>
                    <td class="w-80">
                        @if ($data->incident_category)
                            {{ $data->incident_category }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Justification for categorization</th>
                    <td class="w-30">
                        @if ($data->Justification_for_categorization)
                            {{ strip_tags($data->Justification_for_categorization) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th class="w-20">Investigation Required?</th>
                    <td class="w-80">
                        @if ($data->Investigation_required)
                            {{ $data->Investigation_required }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Investigation Details</th>
                    <td class="w-80">
                        @if ($data->Investigation_Details)
                            {{ $data->Investigation_Details }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th class="w-20">QA Initial Remarks</th>
                    <td class="w-80">
                        @if ($data->QAInitialRemark)
                            {{ strip_tags($data->QAInitialRemark) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="border-table">
                <div class="block-head">
                    QA Initial Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">S.N.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->Initial_attachment)
                        @foreach (json_decode($data->Initial_attachment) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-20"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
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
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submit By </th>
                        <td class="w-30">{{ $data->submit_by }}</td>
                        <th class="w-20">Submit On </th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->submit_on) }}</td>
                        <th class="w-20">Submit Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->submit_comment) }}</td>
                    </tr>
                 
                    <tr>
                        <th class="w-20">HOD Initial Review completed by</th>
                        <td class="w-30">{{ $data->HOD_Initial_Review_Complete_By }}</td>
                        <th class="w-20">HOD Initial Review completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->HOD_Initial_Review_Complete_On) }}</td>
                        <th class="w-20">HOD Initial Review Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->HOD_Initial_Review_Comments) }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $data->more_info_req_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->more_info_req_on) }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->Hod_Cancelled_by}}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Hod_Cancelled_on) }}</td>
                        <th class="w-20">Cancelled Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Hod_Cancelled_cmt) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Initial Review Complete By</th>
                        <td class="w-30">{{ $data->QA_Initial_Review_Complete_By }}</td>
                        <th class="w-20">QA Initial Review Complete On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->QA_Initial_Review_Complete_On) }}</td>
                        <th class="w-20">QA Initial Review Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->QA_Initial_Review_Comments) }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $data->Qa_more_info_req_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Qa_more_info_req_on) }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Pending Initiator Update Complete By</th>
                        <td class="w-30">{{ $data->Pending_Review_Complete_By }}</td>
                        <th class="w-20">Pending Initiator Update CompleteOn</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Pending_Review_Complete_On) }}</td>
                        <th class="w-20">Pending Initiator Update Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Pending_Review_Comments) }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $data->Pending_more_info_req_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Pending_more_info_req_on) }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">HOD Final Review Completed By</th>
                        <td class="w-30">{{ $data->Hod_Final_Review_Complete_By }}</td>
                        <th class="w-20">HOD Final Review Completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Hod_Final_Review_Complete_On) }}</td>
                        <th class="w-20">HOD Final Review Completed Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Hod_Final_Review_Comments) }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $data->Hod_more_info_req_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Hod_more_info_req_on) }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20"> QA Final Review Complete By</th>
                        <td class="w-30">{{ $data->Qa_Final_Review_Complete_By }}</td>
                        <th class="w-20"> QA Final Review Complete On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Qa_Final_Review_Complete_On) }}</td>
                        <th class="w-20">QA Final Review Complete Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Qa_Final_Review_Comments) }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $data->Qa_final_more_info_req_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Qa_final_more_info_req_on) }}</td>
                        <th class="w-20">Cancelled Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Cancelled_cmt) }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">{{ $data->QA_head_approved_by }}</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->QA_head_approved_on) }}</td>
                        <th class="w-20">Approved Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->QA_head_approved_comment) }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-30">{{ $data->approved_more_info_req_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->approved_more_info_req_on) }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->Cancelled_by}}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Cancelled_on) }}</td>
                        <th class="w-20">Cancelled Comments</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->Cancelled_cmt) }}</td>
                    </tr>

                </table>
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
