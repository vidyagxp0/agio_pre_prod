@php
    use Carbon\Carbon;
@endphp

@forelse ($effectiveneses as $effectivenescheck)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $effectivenescheck->intiation_date
            ? Carbon::parse($effectivenescheck->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{ Helpers::getDivisionName($effectivenescheck->division_id) ?? '-' }}/EC/{{ date('Y') }}/{{ str_pad($effectivenescheck->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($effectivenescheck->division_id)
                {{ Helpers::getDivisionName($effectivenescheck->division_id) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($effectivenescheck->initiator_id) ?? 'Not Available'}}</td>
    
   

    <td>{{ Helpers::getInitiatorName($effectivenescheck->assign_to) ?? '-' }}</td>

    
     <td> {{ $effectivenescheck->due_date
            ? Carbon::parse($effectivenescheck->due_date)->format('d-M-Y')
            : 'NA'
        }}</td>

    <td>{{ $effectivenescheck->short_description ?? '-' }}</td>


    <td>{{ $effectivenescheck->Effectiveness_check_Plan ?? '-' }}</td>

    

    <td>{{ $effectivenescheck->status ?? '-' }}</td>
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
