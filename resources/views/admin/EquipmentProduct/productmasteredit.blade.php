@php
    $mainmenu = 'EquipmentMaster';
    $submenu = 'Product';
@endphp


@extends('admin.layout')

@section('container')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Edit Equipment Product</h4>
        </div>
 
        <div class="card-body">
            <form action="{{ route('eqproduct.update', $equipmentproduct->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label>Product Name <span class="text-danger">*</span></label>
                        <input type="text"
                            name="product_name"
                            class="form-control"
                            value="{{ old('product_name', $equipmentproduct->product_name) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Product Code <span class="text-danger">*</span></label>
                        <input type="text"
                            name="product_code"
                            class="form-control"
                            value="{{ old('product_code', $equipmentproduct->product_code) }}"
                            required>
                    </div>
                     <div class="form-group">
                        <label>Caegory <span class="text-danger">*</span></label>
                        <input type="text"
                            name="category"
                            class="form-control"
                            value="{{ old('category', $equipmentproduct->category) }}"
                            required>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <a href="{{ route('eqproduct.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
