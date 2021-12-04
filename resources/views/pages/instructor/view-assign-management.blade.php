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
                    <h3 class="box-title">Assign Section to Subject</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('view.add.instructor.section.subject')}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Section</label>
                                    <select class="selectpicker section form-control" name="section_id" data-live-search="true" title="Select Section">
                                     @foreach($section as $section)
                                          <option value="{{$section->id}}">{{$section->section}}</option>
                                      @endforeach
                                    </select>
                                    @error('section_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Subject</label>
                                <select class="selectpicker subject form-control" name="subject_id" data-live-search="true" title="Select Subject">
                                   @foreach($subject as $subject)
                                        <option value="{{$subject->id}}">{{$subject->subject}}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary text-white btn-block">Assign</button>
                            </div>   
                        </div>
                        
                    </form>
                </div>
            </div>
            
           <div class="box">
              <div class="box-header with-border">
                  <h3 class="box-title">Section List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Subject</th>
                              <th scope="col">Section</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php($i=1)
                              @foreach ($assign as $assign)
                                  <tr>
                                      <th scope="row">{{$i++}}</th>
                                      <td>{{$assign['subject']['subject']}}</td>
                                      <td>
                                          
                                          <a href="{{url('instructor/assign/section-subject/details/'.$assign->section_id.'/'.$assign['subject']['id'])}}" class="btn btn-primary text-white">{{$assign['section']['section']}}</a>  
                                      </td>
                                      <td>
                                          <a href="{{url('instructor/announcement/view/'.$assign->section_id.'/'.$assign->subject_id)}}" data-toggle="tooltip" title="View Announcement" class="btn btn-circle btn-info text-white"><i class ="glyphicon glyphicon-envelope"></i></a>
                                          <a href="{{url('instructor/assign/section-subject/delete/'.$assign->id.'/'.$assign->section_id.'/'.$assign->subject_id)}}" id="delete" data-toggle="tooltip" title="Delete Section and Subject" class="btn btn-circle btn-danger text-white"><i class ="glyphicon glyphicon-trash"></i></a>
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