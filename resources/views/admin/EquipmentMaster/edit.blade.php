@php
    $mainmenu = 'EquipmentMaster';
    $submenu = 'Master';
@endphp


@extends('admin.layout')

@section('container')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Edit Master</h4>
        </div>
 
        <div class="card-body">
            <form action="{{ route('eqmaster.update', $equipmentmaster->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- Sno --}}
                    {{-- <div class="form-group">
                        <label>Sno <span class="text-danger">*</span></label>
                        <input type="text"
                            name="sno"
                            class="form-control"
                            value="{{ old('sno', $equipmentmaster->id) }}"
                            readonly>
                    </div> --}}

                    {{-- Department --}}
                
                    <div class="form-group">
                        <label>Department <span class="text-danger">*</span></label>
                        <select name="department_id" class="form-control" required>
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ $equipmentmaster->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Equipment Name --}}
                    <div class="form-group">
                        <label>Equipment Name <span class="text-danger">*</span></label>
                        <input type="text"
                            name="equipment_name"
                            class="form-control"
                            value="{{ old('equipment_name', $equipmentmaster->equipment_name) }}"
                            required>
                    </div>

                    {{-- Equipment ID --}}
                    <div class="form-group">
                        <label>Equipment ID <span class="text-danger">*</span></label>
                        <input type="text"
                            name="equipment_id"
                            class="form-control"
                            value="{{ old('equipment_id', $equipmentmaster->equipment_id) }}"
                            required>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <a href="{{ route('eqmaster.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
