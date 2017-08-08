@extends('layout.newthemelayout')

@section('title')
	<title>ZeroGrad: Settings</title>
@stop


@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container remodal-bg">
		<div class="ten columns">
			<h2>Settings&nbsp</h2>
		</div>

		<div class="six columns">
			
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container remodal-bg">
	
	<!-- Info -->
	<div class="eleven columns">
	<div class="padding-right">
		<form id="account-info" action="{{route('update-personal-info')}}" method="POST">
				{{csrf_field()}}

			<!-- Change name -->
			<div class="form-group">
				<h3>Personal Info</h3>
					<label>Change Your Name.</label>
					<input type="text" name="student_name" value="{{Session::get('student_name')}}" class="form-control"> 

			</div>
			<!-- Change email  -->
			<div class="form-group">
				
					<label>Change the email associated with your account.</label>
					<input type="email" name="email" value="{{Session::get('email')}}" class="form-control"> 

			</div>
			
			<button type="submit" class="btn btn-success" style="float:right;">Update Info</button>
		</form>
		<form id="change-password-form" action="{{route('update-password')}}" method="POST">
				{{csrf_field()}}

			<!-- Change Password -->
			<div class="form-group" style="margin-top: 50px;">
				<h3>Password</h3>
					<label>Change Your Name.</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required> 
					<input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm Password" required> 
			</div>
			
			<button type="submit" class="btn btn-success" style="float:right;">Update Password</button>
		</form>
	</div>
	</div>




	


</div>


@stop

@section('script_plugins')

<!-- Angular code for this page -->
	<script type="text/javascript">

	$(document).ready(function(){
		@if(Session::has('info_updated'))
			swal(
				  'Good job!',
				  "{{Session::get('info_updated')}}",
				  'success'
				);
		@endif

		@if(Session::has('password_update'))
			swal(
				  'Good job!',
				  "{{Session::get('password_update')}}",
				  'success'
				);
		@endif

		@if(Session::has('password_match'))
				swal(
			      'Error',
			      "Passwords do not match",
			      'error'
			    )
		@endif
	});
		
		
		
	</script>
@stop