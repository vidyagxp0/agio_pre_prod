@forelse ($labincident as $lablog)
<tr>
    <td>{{ $loop->index + 1 }}</td>
    <td>{{ $lablog->intiation_date }}</td>
    <td>{{$lablog->division ? $lablog->division->name : '-'}}/CC/{{ date('Y') }}/{{ str_pad($lablog->record, 4, '0', STR_PAD_LEFT) }}</td>
    <td>{{ $lablog->initiator ? $lablog->initiator->name : '-' }}</td>
    <td>{{ $lablog->Initiator_Group }}</td>
    <td>{{$lablog->division ? $lablog->division->name : '-'}}</td>
    <td>{{ $lablog->short_desc }}</td>
    <td>1</td>
    <td>2</td>
    <td>{{$lablog->Incident_Type}}</td>
    <td>{{$lablog->Incident_name_analyst_no_gi}}</td>
    <td>{{$lablog->due_date}}</td>
    <td>{{$lablog->closure_completed_on}}</td>
    <td>{{$lablog->status}}</td>
</tr>

@empty
<tr>
    <td colspan="12" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793;     --bs-alert-color:#060606 ">
            Data Not Found
        </div>
    </td>
</tr>

@endforelse