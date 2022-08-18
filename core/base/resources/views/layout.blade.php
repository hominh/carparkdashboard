<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') | Carpark dashboard</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="/vendor/core/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/vendor/core/libraries/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/vendor/core/libraries/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="/vendor/core/css/AdminLTE.min.css">
	<link rel="stylesheet" href="/vendor/core/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/vendor/core/css/custom.css">

	<!--<link rel="stylesheet" href="/vendor/core/libraries/iCheck/all.css">!-->
	<link rel="stylesheet" href="/vendor/core/core/table/table.css">
	<link href="/vendor/core/css/select2/select2.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<script src="/vendor/core/libraries/jquery/dist/jquery.min.js"></script>
	<script src="/vendor/core/libraries/jquery-ui/jquery-ui.min.js"></script>
	<script src="/vendor/core/libraries/bootstrap/js/bootstrap.min.js"></script>
	<script src="/vendor/core/libraries/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/vendor/core/js/adminlte.min.js"></script>
	<script src="/vendor/core/js/select2/select2.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('carparkdashboard-base::partials/header')
		@include('carparkdashboard-base::partials/sidebar')
		@yield('page')
		@include('carparkdashboard-base::partials/footer')
	</div>
</body>
<script>
    $(function() {
    	getStatusConnectDeviceCenter();
    	setInterval(function(){
			getStatusConnectDeviceCenter();
		},1000 * 10);
        var url = window.location;
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).closest('.treeview').addClass('active');
        
        function getStatusConnectDeviceCenter()
        {
        	$('#status_connect_device_center').empty()
        	var url = "{{URL('params/getdatabyparamname/')}}";
			$.ajax({
				url: url,
				method: "POST",
				data:{
					"_token": "{{ csrf_token() }}",
					"name": "STATUS_DEVICE"
				},
				success: function( data ) {
					if(data == 2)
						$("#status_connect_device_center").append('<a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Kết nối</span></a>');

					else
						$("#status_connect_device_center").append('<a href="#"><i class="fa fa-circle-o text-red"></i> <span>Mất kết nối</span></a>');
				}
			});
        }

    })
</script>
</html>
