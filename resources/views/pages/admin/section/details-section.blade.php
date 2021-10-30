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
                  <h3 class="box-title">Student Assigned in this Section - {{$section['section']}}</h3>
                  <a href="{{url('administrator/section/add/student/'.$section->id)}}" class="btn btn-primary float-right"><i class="glyphicon glyphicon-plus"></i> Add Student</a>
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
                              <th scope="col">Created</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php($i=1)
                              @php($x=0)
                              @foreach ($assign as $assign)
                                  <tr>
                                      <th scope="row">{{$i++}}</th>
                                      <td>{{$assign['student']['username']}}</td>
                                      <td>{{$assign['student']['first_name']}}</td>
                                      <td>{{$assign['student']['middle_name']}}</td>
                                      <td>{{$assign['student']['last_name']}}</td>
                                      <td>{{$assign['student']['created_at']->format('m-d-Y')}}</td>
  
                                      @if($status[$x]=='Regular')
                                          <td><span class="badge badge-success">Regular</span></td>
                                          @php($x++)
                                      @elseif($status[$x]=='Drop')
                                          <td><span class="badge badge-danger">Drop</span></td>
                                          @php($x++)
                                      @else
                                          <td><span class="badge badge-info">Irregular</span></td>
                                          @php($x++)
                                      @endif
                                      <td>
                                        <a href="{{url('administrator/section/edit-student/'.$assign['student']['id'])}}" data-toggle="tooltip" title="Edit Student" class="btn btn-circle btn-primary text-white"><i class ="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{url('administrator/section/delete-student/'.$assign['student']['id'])}}" id="delete" data-toggle="tooltip" title="Delete Student" class="btn btn-circle btn-danger text-white"><i class ="glyphicon glyphicon-trash"></i></a>
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