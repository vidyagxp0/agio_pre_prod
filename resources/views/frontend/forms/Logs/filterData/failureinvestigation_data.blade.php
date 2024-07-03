@forelse ($failure as $failurelog)
                                            
<tr>
    <td>{{$loop->index+1}}</td>
    <td>{{$failurelog->intiation_date}}</td>
    <td>{{$failurelog->short_description}}</td>
    <td>{{$failurelog->division ? $failurelog->division->name : '-'}}/FI/{{date('y')}}/{{$failurelog->record}}</td>
    <td>{{$failurelog->initiator ? $failurelog->initiator->name : '-'}}</td>
    <td>{{$failurelog->Initiator_Group}}</td>
    <td>{{$failurelog->division ? $failurelog->division->name : '-'}}</td>
    <td>{{$failurelog->due_date}}</td>
    <td>{{$failurelog->QA_final_approved_on}}</td>
    <td>{{$failurelog->status}}</td>
   
    
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