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
                    <h4 class="box-title">Facebook</h4>
                  </div>
                  @if($fbID=='No Facebook ID')
                    <form method="POST" action="{{route('view.facebook.add')}}">
                      @csrf
                        <div class="box-body">
                          
                            <div class="form-group mb-3">
                              <label>Facebook ID</label>
                                <input type="text" class="form-control" name="facebook_id" id="facebook_id" placeholder="Enter Facebook ID">
                                @error('facebook_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            
                        </div>
                        <div class="box-footer text-right">
                          <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
                          </button>
                      </div>  
                    </form>
                  @else
                  <form method="POST" action="{{route('view.facebook.update')}}">
                    @csrf
                      <div class="box-body">
                        
                          <div class="form-group mb-3">
                            <label>Facebook ID</label>
                                <input type="text" class="form-control" name="facebook_id" id="facebook_id" placeholder="Enter Facebook ID" value="{{$fbID->facebook_id}}">
                              
                              @error('facebook_id')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                          
                      </div>
                      <div class="box-footer text-right">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                          <i class="fa fa-repeat"></i> Update
                        </button>
                    </div>  
                  </form>
                  @endif
                  
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