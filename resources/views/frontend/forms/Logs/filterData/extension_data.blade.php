@php
    use Carbon\Carbon;
@endphp

@forelse ($extension_news as $extension_new)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $extension_new->initiation_date
            ? Carbon::parse($extension_new->initiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{ Helpers::getDivisionName($extension_new->division_id) ?? '-' }}/Ext/{{ date('Y') }}/{{ str_pad($extension_new->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($extension_new->division_id)
                {{ Helpers::getDivisionName($extension_new->division_id) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($extension_new->initiator) ?? 'Not Available'}}</td>
    
   


    <td> {{ $extension_new->current_due_date
            ? Carbon::parse($extension_new->current_due_date)->format('d-M-Y')
            : 'NA'
        }}</td>


    <td>{{ $extension_new->short_description ?? '-' }}</td>


    <td>{{ $extension_new->count ?? '-' }}</td>
    <td>{{  Helpers::getInitiatorName($extension_new->reviewers) ?? '-' }}</td>

    <td>{{  Helpers::getInitiatorName($extension_new->approvers) ?? '-' }}</td>
    
    <td>{{ $extension_new->justification_reason ?? '-' }}</td>
    
    <td>{{ $extension_new->description ?? '-' }}</td>
     <td>{{ $extension_new->status ?? '-' }}</td>
    
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
