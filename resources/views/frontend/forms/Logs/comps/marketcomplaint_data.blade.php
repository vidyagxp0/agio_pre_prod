
@forelse ($marketcomplaint as $marketlog)
@php

$productDetails= $marketlog->product_details;
@endphp

@foreach ($productDetails['data'] as $data) 

    
    <tr>
        <td>{{ $loop->parent->index + 1 }}</td>
        <td>{{ $marketlog->intiation_date }}</td>
        <td>{{ $marketlog->division ? $marketlog->division->name : '-' }}/MC/{{ date('Y') }}/{{ str_pad($marketlog->record, 4, '0', STR_PAD_LEFT) }}</td>
        <td>{{ $marketlog->description_gi }}</td>
        <td>{{ $marketlog->initiator ? $marketlog->initiator->name : '-' }}</td>
        <td>{{ $marketlog->initiator_group }}</td>
        <td>{{ $marketlog->division ? $marketlog->division->name : '-' }}</td>
        <td>{{ $data['info_product_name']}}</td>
        <td>{{$data['info_mfg_date']}}</td>
        <td>{{$data['info_expiry_date']}} </td>
        <td>{{$data['info_batch_size']}}<td>
        <td>{{ $marketlog->details_of_nature_market_complaint_gi }}</td>
        <td>{{ $marketlog->categorization_of_complaint_gi }}</td>
        <td>{{ $marketlog->complaint_reported_on_gi }}</td>
        <td>{{ $marketlog->due_date_gi }}</td>
        <td>{{ $marketlog->closed_done_on }}</td>
        <td>{{ $marketlog->status }}</td>
    </tr>
    @endforeach
@empty
<tr>
    <td colspan="17" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606">
            Data Not Found
        </div>
    </td>
</tr>
@endforelse
