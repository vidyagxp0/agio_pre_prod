@forelse ($labincident as $lablog)
    @foreach($lablog->incidentInvestigationReports as $secondIncident)
        @foreach($secondIncident->data as $dataaas)
            <tr>
                <td>{{ $loop->parent->parent->index + 1 }}</td> <!-- Adjusted to get the index from the parent loop -->
                <td>{{ $lablog->intiation_date }}</td>
                <td>{{ $lablog->division ? $lablog->division->name : '-' }}/CC/{{ date('Y') }}/{{ str_pad($lablog->record, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $lablog->initiator ? $lablog->initiator->name : '-' }}</td>
                <td>{{ $lablog->Initiator_Group }}</td>
                <td>{{ $lablog->division ? $lablog->division->name : '-' }}</td>
                <td>{{ $lablog->short_desc }}</td>
                <td>{{ isset($dataaas['name_of_product']) ? $dataaas['name_of_product'] : '' }}</td>
                <td>{{ isset($dataaas['batch_no']) ? $dataaas['batch_no'] : '' }}</td>
                <td>type of incidence</td>
                <td></td>
                <td>{{ $lablog->due_date }}</td>
                <td>{{ $lablog->closure_completed_on }}</td>
                <td>{{ $lablog->status }}</td>
            </tr>
        @endforeach
    @endforeach
@empty
    <tr>
        <td colspan="12" class="text-center">
            <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606 ">
                Data Not Found
            </div>
        </td>
    </tr>
@endforelse
