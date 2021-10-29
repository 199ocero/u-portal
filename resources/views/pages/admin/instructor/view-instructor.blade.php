@extends('pages.master.master')
@section('index')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <form method="POST" action="{{url('administrator/instructor/excel')}}" enctype="multipart/form-data">
              @csrf
              <div class="box">
                <div class="box-header">					
                  <h4 class="box-title">Import Excel File</h4>
                  <button type="submit" class="btn btn-primary float-right" type="button" disabled><i class="glyphicon glyphicon-upload"></i> Upload</button>
                  <h6 class="box-subtitle">You can register instructors via <strong class="text-warning">excel file.</strong></h6>
                </div>
                <div class="box-body">
                  <div class="col-lg-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="file" id="file_id">
                      <label class="custom-file-label text-white" for="customFile">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            
           <div class="box">
              <div class="box-header with-border">
                  <h3 class="box-title">Instructor Accounts</h3>
                  <a href="{{route('view.instructor.add')}}" class="btn btn-primary float-right"><i class="glyphicon glyphicon-plus"></i> Add Instructor</a>
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
                            @foreach ($instructor as $instructor)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$instructor->username}}</td>
                                    <td>{{$instructor->first_name}}</td>
                                    <td>{{$instructor->middle_name}}</td>
                                    <td>{{$instructor->last_name}}</td>
                                    <td>{{$instructor->email}}</td>
                                    <td>{{$instructor->created_at->format('m-d-Y')}}</td>
                                    <td style="white-space: nowrap;width:1%">
                                        <a href="{{url('administrator/instructor/edit/'.$instructor->id)}}" class="btn btn-circle btn-primary text-white"><i class ="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{url('administrator/instructor/delete/'.$instructor->id)}}" class="btn btn-circle btn-danger text-white"><i class ="glyphicon glyphicon-trash"></i></a>
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