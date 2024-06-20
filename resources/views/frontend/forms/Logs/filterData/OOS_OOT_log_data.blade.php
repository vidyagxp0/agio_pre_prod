@forelse ($oots as $ootlog)
                                           @foreach ($oosmicro as $micro )
                                           
                                              @php
                                                  $productDetails= $ootlog->ProductGridOot;


                                              @endphp 
                                              @foreach ($productDetails['data'] as $data) 
                                           <tr>
                                               
                                               <td>{{$loop->index+1}}</td>
                                               <td>{{$ootlog->intiation_date}}</td>
                                               <td>{{$ootlog->record_number}}</td>
                                               <td>{{$ootlog->short_description}}</td>
                                               <td>{{$micro->source_document_type_gi?$micro->source_document_type_gi:'Not Available'}}</td>
                                               <td>{{$data['item_product_code']}}</td>
                                               <td>{{$data['lot_batch_no']}}</td>
                                               <td>{{$ootlog->due_date}}</td>
                                               <td>{{$ootlog->Final_Approval_on}}</td>
                                               <td>{{$ootlog->status}}</td>
                                               
                                            </tr>
                                            @endforeach
                                            @endforeach 
                                            @empty <tr>
                                                <td colspan="12" class="text-center">
                                                    <div class="alert alert-warning my-2" style="--bs-alert-bg:#999793; --bs-alert-color:#060606 ">
                                                        Data Not Found
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        @endforelse
