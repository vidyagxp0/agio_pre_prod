@php
    use Carbon\Carbon;
@endphp

@forelse ($ccontrol as $control)
        
<tr>

    <td>{{$loop->index+1}}</td>
    @if($control->intiation_date)
    <td>{{ Carbon::createFromFormat('Y-m-d', $control->intiation_date)->format('d-M-Y') }}</td> 
    @else
        NA
    @endif
    <td>{{ $control->division ? $control->division->name : '-' }}/CC/{{ date('Y') }}/{{ str_pad($control->record, 4, '0', STR_PAD_LEFT) }}</td>
    <td>{{ $control->division ? $control->division->name : '-' }}</td>
    <td>{{$control->Initiator_Group}}</td>
    <td>{{ $control->initiator ? $control->initiator->name : '-' }}</td>
    <td>{{$control->short_description}}</td>
    <td>{{$control->proposed_change}}</td>
    <td>{{$control->doc_change}}</td>
    <td></td>
    <td></td>
    <td>{{$control->due_date}}</td>
    <td>{{$control->status}}</td>

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