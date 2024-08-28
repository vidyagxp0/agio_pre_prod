@forelse ($audit as $audits => $dataDemo)
    <tr>
        <td>
            {{ isset($filter_request) ? $audits + 1 : ($audit->currentPage() - 1) * $audit->perPage() + $audits + 1 }}
        </td>

        <td>
            <div><strong>Changed From :</strong>{{ $dataDemo->change_from ?: 'Not Applicable' }}</div>
        </td>

        <td>
            <div><strong>Changed To :</strong>{{ $dataDemo->change_to ?: 'Not Applicable' }}</div>
        </td>

        <td>
            <div>
                <strong>Data Field Name :</strong><a
                    href="#">{{ $dataDemo->activity_type ?: 'Not Applicable' }}</a>
            </div>
            <div style="margin-top: 5px;">
                @if ($dataDemo->activity_type == 'Activity Log')
                    <strong>Change From :</strong>{{ $dataDemo->change_from ?: 'Not Applicable' }}
                @else
                    <strong>Change From :</strong>{{ $dataDemo->previous ?: 'Not Applicable' }}
                @endif
            </div>
            <br>
            <div>
                @if ($dataDemo->activity_type == 'Activity Log')
                    <strong>Change To :</strong>{{ $dataDemo->change_to ?: 'Not Applicable' }}
                @else
                    <strong>Change To :</strong>{{ $dataDemo->current ?: 'Not Applicable' }}
                @endif
            </div>
            <div style="margin-top: 5px;">
                <strong>Change Type :</strong>{{ $dataDemo->action_name ?: 'Not Applicable' }}
            </div>
        </td>

        <td>
            <div>
                <strong>Action Name :</strong>{{ $dataDemo->action ?: 'Not Applicable' }}
            </div>
        </td>

        <td>
            <div>
                <strong>Performed By :</strong>{{ $dataDemo->user_name ?: 'Not Applicable' }}
            </div>
            <div style="margin-top: 5px;">
                <strong>Performed On :</strong>
                {{ $dataDemo->created_at ? \Carbon\Carbon::parse($dataDemo->created_at)->format('d-M-Y') : 'Not Applicable' }}
            </div>
            <div style="margin-top: 5px;">
                <strong>Comments :</strong>{{ $dataDemo->comment ?: 'Not Applicable' }}
            </div>
        </td>
    </tr>
@empty
    <h4 class="text-center font-weight-bold">No Search Result Found</h4>
@endforelse
