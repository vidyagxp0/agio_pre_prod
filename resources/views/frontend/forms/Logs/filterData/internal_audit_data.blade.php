@php
    use Carbon\Carbon;
@endphp
@forelse($internal_audi as $logs)
<tr>
    
<td>{{$loop->index+1}}</td>
@if($logs->intiation_date)
    <td>{{ Carbon::createFromFormat('Y-m-d', $logs->intiation_date)->format('d-M-Y') }}</td> 
    @else
        NA
    @endif
<td>{{$logs->division? $logs->division->name: '-' }}/IA/{{ Helpers::year($logs->created_at) }}/{{ $logs->record }}</td>
<td>{{$logs->initiator? $logs->initiator->name : '-'}}</td>
<td>{{$logs->short_description}}</td>
<td>{{$logs->Audit_Category ? $logs->Audit_Category: 'NA'}}</td>
<td>{{$logs->audit_type}}</td>
<td>{{$logs->leadAuditor ? $logs->leadAuditor->name : 'NA'}}</td>
<td>{{$logs->initiator_group_code}}</td>
<td>{{$logs->division ? $logs->division->name : '-'}}</td>
@if($logs->due_date)
    <td>{{ Carbon::createFromFormat('Y-m-d', $logs->due_date)->format('d-M-Y') }}</td> 
    @else
        NA
    @endif<td>{{$logs->audit_lead_more_info_reqd_on ? $logs->audit_lead_more_info_reqd_on:'NA'}}</td>
<td>{{$logs->status}}</td>        
<tr>

@empty
<tr>
    <td colspan="12" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793;     --bs-alert-color:#060606 ">
            Data Not Found
        </div>
    </td>
</tr>


    

 
@endforelse
