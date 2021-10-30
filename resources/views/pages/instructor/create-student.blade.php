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
                  <h3 class="box-title">Find Irregular Student</h3>
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
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php($i=1)
                              @foreach ($assign as $assign)
                                  <tr>
                                      <th scope="row">{{$i++}}</th>
                                      <td>{{$assign->username}}</td>
                                      <td>{{$assign->first_name}}</td>
                                      <td>{{$assign->middle_name}}</td>
                                      <td>{{$assign->last_name}}</td>
                                      <td>
                                          <a href="{{url('instructor/section/add-irregular/'.$sectionID.'/'.$subjectID.'/'.$assign->id)}}" data-toggle="tooltip" title="Add Irregular Student" class="btn btn-circle btn-primary text-white"><i class ="glyphicon glyphicon-plus"></i></a>
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