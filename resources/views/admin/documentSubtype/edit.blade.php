@php
    $mainmenu = 'System Configuration';
    $submenu = ' Edit Document Subtype';

@endphp
@extends('admin.layout')

@section('container')
    <div class="modal-content">
        <form action="{{ route('document_subtypes.update', $document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <input type="hidden" name="type" value="appsettings" />
                <div class="card-body">
                    <div class="form-group">

                        <label for="exampleInputName1">Document SubType Code*</label>
                        <input type="name" name="typecode" class="form-control" id="exampleInputName1"
                            placeholder="Enter Code" value="{{ $document->code }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Document Type Name*</label>
                        <select class="form-control" id="documentid" name="departmentid" required />
                        <option class="selected disabled hidden;">Select Document Type Name</option>
                        @foreach ($department as $temp)
                            <option value="{{ $temp->id }}" @if ($document->doctype_id == $temp->id) Selected @endif>
                                {{ $temp->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Document SubType Name*</label>
                        <input type="name" name="name" class="form-control" id="exampleInputName1"
                            placeholder="Enter name" value="{{ $document->docSubtype }}" required>
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
