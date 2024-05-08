@php
    $mainmenu = 'Control Management';
    $submenu = 'Download Control';
    
@endphp
@extends('admin.layout')

@section('container')
    <div class="fluid-container mb-3">

        <a href="{{ route('downloadcontrol.create') }}" class="btn btn-primary">
            New
        </a>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Download Control</h3>
                </div>


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Daily</th>
                                <th>Weekly</th>
                                <th>Monthly</th>
                                <th>Quatarly</th>
                                <th>Yearly</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($downloadcontrol as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                    {{$user->daily}}
                                    </td>
                                    <td>
                                        {{$user->weekly}}
                                    </td>
                                    <td>
                                        {{$user->monthly}}
                                    </td>
                                    <td>
                                        {{$user->quatarly}}
                                    </td>
                                    <td>
                                        {{$user->yearly}}
                                    </td>

                                    <td>
                                        <a class="mdi mdi-table-edit"
                                            href="{{ route('downloadcontrol.edit', $user->id) }}"><button
                                                class="btn btn-dark">Edit</button></a>
                                    
                                            <form action="{{ route('downloadcontrol.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="confirmation btn btn-danger">Delete</button>
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
@endsection


@section('jquery')
@endsection
