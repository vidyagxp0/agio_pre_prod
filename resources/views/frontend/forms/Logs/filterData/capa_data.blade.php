@php
    use Carbon\Carbon;
@endphp

@forelse ($capa as $capalog)
<tr>

 <td>{{$loop->index+1}}</td>
 @if($capalog->intiation_date)
    <td>{{ Carbon::createFromFormat('Y-m-d', $capalog->intiation_date)->format('d-M-Y') }}</td> 
    @else
        NA
    @endif
 <td>{{$capalog->division ? $capalog->division->name : 'Null'}}/CP/{{ date('Y') }}/{{ str_pad($capalog->record, 4, '0', STR_PAD_LEFT)}}</td>
 <td>{{$capalog->short_description}}</td>
 <td>{{$capalog->initiator ? $capalog->initiator->name : 'Null'}}</td>
 <td>{{$capalog->initiator_Group}} </td>
 <td>{{$capalog->division ? $capalog->division->name : 'Null'}}</td>
 <td>{{$capalog->capa_type}}</td>
 <td>{{ $capalog->parent_type ? $capalog->parent_type : 'Null' }}</td>
 @if($capalog->due_date)
    <td>{{ Carbon::createFromFormat('Y-m-d', $capalog->due_date)->format('d-M-Y') }}</td> 
    @else
        NA
    @endif
 <td>{{$capalog->status}}</td>


</tr>

@empty
<tr>
    <td colspan="12" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606 ">
            Data Not Found
        </div>
    </td>
</tr>

    
@endforelse