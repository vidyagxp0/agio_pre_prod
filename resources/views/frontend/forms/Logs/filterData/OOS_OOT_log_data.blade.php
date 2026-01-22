@php
    $serialNumber = 1;
    //dd($oots);
@endphp

@forelse ($oots as $ootlog)
    @php
        $productDetails = $ootlog->ProductGridOot;
    @endphp
    {{-- @foreach ($productDetails['data'] as $data) --}}
        <tr>
            <td>{{ $serialNumber++ }}</td>
            <td>{{ \Carbon\Carbon::parse($ootlog->intiation_date)->format('j-M-Y') }}</td>
            <td>{{ Helpers::getDivisionName($ootlog->division_id) }}/{{ $ootlog->Form_type }}/{{ Helpers::year($ootlog->created_at) }}/{{ $ootlog->record_number ? str_pad($ootlog->record_number, 4, '0', STR_PAD_LEFT) : '1' }}</td>
            <td>{{ $ootlog->description_gi }}</td>
            <td>
                {{ $ootlog->source_document_type_gi ? $ootlog->source_document_type_gi : 'Not Available' }}
            </td>
            <td>{{ $ootlog['product_material_name_gi'] }}</td>
            {{-- <td>{{ $ootlog['lot_batch_no'] }}</td> --}}
            <td>{{ \Carbon\Carbon::parse($ootlog->due_date)->format('j-M-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($ootlog->Final_Approval_on)->format('j-M-Y') }}</td>
            <td>{{ $ootlog->status }}</td>
        </tr>
    {{-- @endforeach --}}
@empty
    <tr>
        <td colspan="12" class="text-center">
            <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606">
                Data Not Found
            </div>
        </td>
    </tr>
@endforelse
