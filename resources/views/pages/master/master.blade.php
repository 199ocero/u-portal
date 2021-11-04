<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('backend/images/favicon.ico')}}">

    <title>UPortal - Dashboard</title>
    
	<!-- Vendors Style-->
    
	<link rel="stylesheet" href="{{asset('backend/css/vendors_css.css')}}">
	  
	<!-- Style-->  
	{{-- <link rel="stylesheet" href="{{asset('backend/css/style.css')}}"> --}}
	<link rel="stylesheet" href="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635982104/style_pybnl1.css">
	<link rel="stylesheet" href="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635983960/style_nipgtx.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

  @include('pages.master.body.header')
  
  <!-- Left side column. contains the logo and sidebar -->
  @include('pages.master.body.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('index')
  <!-- /.content-wrapper -->
  @include('pages.master.body.footer')

  <!-- /.control-sidebar -->
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
  	
	
	<!-- Vendor JS -->
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984016/vendors.min_ojuln1.js"></script>
  <script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984069/feather.min_xc9e92.js"></script>	
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984117/jquery.easypiechart_hjd3ur.js"></script>
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984192/irregular-data-series_bsil3o.js"></script>
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984238/apexcharts_uvxq7u.js"></script>
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984290/datatables.min_xvszw9.js"></script>
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984317/data-table_sutbvh.js"></script>
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984348/jquery.toaster_lf6mgn.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<!-- Sunny Admin App -->
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984375/template_s3xdpf.js"></script>
	<script src="https://res.cloudinary.com/dv4dyq4ca/raw/upload/v1635984392/dashboard_f614qy.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<script>
    @if(Session::has('success'))

      $.toaster("{{Session::get('success')}}",'Success','success');
        
    @elseif(Session::has('danger'))
      $.toaster("{{Session::get('danger')}}",'Fail','danger');
    @endif
  </script>
  <script>
    $('#file_id').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    $('input[type=file]').change(function(){
        if($('input[type=file]').val()==''){
            $('button').attr('disabled',true)
        } 
        else{
        $('button').attr('disabled',false);
        }
    });
</script>
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
  </script>
  <script>
    $(function(){
      $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = link
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
          })



      });
    });
  </script>
</body>
</html>
