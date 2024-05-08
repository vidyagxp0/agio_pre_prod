@php
    $mainmenu = 'System Configuration';
    $submenu = 'Destribution List';

@endphp
@extends('admin.layout')

@section('container')
    <div class="fluid-container mb-3">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" fdprocessedid="enyy57">
            New
        </button>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Distribution List</h3>
                </div>


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Distribution List Code</th>
                                <th>Distribution List Name</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($distributionlist as $department)
                                <tr>
                                    <td>{{ $department->dlcode }}</td>

                                    <td>{{ $department->dlname }}</td>
                                    <td>
                                        <a class="mdi mdi-table-edit"
                                            href="{{ route('distributionlist.edit', $department->id) }}"><button
                                                class="btn btn-dark">Edit</button></a>

                                        <form action="{{ route('distributionlist.destroy', $department->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="confirmation btn btn-danger" title="Delete"
                                                onclick="return confirm('Are You sure')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->

                <!-- /.card -->
            </div>
            <!-- /.col -->


        </div>




    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Distribution</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('distributionlist.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">


                        <input type="hidden" name="type" value="appsettings" />
                        <div class="card-body">
                            <div class="form-group">

                                <label for="exampleInputName1">Distribution List Code*</label>
                                <input type="name" name="dlcode" class="form-control" id="exampleInputName1"
                                    placeholder="Enter Code" required>
                            </div>
                            <div class="form-group">

                                <label for="exampleInputName1">Distribution List Name*</label>
                                <input type="name" name="dlname" class="form-control" id="exampleInputName1"
                                    placeholder="Enter Distribution List Name" required>
                            </div>


                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                </form>
            </div>

        </div>

    </div>
@endsection


@section('jquery')
@endsection
