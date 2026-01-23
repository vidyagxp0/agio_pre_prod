@php
    use Carbon\Carbon;
@endphp

@forelse ($oocs as $ooclog)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $ooclog->intiation_date
            ? Carbon::parse($ooclog->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{  Helpers::getDivisionName($ooclog->division_id) ?? '-' }}/OOC/{{ date('Y') }}/{{ str_pad($ooclog->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
        @if ($ooclog->division_id)
            {{ Helpers::getDivisionName($ooclog->division_id) }}
        @else
            -
        @endif
    
        
    </td>

    <td>{{ $ooclog->description_ooc ?? 'Not Available'}}</td>
    
     

    <td>{{ $ooclog->initiator ? $ooclog->initiator->name : '-' }}</td>

    <td>{{ $ooclog->Initiator_Group ? $ooclog->Initiator_Group : '-' }}</td>
   <td>{{  Helpers::getInitiatorName($ooclog->assign_to) ?? '' }}</td>
    <td>{{ Helpers::getInitiatorName($ooclog->qa_assign_person) ?? ''  }}</td>
    
    <td>{{ $ooclog->ooc_due_date ? \Carbon\Carbon::parse($ooclog->ooc_due_date)->format('d-M-Y') : 'Not Applicable' }}</td>
    {{-- <td>{{ $ooclog->approved_ooc_completed ? $ooclog->approved_ooc_completed_on->format('d-M-Y') : 'Not Applicable' }}</td> --}}

    <td>{{ $ooclog->status ?? '-' }}</td>
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
