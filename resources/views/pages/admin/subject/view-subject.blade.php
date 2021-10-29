@extends('pages.master.master')
@section('index')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <form method="POST" action="{{url('administrator/subject/excel')}}" enctype="multipart/form-data">
                @csrf
                <div class="box">
                  <div class="box-header">					
                    <h4 class="box-title">Import Excel File</h4>
                    <button type="submit" class="btn btn-primary float-right" type="button" disabled><i class="glyphicon glyphicon-upload"></i> Upload</button>
                    <h6 class="box-subtitle">You can register subjects via <strong class="text-warning">excel file.</strong></h6>
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
                  <h3 class="box-title">Subject List</h3>
                  <a href="{{route('view.add.view.subject')}}" class="btn btn-primary float-right"><i class="glyphicon glyphicon-plus"></i> Add Subject</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Subject Name</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php($i=1)
                              @foreach ($subject as $subject)
                                  <tr>
                                      <th scope="row">{{$i++}}</th>
                                      <td>{{$subject->subject}}</td>
                                      <td>
                                          <a href="{{url('administrator/subject/edit/'.$subject->id)}}" class="btn btn-circle btn-primary text-white"><i class ="glyphicon glyphicon-edit"></i></a>
                                          <a href="{{url('administrator/subject/delete/'.$subject->id)}}" class="btn btn-circle btn-danger text-white"><i class ="glyphicon glyphicon-trash"></i></a>
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