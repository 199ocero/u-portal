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
                <h3 class="box-title">{{$section->section}} - {{$subject->subject}}</h3>
                <a href="{{url('instructor/announcement/add/view/'.$section_id.'/'.$subject_id)}}" class="btn btn-primary float-right"><i class="glyphicon glyphicon-plus"></i> Add Announcement</a>
            </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Date</th>
                              <th scope="col">Time</th>
                              <th scope="col">Activity Title</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php($i=1)
                              @foreach ($announcement as $announcement)
                                  <tr>
                                      <th scope="row">{{$i++}}</th>
                                      <td>{{$announcement->deadline->format('F j, Y')}}</td>
                                      <td>{{$announcement->deadline->format('h:i A')}}</td>
                                      <td>{{$announcement->act_title}}</td>
                                      <td>
                                        <a href="{{url('instructor/announcement/edit/'.$announcement->id)}}" data-toggle="tooltip" title="Edit Announcement" class="btn btn-circle btn-primary text-white"><i class ="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{url('instructor/announcement/delete/'.$section_id.'/'.$subject_id.'/'.$announcement->id)}}" id="delete" data-toggle="tooltip" title="Delete Announcement" class="btn btn-circle btn-danger text-white"><i class ="glyphicon glyphicon-trash"></i></a>
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