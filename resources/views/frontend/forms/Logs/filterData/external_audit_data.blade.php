@php
    use Carbon\Carbon;
@endphp

@forelse ($external_audits as $external_audit)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $external_audit->intiation_date
            ? Carbon::parse($external_audit->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{ Helpers::getDivisionName($external_audit->division_id) ?? '-' }}/EA/{{ date('Y') }}/{{ str_pad($external_audit->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($external_audit->division_id)
                {{ Helpers::getDivisionName($external_audit->division_id) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($external_audit->initiator_id) ?? 'Not Available'}}</td>
    
   <td>{{ $external_audit->Initiator_Group ?? 'Not Available'}}</td>
    
    <td> {{ $external_audit->due_date
            ? Carbon::parse($external_audit->due_date)->format('d-M-Y')
            : 'NA'
        }}</td>


    <td>{{ $external_audit->short_description ?? '-' }}</td>


    <td>{{ $external_audit->initiated_through ?? '-' }}</td>
    <td>{{ $external_audit->audit_type ?? '-' }}</td>

    <td>{{  $external_audit->external_agencies ?? '-' }}</td>
    
    <td>{{ $external_audit->initial_comments ?? '-' }}</td>
    

    <td> {{ $external_audit->start_date_gi
            ? Carbon::parse($external_audit->start_date_gi)->format('d-M-Y')
            : 'NA'
        }}</td>
     <td> {{ $external_audit->end_date_gi
            ? Carbon::parse($external_audit->end_date_gi)->format('d-M-Y')
            : 'NA'
        }}</td>
    
   
     <td>{{ $external_audit->status ?? '-' }}</td>
    
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
