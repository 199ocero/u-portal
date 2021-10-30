@extends('pages.master.master')
@section('index')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <form method="POST" action="{{route('view.add.section')}}" enctype="multipart/form-data">
              @csrf
              <div class="box">
                <div class="box-header">					
                  <h4 class="box-title">Import Excel File</h4>
                  <button type="submit" class="btn btn-primary float-right" type="button" disabled><i class="glyphicon glyphicon-upload"></i> Upload</button>
                  <h6 class="box-subtitle">You can register section with students via <strong class="text-warning">excel file.</strong></h6>
                </div>
                <div class="box-body">
                  <label>Section</label>
                  <div class="row">
                    
                    <div class="col-md-6">
                      
                      <input type="text" class="form-control" name="section" id="section" placeholder="Enter Section Name">
                      @error('section')
                        <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="file_id">
                        <label class="custom-file-label text-white" for="customFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </form>
            
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
                          <th scope="col">Section Name</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @php($i=1)
                          @foreach ($studentSection as $studentSection)
                              <tr>
                                  <th scope="row">{{$i++}}</th>
                                  <td>{{$studentSection['section']['section']}}</td>
                                  <td>
                                      <a href="{{url('administrator/section/edit/'.$studentSection['section']['id'])}}" data-toggle="tooltip" title="Edit Section" class="btn btn-circle btn-primary text-white"><i class ="glyphicon glyphicon-edit"></i></a>
                                      <a href="{{url('administrator/section/delete/'.$studentSection['section']['id'])}}" id="delete" data-toggle="tooltip" title="Delete Section" class="btn btn-circle btn-danger text-white"><i class ="glyphicon glyphicon-trash"></i></a>
                                      <a href="{{url('administrator/section/details/'.$studentSection['section']['id'])}}" data-toggle="tooltip" title="View Student" class="btn btn-circle btn-info text-white"><i class ="glyphicon glyphicon-info-sign"></i></a>
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