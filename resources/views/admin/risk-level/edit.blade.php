@php
    $mainmenu = 'Divisions & Process';
    $submenu = 'Edit Process';

@endphp
@extends('admin.layout')

@section('container')
    <div class="modal-content">
        <form action="{{ route('risk-level.update', $keyword->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <input type="hidden" name="type" value="appsettings" />
                <div class="card-body">

                    <div class="form-group">

                        <label for="exampleInputName1">Risk Level*</label>
                        <select class="form-control" id="risk_level" name="risk_level" required>
                            <option class="selected disabled hidden;">Select Risk Level</option>
                            <option @if ($keyword->risk_level == "critical")
                                selected
                            @endif value="critical">Critical</option>
                            <option @if ($keyword->risk_level == "minor")
                                selected
                            @endif value="minor">Minor</option>
                        </select>
                    </div>
                    <div class="form-group">

                        <label for="exampleInputName1">Keyword Name*</label>
                        <input type="name" name="keyword_name" value="{{ $keyword->keyword }}" class="form-control" id="exampleInputName1"
                            placeholder="Enter name" required>
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
