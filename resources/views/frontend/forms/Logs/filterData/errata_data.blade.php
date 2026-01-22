

@forelse($erratalog as $logs)
                                         <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{ $logs->intiation_date ? \Carbon\Carbon::parse($logs->intiation_date)->format('d-M-Y') : 'NA' }}</td>
                                            <td>{{ $logs->division_id ? $logs->division->name : '-' }}/CC/{{ date('Y') }}/{{ str_pad($logs->record, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{$logs->short_description ?? ''}}</td>
                                            <td>{{ Helpers::getInitiatorName($logs->initiator_id )?? "" }}</td>
                                            {{-- <td>{{ $logs->division_id ? $logs->division->name : '-'}}</td> --}}
                                             <td>
                                                
                                                    @if ($logs->division_id)
                                                        {{ Helpers::getDivisionName($logs->division_id) }}
                                                    @else
                                                        -
                                                    @endif
                                            
                                                
                                            </td>
                                            <td>{{$logs->department_code ?? ''}}</td>
                                         
                                            <td>{{$logs->type_of_error ?? '-'}}</td>
                                            <td>{{ Helpers::getInitiatorName($logs->department_head_to)  ?? '-' }}</td>
                                             <td>{{ Helpers::getInitiatorName($logs->qa_reviewer)  ?? '-' }}</td>
                                           <td>{{$logs->status}}</td>
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