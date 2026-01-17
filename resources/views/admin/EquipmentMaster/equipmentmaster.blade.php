@php
    $mainmenu = 'EquipmentMaster';
    $submenu = 'Master';

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
                    <h3 class="card-title">All Equipment Master</h3>
                </div>

                    <div class="mb-2 d-flex justify-content-between">
                        <a href="{{ route('eqmaster.export') }}" class="btn btn-success">
                            Export Excel
                        </a>

                        <form action="{{ route('eqmaster.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" required>
                            <button type="submit" class="btn btn-primary">Import Excel/CSV</button>
                        </form>
                    </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Department Name</th>
                            <th>Equipment Name</th>
                            <th>Equipment ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($equipmentmaster as $equi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $equi->department->name ?? '-' }}</td>
                                <td>{{ $equi->equipment_name }}</td>
                                <td>{{ $equi->equipment_id }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('eqmaster.edit', $equi->id) }}" class="btn btn-sm btn-dark mr-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('eqmaster.destroy', $equi->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure?')"
                                            class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
                <h4 class="modal-title">Create Equipment Master</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('eqmaster.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    {{-- Sno --}}
                    {{-- <div class="form-group">
                        <label>Sno <span class="text-danger">*</span></label>
                        <input type="text" name="sno" class="form-control" placeholder="Enter Sno" required>
                    </div> --}}

                    {{-- Department --}}
                    {{-- @php
                        dd($departments);
                    @endphp --}}
                   <div class="form-group">
                        <label>Department <span class="text-danger">*</span></label>
                        <select name="department_id" class="form-control" required>
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Equipment Name --}}
                    <div class="form-group">
                        <label>Equipment Name <span class="text-danger">*</span></label>
                        <input type="text" name="equipment_name" class="form-control"
                               placeholder="Enter Equipment Name" required>
                    </div>

                    {{-- Equipment ID --}}
                    <div class="form-group">
                        <label>Equipment ID <span class="text-danger">*</span></label>
                        <input type="text" name="equipment_id" class="form-control"
                               placeholder="Enter Equipment ID" required>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
            

        </div>
    </div>
</div>

@endsection


@section('jquery')
@endsection
