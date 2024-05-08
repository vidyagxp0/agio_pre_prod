@extends('frontend.layout.main')
@section('container')
    @if (Helpers::checkRoles(6))
        @include('frontend.TMS.head')
    @endif



    @php
        $trainingCompleted = DB::table('training_statuses')->where(['sop_id' => $sopId, 'user_id' => Auth::user()->id, 'status' => 'Complete'])->latest()->first();
        $trainees = explode(',', $trainning->trainees);
        // dd(!in_array(auth()->user()->id, explode(',', $trainning->trainees)));
        // dd(!in_array(auth()->user()->id, explode(',', $trainning->trainees)) || !$trainingCompleted);
    @endphp
    {{-- ======================================
                    TRAINING VIEW
    ======================================= --}}
    <div id="training-document-view">
        <div class="container-fluid">

            <div class="inner-block">
                <div class="main-head"> 
                    Training Details
                </div>
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="train-id">Training ID</label>
                                <div class="static">{{ $trainning->id }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="train-name">Training Name</label>
                                <div class="static">{{ $trainning->traning_plan_name }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="assigned">Assigned By</label>
                                <div class="static">{{ $trainning->trainer->name }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="train-type">Training Type</label>
                                <div class="static">{{ $trainning->training_plan_type }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="train-status">Overall Training Status</label>
                                <div class="static">{{ $trainning->status }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="due-date">Due Date</label>
                                <div class="static">{{ \Carbon\Carbon::parse($doc->due_dateDoc)->format('d M Y') }}</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!in_array(auth()->user()->id, explode(',', $trainning->trainees)) || !$trainingCompleted)
                <div class="foot-btns">
                    @if ($trainning->status == 'Complete')
                        <a href="{{ route('TMS.index') }}">Already Completed</a>
                    @else
                        <a href="{{ route('TMS.index') }}">Continue Later</a>
    
                        <a href="{{ url('training', $sopId) }}">Start Training</a>
                    @endif
                </div>
            @endif

        </div>
    </div>
    
@endsection
