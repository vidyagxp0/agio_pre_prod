@extends('frontend.layout.main')
@section('container')
    {{-- ===============================================
                    DESIGNATE PROXY
    =============================================== --}}
    <div id="designate-proxy">
        <div class="container-fluid">
            <div class="head-bar">
                <div class="title">
                    Proxy Users
                </div>
                <button>Add User</button>
            </div>
            <div class="designate-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Designator name</th>
                            <th>Proxy User Name</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="group-block">
                                    <input type="text" name="name">
                                    <a href="/person-details">Info</a>
                                </div>
                            </td>
                            <td>
                                <div class="group-block">
                                    <input type="text" name="name">
                                    <a href="/person-details">Info</a>
                                </div>
                            </td>
                            <td>
                                <button class="delete"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="group-block">
                                    <input type="text" name="name">
                                    <a href="/person-details">Info</a>
                                </div>
                            </td>
                            <td>
                                <div class="group-block">
                                    <input type="text" name="name">
                                    <a href="/person-details">Info</a>
                                </div>
                            </td>
                            <td>
                                <button class="delete"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
