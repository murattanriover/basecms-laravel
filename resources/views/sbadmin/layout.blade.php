<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="murattanriover">
	<title>
		@section('title')
		@show
	</title>
	<link href="{{asset('sbadmin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('sbadmin/assets/css/plugins.css')}}" rel="stylesheet">
	<link href="{{asset('sbadmin/assets/js/plugins/jquery-notific8/jquery.notific8.min.css')}}" rel="stylesheet" type="text/css"/>

	<link href="{{asset('sbadmin/assets/css/plugins/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
	<link href="{{asset('sbadmin/assets/js/plugins/data-tables/DT_bootstrap.css')}}" rel="stylesheet"/>
	<link href="{{asset('sbadmin/assets/css/sb-admin-2.css')}}" rel="stylesheet">
	<link href="{{asset('sbadmin/assets/font-awesome-4.1.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

	@section('head')
	@show

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

<div id="wrapper">

	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{url('')}}">{{trans('app.app_name')}}</a>
		</div>
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">

			{{-- @include('sbadmin/partial/inc_navs') --}}

			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i>
					@if(Auth::check())
						{{Auth::user()->name}} {{Auth::user()->surname}}
					@endif
					<i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li><a href="{{url('settings/users/data/profile')}}"><i class="fa fa-gear fa-fw"></i> {{trans('app.profile')}}</a></li>
					<li class="divider"></li>
					<li><a href="{{url('auth/logout')}}"><i class="fa fa-sign-out fa-fw"></i> {{trans('app.logout')}}</a></li>
				</ul>
				<!-- /.dropdown-user -->

			</li>
			<!-- /.dropdown -->
		</ul>
		<!-- /.navbar-top-links -->


		@include('sbadmin/partial/inc_nav_menu')


		<!-- /.navbar-static-side -->

	</nav>

	<!-- Page Content -->
	<div id="page-wrapper">

		@include('sbadmin/partial/inc_error')

		@yield('content')


	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script type="text/javascript">
	var BASE = '{{url("")}}';
	var CURRENT_LANG = '{{App::getLocale()}}';
	var LANG = {
		sureDelete : "{{trans('are_you_sure_want_to_delete')}}",
		successful : "{{trans('successful')}}",
		an_error_occured : "{{trans('an_error_occured')}}",
		error : "{{trans('error')}}"
	};
</script>
<script src="{{asset('sbadmin/assets/js/jquery.js')}}"></script>
<script src="{{asset('sbadmin/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('sbadmin/assets/js/plugins/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{asset('sbadmin/assets/js/plugins/jquery-notific8/jquery.notific8.min.js')}}"></script>
<script type="text/javascript" src="{{asset('sbadmin/assets/js/plugins/bootbox/bootbox.min.js')}}"></script>
<script type="text/javascript" src="{{asset('sbadmin/assets/js/plugins/data-tables/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('sbadmin/assets/js/plugins/data-tables/DT_bootstrap.js')}}"></script>
<script src="{{asset('sbadmin/assets/js/sb-admin-2.js')}}"></script>
<script src="{{asset('sbadmin/assets/js/mtcms.js')}}"></script>

@section('footer')
@show

@if (Session::has('custom_success'))
	<script type="text/javascript">MT.showNotification("","{{ Session::get('custom_success') }}","lime")</script>
@endif

@if (Session::has('custom_error'))
	<script type="text/javascript">MT.showNotification("","{{ Session::get('custom_error') }}","ruby")</script>
@endif

@section('footer2')
@show

</body>

</html>