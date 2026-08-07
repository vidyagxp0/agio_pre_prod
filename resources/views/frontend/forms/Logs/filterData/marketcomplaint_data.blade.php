@php
    use Carbon\Carbon;
@endphp

@forelse ($marketcomplaint as $marketlog)
    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>
            {{ $marketlog->intiation_date
                ? Carbon::createFromFormat('Y-m-d', $marketlog->intiation_date)->format('d-M-Y')
                : 'NA'
            }}
        </td>

        <td>
            {{ $marketlog->division ? $marketlog->division->name : '-' }}/MC/{{ date('Y') }}/{{ str_pad($marketlog->record, 4, '0', STR_PAD_LEFT) }}
        </td>

        <td>{{ Helpers::getInitiatorName($marketlog->initiator_id) ?? '-' }}</td>

        <td>{{ $marketlog->initiator_group }}</td>

        <td>{{ $marketlog->division ? $marketlog->division->name : '-' }}</td>

        <td>{{ $marketlog->categorization_of_complaint_gi }}</td>

        <td>
            {{ $marketlog->due_date_gi
                ? Carbon::parse($marketlog->due_date_gi)->format('d-M-Y')
                : 'NA'
            }}
        </td>

        <td>{{ $marketlog->status }}</td>
    </tr>
@empty
    <tr>
        <td colspan="17" class="text-center">
            <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606">
                Data Not Found
            </div>
        </td>
    </tr>
@endforelse