@php
    $mainmenu = 'User Management';
    $submenu = 'Role Permission';

@endphp
@extends('admin.layout')

@section('container')
    <div class="fluid-container mb-3">

        <a type="button" class="btn btn-primary" href="{{ route('role_groups.create') }}">
            New
        </a>

    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Role Group</h3>
        </div>


        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Description</th>

                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($group as $pg)
                        <tr>

                            <td>{{ $pg->name }}</td>
                            <td>{{ $pg->description }}</td>

                            <td>{{ $pg->permission }}</td>
                            <td>
                                <a class="mdi mdi-table-edit" href="{{ route('role_groups.edit', $pg->id) }}"><button
                                        class="btn btn-dark">Edit</button></a>

                                @if ($pg->id != 1 && $pg->id != 2)
                                    <form action="{{ route('role_groups.destroy', $pg->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="confirmation btn btn-danger">Delete</button>
                                    </form>
                                @endif
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
@endsection


@section('jquery')
@endsection
