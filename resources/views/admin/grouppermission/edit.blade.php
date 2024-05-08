@php
    $mainmenu = 'User Management';
    $submenu = 'Group Permission';

@endphp

@extends('admin.layout')


@section('container')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Permission </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('GroupPermission.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">

                <div class="form-group">

                    <label for="exampleInputName1">Name*</label>
                    <input type="name" name="name" class="form-control" value="{{ $data->name }}"
                        id="exampleInputName1" placeholder="Enter User Name" required>
                </div>


                <div class="form-group">
                    <label for="exampleInputName1">Role Name*</label>
                    <select class="form-control" id="rolesid" name="rolesid" required />
                    <option class="selected disabled hidden;">Select Role Name</option>
                    @foreach ($role as $temp)
                        <option value="{{ $temp->id }}" @if ($data->role_id == $temp->id) Selected @endif>
                            {{ $temp->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Role User Name*</label>
                    <select id="choices-multiple-remove-button" placeholder="Select the person.." id="user_ids" name="user_ids[]" multiple>
                        @foreach ($user as $div)
                            <option value="{{ $div->id }}" class='parent-{{ $div->role_id }} name'>{{ $div->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

@endsection
@section('jquery')
<script>


$('#rolesid').on('change', function () {
    $("#user_ids").attr('disabled', false); //enable subcategory select
    $("#user_ids").val("");
    $(".name").attr('disabled', true); //disable all category option
    $(".name").hide(); //hide all subcategory option
    $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent
    $(".parent-" + $(this).val()).show();
}); 

</script>
@endsection
