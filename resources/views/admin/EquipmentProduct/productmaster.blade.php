@php
    $mainmenu = 'EquipmentMaster';
    $submenu = 'Product';

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
                    <h3 class="card-title">All Product</h3>
                </div>

                    <div class="mb-2 d-flex justify-content-between">
                        <a href="{{ route('eqproduct.export') }}" class="btn btn-success">
                            Export Excel
                        </a>

                        <form action="{{ route('eqproduct.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" required>
                            <button type="submit" class="btn btn-primary">Import Excel/CSV</button>
                        </form>
                    </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($prdocutmaster as $equi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $equi->product_name}}</td>
                                <td>{{ $equi->product_code }}</td>
                                <td>{{ $equi->category }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('eqproduct.edit', $equi->id) }}" class="btn btn-sm btn-dark mr-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('eqproduct.destroy', $equi->id) }}" method="POST">
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

            </div>


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

            <form action="{{ route('eqproduct.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                   <div class="form-group">
                        <label>Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="product_name" class="form-control"
                               placeholder="Enter Equipment Name" required>
                    </div>
                   
                    <div class="form-group">
                        <label>Product Code <span class="text-danger">*</span></label>
                        <input type="text" name="product_code" class="form-control"
                               placeholder="Enter Product Code" required>
                    </div>

                    <div class="form-group">
                        <label>Category <span class="text-danger">*</span></label>
                        <input type="text" name="category" class="form-control"
                               placeholder="Enter Product category" required>
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
