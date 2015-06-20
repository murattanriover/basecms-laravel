<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="murattanriover">
	<title>{{trans('app.app_name')}} - {{trans('app.userlogin')}}</title>

	<link href="{{asset('sbadmin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('sbadmin/assets/css/plugins/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
	<link href="{{asset('sbadmin/assets/css/sb-admin-2.css')}}" rel="stylesheet">
	<link href="{{asset('sbadmin/assets/font-awesome-4.1.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						@section('title')
						@show
					</h3>
				</div>
				<div class="panel-body">

					@yield('content')

				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{asset('sbadmin/assets/js/jquery.js')}}"></script>
<script src="{{asset('sbadmin/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('sbadmin/assets/js/plugins/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{asset('sbadmin/assets/js/sb-admin-2.js')}}"></script>

</body>
</html>