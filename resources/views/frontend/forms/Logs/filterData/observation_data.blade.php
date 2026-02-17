@php
    use Carbon\Carbon;
@endphp

@forelse ($observations as $observation)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $observation->intiation_date
            ? Carbon::parse($observation->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{  Helpers::getDivisionName($observation->division_code) ?? '-' }}/obs/{{ date('Y') }}/{{ str_pad($observation->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($observation->division_code)
                {{ Helpers::getDivisionName($observation->division_code) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($observation->initiator_id) ?? 'Not Available'}}</td>
    
   

    <td>{{ Helpers::getInitiatorName($observation->assign_to) ?? '-' }}</td>

     <td>
        {{ $observation->due_date
            ? Carbon::parse($observation->due_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>
     {{-- <td>{{ $actions->division ? $actions->division->name : '-' }}</td> --}}

    <td>{{ $observation->short_description ?? '-' }}</td>

    {{-- <td>{{ $observation->related_records ?? '-' }}</td> --}}

    <td>{{ $observation->recomendation_capa_date_due ?? '-' }}</td>

    

   

    <td>{{ $observation->status ?? '-' }}</td>
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
