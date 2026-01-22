@php
    use Carbon\Carbon;
@endphp

@forelse ($AuditPrograms as $AuditProgram)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $AuditProgram->intiation_date
            ? Carbon::parse($AuditProgram->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{ $AuditProgram->division_code ?? '-' }}/AP/{{ date('Y') }}/{{ str_pad($AuditProgram->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($AuditProgram->division_id)
                {{ Helpers::getDivisionName($AuditProgram->division_id) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($AuditProgram->initiator_id) ?? 'Not Available'}}</td>
    
   

    <td>{{ $AuditProgram->Initiator_Group ?? '-' }}</td>

    
     {{-- <td>{{ $actions->division ? $actions->division->name : '-' }}</td> --}}

    <td>{{ $AuditProgram->short_description ?? '-' }}</td>

    <td>{{ $AuditProgram->assign_to ?? '-' }}</td>

    <td>{{ $AuditProgram->assign_to_department ?? '-' }}</td>

    <td>{{ $AuditProgram->type ?? '-' }}</td>

    <td>{{ $AuditProgram->year ?? '-' }}</td>

    <td>
        {{ $AuditProgram->related_url ?? '-' }}
    </td>

    <td>{{ $AuditProgram->status ?? '-' }}</td>
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
