@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
<div id="audit-trial">
    <div class="container-fluid">
        <div class="audit-trial-container">

            <div class="inner-block">
                <div class="main-head">
                    <div class="default-name">{{ Helpers::getDivisionName($document->division_id) }}/CC/{{ date('Y') }}
                        /<a href="{{ route('CC.show', $document->id) }}">{{ str_pad($document->record, 4, '0', STR_PAD_LEFT) }}</div>

                    <div class="btn-group">
                        <button onclick="window.print();return false;" type="button">Print</button>
                    </div>
                </div>
                <div class="info-list">
                    <div class="list-item">
                        <div class="head">Document Stage</div>
                        <div>:</div>
                        <div>{{ $document->status }}</div>
                    </div>
                    <div class="list-item">
                        <div class="head">Originator</div>
                        <div>:</div>
                        <div>{{ $document->originator }}</div>
                    </div>
                </div>

                <div class="activity-table">
                    <table class="table table-bordered" id='auditTable'>
                        <thead>
                            <tr>
                                <th>Activity Type</th>
                                <th>Performed on</th>
                                <th>Performed by</th>
                                {{-- <th>Performer Role</th> --}}
                                <th>Origin State</th>
                                <th>Resulting State</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audit as $audits)
                                <tr>
                                    <td class="viewdetails"><a
                                            href="{{ url('rcms/audit-detail', $audits->id) }}">{{ $audits->activity_type }}</a>
                                    </td>
                                    <td>{{ $audits->created_at }}</td>
                                    <td>{{ $audits->user_name }}</td>
                                    {{-- <td>{{ $audits->user_role }}</td> --}}
                                    <td>{{ $audits->origin_state }}</td>
                                    <td>{{ $document->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
