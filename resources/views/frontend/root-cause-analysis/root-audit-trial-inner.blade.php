@extends('frontend.layout.main')
@section('container')
    <div id="audit-inner">
        <div class="container-fluid">
            <div class="audit-inner-container">

                <div class="row mb-4">

                    <div class="col-lg-12">
                        <div class="inner-block">
                            <div class="main-head">
                            Record -{{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}
                            </div>
                            <div class="info-list">

                                <div class="list-item">
                                    <div class="head">Document Stage</div>
                                    <div>:</div>
                                    <div>{{ $doc->status }}</div>
                                </div>
                                <div class="list-item">
                                    <div class="head">Originator</div>
                                    <div>:</div>
                                    <div>{{ $doc->origiator_name->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @foreach($detail_data as $temp)
                    <div class="inner-block audit-main">
                        <div class="info-list">
                            <div class="list-item">
                                <div class="head">Modified By</div>
                                <div>:</div>
                                <div>{{ $temp->user_name }}</div>
                            </div>
                            {{-- <div class="list-item">
                                <div class="head">Modifier role</div>
                                <div>:</div>
                                <div>{{ $temp->user_role }}</div>
                            </div> --}}
                            <div class="list-item">
                                <div class="head">Modified On</div>
                                <div>:</div>
                                <div>{{ Helpers::getdateFormat1($temp->created_at) }}</div>
                            </div>
                            @if($temp->comment)
                            <div class="list-item">
                                <div class="head">Comment</div>
                                <div>:</div>
                                <div>{{ $temp->comment }}</div>
                            </div>
                            @endif



                            @if($temp->activity_type == "Responsibility" ||$temp->activity_type == "Abbreviation" ||$temp->activity_type == "Defination" ||$temp->activity_type == "Materials and Equipments" ||$temp->activity_type == "Reporting" )
                            @if(!empty($temp->previous))
                            <div class="list-item">
                                <div class="head">Changed From</div>
                                <div>:</div>
                                @foreach (unserialize($temp->previous) as $data)
                                @if($data)
                                <div>{{ $data }}</div>
                                @else
                                <div>NULL</div>
                                @endif
                                @endforeach

                            </div>
                            @else
                            {{-- @if($temp->activity_type == "Activity Log" ) --}}
                            
                            <div class="list-item">
                                <div class="head">Changed From</div>
                                <div>:</div>
                                <div>NULL</div>
                            </div>
                            {{-- @endif --}}
                            @endif
                            @if($temp->current != $temp->previous)
                            <div class="list-item">
                                <div class="head">Changed To</div>
                                <div>:</div>
                                @foreach (unserialize($temp->current) as $data)
                                <div>{{ $data }}</div>
                                @endforeach

                            </div>
                            @endif
                            @else
                            @if(!empty($temp->previous))
                            <div class="list-item">
                                <div class="head">Changed From</div>
                                <div>:</div>
                                
                                <div>{{ $temp->previous }}</div>
                            </div>
                            @else
                            <div class="list-item">
                                <div class="head">Changed From</div>
                                <div>:</div>
                                <div>NULL</div>
                            </div>
                            @endif

                            @if($temp->current != $temp->previous)
                            <div class="list-item">
                                <div class="head">Changed To</div>
                                <div>:</div>
                                <div>{{ $temp->current }}</div>
                            </div>
                            @endif
                            @endif
                            @if($temp->current != $temp->previous)
                            @if($temp->activity_type == "Activity Log" )

                          
                                     <div class="list-item">
                                      <div class="head">{{$temp->stage}} By</div>
                                      <div>:</div>
                                      <div> {{$temp->current}}</div>
                                      </div>  
                                      <div class="list-item">
                                      <div class="head">{{$temp->stage}} On</div>
                                      <div>:</div>
                                      <div> {{Helpers::getdateFormat1($temp->created_at)}}</div>
                                     </div> 
                                     {{-- @elseif($temp->origin_state =="Investigation in Progress") 
                                     
                                      <div class="list-item">
                                      <div class="head">Submitted By</div>
                                      <div>:</div>
                                      <div> {{$temp->current}}</div>
                                      </div>  
                                      <div class="list-item">
                                      <div class="head">Submitted On</div>
                                      <div>:</div>
                                      <div> {{Helpers::getdateFormat1($temp->created_at)}}</div>
                                     </div> 
                                     @elseif($temp->origin_state =="Pending Group Review Discussion") 
                                      <div class="list-item">
                                      <div class="head">QA Review Completed By</div>
                                      <div>:</div>
                                      <div> {{$temp->current}}</div>
                                      </div>  
                                      <div class="list-item">
                                      <div class="head">QA Review Completed On</div>
                                      <div>:</div>
                                      <div> {{Helpers::getdateFormat1($temp->created_at)}}</div>
                                     </div> 
                                     @elseif($temp->origin_state =="QA Review") 
                                      <div class="list-item">
                                      <div class="head">Approved By</div>
                                      <div>:</div>
                                      <div> {{$temp->current}}</div>
                                      </div>  
                                      <div class="list-item">
                                      <div class="head">Approved On</div>
                                      <div>:</div>
                                      <div> {{Helpers::getdateFormat1($temp->created_at)}}</div>
                                     </div> 
                                    

                                     @endif --}}


                            @else

                            <div class="list-item">
                                <div class="head">Origin state</div>
                                <div>:</div>
                                <div>{{ $temp->origin_state }}</div>
                            </div>
                            @endif
                            @endif
                        </div>
                        {{-- <a href="{{ url('documents/viewpdf/' . $temp->id) }}#toolbar=0" class="view-pdf">
                            <i class="fa-solid fa-file-pdf"></i>&nbsp;View PDF
                        </a> --}}
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
