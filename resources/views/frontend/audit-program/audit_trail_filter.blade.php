@forelse ($audit as $audits => $dataDemo)

<tr>
                     
                            <td>{{ $loop->iteration }}</td>


                            <td>
                                <div><strong>Changed From :</strong>{{ $dataDemo->change_from }}</div>
                            </td>

                            <td>
                                <div><strong>Changed To :</strong>{{ $dataDemo->change_to }}</div>
                            </td>
                            <td>
                                <div>
                                    <strong> Data Field Name
                                        :</strong>{{ $dataDemo->activity_type ?: 'Not Applicable' }}</a>
                                </div>
                                <div style="margin-top: 5px;" class="imageContainer">
                                    <!-- Assuming $dataDemo->image_url contains the URL of your image -->
                                    @if ($dataDemo->activity_type == 'Activity Log')
                                        <strong>Change From :</strong>
                                        @if ($dataDemo->change_from)
                                            {{-- Check if the change_from is a date --}}
                                            @if (strtotime($dataDemo->change_from))
                                                {{ \Carbon\Carbon::parse($dataDemo->change_from)->format('d/M/Y') }}
                                            @else
                                                {{ str_replace(',', ', ', $dataDemo->change_from) }}
                                            @endif
                                        @elseif($dataDemo->change_from && trim($dataDemo->change_from) == '')
                                            NULL
                                        @else
                                            Not Applicable
                                        @endif
                                    @else
                                        <strong>Change From :</strong>
                                        @if (!empty(strip_tags($dataDemo->previous)))
                                            {{-- Check if the previous is a date --}}
                                            @if (strtotime($dataDemo->previous))
                                                {{ \Carbon\Carbon::parse($dataDemo->previous)->format('d/M/Y') }}
                                            @else
                                                {!! $dataDemo->previous !!}
                                            @endif
                                        @elseif($dataDemo->previous == null)
                                            Null
                                        @else
                                            Not Applicable
                                        @endif
                                    @endif
                                </div>
                                <br>

                                <div class="imageContainer">
                                    @if ($dataDemo->activity_type == 'Activity Log')
                                        <strong>Change To :</strong>
                                        @if (strtotime($dataDemo->change_to))
                                            {{ \Carbon\Carbon::parse($dataDemo->change_to)->format('d-M-Y') }}
                                        @else
                                            {!! str_replace(',', ', ', $dataDemo->change_to) ?: 'Not Applicable' !!}
                                        @endif
                                    @else
                                        <strong>Change To :</strong>
                                        @if (strtotime($dataDemo->current))
                                            {{ \Carbon\Carbon::parse($dataDemo->current)->format('d-M-Y') }}
                                        @else
                                            {!! !empty(strip_tags($dataDemo->current)) ? $dataDemo->current : 'Not Applicable' !!}
                                        @endif
                                    @endif
                                </div>
                                <div style="margin-top: 5px;">
                                    <strong>Change Type
                                        :</strong>{{ $dataDemo->action_name ? $dataDemo->action_name : 'Not Applicable' }}
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong> Action Name
                                        :</strong>{{ $dataDemo->action ? $dataDemo->action : 'Not Applicable' }}

                                </div>
                            </td>
                            <td>
                                <div><strong> Peformed By
                                        :</strong>{{ $dataDemo->user_name ? $dataDemo->user_name : 'Not Applicable' }}
                                </div>
                                <div style="margin-top: 5px;"> <strong>Performed On
                                        :</strong>{{ $dataDemo->created_at ? \Carbon\Carbon::parse($dataDemo->created_at)->format('d-M-Y H:i:s') : 'Not Applicable' }}
                                </div>
                                <div style="margin-top: 5px;"><strong> Comments
                                        :</strong>{{ $dataDemo->comment ? $dataDemo->comment : 'Not Applicable' }}</div>

                            </td>
                    </tr>

@empty
    <h4 class="text-center font-weight-bold">No Search Result Found</h4>
@endforelse