@php
    $mainmenu = 'User Management';
    $submenu = 'Group Permission';

@endphp
@extends('admin.layout')

@section('container')
    <div class="fluid-container mb-3">

        <a href="{{ route('GroupPermission.create') }}" class="btn btn-primary">
            New
        </a>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Permission</h3>
                </div>


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Role User Name</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($GroupPermission as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                    {{$user->uname}}
                                    </td>

                                    <td>
                                        <a class="mdi mdi-table-edit"
                                            href="{{ route('GroupPermission.edit', $user->id) }}"><button
                                                class="btn btn-dark">Edit</button></a>
                                        @if ($user->id !== 1 && $user->id !== 2)
                                            <form action="{{ route('GroupPermission.destroy', $user->id) }}" method="POST">
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


        </div>




    </div>
@endsection


@section('jquery')
@endsection
