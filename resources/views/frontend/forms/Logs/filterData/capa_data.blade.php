@php
    use Carbon\Carbon;
@endphp

@forelse ($capa as $capalog)
<tr>
    <td>{{$loop->index+1}}</td>
    <td>{{ $capalog->intiation_date ?? '-' }}</td>
    <td>{{ $capalog->division ? $capalog->division->name : 'Null' }}/CP/{{ date('Y') }}/{{ str_pad($capalog->record, 4, '0', STR_PAD_LEFT) }}</td>
    <td>{{ $capalog->short_description ?? '-' }}</td>
    <td>{{ $capalog->initiator ? $capalog->initiator->name : '-' }}</td>
    <td>{{ $capalog->initiator_Group ?? '-' }}</td>
    <td>{{ $capalog->division ? $capalog->division->name : '-' }}</td>
    <td>{{ $capalog->capa_type ?? '-' }}</td>
    <td>{{ $capalog->parent_type ?? '-' }}</td>
    <td>{{ $capalog->due_date ?? '-' }}</td>
    <td>{{ $capalog->status ?? '-' }}</td>
</tr>
@empty
<tr>
    <td colspan="11" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606 ">
            Data Not Found
        </div>
    </td>
</tr>
@endforelse
