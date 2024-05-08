@php
    $mainmenu = 'Control Management';
    $submenu = 'Print Control';

@endphp

@extends('admin.layout')


@section('container')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Print Control </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form name="myform" id="myform" action="{{ route('printcontrol.store') }}" method="POST">
            @csrf

            <div class="card-body">

                <div class="form-group">

                    <label for="exampleInputName1">Role*</label>
                    <select class="form-control select2 " id="rolesid" name="role_id" style="width: 100%;"
                        data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach ($role as $div)
                            <option value="{{ $div->id }}">{{ $div->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-3">

                        <label for="daily">Daily*</label>
                        <input type="number" name="daily" class="form-control daily" value="0" id="daily"
                            placeholder="Enter here" required>
                    </div>
                    <div class="form-group col-3">

                        <label for="weekly">Weekly*</label>
                        <input type="number" name="weekly" class="form-control" value="0" oninput="checkData()"
                            id="weekly" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group col-3">

                        <label for="monthly">Monthly*</label>
                        <input type="number" name="monthly" class="form-control" value="0" id="monthly"
                            placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group col-3">

                        <label for="quatarly">Quatarly*</label>
                        <input type="number" name="quatarly" class="form-control" value="0" id="quatarly"
                            placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group col-3">

                        <label for="yearly">Yearly*</label>
                        <input type="number" name="yearly" class="form-control" value="0" id="yearly"
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
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $('#rolesid').on('change', function() {

            $("#userid").attr('disabled', false); //enable subcategory select

            $("#userid").val("");

            $(".username").attr('disabled', true); //disable all category option

            $(".username").hide(); //hide all subcategory option

            $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent

            $(".parent-" + $(this).val()).show();

        });



        function checkData() {
            var daily = $("#daily").val();
            var weekly = $("#weekly").val();
            console.log(daily, weekly);
            if (daily < weekly) {
                $("#weekly").val();
            } else {
               alert('Should be more than Daily limit');
            }
        }

        $("#myform").validate({

            rules: {
                daily: {
                    required: true,
                    range: [0, 20],
                },
            }
        });
    </script>
@endsection
