<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VidyaGxP - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

{{-- <style>
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




    .why-why-chart-container {
    width: 100%;
    padding: 10px;
    background: #fff;
    border-radius: 5px;
    }

    .block-head {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .problem-statement th {
        background: #f4bb22;
        width: 150px;
    }

    .why-label {
        color: #393cd4;
        width: 150px;
    }

    .answer-label {
        color: #393cd4;
        width: 150px;
    }

    .root-cause th {
        background: #0080006b;
        width: 150px;
    }

    .text-muted {
        color: gray;
    }
</style> --}}

<style>
    @page {
         margin: 160px 35px 100px;
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

    header, footer {
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

    th, td {
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

    .no-border th, .no-border td {
        border: none !important;
    }

    /* .w-5 { width: 5%; } */
    .w-5 { width: 6%; }
    .w-6 { width: 7%; }
    .w-8 { width: 8%; }
    .w-10 { width: 10%; }
    .w-20 { width: 20%; }
    .w-30 { width: 30%; }
    .w-40 { width: 40%; }
    .w-50 { width: 50%; }
    .w-60 { width: 60%; }
    .w-70 { width: 70%; }
    .w-80 { width: 80%; }
    .w-100 { width: 100%; }
    .text-center { text-align: center; }
    .border-table {
        overflow-x: auto;
    }

    table th, table td {
        word-wrap: break-word;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70" style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 18px; font-weight: 800; display: inline-block;">
                    Deviation Report
                   </div>
                </td>
                <td class="w-30">
                    <div class="logo" style="text-align: center;">
                        <img src="https://agio.mydemosoftware.com/user/images/agio-removebg-preview.png"
                        style="max-height: 55px; max-width: 40px;">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/DEV/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30"e><strong>Page No.</strong>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-50">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-50">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
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
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/DEV/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>


                        {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30"> {{ Helpers::getDivisionName($data->division_id) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        {{-- <td class="w-30">@if{{ Helpers::getdateFormat($data->intiation_date) }} @else Not Applicable @endif</td> --}}
                        {{-- <td class="w-30">@if (Helpers::getdateFormat($data->intiation_date)) {{ Helpers::getdateFormat($data->intiation_date) }} @else Not Applicable @endif</td> --}}
                        <td class="w-30">{{ $data->created_at ? $data->created_at->format('d-M-Y') : '' }} </td>
                        </td>
                    </tr>
                    <tr>


                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ($data->Initiator_Group)
                                {{ $data->Initiator_Group }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-80">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>
                {{-- <div class="inner-block">
                    <label class="Summer"
                        style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                        Short Description </label>
                    <span style="font-size: 0.8rem; margin-left: 50px;">
                        @if ($data->short_description)
                            {{ $data->short_description }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}

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
                        <th class="w-20"> Repeat Deviation?</th>
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
                        <th class="w-20"> Deviation Observed On</th>
                        <td class="w-30">
                            @if ($data->Deviation_date)
                                {{ Helpers::getdateFormat($data->Deviation_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20"> Deviation Observed On (Time)</th>
                        <td class="w-30">
                            @if ($data->deviation_time)
                                {{ $data->deviation_time }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20"> Delay Justification</th>
                        <td class="w-30">
                            @if ($data->Delay_Justification)
                                {{ $data->Delay_Justification }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        {{-- <th class="w-20">Deviation Observed by</th>
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
                        </td> --}}
                        <th class="w-20"> Deviation Observed By</th>
                        <td class="w-30">
                            @if ($data->Facility)
                                {{ $data->Facility }}
                            @else
                                Not Applicable
                            @endif
                        </td>


                        {{-- <td class="w-30">@if ($data->Facility){{ $data->Facility }} @else Not Applicable @endif</td> --}}

                    </tr>

                    <tr>
                        <th class="w-20">Deviation Reported On </th>
                        <td class="w-30" colspan="3">
                            @if ($data->Deviation_reported_date)
                                {{ Helpers::getdateFormat($data->Deviation_reported_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                {{-- </table>
                <table>  --}}
                    <tr>
                        <th class="w-20">Deviation Related To</th>
                        <td class="w-30" colspan="3">
                            @if ($data->audit_type)
                                {{ $data->audit_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                {{-- </table>
                <table> --}}
                    <tr>

                        <th class="w-20"> Others</th>
                        <td class="w-30" colspan="3">
                            @if ($data->others)
                                {{ $data->others }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Facility/ Equipment/ Instrument/ System Details Required?</th>
                        <td class="w-30"colspan="3">
                            @if ($data->Facility_Equipment)
                                {{ Ucfirst($data->Facility_Equipment) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>


                        <div class="block">
                            <div class="block-head">
                                Facility/ Equipment/ Instrument/ System Details
                            </div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-10">Sr. No.</th>
                                        <th class="w-25">Related to</th>
                                        <th class="w-25">Name & ID Number</th>
                                        <th class="w-25">Remarks</th>
                                    </tr>
                                    @php
                                        $idNumbers = !empty($grid_data->IDnumber) ? @unserialize($grid_data->IDnumber) : false;
                                        $facilityNames = !empty($grid_data->facility_name) ? @unserialize($grid_data->facility_name) : false;
                                        $remarks = !empty($grid_data->Remarks) ? @unserialize($grid_data->Remarks) : false;
                                    @endphp
                                    @if ($idNumbers && $facilityNames && $remarks)
                                        @foreach ($idNumbers as $key => $dataDemo)
                                            <tr>
                                                <td class="w-15">{{ $loop->index + 1 }}</td>
                                                <td class="w-15">
                                                    {{ $facilityNames[$key] ?? 'Not Applicable' }}
                                                </td>
                                                <td class="w-15">
                                                    {{ $idNumbers[$key] ?? 'Not Applicable' }}
                                                </td>
                                                <td class="w-15">
                                                    {{ $remarks[$key] ?? 'Not Applicable' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                            <td>Not Applicable</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>


                    <table>
                    <tr>

                        <th class="w-20">Document Details Required?</th>
                        <td class="w-30">
                            @if ($data->Document_Details_Required)
                                {{Ucfirst( $data->Document_Details_Required) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    </table>

                        <div class="block">
                        <div class="block-head">
                            Document Details
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-10">Sr. No.</th>
                                    <th class="w-25">Document Name</th>
                                    <th class="w-25">Document Number</th>
                                    <th class="w-25">Remarks</th>

                                </tr>
                                @if (!empty($grid_data1->Number))
                                    @foreach (unserialize($grid_data1->Number) as $key => $dataDemo)
                                        <tr>
                                            <td class="w-15">{{ $loop->index + 1 }}</td>
                                            <td class="w-15">
                                                {{ unserialize($grid_data1->Number)[$key] ? unserialize($grid_data1->Number)[$key] : 'Not Applicable' }}
                                            </td>
                                            <td class="w-15">
                                                {{ unserialize($grid_data1->ReferenceDocumentName)[$key] ? unserialize($grid_data1->ReferenceDocumentName)[$key] : 'Not Applicable' }}
                                            </td>
                                            <td class="w-15">
                                                {{ unserialize($grid_data1->Document_Remarks)[$key] ? unserialize($grid_data1->Document_Remarks)[$key] : 'Not Applicable' }}
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>

                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    <table>
                    <tr>
                        <th class="w-20">Product / Material Batch Details Required</th>
                        <td class="w-30">
                            @if ($data->Product_Details_Required)
                                {{ Ucfirst(strip_tags($data->Product_Details_Required)) }}
                            @else
                                Not Applicable
                            @endif
                        </td>


                    </tr>

                    </table>

                        <div class="block">
                        <div class="block-head">
                        Product/ Material Batch Details
                        </div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-10">Sr. No.</th>
                                    <th class="w-25">Product /Material</th>
                                    <th class="w-25">Stage</th>
                                    <th class="w-25">Batch No /A.R.No.</th>

                                </tr>
                                @if (!empty($grid_data2->product_name))
                                    @foreach (unserialize($grid_data2->product_name) as $key => $dataDemo)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}</td>
                                            <td>{{ isset(unserialize($grid_data2->product_name)[$key]) ? unserialize($grid_data2->product_name)[$key] : '' }}
                                            </td>
                                            <td>
                                                {{ isset(unserialize($grid_data2->product_stage)[$key]) ? unserialize($grid_data2->product_stage)[$key] : '' }}
                                            </td>
                                            <td>{{ isset(unserialize($grid_data2->batch_no)[$key]) ? unserialize($grid_data2->batch_no)[$key] : '' }}
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>
                                        <td>Not Applicable</td>

                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    <table>
                    <tr>
                    <th class="w-20"> Description of Deviation</th>
                        <td class="w-30" colspan="3">
                            @if ($data->discb_deviat)
                                {{ $data->discb_deviat }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">HOD Person</th>
                        <td class="w-30" colspan="3">
                            @if ($data->Hod_person_to)
                                {{ strip_tags($data->Hod_person_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Reviewer Person</th>
                        <td class="w-30">
                            @if ($data->Reviewer_to)
                                {{ $data->Reviewer_to }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Approver Person</th>
                        <td class="w-30">
                            @if ($data->Approver_to)
                                {{ strip_tags($data->Approver_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>


                    <tr>
                    <th class="w-20"> Immediate Action (if any)</th>
                        <td class="w-30" colspan="3">
                            @if ($data->Immediate_Action)
                                {{ $data->Immediate_Action }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">Preliminary Impact of Deviation</th>
                        <td class="w-30" colspan="3">
                            @if ($data->Preliminary_Impact)
                                {{ strip_tags($data->Preliminary_Impact) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>


                    {{-- <tr> --}}
                    {{-- <th class="w-20">Name of Product & Batch No</th> --}}
                    {{-- <td class="w-30">@if ($data->Product_Batch){{ ($data->Product_Batch) }} @else Not Applicable @endif</td> --}}
                    {{-- </tr> --}}
                </table>
                {{-- <div class="inner-block">
                    <label class="Summer"
                        style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;"> Description of
                        Deviation</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->discb_deviat)
                            {{ $data->discb_deviat }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}

                {{-- <div class="inner-block">
                    <label class="Summer"
                        style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;"> Immediate
                        Action (if any)</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->Immediate_Action)
                            {{ $data->Immediate_Action }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>

                <div class="inner-block">
                    <label class="Summer"
                        style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                        Preliminary Impact of Deviation </label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->Preliminary_Impact)
                            {{ $data->Preliminary_Impact }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}
                {{-- @php
                    // Assuming you have a User model to retrieve user names based on IDs
                    $hodPerson = \App\Models\User::find($data->Hod_person_to);
                    $reviewerPerson = \App\Models\User::find($data->Reviewer_to);
                    $approverPerson = \App\Models\User::find($data->Approver_to);
                @endphp

                <table>
                    <tr>
                        <th class="w-20">HOD Person</th>
                        <td class="w-30">
                            @if ($hodPerson)
                                {{ $hodPerson->name }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Reviewer Person</th>
                        <td class="w-30">
                            @if ($reviewerPerson)
                                {{ $reviewerPerson->name }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Approver Person</th>
                        <td class="w-30">
                            @if ($approverPerson)
                                {{ $approverPerson->name }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table> --}}




                {{-- <div class="block">
                    <div class="block-head">
                        Description of Deviation (5W/2H)
                    </div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">5W/2H</th>
                                <th class="w-80">Remarks</th>
                            </tr>

                            <tr>
                                <td class="w-20" style="background-color: #91b4f7;">What / Remarks</td>
                                <td class="w-80">{{ $data->what }}</td>
                            </tr>
                            <tr>
                                <td class="w-20" style="background-color: #91b4f7;">Why / Remarks</td>
                                <td class="w-80">{{ $data->why_why }}</td>
                            </tr>
                            <tr>
                                <td class="w-20" style="background-color: #91b4f7;">Where / Remarks</td>
                                <td class="w-80">{{ $data->where_where }}</td>
                            </tr>
                            <tr>
                                <td class="w-20" style="background-color: #91b4f7;">When / Remarks</td>
                                <td class="w-80">{{ $data->when_when }}</td>
                            </tr>
                            <tr>
                                <td class="w-20" style="background-color: #91b4f7;">Who / Remarks</td>
                                <td class="w-80">{{ $data->who }}</td>
                            </tr>
                            <tr>
                                <td class="w-20" style="background-color: #91b4f7;">How / Remarks</td>
                                <td class="w-80">{{ $data->how }}</td>
                            </tr>
                            <tr>
                                <td class="w-20" style="background-color: #91b4f7;">How much / Remarks</td>
                                <td class="w-80">{{ $data->how_much }}</td>
                            </tr>

                        </table>
                    </div>
                </div> --}}








                {{-- ==================================new Added=================== --}}


                <div class="border-table">
                    <div class="block-head">
                        Initial Attachments
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->initial_file)
                            @foreach (json_decode($data->initial_file) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif

                    </table>
                </div>
                <!-- {{-- ==================================      --}} -->

                <div class="block">
                    <div class="block-head">
                        HOD Review
                    </div>

                    {{-- <div class="inner-block">
                        <label class="Summer"
                            style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                            HOD Review Comment </label>
                        <span style="font-size: 0.8rem; margin-left: 60px;">
                            @if ($data->HOD_Remarks)
                                {{ $data->HOD_Remarks }}
                            @else
                                Not Applicable
                            @endif
                        </span>
                    </div> --}}
                    <table>
                        <tr>
                            <th class="w-20">HOD Review Comment</th>
                            <td class="w-80">
                                @if ($data->HOD_Remarks)
                                    {{ $data->HOD_Remarks }}
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
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->hod_file_attachment)
                                @foreach (json_decode($data->hod_file_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif

                        </table>
                    </div>



                </div>
            </div>

            <div class="block">
                <div class="block-head">
                    QA/CQA Initial Assessment
                </div>
                <table>

                <tr>
                        <th class="w-20">Initial Deviation category</th>
                        <td class="w-30">
                            @if ($data->Deviation_category)
                                {{ Ucfirst($data->Deviation_category) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">CAPA Required</th>
                        <td class="w-30">
                            @if ($data->capa_required)
                                {{ Ucfirst($data->capa_required) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                </tr>
                    <tr>

                        <th class="w-20">QRM Required?</th>
                        <td class="w-30">
                            @if ($data->qrm_required)
                                {{ $data->qrm_required }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Investigation Required?</th>
                        <td class="w-30">
                            @if ($data->Investigation_required)
                                {{ $data->Investigation_required }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                        {{-- <div class="inner-block">
                            <label class="Summer"
                                style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                                Justification for categorization </label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->Justification_for_categorization)
                                    {{ $data->Justification_for_categorization }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div> --}}
                <table>
                    <tr>
                        <th class="w-20">Justification for categorization</th>
                        <td class="w-80">
                                @if ($data->Justification_for_categorization)
                                    {{ $data->Justification_for_categorization }}
                                @else
                                    Not Applicable
                                @endif
                        </td>
                    </tr>
                </table>
                {{-- <div class="inner-block">
                    <label class="Summer"
                        style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">Investigation
                        Details </label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->Investigation_Details)
                            {{ $data->Investigation_Details }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}
                {{-- <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline; width:5%">
                        Investigation Required? </label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->Investigation_required)
                            {{ $data->Investigation_required }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}

                {{-- <div class="inner-block">
                    <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline; width:5%">QA/CQA Initial Assessment Comment </label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->QAInitialRemark)
                            {{ $data->QAInitialRemark }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Initial Assessment Comment</th>
                        <td class="w-80">
                            @if ($data->QAInitialRemark)
                                {{ $data->QAInitialRemark }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


            </div>

            <div class="border-table">
                <div class="block-head">
                QA/CQA initial Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->Initial_attachment)
                        @foreach (json_decode($data->Initial_attachment) as $key => $file)
                            <tr>
                                <td class="w-20">{{ $key + 1 }}</td>
                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                        target="_blank"><b>{{ $file }}</b></a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-60">Not Applicable</td>
                        </tr>
                    @endif

                </table>
            </div>
            <div class="block">
                <div class="head">
                    <div class="block-head">
                        CFT
                    </div>
                    <div class="head">
                        <div class="block-head">
                            Production (Tablet/Capsule/Powder)
                        </div>
                        <table>

                            <tr>

                                <th class="w-20">Production Tablet/Capsule/Powder Impact Assessment Required ?
                                </th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Table_Review)
                                            {{ Ucfirst($data1->Production_Table_Review) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Tablet/Capsule/Powder Person</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Table_Person)
                                            {{ $data1->Production_Table_Person }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                        </table>
                        <table>
                            <tr>

                                <th class="w-20">Impact Assessment (By Production Tablet/Capsule/Powder)</th>
                                <td class="w-80">
                                    <div>
                                        @if ($data1->Production_Table_Assessment)
                                            {{ $data1->Production_Table_Assessment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                {{-- <th class="w-20">Production Tablet/Capsule/Powder Feedback</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Table_By)
                                            {{ $data1->Production_Table_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td> --}}
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th class="w-20">Production Tablet/Capsule/Powder Impact Assessment Completed By</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Table_By)
                                            {{ $data1->Production_Table_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                                <th class="w-20">Production Tablet/Capsule/Powder Impact Assessment Completed On</th>
                                <td class="w-30">
                                    <div>
                                        @if ($data1->Production_Table_On)
                                            {{ \Carbon\Carbon::parse($data1->Production_Table_On)->format('d-M-Y') }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="head">
                            <div class="block-head">
                                Production Tablet/Capsule/Powder Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Production_Table_Attachment)
                                    @foreach (json_decode($data1->Production_Table_Attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <br>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Production Injection
                            </div>

                            <table>

                                <tr>
                                    <th class="w-20">Production Injection Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Production_Injection_Review)
                                                {{Ucfirst( $data1->Production_Injection_Review )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Production Injection Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Production_Injection_Person)
                                                {{ $data1->Production_Injection_Person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Production Injection)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Production_Injection_Assessment)
                                                {{ $data1->Production_Injection_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Production Injection Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Production_Injection_Feedback)
                                                {{ $data1->Production_Injection_Feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Production Injection Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Production_Injection_By)
                                                {{ $data1->Production_Injection_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Production Injection Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Production_Injection_On)
                                                {{ \Carbon\Carbon::parse($data1->Production_Injection_On)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="border-table">
                            <div class="block-head">
                                Production Injection Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Production_Injection_Attachment)
                                    @foreach (json_decode($data1->Production_Injection_Attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Research & Development
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Research & Development Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ResearchDevelopment_Review)
                                                {{ Ucfirst($data1->ResearchDevelopment_Review )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Research & Development Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ResearchDevelopment_person)
                                                {{ $data1->ResearchDevelopment_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Research & Development)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->ResearchDevelopment_assessment)
                                                {{ $data1->ResearchDevelopment_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Research & Development Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ResearchDevelopment_feedback)
                                                {{ $data1->ResearchDevelopment_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Research & Development Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ResearchDevelopment_by)
                                                {{ $data1->ResearchDevelopment_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Research & Development Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ResearchDevelopment_on)
                                                {{ \Carbon\Carbon::parse($data1->ResearchDevelopment_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Research & Development Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->ResearchDevelopment_attachment)
                                    @foreach (json_decode($data1->ResearchDevelopment_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Human Resource
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Human Resource Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Human_Resource_review)
                                                {{ Ucfirst($data1->Human_Resource_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Human Resource Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Human_Resource_person)
                                                {{ $data1->Human_Resource_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Human Resource)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Human_Resource_assessment)
                                                {{ $data1->Human_Resource_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Human Resource Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Human_Resource_feedback)
                                                {{ $data1->Human_Resource_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Human Resource Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Human_Resource_by)
                                                {{ $data1->Human_Resource_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Human Resource Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Human_Resource_on)
                                                {{ \Carbon\Carbon::parse($data1->Human_Resource_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Human Resource Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Human_Resource_attachment)
                                    @foreach (json_decode($data1->Human_Resource_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Corporate Quality Assurance
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Corporate Quality Assurance Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->CorporateQualityAssurance_Review)
                                                {{Ucfirst($data1->CorporateQualityAssurance_Review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Corporate Quality Assurance Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->CorporateQualityAssurance_person)
                                                {{ $data1->CorporateQualityAssurance_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Corporate Quality Assurance)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->CorporateQualityAssurance_assessment)
                                                {{ $data1->CorporateQualityAssurance_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Corporate Quality Assurance feedback Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->CorporateQualityAssurance_feedback)
                                                {{ $data1->CorporateQualityAssurance_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Corporate Quality Assurance Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->CorporateQualityAssurance_by)
                                                {{ $data1->CorporateQualityAssurance_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Corporate Quality Assurance Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->CorporateQualityAssurance_on)
                                                {{ \Carbon\Carbon::parse($data1->CorporateQualityAssurance_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Corporate Quality Assurance Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->CorporateQualityAssurance_attachment)
                                    @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Stores
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Store Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Store_Review)
                                                {{Ucfirst( $data1->Store_Review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Store Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Store_person)
                                                {{ $data1->Store_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Store)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Store_assessment)
                                                {{ $data1->Store_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Stores feedback Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Store_feedback)
                                                {{ $data1->Store_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Store Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Store_by)
                                                {{ $data1->Store_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Store Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Store_on)
                                                {{ \Carbon\Carbon::parse($data1->Store_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Stores Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Store_attachment)
                                    @foreach (json_decode($data1->Store_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Engineering
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Engineering Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Engineering_review)
                                                {{Ucfirst( $data1->Engineering_review )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Engineering Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Engineering_person)
                                                {{ $data1->Engineering_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Engineering)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Engineering_assessment)
                                                {{ $data1->Engineering_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Engineering Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Engineering_feedback)
                                                {{ $data1->Engineering_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Engineering Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Engineering_by)
                                                {{ $data1->Engineering_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Engineering Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Engineering_on)
                                                {{ \Carbon\Carbon::parse($data1->Engineering_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Engineering Attachments
                            </div>
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Engineering_attachment)
                                    @foreach (json_decode($data1->Engineering_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Regulatory Affair
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Regulatory Affair Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->RegulatoryAffair_Review)
                                                {{ Ucfirst($data1->RegulatoryAffair_Review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Regulatory Affair Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->RegulatoryAffair_person)
                                                {{ $data1->RegulatoryAffair_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Regulatory Affair)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->RegulatoryAffair_assessment)
                                                {{ $data1->RegulatoryAffair_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Regulatory Affair Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->RegulatoryAffair_feedback)
                                                {{ $data1->RegulatoryAffair_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>

                                    <th class="w-20">Regulatory Affair Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->RegulatoryAffair_by)
                                                {{ $data1->RegulatoryAffair_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Regulatory Affair Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->RegulatoryAffair_on)
                                                {{ \Carbon\Carbon::parse($data1->RegulatoryAffair_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Regulatory Affair Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->RegulatoryAffair_attachment)
                                    @foreach (json_decode($data1->RegulatoryAffair_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Quality Assurance
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Quality Assurance Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Assurance_Review)
                                                {{ Ucfirst($data1->Quality_Assurance_Review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Assurance Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->QualityAssurance_person)
                                                {{ $data1->QualityAssurance_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Quality Assurance)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->QualityAssurance_assessment)
                                                {{ $data1->QualityAssurance_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Quality Assurance feedback Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Assurance_feedback)
                                                {{ $data1->Quality_Assurance_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Quality Assurance Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->QualityAssurance_by)
                                                {{ $data1->QualityAssurance_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Assurance Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->QualityAssurance_on)
                                                {{ \Carbon\Carbon::parse($data1->QualityAssurance_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Quality Assurance Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Quality_Assurance_attachment)
                                    @foreach (json_decode($data1->Quality_Assurance_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Production (Liquid/Ointment)
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Production (Liquid/Ointment) Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ProductionLiquid_Review)
                                                {{ Ucfirst($data1->ProductionLiquid_Review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Production (Liquid/Ointment) Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ProductionLiquid_person)
                                                {{ $data1->ProductionLiquid_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Production (Liquid/Ointment))</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->ProductionLiquid_assessment)
                                                {{ $data1->ProductionLiquid_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Production (Liquid/Ointment) Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ProductionLiquid_feedback)
                                                {{ $data1->ProductionLiquid_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Production (Liquid/Ointment) Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ProductionLiquid_by)
                                                {{ $data1->ProductionLiquid_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Production (Liquid/Ointment) Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ProductionLiquid_on)
                                                {{ \Carbon\Carbon::parse($data1->ProductionLiquid_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Production (Liquid/Ointment) Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->ProductionLiquid_attachment)
                                    @foreach (json_decode($data1->ProductionLiquid_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Quality Control
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Quality Control Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_review)
                                                {{ Ucfirst($data1->Quality_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Control Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Control_Person)
                                                {{ $data1->Quality_Control_Person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Quality Control)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Quality_Control_assessment)
                                                {{ $data1->Quality_Control_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Quality Control Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Control_feedback)
                                                {{ $data1->Quality_Control_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Quality Control Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Control_by)
                                                {{ $data1->Quality_Control_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Quality Control Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Quality_Control_on)
                                                {{ \Carbon\Carbon::parse($data1->Quality_Control_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Quality Control Attachments
                            </div>
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Quality_Control_attachment)
                                    @foreach (json_decode($data1->Quality_Control_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Microbiology
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Microbiology Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Microbiology_Review)
                                                {{ Ucfirst($data1->Microbiology_Review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Microbiology Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Microbiology_person)
                                                {{ $data1->Microbiology_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Microbiology)
                                    </th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Microbiology_assessment)
                                                {{ $data1->Microbiology_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Microbiology Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Microbiology_feedback)
                                                {{ $data1->Microbiology_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Microbiology Impact Assessment Completed By
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Microbiology_by)
                                                {{ $data1->Microbiology_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Microbiology Impact Assessment Completed On
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Microbiology_on)
                                                {{ \Carbon\Carbon::parse($data1->Microbiology_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Microbiology Attachment
                            </div>
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Microbiology_attachment)
                                    @foreach (json_decode($data1->Microbiology_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>


                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Safety
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Safety Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Environment_Health_review)
                                                {{ Ucfirst($data1->Environment_Health_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Safety Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Environment_Health_Safety_person)
                                                {{ $data1->Environment_Health_Safety_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Safety)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->Health_Safety_assessment)
                                                {{ $data1->Health_Safety_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Safety Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Health_Safety_feedback)
                                                {{ $data1->Health_Safety_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Safety Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Environment_Health_Safety_by)
                                                {{ $data1->Environment_Health_Safety_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Safety Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Environment_Health_Safety_on)
                                                {{ \Carbon\Carbon::parse($data1->Environment_Health_Safety_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Safety Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Environment_Health_Safety_attachment)
                                    @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Contract Giver
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Contract Giver Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ContractGiver_Review)
                                                {{ Ucfirst($data1->ContractGiver_Review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Contract Giver comment update by</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ContractGiver_person)
                                                {{ $data1->ContractGiver_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Impact Assessment (By Contract Giver)</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data1->ContractGiver_assessment)
                                                {{ $data1->ContractGiver_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Contract Giver Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ContractGiver_feedback)
                                                {{ $data1->ContractGiver_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th class="w-20">Contract Giver Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ContractGiver_by)
                                                {{ $data1->ContractGiver_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Contract Giver Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->ContractGiver_on)
                                                {{ \Carbon\Carbon::parse($data1->ContractGiver_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Contract Giver Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->ContractGiver_attachment)
                                    @foreach (json_decode($data1->ContractGiver_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>


                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 1 ( Additional Person Impact Assessment From Departments If Required)
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Other's 1 Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_review)
                                                {{Ucfirst( $data1->Other1_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 1 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_person)
                                                {{ $data1->Other1_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                </tr>

                                <tr>
                                    <th class="w-20">Other's 1 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_Department_person)
                                                {{ $data1->Other1_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                    <th class="w-20">Impact Assessment (By Other's 1)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_assessment)
                                                {{ $data1->Other1_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Other's 1 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_feedback)
                                                {{ $data1->Other1_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                                <tr>
                                    <th class="w-20">Other's 1 Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_by)
                                                {{ $data1->Other1_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 1 Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other1_on)
                                                {{ \Carbon\Carbon::parse($data1->Other1_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 1 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other1_attachment)
                                    @foreach (json_decode($data1->Other1_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 2 ( Additional Person Impact Assessment From Departments If Required)
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Other's 2 Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_review)
                                                {{Ucfirst( $data1->Other2_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 2 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_person)
                                                {{ $data1->Other2_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Other's 2 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_Department_person)
                                                {{ $data1->Other2_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                    <th class="w-20">Impact Assessment (By Other's 2)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_Assessment)
                                                {{ $data1->Other2_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Other's 2 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_feedback)
                                                {{ $data1->Other2_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 2 Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_by)
                                                {{ $data1->Other2_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 2 Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other2_on)
                                                {{ \Carbon\Carbon::parse($data1->Other2_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 2 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other2_attachment)
                                    @foreach (json_decode($data1->Other2_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 3 ( Additional Person Impact Assessment From Departments If Required)
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Other's 3 Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_review)
                                                {{ Ucfirst($data1->Other3_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 3 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_person)
                                                {{ $data1->Other3_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                </tr>

                                <tr>

                                    <th class="w-20">Other's 3 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_Department_person)
                                                {{ $data1->Other3_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                    <th class="w-20">Impact Assessment (By Other's 3)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_Assessment)
                                                {{ $data1->Other3_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Other's 3 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_feedback)
                                                {{ $data1->Other3_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 3 Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_by)
                                                {{ $data1->Other3_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 3 Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other3_on)
                                                {{ \Carbon\Carbon::parse($data1->Other3_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 3 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other3_attachment)
                                    @foreach (json_decode($data1->Other3_attachment) as $key => $file)
                                        <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 4 ( Additional Person Impact Assessment From Departments If Required)
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Other's 4 Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_review)
                                                {{ Ucfirst($data1->Other4_review )}}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 4 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_person)
                                                {{ $data1->Other4_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Other's 4 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_Department_person)
                                                {{ $data1->Other4_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Impact Assessment (By Other's 4)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_Assessment)
                                                {{ $data1->Other4_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Other's 4 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_feedback)
                                                {{ $data1->Other4_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 4 Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_by)
                                                {{ $data1->Other4_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 4 Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other4_on)
                                                {{ \Carbon\Carbon::parse($data1->Other4_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 4 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other4_attachment)
                                    @foreach (json_decode($data1->Other4_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Other's 5 ( Additional Person Impact Assessment From Departments If Required)
                            </div>
                            <table>
                                <tr>
                                    <th class="w-20">Other's 5 Impact Assessment Required ?
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_review)
                                                {{ Ucfirst($data1->Other5_review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Other's 5 Person</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_person)
                                                {{ $data1->Other5_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Other's 5 Department</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_Department_person)
                                                {{ $data1->Other5_Department_person }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Impact Assessment (By Other's 5)</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_Assessment)
                                                {{ $data1->Other5_Assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <th class="w-20">Other's 5 Feedback</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_feedback)
                                                {{ $data1->Other5_feedback }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td> --}}
                                </tr>
                                <tr>

                                    <th class="w-20">Other's 5 Impact Assessment Completed By</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_by)
                                                {{ $data1->Other5_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20"> Other's 5 Impact Assessment Completed On</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data1->Other5_on)
                                                {{ \Carbon\Carbon::parse($data1->Other5_on)->format('d-M-Y') }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Other's 5 Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data1->Other5_attachment)
                                    @foreach (json_decode($data1->Other5_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>



                    <div class="block">
                        <div class="block-head">
                        QA/CQA Final Assessment
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">QA/CQA Final Assessment Comment </th>
                                <td class="w-80">
                                    @if ($data->qa_final_assement)
                                        {{ strip_tags($data->qa_final_assement) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                        </table>
                    </div>

                    <div class="border-table">
                            <div class="block-head">
                            QA/CQA Final Assessment attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->qa_final_assement_attach)
                                    @foreach (json_decode($data->qa_final_assement_attach) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>


                        <br>

                        <div class="block">
                        <div class="block-head">
                        QA/CQA Head/Designee Approval
                        </div>
                        <table>
                            <tr>
                                <th class="w-20">QA/CQA Head/Designee Approval comment </th>
                                <td class="w-80">
                                    @if ($data->qa_head_designe_comment)
                                        {{ strip_tags($data->qa_head_designe_comment) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                        </table>
                    </div>

                    <div class="border-table">
                            <div class="block-head">

                        QA/CQA Head/ Designee Approval attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->qa_head_designee_attach)
                                    @foreach (json_decode($data->qa_head_designee_attach) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>

                   <!-- **************************INVESTIGATION TAB START******************************* -->

                    <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Investigation
                            </div>
                            <table>
                                {{-- <tr>
                                    <th class="w-20">Proposed Due Date
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($investigationExtension && $investigationExtension->investigation_proposed_due_date)
                                                {{ Helpers::getdateFormat($investigationExtension->investigation_proposed_due_date) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> --}}
                                <tr>
                                    <th class="w-20">Description of Event
                                    </th>
                                    <td class="w-80">
                                        <div>
                                        @if ($data->Discription_Event)
                                            {{ $data->Discription_Event }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Objective
                                    </th>
                                    <td class="w-80">
                                        <div>
                                        @if ($data->objective)
                                            {{ $data->objective }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Scope
                                    </th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->scope)
                                                {{ $data->scope }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="w-20">Immediate Action
                                    </th>
                                    <td class="w-80">
                                        <div>
                                        @if ($data->imidiate_action)
                                            {{ $data->imidiate_action }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            {{-- <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline; width:5%">
                                    Description of Event </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($data->Discription_Event)
                                        {{ $data->Discription_Event }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div>
                            <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline; width:5%">
                                    Objective </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($data->objective)
                                        {{ $data->objective }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div>
                            <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline; width:5%">
                                    Scope </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($data->scope)
                                        {{ $data->scope }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div>
                            <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline; width:5%">
                                    Immediate Action </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($data->imidiate_action)
                                        {{ $data->imidiate_action }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div> --}}


                            <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-head" style="margin-bottom:5px; font-weight:bold;">Investigation
                                    Team
                                    And Responsibilities</div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Investigation Team</th>
                                         <th class="w-60">Designation & Department  </th>
                                        <th class="w-60">Responsibility</th>
                                        <th class="w-60">Remarks</th>

                                    </tr>
                                    <tbody>
                                        @if ($investigation_data && is_array($investigation_data))
                                            @php
                                                $serialNumber = 1;
                                                // Get all users and map them by id
                                                $users = DB::table('users')->pluck('name', 'id')->all();
                                            @endphp
                                            @foreach ($investigation_data as $investigation_item)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">
                                                        {{ isset($users[$investigation_item['teamMember']]) ? $users[$investigation_item['teamMember']] : '' }}
                                                    </td>

                                                    <td class="w-20">{{ $investigation_item['desination_dept'] }}
                                                    </td>

                                                    <td class="w-20">{{ $investigation_item['responsibility'] }}
                                                    </td>
                                                    <td class="w-20">{{ $investigation_item['remarks'] }}</td>
                                                 </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                                                <td colspan="5">No  data available.</td>
                                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            {{-- <tr>
                                    <th class="w-20">Description of Event
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Discription_Event)
                                                {{ strip_tags($data->Discription_Event) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Objective</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->objective)
                                                {{ strip_tags($data->objective) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> --}}
                            {{-- <tr>
                                    <th class="w-20">Scope</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->scope)
                                                {{ strip_tags($data->scope) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Immediate Action</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->imidiate_action)
                                                {{ strip_tags($data->imidiate_action) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr> --}}

                            <!-- {{-- <tr> --}} -->


                            <!-- {{-- <th class="w-20">CAPA Type?</th> --}}
                                {{-- <td class="w-30">
                            <div>
                                @if ($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif
                            </div>
                        </td> --}} -->
                            <!-- {{-- </tr> --}} -->
                            {{-- <table>
                                <tr>

                                    <th class="w-20">CAPA Description</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->CAPA_Description)
                                                {{ $data->CAPA_Description }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Post Categorization Of Deviationt</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Post_Categorization)
                                                {{ $data->Post_Categorization }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table> --}}
                            {{-- <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                                    Justification For Revised category </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($data->Investigation_Of_Review)
                                        {{ $data->Investigation_Of_Review }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div> --}}
                            <table>


                                <tr>
                                    <th class="w-20">Investigation Approach</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->investigation_approach)
                                                {{ $data->investigation_approach }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>


                                </tr>
                                <tr>
                                    <th class="w-20">Others</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->others_data)
                                                {{ $data->others_data }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>


                                </tr>
                            </table>


                            <div class="border-table">
                            <div class="block-head">
                            Other attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->other_attachment)
                                    @foreach (json_decode($data->other_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                            {{-- <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline; width:5%">QA
                                    Description of Event </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($data->Discription_Event)
                                        {{ $data->Discription_Event }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div> --}}


                            {{-- <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-head" style="margin-bottom:5px; font-weight:bold;">
                                    Root Cause
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Root Cause Category</th>
                                        <th class="w-60">Root Cause Sub-Category</th>
                                        <th class="w-60">Others</th>
                                        <th class="w-60">Probability</th>
                                        <th class="w-60">Remark</th>
                                    </tr>

                                    <tbody>
                                        @if ($root_cause_data && is_array($root_cause_data))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($root_cause_data as $rootCause_data)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">
                                                        {{ $rootCause_data['rootCauseCategory'] ?? '' }}</td>
                                                    <td class="w-20">
                                                        {{ $rootCause_data['rootCauseSubCategory'] ?? '' }}</td>
                                                    <td class="w-20">{{ $rootCause_data['ifOthers'] ?? '' }}</td>
                                                    <td class="w-20">{{ $rootCause_data['probability'] ?? '' }}
                                                    </td>
                                                    <td class="w-20">{{ $rootCause_data['remarks'] ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div> --}}
                            {{-- <div class="col-12" id="HideInference" style="display:none;"> --}}

                            <br>
                            <br>
                            <br><br><br><br><br><br><br><br><br><br><br><br>




                            <div class="block-head">
    Fishbone or Ishikawa Diagram
</div>

@if (!empty($fishboneData))
    @php
        $decodedData = json_decode($fishboneData->data, true);
    @endphp

    @if ($decodedData && is_array($decodedData))
    <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;">

@php
    $measurement = $decodedData['measurement'] ?? [];
    $materials = $decodedData['materials'] ?? [];
    $methods = $decodedData['methods'] ?? [];
    $maxCount = max(count((array)$measurement), count((array)$materials), count((array)$methods));

    $environment = $decodedData['environment'] ?? [];
    $manpower = $decodedData['manpower'] ?? [];
    $machine = $decodedData['machine'] ?? [];
    $maxCount2 = max(count((array)$environment), count((array)$manpower), count((array)$machine));
@endphp

<!-- Wrapper table to align content side by side -->
<table style="width: 100%; border-collapse: collapse;">
    <tr valign="top">
        <!-- First Table -->
        <td style="width: 70%;">
            <table style="width: 70%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="color: #007bff;">
                        <th style="padding: 10px; border: 1px solid #ddd;">Measurement</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Materials</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Methods</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $maxCount; $i++)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $measurement[$i] ?? 'N/A' }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $materials[$i] ?? 'N/A' }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $methods[$i] ?? 'N/A' }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </td>
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse;">
    <tr >
        <td style="width: 70%;">
            <div style="width: 100%; height: 2px; background: blue; margin: 20px 0;"></div>
        </td>
        <td style="width: 30%;">
            <div style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #ffffff;">
                <strong style="color: #007bff;">Problem Statement:</strong>
                <div style="margin-top: 10px;">
                    {{ $decodedData['fishbone_problem_statement'] ?? 'N/A' }}
                </div>
            </div>
        </td>
    </tr>
</table>


<!-- Second Table -->
<table style="width: 70%; border-collapse: collapse; text-align: left;">
    <thead>
        <tr style="color: #007bff;">
            <th style="padding: 10px; border: 1px solid #ddd;">Mother Environment</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Man</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Machine</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < $maxCount2; $i++)
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $environment[$i] ?? 'N/A' }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $manpower[$i] ?? 'N/A' }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $machine[$i] ?? 'N/A' }}</td>
            </tr>
        @endfor
    </tbody>
</table>

</div>


    @else
        <p style="text-align: center; color: red;">Invalid Fishbone data format.</p>
    @endif
@else
    <p style="text-align: center; color: red;">No Fishbone data available.</p>
@endif


                                <br><br><br><br>



                                <!-- <div class="block-head">
                                    Fishbone or Ishikawa Diagram
                                </div>

                            @php
                                // Decode the JSON data to convert it to an array
                                $decodedData = json_decode($fishboneData->data, true);

                                // Debug to ensure the data is properly decoded
                                //dd($decodedData);
                            @endphp

                            @if ($decodedData && is_array($decodedData))
                                <table>
                                    <tr>
                                        <th class="w-20">Measurement</th>
                                        <td class="w-80">
                                            @php $measurement = $decodedData['measurement'] ?? []; @endphp
                                            @if (is_array($measurement))
                                                @foreach ($measurement as $value)
                                                    {{ htmlspecialchars($value) }}
                                                @endforeach
                                            @elseif(is_string($measurement))
                                                {{ htmlspecialchars($measurement) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        </tr>
                                        <tr>
                                        <th class="w-20">Materials</th>
                                        <td class="w-80">
                                            @php $materials = $decodedData['materials'] ?? []; @endphp
                                            @if (is_array($materials))
                                                @foreach ($materials as $value)
                                                    {{ htmlspecialchars($value) }}
                                                @endforeach
                                            @elseif(is_string($materials))
                                                {{ htmlspecialchars($materials) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-20">Methods</th>
                                        <td class="w-80">
                                            @php $methods = $decodedData['methods'] ?? []; @endphp
                                            @if (is_array($methods))
                                                @foreach ($methods as $value)
                                                    {{ htmlspecialchars($value) }}
                                                @endforeach
                                            @elseif(is_string($methods))
                                                {{ htmlspecialchars($methods) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        </tr>
                                        <tr>
                                        <th class="w-20">Mother Environment</th>
                                        <td class="w-80">
                                            @php $environment = $decodedData['environment'] ?? []; @endphp
                                            @if (is_array($environment))
                                                @foreach ($environment as $value)
                                                    {{ htmlspecialchars($value) }}
                                                @endforeach
                                            @elseif(is_string($environment))
                                                {{ htmlspecialchars($environment) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-20">Man</th>
                                        <td class="w-80">
                                            @php $manpower = $decodedData['manpower'] ?? []; @endphp
                                            @if (is_array($manpower))
                                                @foreach ($manpower as $value)
                                                    {{ htmlspecialchars($value) }}
                                                @endforeach
                                            @elseif(is_string($manpower))
                                                {{ htmlspecialchars($manpower) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        </tr>
                                        <tr>
                                        <th class="w-20">Machine</th>
                                        <td class="w-80">
                                            @php $machine = $decodedData['machine'] ?? []; @endphp
                                            @if (is_array($machine))
                                                @foreach ($machine as $value)
                                                    {{ htmlspecialchars($value) }}
                                                @endforeach
                                            @elseif(is_string($machine))
                                                {{ htmlspecialchars($machine) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                </table>


                            <div class="inner-block">
                                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                                    Problem Statement
                                </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    {{ $decodedData['fishbone_problem_statement'] ?? 'Not Applicable' }}
                                </span>


                            </div>
                        @endif -->



                            <style>
                                .tableFMEA {
                                    width: 100%;
                                    border-collapse: collapse;
                                    font-size: 7px;
                                    table-layout: fixed; /* Ensures columns are evenly distributed */
                                }

                                .thFMEA,
                                .tdFMEA {
                                    border: 1px solid black;
                                    padding: 5px;
                                    word-wrap: break-word;
                                    text-align: center;
                                    vertical-align: middle;
                                    font-size: 6px; /* Apply the same font size for all cells */
                                }

                                /* Rotating specific headers */
                                .rotate {
                                    transform: rotate(-90deg);
                                    white-space: nowrap;
                                    width: 10px;
                                    height: 100px;
                                }

                                /* Ensure the "Traceability Document" column fits */
                                .tdFMEA:last-child,
                                .thFMEA:last-child {
                                    width: 80px; /* Allocate more space for "Traceability Document" */
                                }

                                /* Adjust for smaller screens to fit */
                                @media (max-width: 1200px) {
                                    .tdFMEA:last-child,
                                    .thFMEA:last-child {
                                        font-size: 6px;
                                        width: 70px; /* Shrink width further for smaller screens */
                                    }
                                }

                            </style>

                                <div class="border-table">
                                    <div class="col-12 mb-4" id="fmea-section-part3">
                                        <div class="group-input">
                                            <div class="block-head">Inference</div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="risk-acceptance">
                                                    <thead>
                                                        <tr class="table_bg">
                                                            <th style="width: 5%;">Sr.No.</th>
                                                            <th style="width: 30%;">Type</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data->inference_type) && !empty($data->inference_remarks))
                                                            @php
                                                                $inference_types = unserialize($data->inference_type);
                                                                $inference_remarks = unserialize($data->inference_remarks);
                                                            @endphp

                                                            @foreach ($inference_types as $key => $inference_type)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>
                                                                        @switch($inference_type)
                                                                            @case('Measurement')
                                                                                Measurement
                                                                                @break
                                                                            @case('Materials')
                                                                                Materials
                                                                                @break
                                                                            @case('Methods')
                                                                                Methods
                                                                                @break
                                                                            @case('Mother Environment')
                                                                                Mother Environment
                                                                                @break
                                                                            @case('Man')
                                                                                Man
                                                                                @break
                                                                            @case('Machine')
                                                                                Machine
                                                                                @break
                                                                            @default
                                                                                N/A
                                                                        @endswitch
                                                                    </td>
                                                                    <td>{{ $inference_remarks[$key] ?? 'No remarks provided' }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="3">No  data available.</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>






                            <div class="block-head">Failure Mode And Effect Analysis</div>
                            <div class="table-responsive">
                            <table class="tableFMEA">
                                <thead>
                                    <tr class="table_bg" style="text-align: center; vertical-align: middle; padding: 20px;">
                                        <th class="thFMEA" rowspan="2">Sr.No</th>
                                        <th class="thFMEA" colspan="2">Risk Identification</th>
                                        <th class="thFMEA">Risk Analysis</th>
                                        <th class="thFMEA" colspan="4">Risk Evaluation</th>
                                        <th class="thFMEA">Risk Control</th>
                                        <th class="thFMEA" colspan="6">Risk Evaluation</th>
                                        {{-- <th class="thFMEA">Risk Level</th>
                                        <th class="thFMEA">Risk Acceptance (Y/N)</th> --}}
                                        <th class="thFMEA" rowspan="2">Traceability Document</th>
                                        <!-- <th class="thFMEA"></th>
                                        <th class="thFMEA"></th> -->

                                    </tr>
                                    <tr class="table_bg">
                                        <th class="thFMEA">Activity</th>
                                        <th class="thFMEA">Possible Risk/Failure (Identified Risk)</th>
                                        <th class="thFMEA">Consequences of Risk/Potential Causes</th>
                                        <th class="thFMEA">Severity (S)</th>
                                        <th class="thFMEA">Probability (P)</th>
                                        <th class="thFMEA">Detection (D)</th>
                                        <th class="thFMEA">Risk Level(RPN)</th>
                                        <th class="thFMEA">	Control Measures recommended/ Risk mitigation proposed</th>
                                        <th class="thFMEA">Severity (S)</th>
                                        <th class="thFMEA">Probability (P)</th>
                                        <th class="thFMEA">Detection (D)</th>
                                        <th class="thFMEA">Risk Level(RPN)</th>
                                        <th class="thFMEA">Category of Risk Level (Low, Medium and High)</th>
                                        <th class="thFMEA">Risk Acceptance (Y/N)</th>
                                        <!-- <th class="thFMEA">Others</th>
                                        <th class="thFMEA">Attchment</th> -->

                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                            @if (!empty($riskEffectAnalysis->risk_factor_1) && is_string($riskEffectAnalysis->risk_factor_1) && @unserialize($riskEffectAnalysis->risk_factor_1) !== false)
                                @foreach (unserialize($riskEffectAnalysis->risk_factor_1) as $key => $riskFactor)
                                    <tr>
                                        <td class="tdFMEA">{{ $key + 1 }}</td>
                                        <td class="tdFMEA">{{ $riskFactor }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->problem_cause_1) && @unserialize($riskEffectAnalysis->problem_cause_1) ? unserialize($riskEffectAnalysis->problem_cause_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->existing_risk_control_1) && @unserialize($riskEffectAnalysis->existing_risk_control_1) ? unserialize($riskEffectAnalysis->existing_risk_control_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->initial_severity_1) && @unserialize($riskEffectAnalysis->initial_severity_1) ? unserialize($riskEffectAnalysis->initial_severity_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->initial_detectability_1) && @unserialize($riskEffectAnalysis->initial_detectability_1) ? unserialize($riskEffectAnalysis->initial_detectability_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->initial_probability_1) && @unserialize($riskEffectAnalysis->initial_probability_1) ? unserialize($riskEffectAnalysis->initial_probability_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->initial_rpn_1) && @unserialize($riskEffectAnalysis->initial_rpn_1) ? unserialize($riskEffectAnalysis->initial_rpn_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->risk_control_measure_1) && @unserialize($riskEffectAnalysis->risk_control_measure_1) ? unserialize($riskEffectAnalysis->risk_control_measure_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->residual_severity_1) && @unserialize($riskEffectAnalysis->residual_severity_1) ? unserialize($riskEffectAnalysis->residual_severity_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->residual_probability_1) && @unserialize($riskEffectAnalysis->residual_probability_1) ? unserialize($riskEffectAnalysis->residual_probability_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->residual_detectability_1) && @unserialize($riskEffectAnalysis->residual_detectability_1) ? unserialize($riskEffectAnalysis->residual_detectability_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->residual_rpn_1) && @unserialize($riskEffectAnalysis->residual_rpn_1) ? unserialize($riskEffectAnalysis->residual_rpn_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->risk_acceptance_1) && @unserialize($riskEffectAnalysis->risk_acceptance_1) ? unserialize($riskEffectAnalysis->risk_acceptance_1)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->risk_acceptance3) && @unserialize($riskEffectAnalysis->risk_acceptance3) ? unserialize($riskEffectAnalysis->risk_acceptance3)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->mitigation_proposal_1) && @unserialize($riskEffectAnalysis->mitigation_proposal_1) ? unserialize($riskEffectAnalysis->mitigation_proposal_1)[$key] ?? null : null }}</td>
                                        <!-- <td class="tdFMEA">{{ is_string($riskEffectAnalysis->conclusion) && @unserialize($riskEffectAnalysis->conclusion) ? unserialize($riskEffectAnalysis->conclusion)[$key] ?? null : null }}</td>
                                        <td class="tdFMEA">{{ is_string($riskEffectAnalysis->attachment) && @unserialize($riskEffectAnalysis->attachment) ? unserialize($riskEffectAnalysis->attachment)[$key] ?? null : null }}</td> -->
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="18">No data available.</td>
                                </tr>
                            @endif
                        </tbody>

                            </table>
                        </div>








                        {{-- <table>


                            <thead>
                                <tr class="table_bg">
                                    <th class="w-20">Row #</th>
                                    <th class="w-20">Activity</th>
                                    <th class="w-20">Possible Risk/Failure (Identified Risk)</th>
                                    <th class="w-20">Consequences of Risk/Potential Causes</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $measurement_1 = unserialize($riskEffectAnalysis->risk_factor_1);
                                    $measurement_2 = unserialize($riskEffectAnalysis->problem_cause_1);
                                    $measurement_3 = unserialize($riskEffectAnalysis->existing_risk_control_1);
                                    $row_number = 1;
                                @endphp

                                @for ($i = 0; $i < count($measurement_1); $i++)
                                    <tr>
                                        <td class="w-10">{{ $row_number++ }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_1[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_2[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_3[$i] ?? 'Not Applicable') }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table> --}}

                        {{-- <table>
                            <thead>
                                <tr class="table_bg">
                                    <th class="w-10">Row #</th>
                                    <th class="w-20">Initial Severity (S)</th>
                                    <th class="w-20">Initial Probability (P)</th>
                                    <th class="w-20">Initial Detectability (D)</th>
                                    <th class="w-20">RPN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $measurement_4 = unserialize($riskEffectAnalysis->initial_severity_1);
                                    $measurement_5 = unserialize($riskEffectAnalysis->initial_probability_1);
                                    $measurement_6 = unserialize($riskEffectAnalysis->initial_detectability_1);
                                    $measurement_7 = unserialize($riskEffectAnalysis->initial_rpn_1);
                                    $row_number = 1; // Reset row number
                                @endphp

                                @for ($i = 0; $i < count($measurement_4); $i++)
                                    <tr>
                                        <td class="w-10">{{ $row_number++ }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_4[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_5[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_6[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_7[$i] ?? 'Not Applicable') }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table> --}}

                        {{-- <table>
                            <thead>
                                <tr class="table_bg">
                                    <th class="w-10">Row #</th>
                                    <th class="w-20">Control Measures recommended/ Risk mitigation proposed</th>
                                    <th class="w-20">Residual Severity (S)</th>
                                    <th class="w-20">Residual Probability (P)</th>
                                    <th class="w-20">Residual Detectability (D)</th>
                                    <th class="w-20">Risk Level (RPN)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $measurement_8 = unserialize($riskEffectAnalysis->risk_control_measure_1);
                                    $measurement_9 = unserialize($riskEffectAnalysis->residual_severity_1);
                                    $measurement_10 = unserialize($riskEffectAnalysis->residual_probability_1);
                                    $measurement_11 = unserialize($riskEffectAnalysis->residual_detectability_1);
                                    $measurement_12 = unserialize($riskEffectAnalysis->residual_rpn_1);
                                    $row_number = 1; // Reset row number
                                @endphp

                                @if (is_array($measurement_8))
                                    @for ($i = 0; $i < count($measurement_8); $i++)
                                        <tr>
                                            <td class="w-10">{{ $row_number++ }}</td>
                                            <td class="w-20">{{ htmlspecialchars($measurement_8[$i] ?? 'Not Applicable') }}
                                            </td>
                                            <td class="w-20">{{ htmlspecialchars($measurement_9[$i] ?? 'Not Applicable') }}
                                            </td>
                                            <td class="w-20">{{ htmlspecialchars($measurement_10[$i] ?? 'Not Applicable') }}
                                            </td>
                                            <td class="w-20">{{ htmlspecialchars($measurement_11[$i] ?? 'Not Applicable') }}
                                            </td>
                                            <td class="w-20">{{ htmlspecialchars($measurement_12[$i] ?? 'Not Applicable') }}
                                            </td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr>
                                        <td colspan="6">No measurements available</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table> --}}

                        {{-- <table>
                            <thead>
                                <tr class="table_bg">
                                    <th class="w-10">Row #</th>
                                    <th class="w-20">Category of Risk Level (Low, Medium, and High)</th>
                                    <th class="w-20">Risk Acceptance (Y/N)</th>
                                    <th class="w-20">Traceability document</th>
                                </tr>
                            </thead>

                            <tbody>
                            @php
                                $measurement_13 = unserialize($riskEffectAnalysis->risk_acceptance_1);
                                $measurement_14 = unserialize($riskEffectAnalysis->risk_acceptance3);
                                $measurement_15 = unserialize($riskEffectAnalysis->mitigation_proposal_1);
                                $max_count = max(count($measurement_13), count($measurement_14), count($measurement_15));
                                $row_number = 1;
                            @endphp

                                @php
                                    $measurement_13 = unserialize($riskEffectAnalysis->risk_acceptance_1);
                                    $measurement_14 = unserialize($riskEffectAnalysis->risk_acceptance3);
                                    $measurement_15 = unserialize($riskEffectAnalysis->mitigation_proposal_1);

                                    // Ensure each variable is an array; if not, set it to an empty array
                                    $measurement_13 = is_array($measurement_13) ? $measurement_13 : [];
                                    $measurement_14 = is_array($measurement_14) ? $measurement_14 : [];
                                    $measurement_15 = is_array($measurement_15) ? $measurement_15 : [];

                                    // Now you can safely use count() since all variables are arrays
                                    $max_count = max(count($measurement_13), count($measurement_14), count($measurement_15));
                                    $row_number = 1;
                                @endphp


                                @for ($i = 0; $i < $max_count; $i++)
                                    <tr>
                                        <td class="w-10">{{ $row_number++ }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_13[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_14[$i] ?? 'Not Applicable') }}</td>
                                        <td class="w-20">{{ htmlspecialchars($measurement_15[$i] ?? 'Not Applicable') }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table> --}}


                            <!-- <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-head">
                                    Why Why Chart
                                </div>


                                <div class="block-head" style="margin-bottom:5px; font-weight:bold;">
                                    Problem Statement
                                </div>

                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if ($why_data && isset($why_data['problem_statement']))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @if (is_array($why_data['problem_statement']))
                                                @foreach ($why_data['problem_statement'] as $statement)
                                                    <tr>
                                                        <td class="w-20">{{ $serialNumber++ }}</td>
                                                        <td class="w-60">{{ $statement }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="w-20">1</td>
                                                    <td class="w-60">{{ $why_data['problem_statement'] }}</td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-60">Not Applicable</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table> -->


                                <!-- <table>
                                    <tr>
                                        <th class="w-20">Problem Statement</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($why_data && $why_data['problem_statement'])
                                                    {{ $why_data['problem_statement'] }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                        <th class="w-20">Root Cause</th>
                                        <td class="w-30">
                                            <div>
                                                @if ($why_data && $why_data['root-cause'])
                                                    {{ $why_data['root-cause'] }}
                                                @else
                                                    Not Applicable
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table> -->

             <!-- *********************** problem state *********************** -->
                                <!-- <div class="block-head" style="margin-bottom:5px; font-weight:bold;">
                                    Why 1
                                </div>


                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if ($why_data && is_array($why_data['why_1']))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($why_data['why_1'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>


                                 <div class="block-head" style="margin-bottom:5px;  font-weight:bold;">
                                    Why 2
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if ($why_data && is_array($why_data['why_2']))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($why_data['why_2'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>


                                 <div class="block-head" style="margin-bottom:5px;  font-weight:bold;">
                                    Why 3
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if ($why_data && is_array($why_data['why_3']))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($why_data['why_3'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>


                                <div class="block-head" style="margin-bottom:5px; font-weight:bold;">
                                    Why 4
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if ($why_data && is_array($why_data['why_4']))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($why_data['why_4'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                            <div class="block-head" style="margin-bottom:5px; font-weight:bold;">
                                    Why 5
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Description</th>
                                    </tr>
                                    <tbody>
                                        @if ($why_data && is_array($why_data['why_5']))
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($why_data['why_5'] as $whyData)
                                                <tr>
                                                    <td class="w-20">{{ $serialNumber++ }}</td>
                                                    <td class="w-20">{{ $whyData }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="w-20">1</td>
                                                <td class="w-20">Not Applicable</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>



                            <div class="block-head" style="margin-bottom:5px; font-weight:bold;">
                                Root Cause
                                </div>


                                <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Description</th>
                            </tr>
                            <tbody>
                                @if ($why_data && isset($why_data['root-cause']))
                                    @php
                                        $serialNumber = 1;
                                    @endphp
                                    @if (is_array($why_data['root-cause']))
                                        @foreach ($why_data['root-cause'] as $rootCause)
                                            <tr>
                                                <td class="w-20">{{ $serialNumber++ }}</td>
                                                <td class="w-60">{{ $rootCause }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">{{ $why_data['root-cause'] }}</td>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table> -->



                            <div class="why-why-chart-container">
                                <div class="block-head">
                                    <strong>Why-Why Chart</strong>
                                </div>

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="problem-statement">
                                            <th>Problem Statement :</th>
                                            <td>
                                                {{ $data->why_problem_statement ?? 'Not Applicable' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div>
                                    @php
                                        $why_data = !empty($data->why_data) ? unserialize($data->why_data) : [];

                                     @endphp

                                    @if (is_array($why_data) && count($why_data) > 0)
                                        @foreach ($why_data as $index => $why)
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th class="why-label">Why {{ $index + 1 }}</th>
                                                        <td>{{ $why['question'] ?? 'Not Applicable' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="answer-label">Answer {{ $index + 1 }}</th>
                                                        <td>{{ $why['answer'] ?? 'Not Applicable' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @else
                                        <p class="text-muted">No Why-Why Data Available</p>
                                    @endif
                                </div>

                                <div id="root-cause-container">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="root-cause">
                                                <th class="w-20">Root Cause :</th>
                                                <td class="w-80">
                                                    {{ $data->why_root_cause ?? 'Not Applicable' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-head" style="margin-bottom: 5px; font-weight:bold;">
                                Category Of Human Error
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Gap Category</th>
                                        <th class="w-60">Issues</th>
                                        <th class="w-60">Actions</th>
                                        <th class="w-60">Remarks</th>
                                    </tr>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Attention</td>
                                            <td>{{ $data->attention_issues }}</td>
                                            <td>{{ $data->attention_actions }}</td>
                                            <td>{{ $data->attention_remarks }}</td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>Understanding</td>
                                            <td>{{ $data->understanding_issues }}</td>
                                            <td>{{ $data->understanding_actions }}</td>
                                            <td>{{ $data->understanding_remarks }}</td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>Procedural</td>
                                            <td>{{ $data->procedural_issues }}</td>
                                            <td>{{ $data->procedural_actions }}</td>
                                            <td>{{ $data->procedural_remarks }}</td>
                                        </tr>

                                        <tr>
                                            <td>4</td>
                                            <td>Behavioral</td>
                                            <td>{{ $data->behavioiral_issues }}</td>
                                            <td>{{ $data->behavioiral_actions }}</td>
                                            <td>{{ $data->behavioiral_remarks }}</td>
                                        </tr>

                                        <tr>
                                            <td>5</td>
                                            <td>Skill</td>
                                            <td>{{ $data->skill_issues }}</td>
                                            <td>{{ $data->skill_actions }}</td>
                                            <td>{{ $data->skill_remarks }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="border-table" style="margin-bottom: 15px;">
                                <div class="block-head" style="margin-bottom: 5px; font-weight:bold;">
                                    Is/Is Not Analysis
                                </div>
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">&nbsp;</th>
                                        <th class="w-60">Will Be</th>
                                        <th class="w-60">Will Not Be</th>
                                        <th class="w-60">Rationale</th>
                                    </tr>

                                    <tbody>
                                        <tr>
                                            <td>What</td>
                                            <td>{{ $data->what_will_be }}</td>
                                            <td>{{ $data->what_will_not_be }}</td>
                                            <td>{{ $data->what_rationable }}</td>
                                        </tr>

                                        <tr>
                                            <td>Where</td>
                                            <td>{{ $data->where_will_be }}</td>
                                            <td>{{ $data->where_will_not_be }}</td>
                                            <td>{{ $data->where_rationable }}</td>
                                        </tr>

                                        <tr>
                                            <td>When</td>
                                            <td>{{ $data->when_will_be }}</td>
                                            <td>{{ $data->when_will_not_be }}</td>
                                            <td>{{ $data->when_rationable }}</td>
                                        </tr>

                                        <tr>
                                            <td>Why</td>
                                            <td>{{ $data->coverage_will_be }}</td>
                                            <td>{{ $data->coverage_will_not_be }}</td>
                                            <td>{{ $data->coverage_rationable }}</td>
                                        </tr>

                                        <tr>
                                            <td>Who</td>
                                            <td>{{ $data->who_will_be }}</td>
                                            <td>{{ $data->who_will_not_be }}</td>
                                            <td>{{ $data->who_rationable }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="block-head">Root Cause</div>
                            {{-- <div class="inner-block">
                                <label class="Summer"
                                    style="font-weight: bold; font-size: 13px; display: inline; width:5%">
                                    Investigation Summary </label>
                                <span style="font-size: 0.8rem; margin-left: 60px;">
                                    @if ($data->Detail_Of_Root_Cause)
                                        {{ $data->Detail_Of_Root_Cause }}
                                    @else
                                        Not Applicable
                                    @endif
                                </span>
                            </div> --}}

                            <table>
                                <tr>
                                    <th class="w-20">Investigation Summary</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Detail_Of_Root_Cause)
                                                {{ $data->Detail_Of_Root_Cause }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        <div class="border-table">
                            <div class="block-head">
                                Investigation Attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->Investigation_attachment)
                                    @foreach (json_decode($data->Investigation_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                        {{-- <div class="border-table">
                            <div class="block-head">
                                CAPA Attachment
                          </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->Capa_attachment)
                                    @foreach (json_decode($data->Capa_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div> --}}

                    </div>
                    @if ($data->qrm_required=='Yes')
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        QRM
                                    </div>


                                    {{-- <table>
                                        <tr>
                                            <th class="w-20">Proposed Due Date
                                            </th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($qrmExtension && $qrmExtension->qrm_proposed_due_date)
                                                        {{ Helpers::getdateFormat($qrmExtension->qrm_proposed_due_date) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Conclusion</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->Conclusion)
                                                        {{ strip_tags($data->Conclusion) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="w-20">Identified Risk</th>
                                            <td class="w-80">
                                                <div>
                                                    @if ($data->Identified_Risk)
                                                        {{ strip_tags($data->Identified_Risk) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Severity Rate</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->severity_rate)
                                                        {{ $data->severity_rate }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="w-20">Occurrence</th>
                                            <td class="w-80">
                                                <div>
                                                    @if ($data->Occurrence)
                                                        {{ $data->Occurrence }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                            <th class="w-20">Detection</th>
                                            <td class="w-30">
                                                <div>
                                                    @if ($data->detection)
                                                        {{ $data->detection }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="w-20">RPN</th>
                                            <td class="w-80">
                                                <div>
                                                    @if ($data->rpn)
                                                        {{ $data->rpn }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </table> --}}



                                    {{--
                                    <div class="border-table">
                                        <div class="block-head" style=" font-weight:bold; margin-bottom:5px;">
                                            Risk Matrix
                                        </div>
                                        <table>

                                            <tr class="table_bg">
                                                <th class="w-20">Sr.No.</th>
                                                <th class="w-60">Risk Assessment</th>
                                                <th class="w-60">Review Schedule</th>
                                                <th class="w-60">Actual Reviewed On</th>
                                                <th class="w-60">Recorded By Sign and Date</th>
                                                <th class="w-60">Remark</th>
                                            </tr>
                                            <tbody>
                                                @if ($grid_data_matrix_qrms && is_array($grid_data_matrix_qrms->data))
                                                    @php
                                                        $serialNumber = 1;
                                                    @endphp
                                                    @foreach ($grid_data_matrix_qrms->data as $matrix_grid_data)
                                                        <tr>
                                                            <td>{{ $serialNumber }}</td>
                                                            <td>{{ $matrix_grid_data['risk_Assesment'] }}</td>
                                                            <td>{{ $matrix_grid_data['review_schedule'] }}</td>
                                                            <td>{{ $matrix_grid_data['actual_reviewed'] }}</td>
                                                            <td>{{ $matrix_grid_data['recorded_by'] }}</td>
                                                            <td>{{ $matrix_grid_data['remark'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="w-20">1</td>
                                                        <td class="w-20">Not Applicable</td>
                                                        <td class="w-20">Not Applicable</td>
                                                        <td class="w-20">Not Applicable</td>
                                                        <td class="w-20">Not Applicable</td>
                                                        <td class="w-20">Not Applicable</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div> --}}
                                    <div class="block-head">Failure Mode And Effect Analysis</div>
                                    <div class="table-responsive">
                                        <table class="tableFMEA">
                                            <thead>
                                                <tr class="table_bg">
                                                    <th class="thFMEA" rowspan="2">Sr.No.</th>
                                                    <th class="thFMEA" colspan="2">Risk Identification</th>
                                                    <th class="thFMEA" rowspan="1">Risk Analysis</th>
                                                    <th class="thFMEA" colspan="4">Risk Evaluation</th>
                                                    <!-- <th class="thFMEA" rowspan="2">RPN</th> -->
                                                    <th class="thFMEA" colspan="1">Risk Control</th>
                                                    <th class="thFMEA" colspan="6">Risk Evaluation</th>
                                                    <th class="thFMEA" rowspan="2">Traceability Document</th>

                                                </tr>
                                                <tr class="table_bg">
                                                    <th class="thFMEA">Activity</th>
                                                    <th class="thFMEA">Possible Risk/Failure (Identified Risk)</th>
                                                    <th class="thFMEA">Consequences of Risk/Potential Causes</th>
                                                    <th class="thFMEA">Severity (S)</th>
                                                    <th class="thFMEA">Probability (P)</th>
                                                    <th class="thFMEA">Detection (D)</th>
                                                    <th class="thFMEA">Risk Level (RPN)</th>

                                                    <th class="thFMEA">Control Measures recommended/ Risk mitigation proposed</th>
                                                    <th class="thFMEA">Severity (S)</th>
                                                    <th class="thFMEA">Probability (P)</th>
                                                    <th class="thFMEA">Detection (D)</th>
                                                    <th class="thFMEA">Risk Level(RPN)</th>
                                                    <th class="thFMEA">Category of Risk Level (Low, Medium and High)</th>
                                                    <th class="thFMEA">Risk Acceptance (Y/N)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($riskEffectAnalysis->risk_factor))

                                                    @foreach (unserialize($riskEffectAnalysis->risk_factor) as $key => $risk_factor)
                                                        <tr>
                                                            <td class="tdFMEA">{{ $key + 1 }}</td>
                                                            <td class="tdFMEA">{{ $risk_factor }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->problem_cause)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->existing_risk_control)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->initial_rpn)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->risk_control_measure)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->residual_rpn)[$key] ?? null }}</td>

                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->risk_acceptance)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->risk_acceptance2)[$key] ?? null }}</td>
                                                            <td class="tdFMEA">{{ unserialize($riskEffectAnalysis->mitigation_proposal)[$key] ?? null }}</td>
                                                        </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="3">No data available.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <table>
                                            <th class="w-20">Conclusion</th>
                                            <td class="w-80">
                                                <div>
                                                    @if ($data->Conclusion)
                                                        {{ $data->Conclusion }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                    </table>
                                </div>
                            </div>
                    @endif



                    <!-- **************************QRM TAB ENDS******************************** -->


                    <!-- **************************CAAP TAB START******************************* -->

                    @if ($data->capa_required=='yes')
                            <div class="block">
                                <div class="head">
                                    <div class="block-head">
                                        CAPA
                                    </div>
                                    <table>

                                        <tr>
                                            </td>
                                            <th class="w-20">Root Cause</th>
                                            <td class="w-80">
                                                <div>
                                                    @if ($data->capa_root_cause)
                                                        {{ strip_tags($data->capa_root_cause) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>

                                            <th class="w-20">Immediate Action Taken (If Applicable)</th>
                                                    <td class="w-80">
                                                        <div>
                                                            @if ($data->Immediate_Action_Take)
                                                                {{ strip_tags($data->Immediate_Action_Take) }}
                                                            @else
                                                                Not Applicable
                                                            @endif
                                                        </div>
                                                    </td>
                                        </tr>

                                        <tr>
                                            <th class="w-20">Corrective Action Details</th>
                                            <td class="w-80">
                                                <div>
                                                    @if ($data->Corrective_Action_Details)
                                                        {{ strip_tags($data->Corrective_Action_Details) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>

                                        <th class="w-20">Preventive Action Details</th>
                                            <td class="w-80">
                                                <div>
                                                    @if ($data->Preventive_Action_Details)
                                                        {{ strip_tags($data->Preventive_Action_Details) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>









                                    </table>
                                </div>
                            </div>
                            <div class="border-table">
                                <div class="block-head">
                                    CAPA Attachment
                                </div>
                                <table>

                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No.</th>
                                        <th class="w-60">Attachment</th>
                                    </tr>
                                    @if ($data->CAPA_Closure_attachment)
                                        @foreach (json_decode($data->CAPA_Closure_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                        target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-60">Not Applicable</td>
                                        </tr>
                                    @endif

                                </table>
                            </div>
                    @endif






                    <!-- **************************INVESTIGATION TAB ENDS******************************** -->



                    <!-- **************************QRM TAB START******************************* -->



                    <!-- **************************CAPA TAB ENDS******************************** -->


                    {{-- <div class="block">
                        <div class="head">
                            <div class="block-head">
                                Investigation & CAPA
                            </div>
                            <table>

                                <tr>

                                    <th class="w-20">Investigation Summary
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Investigation_Summary)
                                                {{ $data->Investigation_Summary }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Impact Assessment</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Impact_assessment)
                                                {{ $data->Impact_assessment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-20">Root cause</th>
                                    <td class="w-80">
                                        <div>
                                            @if ($data->Root_cause)
                                                {{ $data->Root_cause }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">CAPA Required ?</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->CAPA_Rquired)
                                                {{ $data->CAPA_Rquired }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>


                                <tr>

                                    <th class="w-20">CAPA Description</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->CAPA_Description)
                                                {{ $data->CAPA_Description }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                    <th class="w-20">Post Categorization Of Deviationt</th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Post_Categorization)
                                                {{ $data->Post_Categorization }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <th class="w-20"> Justification For Revised category
                                    </th>
                                    <td class="w-30">
                                        <div>
                                            @if ($data->Investigation_Of_Review)
                                                {{ strip_tags($data->Investigation_Of_Review) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                Investigation Attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->Investigation_attachment)
                                    @foreach (json_decode($data->Investigation_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                CAPA Attachment
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->Capa_attachment)
                                    @foreach (json_decode($data->Capa_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>

                        <div class="block">
                            <div class="block-head">
                                QA Final Review
                            </div>
                            <table>

                                <tr>
                                    <th class="w-20">QA Feedbacks</th>
                                    <td class="w-30">
                                        @if ($data->QA_Feedbacks)
                                            {{ strip_tags($data->QA_Feedbacks) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>

                            </table>
                        </div>
                        <div class="border-table">
                            <div class="block-head">
                                QA Attachments
                            </div>
                            <table>

                                <tr class="table_bg">
                                    <th class="w-20">Sr.No.</th>
                                    <th class="w-60">Attachment</th>
                                </tr>
                                @if ($data->QA_attachments)
                                    @foreach (json_decode($data->QA_attachments) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                    target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div> --}}
                    <div class="block">
                        <div class="block-head">
                            Pending Initiator Update
                        </div>
                        <table>

                            <tr>
                                <th class="w-20">Pending Initiator Update Comments</th>
                                <td class="w-80">
                                    @if ($data->Pending_initiator_update)
                                        {{ strip_tags($data->Pending_initiator_update) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>

                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            Pending Initiator Update Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->pending_attachment)
                                @foreach (json_decode($data->pending_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                    <div class="block">
                        <div class="block-head">
                            HOD Final Review
                        </div>
                        <table>

                            <tr>
                                <th class="w-20">HOD Final Review Comments</th>
                                <td class="w-80">
                                    @if ($data->hod_final_review)
                                        {{ strip_tags($data->hod_final_review) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            HOD Final Review Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->hod_final_attachment)
                                @foreach (json_decode($data->hod_final_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif

                        </table>
                    </div>

                    <br>

                    <div class="block">
                        <div class="block-head">
                            QA/CQA Implementation Verification

                        </div>
                        <table>

                            <tr>
                                <th class="w-20">QA/CQA Implementation Verification</th>
                                <td class="w-80">
                                    @if ($data->QA_Feedbacks)
                                        {{ strip_tags($data->QA_Feedbacks) }}
                                    @else
                                        Not Applicable
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-table">
                        <div class="block-head">
                            QA/CQA Implementation Verification Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->QA_attachments)
                                @foreach (json_decode($data->QA_attachments) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                    <br>
                    <div class="block">
                        <div class="block-head">
                        Head QA/CQA / Designee Closure Approval
                        </div>

                        <table>
                            <tr>
                                <th class="w-20">Post Categorization Of Deviation</th>
                                <td class="w-80">
                                    <div>
                                        @if ($data->Post_Categorization)
                                            {{ Ucfirst($data->Post_Categorization) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="w-20">Justification for Revised Category</th>
                                <td class="w-80">
                                    <div>
                                        @if ($data->Investigation_Of_Review)
                                            {{ $data->Investigation_Of_Review }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="w-20">Head QA/CQA / Designee Closure Approval Comments</th>
                                <td class="w-80">
                                    <div>
                                        @if ($data->Closure_Comments)
                                            {{ $data->Closure_Comments }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="w-20">Disposition Of Batch</th>
                                <td class="w-80">
                                    <div>
                                        @if ($data->Disposition_Batch)
                                            {{ $data->Disposition_Batch }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>

                        {{-- <div class="inner-block">
                            <label class="Summer"
                                style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">

                                Post Categorization Of Deviation </label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->Post_Categorization)
                                    {{ Ucfirst($data->Post_Categorization) }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div>

                        <div class="inner-block">
                            <label class="Summer"
                                style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">

                                Justification for Revised Category </label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->Investigation_Of_Review)
                                    {{ $data->Investigation_Of_Review }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div>
                        <div class="inner-block">
                            <label class="Summer"
                                style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                                Head QA/CQA / Designee Closure Approval Comments </label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->Closure_Comments)
                                    {{ $data->Closure_Comments }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div>
                        <div class="inner-block">
                            <label class="Summer"
                                style="font-weight: bold; font-size: 13px; display: inline-block; width: 75px;">
                                Disposition Of Batch </label>
                            <span style="font-size: 0.8rem; margin-left: 60px;">
                                @if ($data->Disposition_Batch)
                                    {{ $data->Disposition_Batch }}
                                @else
                                    Not Applicable
                                @endif
                            </span>
                        </div> --}}


                    </div>
                    <div class="border-table">
                        <div class="block-head">
                        Head QA/CQA / Designee Closure Approval Attachments
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-20">Sr.No.</th>
                                <th class="w-60">Attachment</th>
                            </tr>
                            @if ($data->closure_attachment)
                                @foreach (json_decode($data->closure_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                </div>
            </div>


            <div class="block">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-30">{{ $data->submit_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">Submit On</th>
                        <td class="w-30">{{ $data->submit_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Submit Comment</th>
                        <td class="w-80">{{ $data->submit_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">HOD Review Complete By</th>
                        <td class="w-30">{{ $data->HOD_Review_Complete_By ?? 'Not Applicable' }}</td>
                        <th class="w-20">HOD Review Complete On</th>
                        <td class="w-30">{{ $data->HOD_Review_Complete_On ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">HOD Review Comment</th>
                        <td class="w-80">{{ $data->HOD_Review_Comments ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Request For Cancellation By</th>
                        <td class="w-30">{{ $data->pending_Cancel_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">Request For Cancellation On</th>
                        <td class="w-30">{{ $data->pending_Cancel_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Request For Cancellation Comment</th>
                        <td class="w-80">{{ $data->pending_Cancel_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Initial Review Complete By</th>
                        <td class="w-30">{{ $data->QA_Initial_Review_Complete_By ?? 'Not Applicable' }}</td>
                        <th class="w-20">QA/CQA Initial Review Complete On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->QA_Initial_Review_Complete_On) ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Initial Review Comment</th>
                        <td class="w-80">{{ $data->QA_Initial_Review_Comments ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">CFT Review Complete By</th>
                        <td class="w-30">{{ $data->CFT_Review_Complete_By ?? 'Not Applicable' }}</td>
                        <th class="w-20">CFT Review Complete On</th>
                        <td class="w-30">{{ $data->CFT_Review_Complete_On ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">CFT Review Comment</th>
                        <td class="w-80">{{ $data->CFT_Review_Comments ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">CFT Review Not Required By</th>
                        <td class="w-30">{{ $data->cft_review_not_req_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">CFT Review Not Required On</th>
                        <td class="w-30">{{ $data->cft_review_not_req_on ?? 'Not Applicable' }}</td>
                    </tr>


                </table>
                <table>
                    <tr>
                        <th class="w-20">CFT Review Not Required Comment</th>
                        <td class="w-80">{{ $data->cft_review_not_req_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Final Assessment Complete By</th>
                        <td class="w-30">{{ $data->QA_Final_Review_Complete_By ?? 'Not Applicable' }}</td>
                        <th class="w-20">QA/CQA Final Assessment Complete On</th>
                        <td class="w-30">{{ $data->QA_Final_Review_Complete_On ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">QA/CQA Final Assessment Complete Comment</th>
                        <td class="w-80">{{ $data->QA_Final_Review_Comments ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Approved By</th>
                        <td class="w-30">{{ $data->QA_head_approved_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">Approved On</th>
                        <td class="w-30">{{ $data->QA_head_approved_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Approved Comment</th>
                        <td class="w-80">{{ $data->QA_head_approved_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Initiator Update Completed By</th>
                        <td class="w-30">{{ $data->pending_initiator_approved_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">Initiator Update Completed On</th>
                        <td class="w-30">{{ $data->pending_initiator_approved_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Initiator Update Completed Comment</th>
                        <td class="w-80">{{ $data->pending_initiator_approved_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">HOD Final Review Complete By</th>
                        <td class="w-30">{{ $data->Hod_final_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">HOD Final Review Complete On</th>
                        <td class="w-30">{{ $data->Hod_final_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">HOD Final Review Complete Comment</th>
                        <td class="w-80">{{ $data->Hod_final_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Implementation Verification Complete By</th>
                        <td class="w-30">{{ $data->QA_final_approved_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">Implementation Verification Complete On</th>
                        <td class="w-30">{{ $data->QA_final_approved_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Implementation Verification Complete Comment</th>
                        <td class="w-80">{{ $data->QA_final_approved_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Closure Approved By</th>
                        <td class="w-30">{{ $data->Close_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">Closure Approved On</th>
                        <td class="w-30">{{ $data->Close_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Closure Approved Comment</th>
                        <td class="w-80">{{ $data->Close_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">{{ $data->cancelled_by ?? 'Not Applicable' }}</td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-30">{{ $data->cancelled_on ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-80">{{ $data->cancelled_comment ?? 'Not Applicable' }}</td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</body>

<div class="inner-block">
    @if ($extension->isNotEmpty())
        @foreach ($extension as $data)
            <center>
                <h3>Extenstion  Report</h3>
            </center>
    
        <div class="content-table">
            <div class="block">
                <div class="block-head">General Information</div>
                <table>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record_number)
                                {{ Helpers::divisionNameForQMS($data->site_location_code) }}/Ext/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record_number, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($data->site_location_code)
                                {{ Helpers::getDivisionName($data->site_location_code) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
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
                        <th class="w-20">Extension Number</th>
                        <td class="w-30">
                            @if ($data->count)
                                {{ $data->count }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    
                        <th class="w-20">HOD Review</th>
                        <td class="w-30">
                            @if ($data->reviewers)
                                {{ Helpers::getInitiatorName($data->reviewers) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20">Parent Record Number</th>
                        <td class="w-30">
                            @if ($data->related_records)
                                {{ str_replace(',', ', ', $data->related_records) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">QA/CQA Approval</th>
                        <td class="w-30">
                            @if ($data->approvers)
                                {{ Helpers::getInitiatorName($data->approvers) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Current Due Date (Parent)</th>
                        <td class="w-30">
                            @if ($data->current_due_date)
                                {{ Helpers::getdateFormat($data->current_due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Proposed Due Date</th>
                        <td class="w-30">
                            @if ($data->proposed_due_date)
                                {{ Helpers::getdateFormat($data->proposed_due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-20"> Description</th>
                        <td class="w-80">
                            @if ($data->description)
                                {{ $data->description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>    
                        <th class="w-20">Justification / Reason</th>
                        <td class="w-80">
                            @if ($data->justification_reason)
                                {{ $data->justification_reason }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

            </div>
            <div class="block">
                <div class="block-head">Attachment Extension</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80">Attachment</th>
                        </tr>
                        @if ($data->file_attachment_extension)
                            @foreach (json_decode($data->file_attachment_extension) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-80">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="block">
                <div class="block-head">HOD Review</div>

                <table>
                    <tr>
                        <th class="w-20">HOD Remarks</th>
                        <td class="w-80">
                            @if ($data->reviewer_remarks)
                                {{ $data->reviewer_remarks }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

            </div>
            <div class="block">
                <div class="block-head">HOD Attachments</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80">Attachment</th>
                        </tr>
                        @if ($data->file_attachment_reviewer)
                            @foreach (json_decode($data->file_attachment_reviewer) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-80">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        @if ($data->count != 3)  
            <div class="block">
                <div class="block-head">QA/CQA Approval</div>

                <table>
                    <tr>
                        <th class="w-20">QA/CQA Approval Comments </th>
                        <td class="w-80">
                            @if ($data->approver_remarks)
                                {{ $data->approver_remarks }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

            </div>
            <div class="block">
                <div class="block-head">QA/CQA Approval Attachments</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-80">Attachment</th>
                        </tr>
                        @if ($data->file_attachment_approver)
                            @foreach (json_decode($data->file_attachment_approver) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-80">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

        @endif
        @if ($data->count == 3)  
            <div class="block">
                <div class="block-head">CQA Approval</div>

                <table>
                    <tr>
                        <th class="w-20">CQA Approval Comments </th>
                        <td class="w-80">
                            @if ($data->QAapprover_remarks)
                                {{ $data->QAapprover_remarks }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

            </div>
            <div class="block">
                <div class="block-head">CQA Approval Attachments</div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-80">File</th>
                        </tr>
                        @if ($data->QAfile_attachment_approver)
                            @foreach (json_decode($data->QAfile_attachment_approver) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-80"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-80">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        @endif

            <div class="block">
                <div class="block-head">Activity Log</div>
                <table>
                    <tr>
                        <th class="w-20">Submit By</th>
                        <td class="w-30">@if ($data->submit_by) {{ $data->submit_by }} @else Not Applicable @endif</td>
                        <th class="w-20">Submit On</th>
                        <td class="w-30">@if ($data->submit_on) {{ $data->submit_on }} @else Not Applicable @endif</td>
                        <th class="w-20">Submit Comment</th>
                        <td class="w-30">@if ($data->submit_comment) {{ $data->submit_comment }} @else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Cancel By</th>
                        <td class="w-30">@if ($data->reject_by) {{ $data->reject_by }} @else Not Applicable @endif</td>
                        <th class="w-20">Cancel On</th>
                        <td class="w-30">@if ($data->reject_on) {{ $data->reject_on }} @else Not Applicable @endif</td>
                        <th class="w-20">Cancel Comment</th>
                        <td class="w-30">@if ($data->reject_comment) {{ $data->reject_comment }} @else Not Applicable @endif</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-80">{{ $data->more_info_review_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-80">{{ $data->more_info_review_on }}</td>
                        <th class="w-20">More Information Required Comment</th>
                        <td class="w-80">{{ $data->more_info_review_comment }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Review By</th>
                        <td class="w-30">@if ($data->submit_by_review) {{ $data->submit_by_review }} @else Not Applicable @endif</td>
                        <th class="w-20">Review On</th>
                        <td class="w-30">@if ($data->submit_on_review) {{ $data->submit_on_review }} @else Not Applicable @endif</td>
                        <th class="w-20">Review Comment</th>
                        <td class="w-30">@if ($data->submit_comment_review) {{ $data->submit_comment_review }} @else Not Applicable @endif</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">System By</th>
                        <td class="w-80">{{ $data->submit_by_review }}</td>
                        <th class="w-20">System On</th>
                        <td class="w-80">{{ $data->submit_on_review }}</td>
                        <th class="w-20">System Comment</th>
                        <td class="w-80">{{ $data->submit_comment_review }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Reject By</th>
                        <td class="w-30">@if ($data->submit_by_inapproved) {{ $data->submit_by_inapproved }} @else Not Applicable @endif</td>
                        <th class="w-20">Reject On</th>
                        <td class="w-30">@if ($data->submit_on_inapproved) {{ $data->submit_on_inapproved }} @else Not Applicable @endif</td>
                        <th class="w-20">Reject Comment</th>
                        <td class="w-30">@if ($data->submit_commen_inapproved) {{ $data->submit_commen_inapproved }} @else Not Applicable @endif</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">More Information Required By</th>
                        <td class="w-80">{{ $data->more_info_inapproved_by }}</td>
                        <th class="w-20">More Information Required On</th>
                        <td class="w-80">{{ $data->more_info_inapproved_on }}</td>
                        <th class="w-20">More Information Required Comment</th>
                        <td class="w-80">{{ $data->more_info_inapproved_comment }}</td>
                    </tr> --}}
                    <!-- @if($data->count == 3)
                        <tr>
                            <th class="w-20">Send for CQA By</th>
                            <td class="w-80">@if ($data->send_cqa_by) {{ $data->send_cqa_by }} @else Not Applicable @endif</td>
                            <th class="w-20">Send for CQA On</th>
                            <td class="w-80">@if ($data->send_cqa_on) {{ $data->send_cqa_on }} @else Not Applicable @endif</td>
                            <th class="w-20">Send for CQA Comment</th>
                            <td class="w-80">@if ($data->send_cqa_comment) {{ $data->send_cqa_comment }} @else Not Applicable @endif</td>
                        </tr>
                    @endif -->
                    @if($data->count != 3)
                        <tr>
                            <th class="w-20">Approved By</th>
                            <td class="w-30">@if ($data->submit_by_approved) {{ $data->submit_by_approved }} @else Not Applicable @endif</td>
                            <th class="w-20">Approved On</th>
                            <td class="w-30">@if ($data->submit_on_approved) {{ $data->submit_on_approved }} @else Not Applicable @endif</td>
                            <th class="w-20">Approved Comment</th>
                            <td class="w-30">@if ($data->submit_comment_approved) {{ $data->submit_comment_approved }} @else Not Applicable @endif</td>
                        </tr>
                    @endif

                    @if($data->count == 3)
                        <tr>
                            <th class="w-20">CQA Approval Complete By</th>
                            <td class="w-30">@if ($data->cqa_approval_by) {{ $data->cqa_approval_by }} @else Not Applicable @endif</td>
                            <th class="w-20">CQA Approval Complete On</th>
                            <td class="w-30">@if ($data->cqa_approval_on) {{ $data->cqa_approval_on }} @else Not Applicable @endif</td>
                            <th class="w-20">CQA Approval Complete Comment</th>
                            <td class="w-30">@if ($data->cqa_approval_comment) {{ $data->cqa_approval_comment }} @else Not Applicable @endif</td>
                        </tr>
                    @endif

                </table>
            </div>
        </div>
        @endforeach
        @endif

    </div>

    {{-- Capa Child --}}

    @if (count($capa_Data) > 0)
        @foreach ($capa_Data as $data)
        <center>
            <h3>CAPA Child Report</h3>
        </center>
     <div class="inner-block">
        
       

        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">{{ Helpers::divisionNameForQMS($data->division_id) }}/CAPA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }} </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_id){{ Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                    </tr>

                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->intiation_date) }}</td>
                    </tr>

                    <tr>
                    <th class="w-20">Assigned To</th>
                    <td class="w-30">@if($data->assign_to){{ $data->assign_to }} @else Not Applicable @endif</td>
                    <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td>


                    </tr>
                    <!-- <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">{{ Helpers::divisionNameForQMS($data->division_id) }}/{{ Helpers::year($data->created_at) }}/CAPA/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }} </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_id){{ Helpers::getDivisionName($data->division_id) }} @else Not Applicable @endif</td>
                    </tr> -->
                    <tr>
                        <th class="w-20">Initiator Department</th>

                        <td class="w-30">@if($data->initiator_Group){{ $data->initiator_Group }} @else Not Applicable @endif</td>
                        {{-- <td class="w-30">{{ Helpers::getFullDepartmentName($data->initiator_Group) }}</td> --}}

                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-30">{{ $data->initiator_group_code }}</td>

                     </tr>


                    </table>
                    <table>

                     {{-- <h5>
                        Short Description
                     </h5>
                    <div  style="font-size: 14px;">
                        @if($data->short_description){{ $data->short_description }}@else Not Applicable @endif
                    </div> --}}
                     <tr>
                            <th class="w-20">Short Description</th>

                            <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>
                     </tr>

                     <tr>

                        <!-- <th class="w-20">Due Date</th>
                        <td class="w-30"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td> -->
                       <th class="w-20">Initiated Through</th>
                        <td class="w-30">@if($data->initiated_through){{ $data->initiated_through }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-30">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                    </tr>

                    </table>

                    <table>

                        <!-- <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat){{ $data->repeat }}@else Not Applicable @endif</td>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td> -->

                        <tr>

                    <!-- <th class="w-20">Due Date</th>
                    <td class="w-80"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td> -->
                   <th class="w-20">Repeat</th>
                    <td class="w-80">@if($data->repeat ){{ $data->repeat }}@else Not Applicable @endif</td>
                </tr>
                <tr>
                    <th class="w-20">Repeat Nature</th>
                    <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td>
                </tr>


                </table>

                <table>
                    <tr>
                        <th class="w-20">Problem Description</th>
                        <td class="w-80" colspan="5">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>
                        <th class="w-20">CAPA Team</th>
                        <td class="w-80" colspan="5">@if($data->capa_team){{  $capa_teamNamesString }}@else Not Applicable @endif</td>

                    </tr>
                </table>
                <table>

                <table>
                     <tr>
                            <th class="w-20">Reference Records</th>
                            <td class="w-80" colspan="5">
                                @if($data->parent_record_number_edit){{ $data->parent_record_number_edit}}@else Not Applicable @endif
                                {{--@if($data->capa_related_record){{ Helpers::getDivisionName($data->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($data->record) }}@else Not Applicable @endif--}}
                            </td>
                        </tr>
                        <tr>
                            <th class="w-20"> Initial Observation</th>
                            <td class="w-80" colspan="5">
                            @if($data->initial_observation){{ $data->initial_observation}}@else Not Applicable @endif </td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th class="w-20">Interim Containment</th>

                       <td class="w-80">
                            @if($data->interim_containnment)
                                {{ str_replace(' ', '-', ucwords(str_replace('-', ' ', $data->interim_containnment))) }}
                            @else
                                Not Applicable
                            @endif
                        </td>   
                    </tr>
                    <tr>
                        <th class="w-20"> Containment Comments </th>
                        <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif </td>
                    </tr>
                      {{-- <tr>
                            <th class="w-20">Short Description</th>

                            <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td>

                      </tr>  --}}
                      <!-- <table>
                     <tr> -->
                        {{-- <th class="w-20">Short Description</th>
                        <td class="w-80">@if($data->short_description){{ $data->short_description }}@else Not Applicable @endif</td> --}}
                        <!-- <th class="w-20">Severity Level</th>
                        <td class="w-80">{{ $data->severity_level_form }}</td> -->
                        <!-- <th class="w-20">Assigned To</th>
                            <td class="w-80">@if($data->assign_to){{ ($data->assign_to) }} @else Not Applicable @endif</td> -->
                    <!-- </tr>
     -->
                    <!-- <tr>

                        <!-- <th class="w-20">Due Date</th>
                        <td class="w-80"> @if($data->due_date){{ Helpers::getdateFormat($data->due_date) }} @else Not Applicable @endif</td> -->
                       <!-- <th class="w-20">Initiated Through</th>
                        <td class="w-80">@if($data->initiated_through){{ $data->initiated_through }}@else Not Applicable @endif</td>
                        <th class="w-20">Others</th>
                        <td class="w-80">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                    </tr> --> -->
                <!-- </table> -->
                <!-- <table>

                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">@if($data->initiated_through_req){{ $data->initiated_through_req }}@else Not Applicable @endif</td>
                    </tr>
                </table> -->
                <!-- <table>
                <tr>
                        <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat){{ $data->repeat }}@else Not Applicable @endif</td>

                    <tr>
                        <th class="w-20">Repeat Nature</th>
                        <td class="w-80">@if($data->repeat_nature){{ $data->repeat_nature }}@else Not Applicable @endif</td>
                    </tr>
                </table>
                <table> -->
                        <!-- <tr>
                        <th class="w-20">Repeat</th>
                        <td class="w-80">@if($data->repeat){{ $data->repeat }}@else Not Applicable @endif</td>

                    </tr> -->
                </table>
                <!-- <table>
                    <tr>
                        <th class="w-20">Problem Description</th>
                        <td class="w-80">@if($data->problem_description){{ $data->problem_description }}@else Not Applicable @endif</td>

                    </tr>
                </table> -->

                <!-- <table>
                    <tr>
                        <th class="w-20"> Initial Observation</th>
                        <td class="w-80">
                        @if($data->initial_observation){{ $data->initial_observation}}@else Not Applicable @endif </td>
                    </tr>
                </table> -->
                <!-- <table>
                    <tr>
                        <th class="w-20">Interim Containnment</th>
                        <td class="w-80">@if($data->interim_containnment){{ $data->interim_containnment }}@else Not Applicable @endif</td>
                        <th class="w-20"> Containment Comments </th>
                        <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif </td>
                    </tr>
                </table> -->
                <!-- <table>
                    <tr>

                        <th class="w-20"> Containment Comments </th>
                        <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif </td>
                    </tr>
                </table> -->
                {{-- <table>
                    <tr>
                        <th class="w-20">  CAPA QA Comments  </th>
                        <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif </td>
                    </tr>
                </table> --}}
                <!-- <table>
                    <tr>
                        <th class="w-20">  Investigation  </th>
                        <td class="w-80">@if($data->investigation){{ $data->investigation }}@else Not Applicable @endif </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">  Root Cause Analysis  </th>
                        <td class="w-80">@if($data->rcadetails){{ $data->rcadetails }}@else Not Applicable @endif </td>
                    </tr>


                </table>

                <table> -->
                    {{-- <tr>
                        <th class="w-20">Containment Comments</th>
                        <td class="w-80">@if($data->containment_comments){{ $data->containment_comments }}@else Not Applicable @endif</td>

                    </tr> --}}
                    {{-- <tr>
                        <th class="w-20">CAPA QA Comments</th>
                        <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                    </tr> --}}
                <div class="block-head">
                    CAPA Attachments
                    </div>
                      <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th class="w-20">Sr.No</th>
                                <th class="w-60">Attachment </th>
                            </tr>
                                @if($data->capa_attachment)
                                @foreach(json_decode($data->capa_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif

                        </table>
                      </div>
                </table>
            </div>

            <div class="block">
                    <div class="block-head">
                        Other Type Details

                        </div>
                        <table>
                            <tr>
                              <th class="w-20">Investigation Summary</th>
                              <td class="w-80">@if($data->investigation){{ $data->investigation }}@else Not Applicable @endif</td>
                            </tr>
                            <tr>
                               <th class="w-20">Root Cause</th>
                               <td class="w-80">@if($data->rcadetails){{ $data->rcadetails }}@else Not Applicable @endif</td>
                             </tr>
                        </table>
                    </div>

                    <div class="border-table tbl-bottum">
                        <div class="block-head">
                            Product / Material Details
                        </div>
                        <table>

                            <tr class="table_bg">
                                <th class="w-10">Sr.No.</th>
                                <th class="w-20">Product / Material Name</th>
                                <th class="w-20">Product /Material Batch No./Lot No./AR No.</th>
                                <th class="w-20">Product / Material Manufacturing Date</th>
                                <th class="w-20">Product / Material Date of Expiry</th>
                                <th class="w-20">Product Batch Disposition Decision</th>
                                <th class="w-20">Product Remark</th>
                                <th class="w-20">Product Batch Status</th>
                            </tr>
                                {{-- @if($data->root_cause_initial_attachment)
                                @foreach(json_decode($data->root_cause_initial_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                                @else --}}
                                @if(optional($data->Material_Details)->material_name)
                                @foreach (unserialize($data->Material_Details->material_name) as $key => $dataDemo)
                                <tr>
                                    <td class="w-15">{{ $dataDemo ? $key + 1  : "NA" }}</td>
                                    <td class="w-15">{{ unserialize($data->Material_Details->material_name)[$key] ?  unserialize($data->Material_Details->material_name)[$key]: "NA"}}</td>
                                    <td class="w-15">{{unserialize($data->Material_Details->material_batch_no)[$key] ?  unserialize($data->Material_Details->material_batch_no)[$key] : "NA" }}</td>
                                    <td class="w-5">{{unserialize($data->Material_Details->material_mfg_date)[$key] ?  unserialize($data->Material_Details->material_mfg_date)[$key] : "NA" }}</td>
                                    <td class="w-15">{{unserialize($data->Material_Details->material_expiry_date)[$key] ?  unserialize($data->Material_Details->material_expiry_date)[$key] : "NA" }}</td>
                                    <td class="w-15">{{unserialize($data->Material_Details->material_batch_desposition)[$key] ?  unserialize($data->Material_Details->material_batch_desposition)[$key] : "NA" }}</td>
                                    <td class="w-15">{{unserialize($data->Material_Details->material_remark)[$key] ?  unserialize($data->Material_Details->material_remark)[$key] : "NA" }}</td>
                                    <td class="w-15">{{unserialize($data->Material_Details->material_batch_status)[$key] ?  unserialize($data->Material_Details->material_batch_status)[$key] : "NA" }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                </tr>
                                @endif

                        </table>
                    </div>
                    <br>

                    <div class="border-table tbl-bottum">
                        <div class="block-head">
                            Equipment/Instruments Details
                        </div>
                        <div>
                            <table>
                                <tr class="table_bg">
                                    <th class="w-25">Sr.No.</th>
                                    <th class="w-25">Equipment/Instruments Name</th>
                                    <th class="w-25">Equipment/Instrument ID</th>
                                    <th class="w-25">Equipment/Instruments Comments</th>
                                </tr>
                                @if(optional($data->Instruments_Details)->equipment)
                                @foreach (unserialize($data->Instruments_Details->equipment) as $key => $dataDemo)
                                <tr>
                                    <td class="w-15">{{ $dataDemo ? $key +1  : "Not Applicable" }}</td>

                                    <td class="w-15">{{ $dataDemo ? $dataDemo : "Not Applicable"}}</td>
                                    <td class="w-15">{{unserialize($data->Instruments_Details->equipment_instruments)[$key] ?  unserialize($data->Instruments_Details->equipment_instruments)[$key] : "Not Applicable" }}</td>
                                    <td class="w-15">{{unserialize($data->Instruments_Details->equipment_comments)[$key] ?  unserialize($data->Instruments_Details->equipment_comments)[$key] : "Not Applicable" }}</td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>
                                    <td>Not Applicable</td>

                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="block-head">
                        Other Type CAPA Details
                        </div>
                        <table>
                        <tr>
                            <th class="w-20">Details</th>
                            <td class="w-80">@if($data->details_new){{ $data->details_new }}@else Not Applicable @endif</td>

                         </tr>
                        </table>

                    <div class="block">
                        <div class="block-head">
                             CAPA Details
                            </div>
                            <table>
                            <tr>

                                <th class="w-20">CAPA Type</th>
                                <td class="w-80" colspan="3"> @if($data->capa_type){{ $data->capa_type }}@else Not Applicable @endif</td>
                            </tr>

                            
                            @if($data->corrective_action) 
                            <tr>

                                <th class="w-20">Corrective Action</th>
                                <td class="w-80" colspan="3"> @if($data->corrective_action){{ $data->corrective_action }}@else Not Applicable @endif</td>
                            </tr>
                            @endif

                            @if($data->preventive_action) 
                            <tr>

                                <th class="w-20">Preventive Action</th>
                                <td class="w-80" colspan="3"> @if($data->preventive_action){{ $data->preventive_action }}@else Not Applicable @endif</td>
                            </tr>
                            @endif
                            </table>
                             <!-- <tr>

                                <th class="20">Preventive Action</th>
                                <td class="80">@if($data->preventive_action){{ $data->preventive_action }}@else Not Applicable @endif</td>
                             </tr>
                            </table>
                        </div>

                    </tr> -->
                    <div class="block-head">
                           File Attachment
                        </div>
                          <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->capafileattachement)
                                    @foreach(json_decode($data->capafileattachement) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                          </div>
                      </table>
                      </div>
                      <br>
            <div class="block">
                <div class="block-head">
                   HOD Review
                </div>
                <div>
                   <table>
                    <tr>
                        <th class="w-20">HOD Remark</th>
                        <td class="w-80">@if($data->hod_remarks){{ $data->hod_remarks }}@else Not Applicable @endif</td>

                    </tr>
                    </table>

                    <div class="block-head">
                        HOD Attachment
                     </div>
                       <div class="border-table">
                         <table>
                             <tr class="table_bg">
                                 <th class="w-20">Sr.No</th>
                                 <th class="w-60">Attachment </th>
                             </tr>
                                 @if($data->hod_attachment)
                                 @foreach(json_decode($data->hod_attachment) as $key => $file)
                                     <tr>
                                         <td class="w-20">{{ $key + 1 }}</td>
                                         <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                     </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                     <td class="w-20">1</td>
                                     <td class="w-60">Not Applicable</td>
                                 </tr>
                             @endif

                         </table>
                       </div>
                   </table>
                   </div>
                    <br>
                    <div class="block">
                <div class="block-head">
                    QA/CQA Review
                </div>
                <div>
                    <table>
                        <tr>
                            <th class="w-20"> QA/CQA Review Comment </th>
                            <td class="w-80">@if($data->capa_qa_comments){{ $data->capa_qa_comments }}@else Not Applicable @endif</td>
                        </tr>
                    </table>

                    <div class="block-head">
                        QA/CQA Attachment
                     </div>
                       <div class="border-table">
                         <table>
                             <tr class="table_bg">
                                 <th class="w-20">Sr.No</th>
                                 <th class="w-60">Attachment </th>
                             </tr>
                                 @if($data->qa_attachment)
                                 @foreach(json_decode($data->qa_attachment) as $key => $file)
                                     <tr>
                                         <td class="w-20">{{ $key + 1 }}</td>
                                         <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                     </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                     <td class="w-20">1</td>
                                     <td class="w-60">Not Applicable</td>
                                 </tr>
                             @endif

                         </table>
                       </div>
                   </table>
                   </div>
                    <br>
                    <div class="block">
                                <div class="block-head">
                                    QA/CQA Approval
                                </div>
                                <div>
                                   <table>
                                    <tr>
                                        <th class="w-20">QA/CQA Approval Comment</th>
                                        <td class="w-80">@if($data->qah_cq_comments){{ $data->qah_cq_comments }}@else Not Applicable @endif</td>

                                    </tr>
                    </table> <div class="block-head">
                        QA/CQA Approval Attachment
                     </div>
                       <div class="border-table">
                         <table>
                             <tr class="table_bg">
                                 <th class="w-20">Sr.No</th>
                                 <th class="w-60">Attachment </th>
                             </tr>
                                 @if($data->qah_cq_attachment)
                                 @foreach(json_decode($data->qah_cq_attachment) as $key => $file)
                                     <tr>
                                         <td class="w-20">{{ $key + 1 }}</td>
                                         <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                     </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                     <td class="w-20">1</td>
                                     <td class="w-60">Not Applicable</td>
                                 </tr>
                             @endif

                         </table>
                       </div>
                   </table>
                   </div>


                    <br>
                    <div class="block">
                                <div class="block-head">
                                Initiator CAPA update
                                </div>
                                <div>
                                   <table>
                                    <tr>
                                        <th class="w-20">Initiator CAPA Update Comment</th>
                                        <td class="w-80">@if($data->initiator_comment){{ $data->initiator_comment}}@else Not Applicable @endif</td>

                                          </tr>
                    </table>

                    <div class="block-head">
                        Initiator CAPA update Attachment
                     </div>
                       <div class="border-table">
                         <table>
                             <tr class="table_bg">
                                 <th class="w-20">Sr.No</th>
                                 <th class="w-60">Attachment </th>
                             </tr>
                                 @if($data->initiator_capa_attachment)
                                 @foreach(json_decode($data->initiator_capa_attachment) as $key => $file)
                                     <tr>
                                         <td class="w-20">{{ $key + 1 }}</td>
                                         <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                     </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                     <td class="w-20">1</td>
                                     <td class="w-60">Not Applicable</td>
                                 </tr>
                             @endif

                         </table>
                       </div>
                   </table>
                   </div>
                    <br>
                    <div class="block">
                                <div class="block-head">
                                HOD Final Review
                                </div>
                                <div>
                                    <table>
                                        <tr>
                                            <th class="w-20">HOD Final Review Comments</th>
                                            <td class="w-80">@if($data->hod_final_review ){{ $data->hod_final_review }}@else Not Applicable @endif</td>

                                        </tr>
                                    </table>
                    <div class="block-head">
                        HOD Final Attachment
                     </div>
                       <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th class="w-20">Sr.No</th>
                                    <th class="w-60">Attachment </th>
                                </tr>
                                    @if($data->hod_final_attachment)
                                    @foreach(json_decode($data->hod_final_attachment) as $key => $file)
                                        <tr>
                                            <td class="w-20">{{ $key + 1 }}</td>
                                            <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="w-20">1</td>
                                        <td class="w-60">Not Applicable</td>
                                    </tr>
                                @endif

                            </table>
                       </div>
                   </table>
                   </div>
                    <br>

                    <div class="block">
                                <div class="block-head">
                                   QA/CQA Closure Review
                                </div>
                                <div>
                                   <table>
                                    <tr>
                                        <th class="w-20">QA/CQA Closure Review Comment</th>
                                        <td class="w-80">@if($data->qa_cqa_qa_comments){{ $data->qa_cqa_qa_comments }}@else Not Applicable @endif</td>

                                            </tr>
                    </table>
                    <div class="block-head">
                        QA/CQA Closure Review Attachment
                     </div>
                       <div class="border-table">
                         <table>
                             <tr class="table_bg">
                                 <th class="w-20">Sr.No</th>
                                 <th class="w-60">Attachment </th>
                             </tr>
                                 @if($data->qa_closure_attachment)
                                 @foreach(json_decode($data->qa_closure_attachment) as $key => $file)
                                     <tr>
                                         <td class="w-20">{{ $key + 1 }}</td>
                                         <td class="w-60"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                     </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                     <td class="w-20">1</td>
                                     <td class="w-60">Not Applicable</td>
                                 </tr>
                             @endif

                         </table>
                       </div>
                   </table>
                   </div>




                    <div class="block">
                    <div class="block-head">
                       CAPA Closure
                    </div>
                    <table>
                    <tr>

                      <th class="w-20">
                      Effectiveness check required
                        </th>
                       <td class="w-80">
                          @if($data->effectivness_check){{ $data->effectivness_check }}@else Not Applicable @endif
                        </td>
                       </tr>
                     <tr>
                      <th class="w-20">QA/CQA Head Closure Review Comment</th>
                      <td class="w-80">@if($data->qa_review){{ $data->qa_review }}@else Not Applicable @endif</td>
                     </tr>
                    </table>
                    </div>

                </table>
            </div>



                            <div class="block-head">
                                QA/CQA Head Closure Review Attachment
                            </div>
                            <div class="border-table">
                                <table>
                                    <tr class="table_bg">
                                        <th class="w-20">Sr.No</th>
                                        <th class="w-60">Attachment </th>
                                    </tr>
                                        @if($data->closure_attachment)
                                        @foreach(json_decode($data->closure_attachment) as $key => $file)
                                            <tr>
                                                <td class="w-20">{{ $key + 1 }}</td>
                                                <td class="w-80"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="w-20">1</td>
                                            <td class="w-80">Not Applicable</td>
                                        </tr>
                                    @endif

                                </table>
                            </div>
                            {{-- <div class="block-head">
                                Extension Justification
                             </div>

                            <table>
                                <tr>
                                    <th class="w-20">Due Date Extension Justification</th>
                                        <td class="w-80">
                                            {{ $data->due_date_extension }}</td>
                                </tr>
                            </table> --}}

                        <div class="block">
                            <div class="block-head">
                                Activity Log
                            </div>
                            <table>
                                {{-- Propose Plan --}}
                                <tr>
                                    <th class="w-20">Propose Plan By</th>
                                    <td class="w-30">@if($data->plan_proposed_by){{ $data->plan_proposed_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">Propose Plan On</th>
                                    <td class="w-30">@if($data->plan_proposed_on){{ $data->plan_proposed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Propose Plan Comment</th>
                                    <td colspan="3">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                                </tr>

                                {{-- Cancel --}}
                                <tr>
                                    <th>Cancel By</th>
                                    <td>@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                                    <th>Cancel On</th>
                                    <td>@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Cancel Comment</th>
                                    <td colspan="3">@if($data->cancelled_on_comment){{ $data->cancelled_on_comment }}@else Not Applicable @endif</td>
                                </tr>

                                {{-- HOD Review --}}
                                <tr>
                                    <th>HOD Review Complete By</th>
                                    <td>@if($data->hod_review_completed_by){{ $data->hod_review_completed_by }}@else Not Applicable @endif</td>
                                    <th>HOD Review Complete On</th>
                                    <td>@if($data->hod_review_completed_on){{ $data->hod_review_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>HOD Review Complete Comment</th>
                                    <td colspan="3">@if($data->hod_comment){{ $data->hod_comment }}@else Not Applicable @endif</td>
                                </tr>

                                {{-- QA/CQA Review --}}
                                <tr>
                                    <th>QA/CQA Review Complete By</th>
                                    <td>@if($data->qa_review_completed_by){{ $data->qa_review_completed_by }}@else Not Applicable @endif</td>
                                    <th>QA/CQA Review Complete On</th>
                                    <td>@if($data->qa_review_completed_on){{ $data->qa_review_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QA/CQA Review Complete Comment</th>
                                    <td colspan="3">@if($data->qa_comment){{ $data->qa_comment }}@else Not Applicable @endif</td>
                                </tr>

                                {{-- Approved --}}
                                <tr>
                                    <th>Approved By</th>
                                    <td>@if($data->approved_by){{ $data->approved_by }}@else Not Applicable @endif</td>
                                    <th>Approved On</th>
                                    <td>@if($data->approved_on){{ $data->approved_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Approved Comment</th>
                                    <td colspan="3">@if($data->approved_comment){{ $data->approved_comment }}@else Not Applicable @endif</td>
                                </tr>

                                {{-- Completed --}}
                                <tr>
                                    <th>Completed By</th>
                                    <td>@if($data->completed_by){{ $data->completed_by }}@else Not Applicable @endif</td>
                                    <th>Completed On</th>
                                    <td>@if($data->completed_on){{ $data->completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>Complete Comment</th>
                                    <td colspan="3">@if($data->comment){{ $data->comment }}@else Not Applicable @endif</td>
                                </tr>

                                {{-- HOD Final Review --}}
                                <tr>
                                    <th>HOD Final Review Complete By</th>
                                    <td>@if($data->hod_final_review_completed_by){{ $data->hod_final_review_completed_by }}@else Not Applicable @endif</td>
                                    <th>HOD Final Review Complete On</th>
                                    <td>@if($data->hod_final_review_completed_on){{ $data->hod_final_review_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>HOD Final Review Complete Comment</th>
                                    <td colspan="3">@if($data->final_comment){{ $data->final_comment }}@else Not Applicable @endif</td>
                                </tr>

                                {{-- QA/CQA Closure Review --}}
                                <tr>
                                    <th>QA/CQA Closure Review Complete By</th>
                                    <td>@if($data->qa_closure_review_completed_by){{ $data->qa_closure_review_completed_by }}@else Not Applicable @endif</td>
                                    <th>QA/CQA Closure Review Complete On</th>
                                    <td>@if($data->qa_closure_review_completed_on){{ $data->qa_closure_review_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QA/CQA Closure Review Complete Comment</th>
                                    <td colspan="3">@if($data->qa_closure_comment){{ $data->qa_closure_comment }}@else Not Applicable @endif</td>
                                </tr>

                                {{-- QAH/CQA Head Approval --}}
                                <tr>
                                    <th>QAH/CQA Head Approval Complete By</th>
                                    <td>@if($data->qah_approval_completed_by){{ $data->qah_approval_completed_by }}@else Not Applicable @endif</td>
                                    <th>QAH/CQA Head Approval Complete On</th>
                                    <td>@if($data->qah_approval_completed_on){{ $data->qah_approval_completed_on }}@else Not Applicable @endif</td>
                                </tr>
                                <tr>
                                    <th>QAH/CQA Head Approval Complete Comment</th>
                                    <td colspan="3">@if($data->qah_comment){{ $data->qah_comment }}@else Not Applicable @endif</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                    </div>

        </div>
        
    </div>
    @endforeach
        @endif


    {{-- RCA Child Report --}}

        <div class="inner-block">
            @if ($rcaData->isNotEmpty())
            @foreach ($rcaData as $data)
            <center><h3>RCA Child Report</h3></center>
                
           
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            {{ Helpers::divisionNameForQMS($data->division_id) }}/RCA/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($data->division_code)
                                {{ $data->division_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>

                    </tr>

                    <tr>

                        <th class="w-20">Initiator Department</th>
                        <td class="w-30">
                            @if ( Helpers::getUsersDepartmentName(Auth::user()->departmentid))
                                {{  Helpers::getUsersDepartmentName(Auth::user()->departmentid)}}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiator Department Code</th>
                        <td class="w-30">
                            @if ($data->initiator_group_code)
                                {{ $data->initiator_group_code }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table> 
                <table>   
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">
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
                        <th class="w-20"> Name Of Responsible Department Head</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">QA Reviewer</th>
                        <td class="w-30">
                            @if ($data->qa_reviewer)
                                {{ Helpers::getInitiatorName($data->qa_reviewer) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-30">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Initiated Through</th>
                        <td class="w-30">
                            @if ($data->initiated_through)
                                {{ $data->initiated_through }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    </table>
                    <table>
                        <tr>
                            <th class="w-20">Others</th>
                            <td class="w-80">
                                @if ($data->initiated_if_other)
                                    {!! $data->initiated_if_other !!}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                            {{-- <th class="w-20">Type</th>
                            <td class="w-30">
                                @if ($data->Type)
                                    {{ $data->Type }}
                                @else
                                    Not Applicable
                                @endif
                            </td> --}}
                        </tr>
                    </table>
                    <table>    

                        <tr>
                            <th class="w-20">Responsible Department</th>
                            <td class="w-80">
                                @if ($data->department)
                                    {{ $data->department }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                   
                </table>

                <div class="block-head">
                    Investigation Details
                </div>
                <table>
                    <tr>
                        <th class="w-20" >Description</th>
                        <td class="w-80">
                            @if ($data->description)
                                {{ $data->description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                </table>

                <table>
                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-80">
                            @if ($data->comments)
                                {{ $data->comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                
                <div class="border-table">
                    <div class="block-head">
                        Initial Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->root_cause_initial_attachment)
                            @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
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

        <div class="block">
            <div class="block-head">
              HOD Review
            </div>
            <table>
                <tr>
                    <th class="w-20" >HOD Review Comment</th>
                    <td class="w-80">
                        @if ($data->hod_comments)
                            {{ $data->hod_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
            <div class="border-table">
                <div class="block-head">
                    HOD Review Attachments
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->hod_attachments)
                        @foreach (json_decode($data->hod_attachments) as $key => $file)
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

        <div class="block">
            <div class="block-head">
              Initial QA/CQA Review 
            </div>
            <table>
                <tr>
                    <th class="w-20" >Initial QA/CQA Review Comments</th>
                    <td class="w-80">
                        @if ($data->cft_comments_new)
                            {{ $data->cft_comments_new }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>

            </table>
            
            <div class="border-table">
                <div class="block-head">
                    Initial QA/CQA Review Attachment
                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->cft_attchament_new)
                        @foreach (json_decode($data->cft_attchament_new) as $key => $file)
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


        <style>
            .tableFMEA {
                width: 100%;
                border-collapse: collapse;
                font-size: 7px;
                table-layout: fixed; /* Ensures columns are evenly distributed */
            }

            .thFMEA,
            .tdFMEA {
                border: 1px solid black;
                padding: 5px;
                word-wrap: break-word;
                text-align: center;
                vertical-align: middle;
                font-size: 6px; /* Apply the same font size for all cells */
            }

            /* Rotating specific headers */
            .rotate {
                transform: rotate(-90deg);
                white-space: nowrap;
                width: 10px;
                height: 100px;
            }

            /* Ensure the "Traceability Document" column fits */
            .tdFMEA:last-child,
            .thFMEA:last-child {
                width: 80px; /* Allocate more space for "Traceability Document" */
            }

            /* Adjust for smaller screens to fit */
            @media (max-width: 1200px) {
                .tdFMEA:last-child,
                .thFMEA:last-child {
                    font-size: 6px;
                    width: 70px; /* Shrink width further for smaller screens */
                }
            }

        </style>


        <div class="block">
                <div class="block-head">
                    Investigation & Root Cause
                </div>
                <!-- <div class="block-head">
                    Investigation
                </div> -->

                <table>
                    <tr>
                        <th class="w-20">Objective</th>
                        <td class="w-80">
                            @if ($data->objective)
                                {!! strip_tags($data->objective) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


               

                <table>
                    <tr>
                        <th class="w-20">Scope</th>
                        <td class="w-80">
                            @if ($data->scope)
                                {!! strip_tags($data->scope) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Problem Statement</th>
                        <td class="w-80">
                            @if ($data->problem_statement_rca)
                                {!! strip_tags($data->problem_statement_rca) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

               
                <table>
                    <tr>
                        <th class="w-20">Background</th>
                        <td class="w-80">
                            @if ($data->requirement)
                                {!! strip_tags($data->requirement) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

               
                <table>
                    <tr>
                        <th class="w-20">Immediate Action</th>
                        <td class="w-80">
                            @if ($data->immediate_action)
                                {!! strip_tags($data->immediate_action) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                

                

                <table>
                    <tr>
                        <th class="w-20">Investigation Team</th>
                        <td class="w-80">
                            @if ($data->investigation_team)
                                {{($investigation_teamNamesString) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>        
                        <th class="w-20">Root Cause Methodology</th>
                        <td class="w-80">
                            @if ($data->root_cause_methodology)
                                {{ is_array($selectedMethodologies) ? implode(', ', $selectedMethodologies) : $selectedMethodologies }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <br><br>
                <div class="border-table  tbl-bottum">
                    <div class="block-head">
                        Failure Mode and Effect Analysis
                    </div>
                    <table class="tableFMEA">
                        <thead>
                            <tr class="table_bg" style="text-align: center; vertical-align: middle; padding: 20px;">
                                <th class="thFMEA" rowspan="2">Sr.No</th>
                                <th class="thFMEA" colspan="2">Risk Identification</th>
                                <th class="thFMEA">Risk Analysis</th>
                                <th class="thFMEA" colspan="4">Risk Evaluation</th>
                                <th class="thFMEA">Risk Control</th>
                                <th class="thFMEA" colspan="6">Risk Evaluation</th>

                                <th class="thFMEA" rowspan="2">Traceability Document</th>
                                
                            </tr>
                            <tr class="table_bg">
                                <th class="thFMEA">Activity</th>
                                <th class="thFMEA">Possible Risk/Failure (Identified Risk)</th>
                                <th class="thFMEA">Consequences of Risk/Potential Causes</th>
                                <th class="thFMEA">Severity (S)</th>
                                <th class="thFMEA">Probability (P)</th>
                                <th class="thFMEA">Detection (D)</th>
                                <th class="thFMEA">Risk Level(RPN)</th>
                                <th class="thFMEA">	Control Measures recommended/ Risk mitigation proposed</th>
                                <th class="thFMEA">Severity (S)</th>
                                <th class="thFMEA">Probability (P)</th>
                                <th class="thFMEA">Detection (D)</th>
                                <th class="thFMEA">Risk Level(RPN)</th>
                                <th class="thFMEA">Category of Risk Level (Low, Medium and High)</th>
                                <th class="thFMEA">Risk Acceptance (Y/N)</th>
                                <!-- <th class="thFMEA">Others</th>
                                <th class="thFMEA">Attchment</th> -->
                                
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($data->risk_factor))
                            @foreach (unserialize($data->risk_factor) as $key => $riskFactor)
                                <tr class="tr">
                                    <td class="tdFMEA">{{ $key + 1 }}</td>
                                    <td class="tdFMEA">{{ $riskFactor }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_element)[$key] ?? null }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->problem_cause)[$key] ?? null }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_severity)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_detectability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_probability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->initial_rpn)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_control_measure)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_severity)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_probability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_detectability)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->residual_rpn)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_acceptance)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->risk_acceptance2)[$key] }}</td>
                                    <td class="tdFMEA">{{ unserialize($data->mitigation_proposal)[$key] }}</td>
                                    
                                </tr>
                            @endforeach
                            @else
                            @endif

                        </tbody>
                    </table>

                </div>
               
                <div class="block-head">
                    Fishbone or Ishikawa Diagram
                </div>

                @if (!empty($data))
                    @php
                        $measurement = !empty($data->measurement) ? unserialize($data->measurement) : [];
                        $materials = !empty($data->materials) ? unserialize($data->materials) : [];
                        $methods = !empty($data->methods) ? unserialize($data->methods) : [];

                        $environment = !empty($data->environment) ? unserialize($data->environment) : [];
                        $manpower = !empty($data->manpower) ? unserialize($data->manpower) : [];
                        $machine = !empty($data->machine) ? unserialize($data->machine) : [];

                        $problem_statement = $data->problem_statement ?? 'N/A';

                        $maxCount = max(count($measurement), count($materials), count($methods));
                        $maxCount2 = max(count($environment), count($manpower), count($machine));
                    @endphp

                    <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;">
                        <!-- Top Table -->
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr valign="top">
                                <!-- First Table -->
                                <td style="width: 70%;">
                                    <table style="width: 70%; border-collapse: collapse; text-align: left;">
                                        <thead>
                                            <tr style="color: #007bff;">
                                                <th style="padding: 10px; border: 1px solid #ddd;">Measurement</th>
                                                <th style="padding: 10px; border: 1px solid #ddd;">Materials</th>
                                                <th style="padding: 10px; border: 1px solid #ddd;">Methods</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < $maxCount; $i++)
                                                <tr>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $measurement[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $materials[$i] ?? 'N/A' }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $methods[$i] ?? 'N/A' }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </td>        
                            </tr>
                        </table>

                        <table style="width: 100%; border-collapse: collapse;">
                            <tr >
                                <td style="width: 70%;">
                                    <div style="width: 100%; height: 2px; background: blue; margin: 20px 0;"></div>
                                </td>
                                <td style="width: 30%;">
                                    <div style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #ffffff;">
                                        <strong style="color: #007bff;">Problem Statement:</strong>
                                        <div style="margin-top: 10px;">
                                            {{ $data->problem_statement ?? 'N/A' }}
                                        </div>
                                    </div>
                                </td>       
                            </tr>
                        </table>


                        <!-- Second Table -->
                        <table style="width: 70%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="color: #007bff;">
                                    <th style="padding: 10px; border: 1px solid #ddd;">Mother Environment</th>
                                    <th style="padding: 10px; border: 1px solid #ddd;">Man</th>
                                    <th style="padding: 10px; border: 1px solid #ddd;">Machine</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $maxCount2; $i++)
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $environment[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $manpower[$i] ?? 'N/A' }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $machine[$i] ?? 'N/A' }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                    </div>
                @else
                    <p style="text-align: center; color: red;">No Fishbone data available.</p>
                @endif



                    <br><br><br><br>
                

                <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Inference
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-5">Sr.No.</th>
                            <th class="w-30">Type</th>
                            <th class="w-30">Remarks</th>
                        </tr>

                        @if (!empty($data->inference_type))
                            @foreach (unserialize($data->inference_type) as $key => $inference_type)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->inference_type)[$key] ? unserialize($data->inference_type)[$key] : 'Not Applicable' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->inference_remarks)[$key] ? unserialize($data->inference_remarks)[$key] : 'Not Applicable' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div>

                




                <div class="why-why-chart-container">
                    <div class="block-head">
                        <strong>Why-Why Chart</strong>
                    </div>

                    <table class="table table-bordered">
                        <tbody>
                            <tr class="problem-statement">
                                <th>Problem Statement :</th>
                                <td>
                                    {{ $data->why_problem_statement ?? 'Not Applicable' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        @php
                            $why_data = !empty($data->why_data) ? unserialize($data->why_data) : [];
                        @endphp

                        @if (is_array($why_data) && count($why_data) > 0)
                            @foreach ($why_data as $index => $why)
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="why-label">Why {{ $index + 1 }}</th>
                                            <td>{{ $why['question'] ?? 'Not Applicable' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="answer-label">Answer {{ $index + 1 }}</th>
                                            <td>{{ $why['answer'] ?? 'Not Applicable' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            <p class="text-muted">No Why-Why Data Available</p>
                        @endif
                    </div>

                    <div id="root-cause-container">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="root-cause">
                                    <th>Root Cause :</th>
                                    <td>
                                        {{ $data->why_root_cause ?? 'Not Applicable' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="block-head">
                    Is/Is Not Analysis
                </div>
                <table>
                    <tr>
                        <th class="w-20">What Will Be</th>
                        <td class="w-80">
                            @if ($data->what_will_be)
                                {{ $data->what_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Not Be </th>
                        <td class="w-80">
                            @if ($data->what_will_not_be)
                                {{ $data->what_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">What Will Rationale </th>
                        <td class="w-80">
                            @if ($data->what_rationable)
                                {{ $data->what_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Be</th>
                        <td class="w-80">
                            @if ($data->where_will_be)
                                {{ $data->where_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Not Be </th>
                        <td class="w-80">
                            @if ($data->where_will_not_be)
                                {{ $data->where_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Where Will Rationale </th>
                        <td class="w-80">
                            @if ($data->where_rationable)
                                {{ $data->where_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    <tr>
                        <th class="w-20">When Will Be</th>
                        <td class="w-80">
                            @if ($data->when_will_be)
                                {{ $data->when_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Not Be </th>
                        <td class="w-80">
                            @if ($data->when_will_not_be)
                                {{ $data->when_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">When Will Rationale </th>
                        <td class="w-80">
                            @if ($data->when_rationable)
                                {{ $data->when_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Be</th>
                        <td class="w-80">
                            @if ($data->coverage_will_be)
                                {{ $data->coverage_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Not Be </th>
                        <td class="w-80">
                            @if ($data->coverage_will_not_be)
                                {{ $data->coverage_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Why Will Rationale </th>
                        <td class="w-80">
                            @if ($data->coverage_rationable)
                                {{ $data->coverage_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Who Will Be</th>
                        <td class="w-80">
                            @if ($data->who_will_be)
                                {{ $data->who_will_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>

                        <th class="w-20">Who Will Not Be </th>
                        <td class="w-80">
                            @if ($data->who_will_not_be)
                                {{ $data->who_will_not_be }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <th class="w-20">Who Will Rationale </th>
                        <td class="w-80">
                            @if ($data->who_rationable)
                                {{ $data->who_rationable }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                    </tr>
                </table>
            </div>


                <table>
                    <tr>
                        <th class="w-20">Others</th>
                        <td class="w-80">
                            @if ($data->root_cause_Others)
                                {!! strip_tags($data->root_cause_Others) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                <div class="border-table">
                    <div class="block-head">
                        Other Attachment
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">Sr.No.</th>
                            <th class="w-60">Attachment</th>
                        </tr>
                        @if ($data->investigation_attachment)
                            @foreach (json_decode($data->investigation_attachment) as $key => $file)
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

                

                <table>
                    <tr>
                        <th class="w-20">Root Cause</th>
                        <td class="w-80">
                            @if ($data->root_cause)
                                {!! strip_tags($data->root_cause) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Impact / Risk Assessment</th>
                        <td class="w-80">
                            @if ($data->impact_risk_assessment)
                                {!! strip_tags($data->impact_risk_assessment) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>


                
                <table>
                    <tr>
                        <th class="w-20">CAPA</th>
                        <td class="w-80">
                            @if ($data->capa)
                                {!! strip_tags($data->capa) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                

                <table>
                    <tr>
                        <th class="w-20">Investigation Summary</th>
                        <td class="w-80">
                            @if ($data->investigation_summary_rca)
                                {!! strip_tags($data->investigation_summary_rca) !!}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
        
        
        <div class="border-table">
            <div class="block-head">
                Investigation Attachment

            </div>
            <table>

                <tr class="table_bg">
                    <th class="w-20">Sr.No.</th>
                    <th class="w-60">Attachment</th>
                </tr>
                @if ($data->root_cause_initial_attachment_rca)
                    @foreach (json_decode($data->root_cause_initial_attachment_rca) as $key => $file)
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
    </div><br>





                

        <div class="block">
            <div class="block-head">
                HOD Final Review
            </div>

            <table>
                <tr>
                    <th class="w-20"> HOD Final Review Comments</th>
                    <td class="w-80">
                        @if ($data->hod_final_comments)
                            {!! strip_tags($data->hod_final_comments) !!}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            <div class="border-table">
                <div class="block-head">
                    HOD Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->hod_final_attachments)
                        @foreach (json_decode($data->hod_final_attachments) as $key => $file)
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

        <div class="block">
            <div class="block-head">
                QA/CQA Final Review
            </div>
            <table>
                <tr>
                    <th class="w-20">QA/CQA Final Review Comments</th>
                    <td class="w-80">
                        @if ($data->qa_final_comments)
                            {{ strip_tags($data->qa_final_comments) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            
            <div class="border-table">
                <div class="block-head">
                    QA/CQA Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_attachments)
                        @foreach (json_decode($data->qa_final_attachments) as $key => $file)
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


            
        <div class="block">
            <div class="block-head">
                QAH/CQAH/Designee Final Approval
            </div>
            <table>
                <tr>
                    <th class="w-20">QAH/CQAH/Designee Final Approval Comments</th>
                    <td class="w-80">
                        @if ($data->qah_final_comments)
                            {{ strip_tags($data->qah_final_comments) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="border-table">
                <div class="block-head">
                    QAH/CQAH/Designee Final Approval Attachments

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qah_final_attachments)
                        @foreach (json_decode($data->qah_final_attachments) as $key => $file)
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
               
                {{-- <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Root Cause Methodology </label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->root_cause_methodology)
                            {{ $data->root_cause_methodology }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Root Cause Description</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->root_cause_description)
                            {{ $data->root_cause_description }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div>
                <div class="inner-block">
                    <label
                        class="Summer"style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                        Investigation Summary</label>
                    <span style="font-size: 0.8rem; margin-left: 60px;">
                        @if ($data->investigation_summary)
                            {{ $data->investigation_summary }}
                        @else
                            Not Applicable
                        @endif
                    </span>
                </div> --}}
                <!-- <tr>
                            <th class="w-20">Attachments</th>
                            <td class="w-80">
                        @if ($data->attachments)
                        <a href="{{ asset('upload/document/', $data->attachments) }}">{{ $data->attachments }}
                        @else
                        Not Applicable
                        @endif
                        </td>
                        </tr> -->
                                        {{-- <tr>
                            <th class="w-20">Comments</th>
                            <td class="w-80">@if ($data->comments){{ $data->comments }}@else Not Applicable @endif</td>
                        </tr>
                      --}}
                </table>
                {{-- <div class="border-table tbl-bottum ">
                    <div class="block-head">
                        Root Cause
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-10">Sr.No.</th>
                            <th class="w-30">Root Cause Category</th>
                            <th class="w-30">Root Cause Sub-Category</th>
                            <th class="w-30">Probability</th>
                            <th class="w-30">Remarks</th>
                        </tr>
                        {{-- @if ($data->root_cause_initial_attachment)
                                @foreach (json_decode($data->root_cause_initial_attachment) as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                    </tr>
                                @endforeach
                                @else --}}
                        {{-- @if (!empty($data->Root_Cause_Category))
                            @foreach (unserialize($data->Root_Cause_Category) as $key => $Root_Cause_Category)
                                <tr>
                                    <td class="w-10">{{ $key + 1 }}</td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Category)[$key] ? unserialize($data->Root_Cause_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Root_Cause_Sub_Category)[$key] ? unserialize($data->Root_Cause_Sub_Category)[$key] : '' }}
                                    </td>
                                    <td class="w-30">
                                        {{ unserialize($data->Probability)[$key] ? unserialize($data->Probability)[$key] : '' }}
                                    </td>
                                    <td class="w-30">{{ unserialize($data->Remarks)[$key] ?? null }}</td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </table>
                </div> --}} 
                
  
            <div class="block">
                <div class="block-head">
                    Activity log
                </div>
                <table>
    
                                    <tr>
                                        <th class="w-20">Acknowledge By</th>
                                        <td class="w-30">
                                            @if ($data->acknowledge_by)
                                                {{ $data->acknowledge_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Acknowledge On</th>
                                        <td class="w-30">
                                            @if ($data->acknowledge_on)
                                                {{ Helpers::getdateFormat($data->acknowledge_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                
                                        <th class="w-20"> Acknowledge Comment</th>
                                        <td class="w-30">
                                            @if ($data->ack_comments)
                                                {{ $data->ack_comments }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                    {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_ack_by){{ $data->More_Info_ack_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_ack_on){{ $data->More_Info_ack_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_ack_comment){{ $data->More_Info_ack_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
    
                                                                        
                                 <tr>
                                    <th class="w-20">HOD Review Complete By</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_By)
                                            {{ $data->HOD_Review_Complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    <th class="w-20">HOD Review Complete On</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_On)
                                            {{ Helpers::getdateFormat($data->HOD_Review_Complete_On) }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    <th class="w-20">HOD Review Complete Comment</th>
                                    <td class="w-30">
                                        @if ($data->HOD_Review_Complete_Comment)
                                            {{ $data->HOD_Review_Complete_Comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                    </td>
                                    {{-- <th class="w-20">QA Review Complete Comment</th>
                                            <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td> --}}
                                </tr>
                                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if($data->More_Info_hrc_by){{ $data->More_Info_hrc_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if($data->More_Info_hrc_on){{ $data->More_Info_hrc_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if($data->More_Info_hrc_comment){{ $data->More_Info_hrc_comment }}@else Not Applicable @endif</td>
                                </tr> --}}

                                <tr>
                                        <th class="w-20">QA/CQA Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->QQQA_Review_Complete_By)
                                                {{ $data->QQQA_Review_Complete_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QA/CQA Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->QQQA_Review_Complete_On)
                                                {{ Helpers::getdateFormat($data->QQQA_Review_Complete_On) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QA/CQA Review Complete Comment</th>
                                        <td class="w-30">
                                            @if ($data->QAQQ_Review_Complete_comment)
                                                {{ $data->QAQQ_Review_Complete_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                {{-- <tr>
                                    <th class="w-20"> More Info Required By
                                    </th>
                                    <td class="w-30">@if($data->More_Info_qac_by){{ $data->More_Info_qac_by }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        More Info Required On</th>
                                    <td class="w-30">@if($data->More_Info_qac_on){{ $data->More_Info_qac_on }}@else Not Applicable @endif</td>
                                    <th class="w-20">
                                        Comment</th>
                                    <td class="w-30">@if($data->More_Info_qac_comment){{ $data->More_Info_qac_comment }}@else Not Applicable @endif</td>
                                </tr> --}}
    
                           
                                    <tr>
                                        <th class="w-20">Submit By</th>
                                        <td class="w-30">
                                            @if ($data->submitted_by)
                                                {{ $data->submitted_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Submit On</th>
                                        <td class="w-30">
                                            @if ($data->submitted_on)
                                                {{ Helpers::getdateFormat($data->submitted_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">Submit Comment</th>
                                        <td class="w-30">
                                            @if ($data->qa_comments_new)
                                                {{ $data->qa_comments_new }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
    
                                        {{-- <tr>
                                            <th class="w-20"> More Info Required By
                                            </th>
                                            <td class="w-30">@if($data->More_Info_sub_by){{ $data->More_Info_sub_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_sub_on){{ $data->More_Info_sub_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_sub_comment){{ $data->More_Info_sub_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20">HOD Final Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_By)
                                            {{ $data->HOD_Final_Review_Complete_By }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                        <th class="w-20">HOD Final Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_On)
                                            {{ $data->HOD_Final_Review_Complete_On }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                        <th class="w-20">
                                            HOD Final Review Complete Comment</th>
                                        <td class="w-30">
                                            @if ($data->HOD_Final_Review_Complete_Comment)
                                            {{ $data->HOD_Final_Review_Complete_Comment }}
                                        @else
                                            Not Applicable
                                        @endif
                                        </td>
                                    </tr>
                                    
                                    {{-- <tr>
                                            <th class="w-20">More Info Required By
                                            </th>
                                            <td class="w-30"> @if($data->More_Info_hfr_by){{ $data->More_Info_hfr_by }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                More Info Required On</th>
                                            <td class="w-30">@if($data->More_Info_hfr_on){{ $data->More_Info_hfr_on }}@else Not Applicable @endif</td>
                                            <th class="w-20">
                                                Comment</th>
                                            <td class="w-30">@if($data->More_Info_hfr_comment){{ $data->More_Info_hfr_comment }}@else Not Applicable @endif</td>
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20"> FinalQA/CQA Review Complete By</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_By)
                                                {{ $data->Final_QA_Review_Complete_By }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20"> FinalQA/CQA Review Complete On</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_On)
                                                {{ Helpers::getdateFormat($data->Final_QA_Review_Complete_On) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20"> FinalQA/CQA Review Completed Comment</th>
                                        <td class="w-30">
                                            @if ($data->evalution_Closure_comment)
                                                {{ $data->Final_QA_Review_Complete_Comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                            <th class="w-20">More information Required By</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_by) {{ $data->qA_review_complete_by }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required On</th>
                                            <td class="w-30"> @if ($data->qA_review_complete_on) {{ Helpers::getdateFormat($data->qA_review_complete_on) }} @else Not Applicable @endif</td>
                                            <th class="w-20">More information Required Comment</th>
                                        <td class="w-80"> @if ($data->qA_review_complete_comment) {{ $data->qA_review_complete_comment }} @else Not Applicable @endif</td>
    
                                        </tr> --}}
                                    <tr>
                                        <th class="w-20">QAH/CQAH Closure By</th>
                                        <td class="w-30">
                                            @if ($data->evaluation_complete_by)
                                                {{ $data->evaluation_complete_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">QAH/CQAH Closure On</th>
                                        <td class="w-30">
                                            @if ($data->evaluation_complete_on)
                                                {{ Helpers::getdateFormat($data->evaluation_complete_on) }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                        <th class="w-20">
                                            QAH/CQAH Closure Comment</th>
                                        <td class="w-30">
                                            @if ($data->Final_QA_Review_Complete_Comment)
                                                {{ $data->evalution_Closure_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-20">Cancel By
                                        </th>
                                        <td class="w-30">
                                            @if ($data->cancelled_by)
                                                {{ $data->cancelled_by }}
                                            @else
                                                Not Applicable
                                            @endif
                                        <th class="w-20">
                                            Cancel On</th>
                                        <td class="w-30">
                                            @if ($data->cancelled_on)
                                                {{ $data->cancelled_on }}
                                            @else
                                                Not Applicable
                                            @endif
                                        <th class="w-20">
                                            Cancel comment</th>
                                        <td class="w-30">
                                            @if ($data->cancel_comment)
                                                {{ $data->cancel_comment }}
                                            @else
                                                Not Applicable
                                            @endif
                                    </tr>
    
                </table>
            </div>
        </div>

                {{-- <tr>
                    <th class="w-20">Investigation Tool</th>
                    <td class="w-80">
                        @if ($data->investigation_tool)
                            {{ $data->investigation_tool }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr> --}}
                {{-- <tr>
                    <th class="w-20">Root Cause</th>
                    <td class="w-80">
                        @if ($data->root_cause)
                            {{ $data->root_cause }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Impact / Risk Assessment</th>
                    <td class="w-80">
                        @if ($data->impact_risk_assessment)
                            {{ $data->impact_risk_assessment }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">CAPA</th>
                    <td class="w-80">
                        @if ($data->capa)
                            {{ $data->capa }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="w-20">Investigation Summary</th>
                    <td class="w-80">
                        @if ($data->investigation_summary_rca)
                            {{ $data->investigation_summary_rca }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            
        </div>

        <div class="block">
            <div class="block-head">
                QA/CQA Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    QA/CQA Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->qa_final_comments)
                        {{ $data->qa_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    QA/CQA Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Attachment</th>
                    </tr>
                    @if ($data->qa_final_attachments)
                        @foreach (json_decode($data->qa_final_attachments) as $key => $file)
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
        <div class="block">
            <div class="block-head">
                QAH/CQAH Final Review
            </div>
            <div class="inner-block">
                <label class="Summer" style="font-weight: bold; font-size: 13px; display: inline-block; width: 77px;">
                    QAH/CQAH Final Review Comments</label>
                <span style="font-size: 0.8rem; margin-left: 60px;">
                    @if ($data->qah_final_comments)
                        {{ $data->qah_final_comments }}
                    @else
                        Not Applicable
                    @endif
                </span>
            </div>
            <div class="border-table">
                <div class="block-head">
                    QAH/CQAH Final Review Attachment

                </div>
                <table>

                    <tr class="table_bg">
                        <th class="w-20">Sr.No.</th>
                        <th class="w-60">Batch No</th>
                    </tr>
                    @if ($data->qah_final_attachments)
                        @foreach (json_decode($data->qah_final_attachments) as $key => $file)
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

        </div>--}}
    </div>
     @endforeach
                
            @endif
    </div>

    {{-- action Item Child --}}

    <div class="inner-block">
        @if ($lastAi->isNotEmpty())

        @foreach ($lastAi as $data)

        <center><h3>Action Item Child</h3></center>
            
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                                {{ Helpers::divisionNameForQMS($data->division_id) }}/AI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ($data->division_id)
                                {{ Helpers::getDivisionName($data->division_id) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Parent Record Number</th>
                        <td class="w-30">
                            @if ($data->parent_record_number)
                                {{ $data->parent_record_number }}
                            @elseif($data->parent_record_number_edit)
                                {{ $data->parent_record_number_edit }}
                                @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="w-20">Due Date</th>
                        <td class="w-80">
                            @if ($data->due_date)
                                {{ Helpers::getdateFormat($data->due_date) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="block">
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
                </div>



                <div class="block">
                    <table>
                        <tr>
                            <th class="w-20">Action Item Related Records</th>
                            <td class="w-30">
                                @if ($data->related_records)
                                    {{ str_replace(',', ', ', $data->related_records) }}
                                @else
                                    Not Applicable
                                @endif
                            </td>

                        {{-- <tr>
                            <th class="w-20">HOD Persons</th>
                            <td class="w-80">
                                @if ($data->hod_preson)
                                    {{ $data->hod_preson }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr> --}}

                            <th class="w-20">HOD Persons</th>
                            <td class="w-30">
                                @if ($data->hod_preson)
                                    {{ $data->hod_preson }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>

                    {{-- <div class="other-container ">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-left">
                                        <div class="bold">Description</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="custom-procedure-block" style="margin-left: 12px">
                            <div class="custom-container">
                                <div class="custom-table-wrapper" id="custom-table2">
                                    <div class="custom-procedure-content">
                                        <div class="custom-content-wrapper">
                                            <div class="table-containers">
                                                {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="other-container">
                        <table style="width:100%; border-collapse: collapse;">
                                <tr>
                                    <th class="w-20">
                                        <strong>Description</strong>
                                    </th>
                                    <td class="w-80">
                                        {!! strip_tags($data->description, '<br><table><th><td><tbody><tr><p><img><a><span><h1><h2><h3><h4><h5><h6><div><b><ol><li>') !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Responsible Department</th>
                            <td class="w-80">
                                @if ($data->departments)
                                    {{ $data->departments }}
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="block-head">
                    File Attachment
                </div>
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-20"> Sr.No.</th>
                            <th class="w-60">Attachment </th>
                        </tr>
                        @if ($data->file_attach)
                            @php $files = json_decode($data->file_attach); @endphp
                            @if (count($files) > 0)
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td class="w-20">{{ $key + 1 }}</td>
                                        <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                                target="_blank"><b>{{ $file }}</b></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="w-20">1</td>
                                    <td class="w-60">Not Applicable</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>



            <div class="block-head">
                Acknowledge
            </div>
            <table>
                <tr>
                    <th class="w-20">Acknowledge Comment</th>
                    <td class="w-80">
                        @if ($data->acknowledge_comments)
                            {{ $data->acknowledge_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>


            <div class="block-head">
                Acknowledge Attachment
            </div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20"> Sr.No.</th>
                        <th class="w-60">Attachment </th>
                    </tr>
                    @if ($data->acknowledge_attach)
                        @php $files = json_decode($data->acknowledge_attach); @endphp
                        @if (count($files) > 0)
                            @foreach ($files as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-60">Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>


            <div class="block-head">
                Post Completion
            </div>
            <table>
                <tr>
                    <th class="w-20">Action Taken</th>
                    <td class="w-80">
                        @if ($data->action_taken)
                            {{ $data->action_taken }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th class="w-20">Actual Start Date</th>
                    <td class="w-30">
                        @if ($data->start_date)
                            {{ Helpers::getdateFormat($data->start_date) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                    <th class="w-20">Actual End Date</th>
                    <td class="w-30">
                        @if ($data->end_date)
                            {{ Helpers::getdateFormat($data->end_date) }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>

            <div class="block">
                <table>
                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-80">
                            @if ($data->comments)
                                {{ $data->comments }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="block-head">
                Completion Attachment
            </div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20"> Sr.No.</th>
                        <th class="w-60">Attachment </th>
                    </tr>
                    @if ($data->Support_doc)
                        @php $files = json_decode($data->Support_doc); @endphp
                        @if (count($files) > 0)
                            @foreach ($files as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-60">Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>


            <div class="block-head">
            QA/CQA Verification
            </div>
            <table>
                <tr>
                    <th class="w-20">QA/CQA Verification Comments</th>
                    <td class="w-80">
                        @if ($data->qa_comments)
                            {{ $data->qa_comments }}
                        @else
                            Not Applicable
                        @endif
                    </td>
                </tr>
            </table>


            <div class="block-head">
                    QA/CQA Verification Attachment
            </div>
            <div class="border-table">
                <table>
                    <tr class="table_bg">
                        <th class="w-20"> Sr.No.</th>
                        <th class="w-60">Attachment </th>
                    </tr>
                    @if ($data->final_attach)
                        @php $files = json_decode($data->final_attach); @endphp
                        @if (count($files) > 0)
                            @foreach ($files as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-60"><a href="{{ asset('upload/' . $file) }}"
                                            target="_blank"><b>{{ $file }}</b></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-60">Not Applicable</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-60">Not Applicable</td>
                        </tr>
                    @endif
                </table>
            </div>

            <div class="block" style="margin-top: 15px;">
                <div class="block-head">
                    Activity Log
                </div>
                <table>
                    <tr>
                        <th class="w-10">Submit By</th>
                        <td class="w-20">@if($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Submit On</th>
                        <td class="w-20">@if($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Submit Comment</th>
                        <td class="w-30">@if($data->submitted_comment){{ $data->submitted_comment }}@else Not Applicable @endif</td>
                    </tr>


                    

                    <!-- </table>
                    <div class="block-head">
                        Cancel
                    </div>
                    <table> -->

                    <tr>
                        <th class="w-10">Cancel By</th>
                        <td class="w-20">@if($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Cancel On</th>
                        <td class="w-20">@if($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Cancel Comment</th>
                        <td class="w-30">@if($data->cancelled_comment){{ $data->cancelled_comment }}@else Not Applicable @endif</td>
                    </tr>

                    <!-- </table>
                    <div class="block-head">
                        Acknowledge Complete
                    </div>
                    <table> -->

                    <tr>
                        <th class="w-10">Acknowledge Complete By</th>
                        <td class="w-20">@if($data->acknowledgement_by){{ $data->acknowledgement_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Acknowledge Complete On</th>
                        <td class="w-20">@if($data->acknowledgement_on){{ $data->acknowledgement_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Acknowledge Complete Comment</th>
                        <td class="w-30">@if($data->acknowledgement_comment){{ $data->acknowledgement_comment }}@else Not Applicable @endif</td>
                    </tr>
                    <!-- </table>
                    <div class="block-head">
                        Complete
                    </div>
                    <table> -->
                    <tr>
                        <th class="w-10">Complete By</th>
                        <td class="w-20">@if($data->work_completion_by){{ $data->work_completion_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Complete On</th>
                        <td class="w-20">@if($data->work_completion_on){{ $data->work_completion_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Complete Comment</th>
                        <td class="w-30">@if($data->work_completion_comment){{ $data->work_completion_comment }}@else Not Applicable @endif</td>
                    </tr>
                    <!-- </table>
                    <div class="block-head">
                    Verification Complete
                    </div>
                    <table> -->
                    <tr>
                        <th class="w-10">Verification Complete By</th>
                        <td class="w-20">@if($data->qa_varification_by){{ $data->qa_varification_by }}@else Not Applicable @endif</td>
                        <th class="w-10">Verification Complete On</th>
                        <td class="w-20">@if($data->qa_varification_on){{ $data->qa_varification_on }}@else Not Applicable @endif</td>
                        <th class="w-10">Verification Complete Comment</th>
                        <td class="w-30">@if($data->qa_varification_comment){{ $data->qa_varification_comment }}@else Not Applicable @endif</td>
                    </tr>
                </table>
            </div>
        </div>
         @endforeach
            
        @endif
    </div>
    

</html>
