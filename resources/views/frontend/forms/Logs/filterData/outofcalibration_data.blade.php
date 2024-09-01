@php
    use Carbon\Carbon;
@endphp
@forelse ($oocs as $ooclog)
    @php
        $productDetails = $ooclog->InstrumentDetails;
    @endphp

    @if(isset($productDetails['data']) && is_array($productDetails['data']))
        @foreach (array_unique($productDetails['data'], SORT_REGULAR) as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                @if($ooclog->intiation_date)
    <td>{{ Carbon::createFromFormat('Y-m-d', $ooclog->intiation_date)->format('d-M-Y') }}</td> 
    @else
        NA
    @endif
                <td>{{ $data['instrument_name'] }}</td>
                <td>{{ $data['instrument_id'] }}</td>
                <td>{{ $ooclog->description_ooc }}</td>
                <td>{{ $ooclog->initiator ? $ooclog->initiator->name : '-' }}</td>
                <td>{{ $ooclog->division ? $ooclog->division->name : '-' }}</td>
                <td>{{ $ooclog->Initiator_Group }}</td>
                <td>{{ $ooclog->assignedUser ? $ooclog->assignedUser->name : '-' }}</td>
                <td>{{ $ooclog->ooc_due_date ? \Carbon\Carbon::parse($ooclog->ooc_due_date)->format('d-M-Y') : 'Not Applicable' }}</td>
                <td>{{ $ooclog->approved_ooc_completed ? $ooclog->approved_ooc_completed_on->format('d-M-Y') : 'Not Applicable' }}</td>
                <td>{{ $ooclog->status }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="13" class="text-center">
                <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606;">
                    Data Not Found
                </div>
            </td>
        </tr>
    @endif
@empty
    <tr>
        <td colspan="13" class="text-center">
            <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606;">
                Data Not Found
            </div>
        </td>
    </tr>
@endforelse
