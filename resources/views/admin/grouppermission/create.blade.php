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
        <form action="{{ route('GroupPermission.store') }}" method="POST">
            @csrf

            <div class="card-body">


                <div class="form-group">

                    <label for="exampleInputName1">Name*</label>
                    <input type="name" name="name" class="form-control" id="exampleInputName1"
                        placeholder="Enter User Name" required>
                </div>



                <div class="form-group">

                    <label for="exampleInputName1">Role*</label>
                    <select class="form-control select2 " id="rolesid" name="rolesid" style="width: 100%;"
                        data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach ($group as $div)
                            <option value="{{ $div->id }}">{{ $div->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">

                    <label for="exampleInputName1">Role User Name*</label>
                    <select id="choices-multiple-remove-button" placeholder="Select the person.." id="user_ids" name="user_ids[]" multiple>

                    @foreach ($user as $temp)
                        <option value="{{ $temp->id }}" class='parent-{{ $temp->role }} username'>{{ $temp->name }}
                        </option>
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
        $('#rolesid').on('change', function() {

            $("#userid").attr('disabled', false); //enable subcategory select

            $("#userid").val("");

            $(".username").attr('disabled', true); //disable all category option

            $(".username").hide(); //hide all subcategory option

            $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent

            $(".parent-" + $(this).val()).show();

        });
    </script>
@endsection
