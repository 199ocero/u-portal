@extends('pages.master.master')
@section('index')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="box">
                  <div class="box-header with-border">
                    <h4 class="box-title">Instructor Credentials</h4>
                  </div>
                  <!-- /.box-header -->
                  <form method="POST" action="{{route('view.profile.update.instructor')}}">
                      @csrf
                      <input type="hidden" id="role_id" class="role_id form-control" type="text" name="role_id" value="instructor"/>
                      <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Username</label>
                              <input type="text" class="form-control" name="username" id="username_id" placeholder="Enter Username" value="{{$instructor->username}}">
                              @error('username')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" value="{{$instructor->first_name}}">
                                @error('first_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Enter Middle Name" value="{{$instructor->middle_name}}">
                                @error('middle_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{$instructor->last_name}}">
                                @error('last_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" :value="old('email')" placeholder="Enter Email" value="{{$instructor->email}}">
                                @error('email')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer text-right">
                          <a href="{{route('view.profile.instructor')}}" class="btn btn-rounded btn-danger btn-outline mr-1">
                            <i class="ti-trash"></i> Cancel
                          </a>
                          <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
                          </button>
                      </div>  
                  </form>
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