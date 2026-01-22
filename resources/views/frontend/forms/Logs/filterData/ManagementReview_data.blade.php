@php
    use Carbon\Carbon;
@endphp

@forelse ($ManagementReviews as $ManagementReview)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $ManagementReview->intiation_date
            ? Carbon::parse($ManagementReview->intiation_date)->format('d-M-Y')
            : 'NA'
        }}
    </td>

    <td>
        {{ Helpers::getDivisionName($ManagementReview->division_id) ?? '-' }}/MR/{{ date('Y') }}/{{ str_pad($ManagementReview->record, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
          
            @if ($ManagementReview->division_id)
                {{ Helpers::getDivisionName($ManagementReview->division_id) }}
            @else
                -
            @endif
    
        
    </td>

    <td>{{ Helpers::getInitiatorName($ManagementReview->initiator_id) ?? 'Not Available'}}</td>
    
    <td>{{ $ManagementReview->initiator_Group ?? '-' }}</td>


    
   

    <td>{{ $ManagementReview->short_description ?? '-' }}</td>


    <td>{{ $ManagementReview->summary_recommendation ?? '-' }}</td>
     <td>{{ $ManagementReview->review_period_monthly ?? '-' }}</td>
      <td>{{ $ManagementReview->start_date ?? '-' }}</td>
      {{-- <td>{{ $ManagementReview->description ?? '-' }}</td> --}}
      <td>{{ $ManagementReview->status ?? '-' }}</td>
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
