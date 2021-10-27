@extends('layouts.app')

@section('superadmin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin List</div>

                <div class="card-body">
                    <div class="mb-2">
                        <a href="" class="btn btn-primary text-white">Add Admin</a>
                    </div>
                    <table class="table table-sm table-bordered" id="admin_table_id" data-search="true" data-toggle="table" data-pagination="true">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach ($admin as $admin)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$admin->username}}</td>
                                    <td>{{$admin->first_name}}</td>
                                    <td>{{$admin->middle_name}}</td>
                                    <td>{{$admin->last_name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->created_at->format('m-d-Y')}}</td>
                                    <td style="white-space: nowrap;width:1%">
                                        <a href="" class="btn btn-primary btn-sm text-white">Edit</a>
                                        <a href="" class="btn btn-danger btn-sm text-white">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    
</div>


@endsection


