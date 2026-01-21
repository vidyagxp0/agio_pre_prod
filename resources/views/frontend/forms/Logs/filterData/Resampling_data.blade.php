@php
    use Carbon\Carbon;
@endphp

@forelse ($Resamplings as $Resampling)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $Resampling->intiation_date
            ? Carbon::parse($Resampling->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{  Helpers::getDivisionName($Resampling->division_id) ?? '-' }}/Resampling/{{ date('Y') }}/{{ str_pad($Resampling->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($Resampling->division_id)
                {{ Helpers::getDivisionName($Resampling->division_id) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($Resampling->initiator_id) ?? 'Not Available'}}</td>
    
   

    <td>{{ Helpers::getInitiatorName($Resampling->assign_to) ?? '-' }}</td>

     <td>
        {{ $Resampling->due_date
            ? Carbon::parse($Resampling->due_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>
     {{-- <td>{{ $actions->division ? $actions->division->name : '-' }}</td> --}}

    <td>{{ $Resampling->short_description ?? '-' }}</td>

    <td>{{ $Resampling->related_records ?? '-' }}</td>

    <td>{{ Helpers::getInitiatorName($Resampling->hod_preson) ?? '-' }}</td>

    <td>{{ $Resampling->description ?? '-' }}</td>

   <td>
        {{ $Resampling->departments 
            ? Helpers::getFullDepartmentName($Resampling->departments) 
            : '-' 
        }}
    </td>

    <td>
        {{ $Resampling->if_others ?? '-' }}
    </td>

    <td>{{ $Resampling->status ?? '-' }}</td>
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
