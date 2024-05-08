@php
    $mainmenu = 'Divisions & Process';
    $submenu = 'Process';

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
                    <h3 class="card-title">All Processes</h3>
                </div>


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>Divisions Name</th>
                                <th>Process Name</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($process as $doc)
                                <tr>

                                    <td>{{ $doc->dname }}</td>

                                    <td>{{ $doc->process_name }}</td>
                                    <td>
                                        <a class="mdi mdi-table-edit"
                                            href="{{ route('qms-process.edit', $doc->id) }}"><button
                                                class="btn btn-dark">Edit</button></a>

                                        <form action="{{ route('qms-process.destroy', $doc->id) }}" method="POST">
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
                    <h4 class="modal-title">Create process</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('qms-process.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">


                        <input type="hidden" name="type" value="appsettings" />
                        <div class="card-body">

                            <div class="form-group">

                                <label for="exampleInputName1">Division Name*</label>
                                <select class="form-control" id="division_id" name="division_id" required />
                                <option class="selected disabled hidden;">Select Division Name</option>
                                @foreach ($division as $temp)
                                    <option value="{{ $temp->id }}">{{ $temp->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">

                                <label for="exampleInputName1">Process Name*</label>
                                <input type="name" name="process_name" class="form-control" id="exampleInputName1"
                                    placeholder="Enter name" required>
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
