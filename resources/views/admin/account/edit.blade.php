@php
    $mainmenu = 'User Management';
    $submenu = 'Login Account';

@endphp

@extends('admin.layout')


@section('container')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Account </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('user_management.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <div class="form-group">

                    <label for="exampleInputName1">Name*</label>
                    <input type="name" name="name" class="form-control" value="{{ $data->name }}"
                        id="exampleInputName1" placeholder="Enter User Name" required>
                </div>



                <div class="form-group">

                    <label for="exampleInputName1">email*</label>
                    <input type="email" name="email" class="form-control" value="{{ $data->email }}"
                        id="exampleInputName1" placeholder="enter email" required>
                </div>

                <div class="form-group">

                    <label for="exampleInputName1">password*</label>
                    <input type="name" name="password" class="form-control" id="exampleInputName1"
                        placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Department Name*</label>
                    <select class="form-control" id="documentid" name="departmentid" required />
                    <option class="selected disabled hidden;">Select Document Name</option>
                    @foreach ($department as $temp)
                        <option value="{{ $temp->id }}" @if ($data->departmentid == $temp->id) Selected @endif>
                            {{ $temp->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group" id="roleGroup">
                    <label for="exampleInputName1">Roles (Ctrl (windows) or Command (Mac) button to select multiple options)<span style="color: red">*</span></label>
                    <select class="form-control2" id="roles" name="roles[]" multiple required onchange="updateSelectedOptions()">
                        @foreach ($group as $role)
                            <option value="{{ $role->id }}" {{ in_array($role->id, $userRoles) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div id="selectedOptions"></div>

                <script>
                    function updateSelectedOptions() {
                        var selectElement = document.getElementById("roles");
                        var selectedOptions = [];
                        for (var i = 0; i < selectElement.options.length; i++) {
                            if (selectElement.options[i].selected) {
                                selectedOptions.push(selectElement.options[i].text);
                            }
                        }
                        document.getElementById("selectedOptions").innerHTML = "Selected roles: <br>" + selectedOptions.join("<br>");
                    }
                </script>

            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <style>
            .form-control2 {
                width: 100%;
                height: 200px;
                font-size: 14px;
                line-height: 0.5;
                border-radius: 5px;
                padding: 15px 25px;
                border: 1px solid rgba(0, 0, 0, 0.1);
             }
             /* body:not(.layout-fixed) .main-sidebar {
                height: inherit;
                min-height: 100%;
                position: fixed;
                top: 0; 
            }*/
        </style>
    </div>
    <!-- /.card -->
@endsection
