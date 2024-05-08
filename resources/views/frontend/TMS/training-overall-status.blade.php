@extends('frontend.layout.main')
@section('container')
    @if (Helpers::checkRoles(6))
        @include('frontend.TMS.head')
    @endif

<style>
   .inner-block {
    margin-bottom: 20px;
    padding: 20px;
    box-shadow: 12px 12px 24px #b2b8c9, -12px -12px 24px #f0f8ff;
    background: #ffffff;
    overflow: hidden;
}
</style>


    <div id="training-document-view">
        <div class="container-fluid">
        <div class="inner-block">
            <div style="padding-bottom: 10px">
                <div style="    font-size: 18px;
                font-weight: 600;
            ">SOPs</div>
                @foreach ($sops as $index => $sop)
                    <div>{{ $index + 1 }}. {{ $sop->document_name }}</div>
                @endforeach
            </div>
            
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background: #4274dac4;">
                        <tr>
                            <th>Trainee</th>
                            <th>Status</th>
                            <th>Completed On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainingUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                @php
                                    // Find the status for the current user
                                    $status = $trainingStatus->where('user_id', $user->id)->first();
                                @endphp
                                <td>{{ $status ? $status->status : 'Not Started' }}</td>
                                <td>{{ $status ? $status->updated_at : '-' }}</td>
                            </tr>
                        @endforeach
                        {{-- Handle case when no data is found --}}
                        {{-- @if ($trainingUsers->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No data available</td>
                        </tr>
                        @endif --}}

                    </tbody>
                </table>
            </div>
        </div>
      
    </div>
</div>
@endsection
