@php
    $mainmenu = 'Divisions & Process';
    $submenu = 'Edit Process';

@endphp
@extends('admin.layout')

@section('container')
    <div class="modal-content">
        <form action="{{ route('qms-process.update', $process->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <input type="hidden" name="type" value="appsettings" />
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputName1">Division Name*</label>
                        <select class="form-control" id="documentid" name="division_id" required />
                        <option class="selected disabled hidden;">Select Document Name</option>
                        @foreach ($division as $temp)
                            <option value="{{ $temp->id }}" @if ($process->division_id == $temp->id) Selected @endif>
                                {{ $temp->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Process Name*</label>
                        <input type="name" name="process_name" class="form-control" id="exampleInputName1"
                            placeholder="Enter name" value="{{ $process->process_name }}" required>
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
