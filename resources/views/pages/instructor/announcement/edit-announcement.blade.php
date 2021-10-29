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
                    <h4 class="box-title">Announcement</h4>
                  </div>
                  <!-- /.box-header -->
                  <form method="POST" action="{{url('instructor/announcement/update/'.$announcement->section_id.'/'.$announcement->subject_id.'/'.$announcement->id)}}">
                    @csrf
                     
                      <div class="box-body">
                        <div class="form-group mb-3">
                            <label>Due Date</label>
                            <input class="form-control" type="datetime-local" id="deadline" name="deadline" value="{{$announcement->deadline->format('Y-m-d\TH:i:s')}}">
                            @error('deadline')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                       </div>
                       <div class="form-group mb-3">
                            <label>Activity Title</label>
                            <input type="text" class="form-control" name="act_title" id="act_title" placeholder="Enter Activity Title" value="{{$announcement->act_title}}">
                            @error('act_title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                      </div>
                      <div class="form-group mb-3">
                            <label>Activity Instruction</label>
                            <textarea name="instruction" id="instruction" class="form-control" placeholder="Enter Instructions">{{$announcement->instruction}}</textarea>
                            @error('instruction')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                      </div>
                      <div class="form-group mb-3">
                            <label>Activity Resources</label>
                            <input type="text" class="form-control" name="resources" id="resources" placeholder="Paste Activity Link" value="{{$announcement->resources}}">
                            @error('resources')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                      
                    </div>
                      <!-- /.box-body -->
                      <div class="box-footer text-right">
                          <a href="{{url('instructor/announcement/view/'.$announcement->section_id.'/'.$announcement->subject_id)}}" class="btn btn-rounded btn-danger btn-outline mr-1">
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