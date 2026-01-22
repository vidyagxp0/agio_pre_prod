@php
    use Carbon\Carbon;
@endphp

@forelse ($root_cause_analysises as $root_cause_analysis)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $root_cause_analysis->intiation_date
            ? Carbon::parse($root_cause_analysis->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{  Helpers::getDivisionName($root_cause_analysis->division_id) ?? '-' }}/RCA/{{ date('Y') }}/{{ str_pad($root_cause_analysis->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
        @if ($root_cause_analysis->division_id)
            {{ Helpers::getDivisionName($root_cause_analysis->division_id) }}
        @else
            -
        @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($root_cause_analysis->initiator_id) ?? 'Not Available'}}</td>
    
   

    <td>{{ $root_cause_analysis->initiator_Group ?? '-' }}</td>

    
     {{-- <td>{{ $actions->division ? $actions->division->name : '-' }}</td> --}}

    <td>{{ $root_cause_analysis->short_description ?? '-' }}</td>

    <td>{{  Helpers::getInitiatorName($root_cause_analysis->assign_to) ?? '-' }}</td>
      <td>{{  Helpers::getInitiatorName($root_cause_analysis->qa_reviewer) ?? '-' }}</td>
     <td>
        {{ $root_cause_analysis->due_date
            ? Carbon::parse($root_cause_analysis->due_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>{{ $root_cause_analysis->initiated_through ?? '-' }}</td>
    
    <td>{{ $root_cause_analysis->department ?? '-' }}</td>
    

    <td>{{ $root_cause_analysis->description ?? '-' }}</td>

  

    <td>
        {{ $root_cause_analysis->comments ?? '-' }}
    </td>

    <td>{{ $root_cause_analysis->status ?? '-' }}</td>
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
