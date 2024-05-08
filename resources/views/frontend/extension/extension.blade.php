@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                CHANGE CONTROL LIST
    ======================================= --}}
    <div id="change-control-list">
        <div class="container-fluid">

            <div class="inner-block control-list">
                <div class="main-head">
                    <div>Manage Change Control</div>
                    <button onclick="window.print();return false;" class="button_theme1 new-doc-btn">Print</button>
                </div>

                <div class="list">
                    <div class="control-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Reocrd No.</th>
                                    <th>Title</th>
                                    <th>Current Status</th>
                                    <th>Originator</th>
                                    <th>Date Opened</th>
                                    {{--  <th>Due Date</th>  --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="searchTable">
                                @foreach ($document as $datas)
                                    <tr>
                                        <td>{{ $datas->id }}</td>
                                        <td>{{ str_pad($datas->record, 5, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $datas->short_description }}</td>
                                        <td>{{ $datas->status }}</td>
                                        <td>{{ $datas->originator }}</td>
                                        <td>{{ $datas->created_at }}</td>
                                        {{--  <td>{{ $datas->due_date }}</td>  --}}
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('extension.show', $datas->id) }}"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                {{--  <a href="{{ route('CC.edit', $datas->id) }}"><i
                                                            class="fa-solid fa-edit"></i></a>  --}}
                                            </div>



                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
