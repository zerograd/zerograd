@extends('layout.admin-layout')

@section('title')
	Admin-Home
@stop

@section('content')
	<div id="login-panel" class="panel login-panel" style="background-color:#16a085;">
			<p><i class="fa fa-users" aria-hidden="true"></i></p>
			<h3>ZeroGrad</h3>			
			<form id="login-form" action="{{route('admin-login')}}" method="POST">
				{{csrf_field()}}
				<div class="form-group">
					<input type="email" name="email" id="email" required class="form-control" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control" required placeholder="Password">
				</div>
				<div class="col-sm-12" style="text-align: center;">
					<a style="text-decoration: none;color:black;"><button type="submit"  class="btn btn-default">Login&nbsp<i class="fa fa-sign-in" aria-hidden="true"></i></button></a>
				</div>
			</form>
	</div>
@stop

@section('script_plugins')
	<script type="text/javascript">
		$(document).ready(function(){
			@if(Session::has('adminlogin_invalid'))
				swal(
			      'Error',
			      "Login is Invalid. Try Again",
			      'error'
			    )
			@endif
			@if(Session::has('please_login'))
				swal("{{Session::get('please_login')}}");
			@endif
		});
	</script>
@stop