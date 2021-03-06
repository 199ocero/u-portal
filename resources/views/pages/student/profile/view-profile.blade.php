@extends('pages.master.master')
@section('index')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-black">
                      <h5>User Type: Student</h5>
                      <a href="{{route('view.profile.edit.student')}}" class="btn btn-primary float-right"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>
                    </div>
                    <div class="widget-user-image">
                      <img class="rounded-circle" src="{{asset('backend/images/user3-128x128.jpg')}}" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="description-block">
                            <h5 class="description-header">First Name</h5>
                            <span class="description-text">{{$user->first_name}}</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 br-1 bl-1">
                          <div class="description-block">
                            <h5 class="description-header">Middle Name</h5>
                            <span class="description-text">{{$user->middle_name}}</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                          <div class="description-block">
                            <h5 class="description-header">Last Name</h5>
                            <span class="description-text">{{$user->last_name}}</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    
                </div>
                <div class="box">
                  <div class="box-body box-profile">            
                    <div class="row">
                      <div class="col-12">
                          <div>
                              <p>Email :<span class="text-gray pl-10">{{$user->email}}</span></p>
                              <p>Phone :<span class="text-gray pl-10">+11 123 456 7890</span></p>
                              <p>Address :<span class="text-gray pl-10">123, Lorem Ipsum, Florida, USA</span></p>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="pb-15">						
                              <p class="mb-10">Social Profile:</p>
                              <div class="user-social-acount">
                                  <button class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></button>
                                  <button class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></button>
                                  <button class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></button>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
              </div>
            </div>
            
            
            
            
        </div>
        
        
      </section>
      <!-- /.content -->
    
    </div>
</div>
<!-- /.content-wrapper -->
@endsection