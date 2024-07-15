@php
use Carbon\Carbon;
@endphp
@forelse ($Inc as $incident)
    @foreach ($incident->Grid as $IncGrid)
    @php

        $unserializedData = unserialize($IncGrid->product_name);
        $actionValue = isset($unserializedData[0]) ? $unserializedData[0] : 'Not Available';

        $unserializedData_sec = unserialize($IncGrid->batch_no);
        $BatchNo = isset($unserializedData_sec[0]) ? $unserializedData_sec[0] : 'Not Available';
        @endphp
<tr>
    <td rowspan="">{{$loop->index+1}}</td>
   
    <td rowspan="">{{ $incident->intiation_date }}</td>
   
    <td rowspan="">{{ $incident->division ? $incident->division->name : '-' }}/INC/{{ date('Y') }}/{{ str_pad($incident->record, 4, '0', STR_PAD_LEFT) }}</td>
    <td rowspan="">{{ $incident->initiator ? $incident->initiator->name : '-' }}</td>
    <td rowspan="">{{ $incident->Initiator_Group }}</td>
    <td rowspan="">{{ $incident->division ? $incident->division->name : '-' }}</td>
    <td rowspan="">{{$incident->short_description}}</td>
    <td rowspan="">{{$incident->audit_type}}</td>
    <td rowspan="" >{{$incident->Description_incident}}</td>
    <td rowspan="" >{{$actionValue}}</td>
    <td rowspan="" >{{$BatchNo}}</td>
    <td rowspan="" >{{$incident->due_date}}</td>
    <td rowspan="" >{{$incident->QA_final_approved_on ? $incident->QA_final_approved_on:'Under Process'}}</td>
    <td rowspan="" >{{$incident->status}}</td>


</tr>
</tr>
@endforeach

@empty
<tr>
    <td colspan="12" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793;     --bs-alert-color:#060606 ">
            Data Not Found
        </div>
    </td>
</tr>

@endforelse