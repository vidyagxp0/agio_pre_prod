@php
    $mainmenu = 'System Configuration';
    $submenu = ' Edit Distribution List';

@endphp
@extends('admin.layout')

@section('container')
    <div class="modal-content">
        <form action="{{ route('distributionlist.update', $distributionlist->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <input type="hidden" name="type" value="appsettings" />
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName1">Department Code*</label>
                        <input type="name" name="dlcode" class="form-control" id="exampleInputName1"
                            placeholder="Enter Code" value="{{ $distributionlist->dlcode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Department Name*</label>
                        <input type="name" name="dlname" class="form-control" id="exampleInputName1"
                            placeholder="Enter name" value="{{ $distributionlist->dlname }}" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
        </form>
    </div>
@endsection


@section('jquery')
@endsection
