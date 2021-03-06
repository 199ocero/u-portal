@extends('pages.master.master')
@section('index')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            
           <div class="box">
              <div class="box-header with-border">
                  <h3 class="box-title">Admin Accounts</h3>
                  <a href="{{route('view.super.administrator.add')}}" class="btn btn-primary float-right"><i class="glyphicon glyphicon-plus"></i> Add Admin</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
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
                                        <a href="{{url('super/administrator/edit/'.$admin->id)}}" class="btn btn-circle btn-primary text-white"><i class ="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{url('super/administrator/delete/'.$admin->id)}}" id="delete" class="btn btn-circle btn-danger text-white"><i class ="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                  </table>
                  </div>              
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>
<!-- /.content-wrapper -->
@endsection