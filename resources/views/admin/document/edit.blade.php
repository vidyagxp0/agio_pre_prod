@php
    $mainmenu = 'System Configuration';
    $submenu = ' Edit Document';

@endphp
@extends('admin.layout')

@section('container')
    <div class="modal-content">
        <form action="{{ route('document_types.update', $document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <input type="hidden" name="type" value="appsettings" />
                <div class="card-body">
                    <div class="form-group">

                        <label for="exampleInputName1">Document Type Code*</label>
                        <input type="name" name="typecode" class="form-control" id="exampleInputName1"
                            placeholder="Enter Code" value="{{ $document->typecode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Department Name*</label>
                        <select class="form-control" id="documentid" name="departmentid" required />
                        <option class="selected disabled hidden;">Select Document Name</option>
                        @foreach ($department as $temp)
                            <option value="{{ $temp->id }}" @if ($document->departmentid == $temp->id) Selected @endif>
                                {{ $temp->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Document Name*</label>
                        <input type="name" name="name" class="form-control" id="exampleInputName1"
                            placeholder="Enter name" value="{{ $document->name }}" required>
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
