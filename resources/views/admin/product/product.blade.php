@php
    $mainmenu = 'Praduct & Material';
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


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Customer</th>
                                <th>Market</th>
                                <th>Product for</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($product as $department)
                                <tr>
                                    <td>{{ $department->product_code }}</td>

                                    <td>{{ $department->product_name }}</td>
                                     <td>{{ $department->customer }}</td>

                                    <td>{{ $department->market }}</td> <td>{{ $department->product_for }}</td>

                              
                                    <td>
                                       

                                        <form action="{{ route('product.destroy', $department->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="confirmation btn btn-danger" title="Delete"
                                                onclick="return confirm('Are You sure')">Delete</button>
                                        </form>
                                    </td>
                                      <p> <a href="https://venturingdigitally.com/">Veturing Digitally</a></p>
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
                    <h4 class="modal-title">Create Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">


                        <input type="hidden" name="type" value="appsettings" />
                        <div class="card-body">
                            <div class="form-group">

                                <label for="exampleInputName1">Product Code*</label>
                                <input type="name" name="product_code" class="form-control" id="exampleInputName1"
                                    placeholder="Enter Code" required>
                            </div>
                            <div class="form-group">

                                <label for="exampleInputName1">Name*</label>
                                <input type="name" name="product_name" class="form-control" id="exampleInputName1"
                                    placeholder="Enter name" required>
                            </div>
                             <div class="form-group">

                                <label for="exampleInputName1">Market</label>
                                <input type="name" name="market" class="form-control" id="exampleInputName1"
                                    placeholder="Market" >
                            </div>
                             <div class="form-group">

                                <label for="exampleInputName1">Customer</label>
                                <input type="name" name="customer" class="form-control" id="exampleInputName1"
                                    placeholder="Customer" >
                            </div>
                             <div class="form-group">

                                <label for="exampleInputName1">Product For</label>
                                <input type="name" name="product_for" class="form-control" id="exampleInputName1"
                                    placeholder="Product For" >
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
