@php
    $mainmenu = 'Control Management';
    $submenu = 'Print Control';
    
@endphp

@extends('admin.layout')


@section('container')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Print Control </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('printcontrol.update',$printcontrol->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">

                    <label for="exampleInputName1">Role*</label>
                    <select class="form-control select2 " id="rolesid" name="role_id" style="width: 100%;"
                        data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach ($role as $div)
                            <option value="{{ $div->id }}"@if($printcontrol->role_id == $div->id) selected @endif>{{ $div->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-3">

                        <label for="exampleInputName1">Daily*</label>
                        <input type="number" name="daily" class="form-control" value="{{$printcontrol->daily}}" id="exampleInputName1"
                            placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group col-3">

                        <label for="exampleInputName1">Weekly*</label>
                        <input type="number" name="weekly" class="form-control" value="{{$printcontrol->weekly}}" id="exampleInputName1"
                            placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group col-3">

                        <label for="exampleInputName1">Monthly*</label>
                        <input type="number" name="monthly" class="form-control" value="{{$printcontrol->monthly}}" id="exampleInputName1"
                            placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group col-3">

                        <label for="exampleInputName1">Quatarly*</label>
                        <input type="number" name="quatarly" class="form-control" value="{{$printcontrol->quatarly}}" id="exampleInputName1"
                            placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group col-3">

                        <label for="exampleInputName1">Yearly*</label>
                        <input type="number" name="yearly" class="form-control" value="{{$printcontrol->yearly}}" id="exampleInputName1"
                            placeholder="Enter User Name" required>
                    </div>
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
