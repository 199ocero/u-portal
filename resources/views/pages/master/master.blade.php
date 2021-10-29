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
	<link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/skin_color.css')}}">
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
	<script src="{{asset('backend/js/vendors.min.js')}}"></script>
  <script src="{{asset('../assets/icons/feather-icons/feather.min.js')}}"></script>	
	<script src="{{asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script>
	<script src="{{asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script>
	<script src="{{asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>
	<script src="{{asset('../assets/vendor_components/datatable/datatables.min.js')}}"></script>
	<script src="{{asset('backend/js/pages/data-table.js')}}"></script>
	<script src="{{asset('backend/js/pages/jquery.toaster.js')}}"></script>
  <script src="{{asset('../assets/vendor_components/dropzone/dropzone.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<!-- Sunny Admin App -->
	<script src="{{asset('backend/js/template.js')}}"></script>
	<script src="{{asset('backend/js/pages/dashboard.js')}}"></script>
	
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

</body>
</html>
