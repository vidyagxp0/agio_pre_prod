@forelse ($oocs as $ooclog)
           @php
                    $productDetails= $ooclog->InstrumentDetails;
               
           @endphp          
                    @foreach ($productDetails['data'] as $data) 

                                        <tr>
                                            
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$ooclog->intiation_date}}</td>
                                            <td>{{$data['instrument_name']}}</td>
                                            <td>{{$data['instrument_id']}}</td>
                                            <td>{{$ooclog->description_ooc}}</td>
                                            <td>{{$ooclog->initiator ? $ooclog->initiator->name: '-'}}</td>
                                            <td>{{$ooclog->division ? $ooclog->division->name:'-'}}</td>
                                            <td>{{$ooclog->initiator_group_code}}</td>
                                            <td>{{$ooclog->initiator ? $ooclog->initiator->name:'-'}}</td>
                                            <td>{{$ooclog->ooc_due_date}}</td>
                                            <td>{{$ooclog->due_date}}</td>
                                            <td>{{$ooclog->approved_ooc_completed_on}}</td>
                                            <td>{{$ooclog->status}}</td>
                                            
                                        </tr>
                                        @endforeach
                                        @empty
                                        <tr>
                                            <td colspan="12" class="text-center">
                                                <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793;     --bs-alert-color:#060606 ">
                                                    Data Not Found
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
