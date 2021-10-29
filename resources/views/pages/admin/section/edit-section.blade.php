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
                    <h4 class="box-title">Section</h4>
                  </div>
                  <form method="POST" action="{{url('administrator/section/update/'.$section->id)}}">
                    @csrf
                      <div class="box-body">
                        
                          <div class="form-group mb-3">
                            <label>Section</label>
                            <input type="text" class="form-control" name="section" id="section_id" placeholder="Enter Section Name" value="{{$section->section}}">
                            @error('section')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          
                      </div>
                      <div class="box-footer text-right">
                        <a href="{{route('view.administrator.section')}}" class="btn btn-rounded btn-danger btn-outline mr-1">
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