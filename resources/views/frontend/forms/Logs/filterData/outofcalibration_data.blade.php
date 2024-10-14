@php
    use Carbon\Carbon;
    $dataFound = false; // Flag to track if any data is found
    $serialNumber = 1;  // Initialize the serial number outside the loops
@endphp
@forelse ($oocs as $ooclog)
    @php
        $productDetails = $ooclog->InstrumentDetails;
    @endphp

    @if(isset($productDetails['data']) && is_array($productDetails['data']))
        @foreach (array_unique($productDetails['data'], SORT_REGULAR) as $data)
            @php
                $dataFound = true; // Mark that data was found
            @endphp
            <tr>
                <td>{{ $serialNumber++ }}</td> <!-- Increment the serial number globally -->
                @if($ooclog->intiation_date)
                    <td>{{ Carbon::createFromFormat('Y-m-d', $ooclog->intiation_date)->format('d-M-Y') }}</td>
                @else
                    <td>NA</td>
                @endif

                <!-- Check if 'instrument_name' and 'instrument_id' exist before accessing them -->
                <td>{{ isset($data['instrument_name']) ? $data['instrument_name'] : 'N/A' }}</td>
                <td>{{ isset($data['instrument_id']) ? $data['instrument_id'] : 'N/A' }}</td>

                <td>{{ $ooclog->description_ooc }}</td>
                <td>{{ $ooclog->initiator ? $ooclog->initiator->name : '-' }}</td>
                <td>{{ $ooclog->division ? $ooclog->division->name : '-' }}</td>
                <td>{{ $ooclog->Initiator_Group ? $ooclog->Initiator_Group : '-' }}</td>
                <td>{{ $ooclog->assignedUser ? $ooclog->assignedUser->name : '-' }}</td>
                <td>{{ $ooclog->ooc_due_date ? Carbon::parse($ooclog->ooc_due_date)->format('d-M-Y') : 'Not Applicable' }}</td>
                <td>{{ $ooclog->due_date ? Carbon::parse($ooclog->due_date)->format('d-M-Y') : 'Not Applicable' }}</td>
                <td>{{ $ooclog->approved_ooc_completed ? $ooclog->approved_ooc_completed_on->format('d-M-Y') : 'Not Applicable' }}</td>
                <td>{{ $ooclog->status }}</td>
            </tr>
        @endforeach
    @endif
@empty
    <tr>
        <td colspan="13" class="text-center">
            <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606;">
                No OOCs Found
            </div>
        </td>
    </tr>
@endforelse

@if(!$dataFound)
    <tr>
        <td colspan="13" class="text-center">
            <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606;">
                Data Not Found
            </div>
        </td>
    </tr>
@endif
