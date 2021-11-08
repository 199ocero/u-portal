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
                <h3 class="box-title">Announcement List</h3>
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
                              <th scope="col">Section</th>
                              <th scope="col">Subject</th>
                              <th scope="col">Type</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php($i=1)
                              @php($x=0)
                              @php($y=0)
                              @foreach ($announcement as $announcement)
                                  <tr>
                                      <th scope="row">{{$i++}}</th>
                                      <td>{{$announcement->deadline->format('F j, Y')}}</td>
                                      <td>{{$announcement->deadline->format('h:i A')}}</td>
                                      <td>{{$announcement->act_title}}</td>
                                      <td>{{$announcement['section']['section']}}</td>
                                      <td>{{$announcement['subject']['subject']}}</td>
                                      @if(count($type)==0)
                                          <td><span class="badge badge-success">Regular</span></td>
                                      @elseif ($type[$x]=='Irregular')
                                          <td><span class="badge badge-info">Irregular</span></td>
                                          @php($x++)
                                      @else
                                          <td><span class="badge badge-success">Regular</span></td>
                                          @php($x++)
                                      @endif
                                      @if($status[$y]=='Complete')
                                        <td><span class="badge badge-success">Complete</span></td>
                                        <td>
                                          <a href="{{url('student/announcement/details/'.$announcement->id)}}" data-toggle="tooltip" title="View Details" class="btn btn-circle btn-info text-white"><i class ="glyphicon glyphicon-info-sign"></i></a> 
                                          <a href="{{url('student/activity/incomplete/'.$announcement->id)}}" data-toggle="tooltip" title="Incomplete Activity" class="btn btn-circle btn-danger text-white"><i class ="glyphicon glyphicon-remove"></i></a> 
                                        </td>
                                        @php($y++)
                                      @else
                                        <td><span class="badge badge-danger">Incomplete</span></td>
                                        <td>
                                          <a href="{{url('student/announcement/details/'.$announcement->id)}}" data-toggle="tooltip" title="View Details" class="btn btn-circle btn-info text-white"><i class ="glyphicon glyphicon-info-sign"></i></a> 
                                          <a href="{{url('student/activity/complete/'.$announcement->id)}}" data-toggle="tooltip" title="Complete Activity" class="btn btn-circle btn-success text-white"><i class ="glyphicon glyphicon-check"></i></a> 
                                        </td>
                                        @php($y++)
                                      @endif
                                      
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