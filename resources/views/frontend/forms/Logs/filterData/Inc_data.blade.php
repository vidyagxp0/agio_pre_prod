@php
use Carbon\Carbon;
@endphp
@forelse ($Inc as $incident)
    {{-- @foreach ($incident->Grid as $IncGrid) --}}
    @php
        $unserializedData = unserialize($incident->product_name);
        $actionValue = isset($unserializedData[0]) ? $unserializedData[0] : 'Not Available';

        $unserializedData_sec = unserialize($incident->batch_no);
        $BatchNo = isset($unserializedData_sec[0]) ? $unserializedData_sec[0] : 'Not Available';
    @endphp
<tr>
       <td>{{$loop->index+1}}</td>
    <td>{{ $incident->intiation_date }}</td>
   
    <td>{{ $incident->division ? $incident->division->name : '-' }}/INC/{{ date('Y') }}/{{ str_pad($incident->record, 4, '0', STR_PAD_LEFT) }}</td>
    <td>{{ Helpers::getInitiatorName($incident->initiator_id) ?? 'Not Available' }}</td>
    <td>{{ $incident->Initiator_Group }}</td>
    <td>{{ $incident->division ? $incident->division->name : '-' }}</td>
    <td>{{ $incident->short_description }}</td>
    <td>{{ $incident->audit_type }}</td>
    <td>{{ $incident->Description_incident }}</td>
    <td>{{ $actionValue }}</td>
    <td>{{ $BatchNo }}</td>
    <td>{{ $incident->due_date }}</td>
    <td>{{ $incident->QA_final_approved_on ? $incident->QA_final_approved_on : 'Under Process' }}</td>
    <td>{{ $incident->status }}</td>
</tr>
{{-- @endforeach --}}

@empty
<tr>
    <td colspan="14" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606;">
            Data Not Found
        </div>
    </td>
</tr>

@endforelse
