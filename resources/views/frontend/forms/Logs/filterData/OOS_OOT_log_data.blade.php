@php
    $serialNumber = 1;
@endphp

@forelse ($oots as $ootlog)
    @php
        $productDetails = $ootlog->ProductGridOot;
    @endphp
    @foreach ($productDetails['data'] as $data)
        <tr>
            <td>{{ $serialNumber++ }}</td>
            <td>{{ \Carbon\Carbon::parse($ootlog->intiation_date)->format('j-M-Y') }}</td>
            <td>{{ $ootlog->division ? $ootlog->division->name : 'Na' }}/OOT/{{ date('Y') }}/{{ $ootlog->record_number }}</td>
            <td>{{ $ootlog->short_description }}</td>
            <td>
                @foreach ($oosmicro as $micro)
                    {{ $micro->source_document_type_gi ? $micro->source_document_type_gi : 'Not Available' }}
                @endforeach
            </td>
            <td>{{ $data['item_product_code'] }}</td>
            <td>{{ $data['lot_batch_no'] }}</td>
            <td>{{ \Carbon\Carbon::parse($ootlog->due_date)->format('j-M-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($ootlog->Final_Approval_on)->format('j-M-Y') }}</td>
            <td>{{ $ootlog->status }}</td>
        </tr>
    @endforeach
@empty
    <tr>
        <td colspan="12" class="text-center">
            <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606">
                Data Not Found
            </div>
        </td>
    </tr>
@endforelse
