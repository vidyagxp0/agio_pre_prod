@forelse($changeProposalJustification as $logs)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $logs->intiation_date 
            ? \Carbon\Carbon::parse($logs->intiation_date)->format('d-M-Y') 
            : 'NA' }}
    </td>

    <td>
        {{ $logs->division_code ?? '-' }}/CPJ/{{ date('Y') }}/{{ str_pad($logs->record ?? 0, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>{{ $logs->cpdescription ?? '-' }}</td>

    <td>{{ Helpers::getInitiatorName($logs->initiator_id) ?? 'Not Available' }}</td>

    <td>
        {{ $logs->division_code ?? '-' }}
    </td>

    {{-- <td>{{ $logs->Department ?? '-' }}</td> --}}

    {{-- <td>{{ $logs->type_of_error ?? '-' }}</td> --}}

    {{-- <td>{{ Helpers::getInitiatorName($logs->department_head_to) ?? '-' }}</td> --}}
    <td>{{ $logs->due_date ?? '-' }}</td>


   <td>
    {{ $logs->qa_cqa_Review_Complete_By 
    ? $logs->qa_cqa_Review_Complete_By . ' (' . 
      (\Carbon\Carbon::parse($logs->qa_cqa_Review_Complete_On)->format('d-M-Y')) . ')' 
    : '-' 
}}
    </td>

    <td>{{ $logs->status ?? '-' }}</td>
</tr>

@empty
<tr>
    <td colspan="11" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606">
            Data Not Found
        </div>
    </td>
</tr>
@endforelse