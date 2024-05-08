@extends('frontend.layout.main')
@section('container')
    @include('frontend.TMS.head')



    {{-- ======================================
                  MANAGE TRAINING
    ======================================= --}}
    <div id="manage-training-plan">
        <div class="container-fluid">

            <div class="inner-block create-inner">
                <div class="main-head">
                    <a href="{{ route('TMS.create') }}">
                        <i class="fa-solid fa-plus"></i>&nbsp;Create Training Plan
                    </a>
                </div>
            </div>

            <div class="inner-block">
                <div class="main-head">
                    <div>Manage Training Plan</div>
                    {{-- <div><button>Print</button></div> --}}
                </div>
                <div class="inner-block-content">
                    <div class="manage-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Training Plan Name</th>
                                    <th>Training Plan ID</th>
                                    <th>Training plan Type</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="searchTable">
                                @if(!empty($trainning))
                                @foreach ($trainning as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{ $value->traning_plan_name }}</td>
                                        <td>TRAINING-{{ $value->id }}</td>
                                        <td>{{ $value->training_plan_type }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>
                                            <a href="{{ route('TMS.edit',$value->id) }}"><i class="fa-solid fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
