@php
    $mainmenu = 'System Configuration';
    $submenu = ' Edit Document Language';

@endphp
@extends('admin.layout')

@section('container')
    <div class="modal-content">
        <form action="{{ route('documentlanguage.update', $language->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <input type="hidden" name="type" value="appsettings" />
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName1">Document Language Code*</label>
                        <input type="name" name="lcode" class="form-control" id="exampleInputName1"
                            placeholder="Enter Code" value="{{ $language->lcode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Document Language Name*</label>
                        <input type="name" name="lname" class="form-control" id="exampleInputName1"
                            placeholder="Enter name" value="{{ $language->lname }}" required>
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
