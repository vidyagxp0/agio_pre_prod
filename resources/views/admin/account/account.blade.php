@php
    $mainmenu = 'User Management';
    $submenu = 'Login Account';

@endphp
@extends('admin.layout')

@section('container')
    <div class="fluid-container mb-3">

        <a href="{{ route('user_management.create') }}" class="btn btn-primary">
            New
        </a>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Login Accounts</h3>
                </div>


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                            
                            <tr>
                                    @php
                                    $RoleList = DB::table('user_roles')->where(['user_id' =>$user->id])->pluck('role_id')->toArray();
                                    $role = '';
                                    $roleName = '';
                                    if($RoleList){
                                        $role = implode(',', $RoleList);
                                        $roleNameList = DB::table('q_m_s_roles')
                                            ->whereIn('id', $RoleList)
                                            ->pluck('name')->toArray();
                                        $roleName = implode(',', $roleNameList);
                                    }
                                    @endphp
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->dname }}</td>
                                    <td>
                                        {{-- {{ $roleName }} --}}
                                        <button class="btn btn-dark view-role" data-role="{{ $roleName }}"><i class="fas fa-eye"></i> </button>

                                    </td>
                                    <td>
                                        <a class="mdi mdi-table-edit"
                                            href="{{ route('user_management.edit', $user->id) }}"><button
                                                class="btn btn-dark">Edit</button></a>

                                        <form action="{{ route('user_management.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="confirmation btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('.view-role').click(function() {
                                        var roleName = $(this).data('role');
                                        var roleList = roleName.split(','); // Split the role names into an array
                            
                                        // Create an unordered list
                                        var roleDisplay = $('<div><ul></ul></div>').css({
                                            'position': 'fixed',
                                            'top': '50%',
                                            'left': '78%',
                                            'transform': 'translate(-50%, -50%)',
                                            'background-color': '#fff',
                                            'padding': '20px',
                                            'border': '1px solid #000',
                                            'border-radius': '10px',
                                            'box-shadow': '0px 0px 10px rgba(0, 0, 0, 0.3)',
                                            'z-index': '9999'
                                        });
                            
                                        // Append list items for each role
                                        $.each(roleList, function(index, role) {
                                            roleDisplay.find('ul').append('<li>' + role + '</li>');
                                        });
                            
                                        // Append the list to the body
                                        $('body').append(roleDisplay);
                            
                                        // Remove the role display after a certain time
                                        setTimeout(function() {
                                            roleDisplay.remove();
                                        }, 2000); // Adjust the time (in milliseconds) as needed
                                    });
                                });
                            </script>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
