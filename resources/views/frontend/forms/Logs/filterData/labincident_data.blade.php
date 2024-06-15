@forelse ($labincident as $lablog)
@php
$incidentReportsCollection = collect($lablog->incidentInvestigationReports);
$firstLablogPrinted = false;
$rowSpanCount = $incidentReportsCollection->sum(function($secondIncident) {
    return collect($secondIncident['data'])->count();
});
@endphp

@foreach($incidentReportsCollection as $secondIncident)
@foreach(collect($secondIncident['data']) as $dataaas)
<tr>
    @if (!$firstLablogPrinted)
    <td rowspan="{{ $rowSpanCount }}">{{ $loop->parent->parent->index + 1 }}</td> <!-- Adjusted to get the index from the parent loop -->
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->intiation_date }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->Initiator_Group}}/CC/{{ date('Y') }}/{{ str_pad($lablog->record, 4, '0', STR_PAD_LEFT) }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->initiator ? $lablog->initiator->name : '-' }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->Initiator_Group }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->division ? $lablog->division->name : '-' }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->short_desc }}</td>
    <td rowspan="{{ $rowSpanCount}}">{{$lablog->type_incidence_ia;}}</td>
    @php
        $firstLablogPrinted = true;
    @endphp
<td>{{ isset($dataaas['name_of_product']) ? $dataaas['name_of_product'] : '' }}</td>
<td>{{ isset($dataaas['batch_no']) ? $dataaas['batch_no'] : '' }}</td>


                <td>{{ $lablog->due_date }}</td>
                <td>{{ $lablog->closure_completed_on }}</td>
                <td>{{ $lablog->status }}</td>
                @endif
            </tr>
            @endforeach
            @endforeach
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