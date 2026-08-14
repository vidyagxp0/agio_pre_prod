@php
    $mainmenu = 'Activity';
    $submenu = 'Audit Trail';
@endphp

@extends('admin.layout')

@section('container')
<div id="audit-trial">
    <div class="container-fluid">
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
                /* min-width: 100vw; */
                min-height: 100vh;
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

            .w-90 {
                width: 90%;
            }

            .w-100 {
                width: 100%;
            }

            .h-100 {
                height: 100%;
            }

            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
                font-size: 0.9rem;
            }

            table {
                width: 100%;
            }

            th,
            td {
                padding: 10px;
                text-align: left;
            }

            header .head {
                font-weight: bold;
                text-align: center;
                font-size: 1.2rem;
            }

            @page {
                size: A4;
                margin-top: 160px;
                margin-bottom: 60px;
            }

            header {
                /* position: fixed; */
                top: -140px;
                left: 0;
                width: 100%;
                display: block;
            }

            footer {
                position: fixed;
                bottom: -40px;
                left: 0;
                width: 100%;
            }

            .inner-block {
                padding: 10px;
            }

            .inner-block .head {
                font-weight: bold;
                font-size: 1.2rem;
                margin-bottom: 5px;
            }

            .inner-block .division {
                margin-bottom: 10px;
            }

            .first-table {
                border-top: 1px solid black;
                margin-bottom: 20px;
            }

            .first-table table td,
            .first-table table th,
            .first-table table {
                border: 0;
            }

            .second-table td:nth-child(1)>div {
                margin-bottom: 10px;
            }

            .second-table td:nth-child(1)>div:nth-last-child(1) {
                margin-bottom: 0px;
            }

            .table_bg {
                background: #4274da57;
            }

            .heading {
                border: 1px solid black;
                padding: 10px;
                margin-bottom: 10px;
                margin-top: 10px;
                background: #4274da;
            }

            .heading-new {
                font-size: 27px;
                color: #2f2f58;
            }

            .buttons-new {
                display: flex;
                justify-content: end;
                gap: 10px;
            }
        </style>

        <body>

            <header>
                <table>
                    <tr>
                        <div class="logo">
                            <img src="" alt="" class="w-100">
                        </div>
                    </tr>
                </table>



                <table>
                    <div class="heading">

                        <div class="heading-new">
                            Audit Trail
                        </div>

                        {{--<div style="margin-bottom: 5px;  font-weight: bold;"> Name
                             :{{ $document->initiator ? $document->initiator : '' }}</div> 
                            :{{ $users->name ? $users->name : '' }}  --}}
                        </div>
                        {{-- <div style="margin-bottom: 5px; font-weight: bold;">Department :
                            {{ $users->department }}
                        </div>
                        <div class="" style="display:flex; justify-content:flex-end">
                            <button type="button"> <a class="text-white" href="{{ route('employee.show', $employee->id) }}">
                                    Exit </a> </button>
                        </div> --}}
                    </div>
    </div>
    </table>

    </header>

    <div class="inner-block">
        <div class="division">
        </div>
        <div class="second-table">
            
            <table>
                <tr class="table_bg">
                    <th>S.No</th>
                    <th>Data Field</th>
                    <th>Performer</th>
                </tr>

                <tr>
                    @php
                    $previousItem = null;
                    @endphp

                    @foreach ($admin_audit as $audits => $dataDemo)
                    <td>{{$dataDemo ? ($admin_audit->currentPage() - 1) * $admin_audit->perPage() + $audits + 1 : 'Not Applicable' }}
                    </td>

                    <td>
                        <div>
                            <strong>Affected User :</strong>
                            {{ $dataDemo->targetUser?->name ?? 'Not Applicable' }}
                        </div>

                        <div style="margin-top: 5px;">
                            <strong>Employee Code :</strong>
                            {{ $dataDemo->targetUser?->emp_code ?? 'Not Applicable' }}
                        </div>

                        <div style="margin-top: 5px;">
                            <strong>Data Field :</strong>
                            {{ $dataDemo->activity_type ?? 'Not Applicable' }}
                        </div>

                        <div style="margin-top: 5px;">
                            <strong>Change From :</strong>
                            {{ $dataDemo->previous ?? 'Not Applicable' }}
                        </div>

                        <div style="margin-top: 5px;">
                            <strong>Change To :</strong>
                            {{ $dataDemo->current ?? 'Not Applicable' }}
                        </div>

                        <div style="margin-top: 5px;">
                            <strong>Change Type :</strong>
                            {{ $dataDemo->action_name ?? 'Not Applicable' }}
                        </div>
                    </td>
    
                    <td>
                        <div><strong> Peformed By
                                :</strong>{{ 'superadmin' ? 'superadmin' : 'Not Applicable' }}
                        </div>
                        <div style="margin-top: 5px;"> <strong>Performed On
                                :</strong>{{ \Carbon\Carbon::parse($dataDemo->created_at )->format('d-M-Y h:i A') }}
                        </div>

                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- Pagination links -->

    <div>
    {{ $admin_audit->links() }}
    </div>
    <div style="float: inline-end; margin: 10px;">
        <style>
            .pagination>.active>span {
                background-color: #4274da !important;
                border-color: #4274da !important;
                color: #fff !important;
            }

            .pagination>.active>span:hover {
                background-color: #4274da !important;
                border-color: #4274da !important;
            }

            .pagination>li>a,
            .pagination>li>span {
                color: #4274da !important;
            }

            .pagination>li>a:hover {
                background-color: #4274da !important;
                border-color: #4274da !important;
                color: #fff !important;
            }
        </style>
        {{-- {{ $audit->links() }} --}}
    </div>

    </body>

    </html>

</div>
</div>


<script type='text/javascript'>
    $(document).ready(function() {

        $('#auditTable').on('click', '.viewdetails', function() {
            var auditid = $(this).attr('data-id');

            if (auditid > 0) {

                // AJAX request
                var url = "{{ route('audit-details', [':auditid']) }}";
                url = url.replace(':auditid', auditid);

                // Empty modal data
                $('#auditTableinfo').empty();

                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(response) {

                        // Add employee details
                        $('#auditTableinfo').append(response.html);

                        // Display Modal
                        $('#activity-modal').modal('show');
                    }
                });
            }
        });

    });
</script>
@endsection