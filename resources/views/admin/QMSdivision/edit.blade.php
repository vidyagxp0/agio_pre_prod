@php
    $mainmenu = 'Divisions & Process';
    $submenu = 'Edit Division';

@endphp
@extends('admin.layout')

@section('container')
    <div class="modal-content">
        <form action="{{ route('qms-division.update', $division->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <input type="hidden" name="type" value="appsettings" />
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputName1">Division Name*</label>
                        <input type="name" name="name" class="form-control" id="exampleInputName1"
                            placeholder="Enter name" value="{{ $division->name }}" required>
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
