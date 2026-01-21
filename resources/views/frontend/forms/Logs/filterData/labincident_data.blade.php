{{-- @php
    use Carbon\Carbon;
@endphp
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
    @if($lablog->intiation_date)
    <td rowspan="{{ $rowSpanCount }}">{{ Carbon::createFromFormat('Y-m-d', $lablog->intiation_date)->format('d-M-Y') }}</td>
    @else
        NA
    @endif
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->division ? $lablog->division->name : '-' }}/LI/{{ date('Y') }}/{{ str_pad($lablog->record, 4, '0', STR_PAD_LEFT) }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{  Helpers::getInitiatorName($lablog->initiator_id) ?? '-' }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{  $lablog->initiator_Group ?? '-' }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->division ? $lablog->division->name : '-' }}</td>
    <td rowspan="{{ $rowSpanCount }}">{{ $lablog->short_desc }}</td>
    <td rowspan="{{ $rowSpanCount}}">{{$lablog->type_incidence_ia;}}</td>
    @php
        $firstLablogPrinted = true;
    @endphp
<td>{{ isset($dataaas['name_of_product']) ? $dataaas['name_of_product'] : '' }}</td>
<td>{{ isset($dataaas['batch_no']) ? $dataaas['batch_no'] : '' }}</td>

<td>
                    @if($lablog->due_date)
                        {{ Carbon::createFromFormat('Y-m-d', $lablog->due_date)->format('d-M-Y') }}
                    @else
                        NA
                    @endif
                </td>
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

@endforelse --}}


@php
    use Carbon\Carbon;
@endphp

@forelse ($labincident as $labincident)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $labincident->intiation_date
            ? Carbon::parse($labincident->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{ Helpers::getDivisionName($labincident->division_id) ?? '-' }}/LI/{{ date('Y') }}/{{ str_pad($labincident->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($labincident->division_id)
                {{ Helpers::getDivisionName($labincident->division_id) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($labincident->initiator_id) ?? 'Not Available'}}</td>
    
    <td>{{ $labincident->short_desc ?? '-' }}</td>


    
   

    <td>{{ $labincident->stage_stage_gi ?? '-' }}</td>


    <td>{{ $labincident->incident_stability_cond_gi ?? '-' }}</td>
     <td>{{ $labincident->incident_interval_others_gi ?? '-' }}</td>
      <td>{{ $labincident->test_gi ?? '-' }}</td>
    
      
    <td>
        {{ $labincident->incident_date_analysis_gi
            ? Carbon::parse($labincident->incident_date_analysis_gi)->format('d-M-Y')
            : 'NA'
        }}
    </td>
    <td>{{ $labincident->incident_specification_no_gi ?? '-' }}</td>
    <td>{{ $labincident->incident_stp_no_gi ?? '-' }}</td>
    <td>{{  Helpers::getInitiatorName($labincident->investigator_qc) ?? '-' }}</td>
    <td>{{ Helpers::getInitiatorName( $labincident->qc_review_to) ?? '-' }}</td>
            
    <td>
        {{ $labincident->due_date
            ? Carbon::parse($labincident->due_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

      <td>{{ $labincident->status ?? '-' }}</td>
</tr>
@empty
<tr>
    <td colspan="17" class="text-center">
        <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606">
            Data Not Found
        </div>
    </td>
</tr>
@endforelse
