@php
    use Carbon\Carbon;
@endphp

@forelse ($actions as $action)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $action->intiation_date
            ? Carbon::parse($action->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{ Helpers::getDivisionName($action->division_id) ?? '-' }}/AI/{{ date('Y') }}/{{ str_pad($action->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($action->division_id)
                {{ Helpers::getDivisionName($action->division_id) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($action->initiator_id) ?? 'Not Available'}}</td>
    
   

    <td>{{ Helpers::getInitiatorName($action->assign_to) ?? '-' }}</td>

    
     {{-- <td>{{ $actions->division ? $actions->division->name : '-' }}</td> --}}
     <td> {{ $action->due_date
            ? Carbon::parse($action->due_date)->format('d-M-Y')
            : 'NA'
        }}</td>

    <td>{{ $action->short_description ?? '-' }}</td>


    {{-- <td>{{ $action->related_records ?? '-' }}</td> --}}

    <td>{{  Helpers::getInitiatorName($action->hod_preson) ?? '-' }}</td>

    <td>{{ strip_tags($action->description) ?? '-' }}</td>

    <td>
        {{ $action->departments ?? '-' }}
    </td>

    <td>{{ $action->status ?? '-' }}</td>
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
