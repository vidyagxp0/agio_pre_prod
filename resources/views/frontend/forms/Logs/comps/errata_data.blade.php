@forelse($erratalog as $logs)
    


                                            
                                        <tr>
                                            
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$logs->intiation_date}}</td>
                                            <td>{{ $logs->division_id ? $logs->division->name : '-'  }}/CC/{{ date('Y') }}/{{ str_pad($logs->record, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{$logs->short_description}}</td>
                                            <td>{{ $logs->initiator_id ? $logs->initiator->name : '-' }}</td>
                                            <td>{{ $logs->division_id ? $logs->division->name : '-'}}</td>
                                            <td>{{$logs->department_code}}</td>
                                            <td>{{$logs->document_type}}</td>
                                            <td>{{$logs->type_of_error}}</td>
                                            <td>{{$logs->Date_and_time_of_correction}}</td>
                                            <td>{{$logs->due_date ? $logs->due_data : 'Not Available'}}</td>
                                            <td>{{$logs->qa_head_approval_completed_on ? $logs->qa_head_approval_completed_on : '-'}}</td>
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