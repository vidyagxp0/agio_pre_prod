@forelse ($riskmanagements as $logs)
    {{-- @foreach ($logs->Action as $riskgrid) --}}

    @php

        $unserializedData = unserialize($logs->action);
 
        $actionValue = isset($unserializedData[0]) ? $unserializedData[0] : 'Not Available';
    @endphp

    <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{Helpers::getdateFormat($logs->intiation_date) ?? ''}}</td>
        <td>{{ $logs->division_code }}/RA/{{ date('Y') }}/{{ str_pad($logs->record, 4, '0', STR_PAD_LEFT) }}</td>
        <td>{{$logs->short_description}}</td>
        <td>{{ Helpers::getInitiatorName($logs->initiator_id) ?? 'Not Available' }}</td>
        <td>{{$logs->Initiator_Group}}</td>
        <td>                
            @if ($logs->division_id)
                {{ Helpers::getDivisionName($logs->division_id) }}
            @else
                -
            @endif
        </td>
        <td>{{$logs->source_of_risk ?? ''}}</td>
        {{-- <td>{{$actionValue}}</td> --}}
        <td>{{$logs->type ?? ''}}</td>
       <td>{{$logs->priority_level ?? ''}}</td>
       
        <td>{{$logs->status ?? ''}}</td>
    </tr>

    {{-- @endforeach --}}
@empty
<tr>
    <td colspan="12" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606 ">
            Data Not Found
        </div>
    </td>
</tr>
@endforelse
