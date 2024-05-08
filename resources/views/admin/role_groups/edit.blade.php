@php
    $mainmenu = 'User Management';
    $submenu = 'Role Permission';

@endphp

@extends('admin.layout')


@section('container')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Role Group </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('role_groups.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <div class="form-group">

                    <label for="exampleInputName1">Name*</label>
                    <input type="name" name="name" class="form-control" id="exampleInputName1"
                        value="{{ $data->name }}" placeholder="Enter name"
                        @if ($data->id == 1 || $data->id==2) disabled @endif required>
                </div>

                <div class="form-group">

                    <label for="exampleInputName1">Description*</label>
                    <input type="name" name="description" class="form-control" value="{{ $data->description }}"
                        id="exampleInputName1" placeholder="Enter description">
                </div>

                <div class="form-group">

                    <label for="exampleInputName1">Permission*</label>

                    <table class="table table-bordered table-striped">

                        <tr>
                            <th>Read</th>
                            <th>Create</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="read" id="checkboxPrimary1" checked="">
                                    <label for="checkboxPrimary1">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="create" id="checkboxPrimary2" checked="">
                                    <label for="checkboxPrimary2">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="edit" id="checkboxPrimary3" checked="">
                                    <label for="checkboxPrimary3">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="delete" id="checkboxPrimary4" checked="">
                                    <label for="checkboxPrimary4">
                                    </label>
                                </div>
                            </td>
                        </tr>

                    </table>


                </div>

            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
