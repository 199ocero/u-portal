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
                <h3 class="box-title">Announcement Details</h3>
            </div>
              <!-- /.box-header -->
              <div class="box-body">
                <p><strong class="text-warning">Section:</strong> {{$announcement['section']['section']}}</p>
                <p><strong class="text-warning">Subject:</strong> {{$announcement['subject']['subject']}}</p>
                <p><strong class="text-warning">Date:</strong> {{$announcement->deadline->format('F j, Y')}}</p>
                <p><strong class="text-warning">Time:</strong> {{$announcement->deadline->format('h:i A')}}</p>
                <p><strong class="text-warning">Activity Title:</strong> {{$announcement->act_title}}</p>
                <p><strong class="text-warning">Instruction:</strong></p>
                <p>{!!nl2br($announcement->instruction)!!}</p>
                <p><strong class="text-warning">Activity Link/Resources:</strong> <a href="{{$announcement->resources}}" target="_blank">{{$announcement->resources}}</a></p>
                <div class="form-group d-flex justify-content-end align-items-baseline">
                    <a href="{{url('student/announcement/view/')}}" class="btn btn-danger text-white">Back</a>
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