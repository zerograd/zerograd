@extends('layout.newthemelayout')

@section('title')
	<title>Login</title>
@stop

@section('style_plugins')
	<script type="text/javascript">
		function ValidateEmail(mail)   
		{  
			 var x = mail.value;
		    var atpos = x.indexOf("@");
		    var dotpos = x.lastIndexOf(".");
		    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
		        alert("Not a valid e-mail address");
		        return false;
	    	}else{
	    		return true;
	    	}
		} 
	       function verifyLogin(){
	       	 	var email = document.getElementById('email');
	       	 	var password = document.getElementById('password');
	       	 	if(email == undefined){
	       	 		return false;
	       	 	}
	       	 	if(email.value.length == 0 ){
	       	 		alert("Please enter your email.");
	       	 	}else if(password.value.length == 0){
	       	 		alert("Please enter your password.");
	       	 	}else if(ValidateEmail(email) == true){
	       	 		var data = $("#login-form").serialize();
	       	 		$.post('{{URL::to('/student-login/login')}}'
	       	 			,data,function(data){
	       	 				if(data == "success"){
	       	 					window.location = "{{URL::to('/newtheme')}}";
	       	 				}else{
	       	 					alert('Login is invalid.Please try again.');
	       	 				}
	       	 			}
	   	 			);
	       	 	}
	       }
	</script>
@stop

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>My Account</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>My Account</li>
				</ul>
			</nav>
		</div>

	</div>
</div>


<!-- Content
================================================== -->

<!-- Container -->
<div class="container">

	<div class="my-account">

		<ul class="tabs-nav">
			<li class=""><a href="#tab1">Login</a></li>
			<li><a href="#tab2">Register</a></li>
		</ul>

		<div class="tabs-container">
			<!-- Login -->
			<div class="tab-content" id="tab1" style="display: none;">
				<form method="post" class="login" id="login-form">
                    {{csrf_field()}}
					<p class="form-row form-row-wide">
						<label for="username">Username:
							<i class="ln ln-icon-Male"></i>
							<input type="text" class="input-text" name="email" id="email" value="" />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="password">Password:
							<i class="ln ln-icon-Lock-2"></i>
							<input class="input-text" type="password" name="password" id="password"/>
						</label>
					</p>

					<p class="form-row">
						<input type="button" class="button border fw margin-top-10" name="login" value="Login" onclick="verifyLogin();" style="width:100%;" />

						<label for="rememberme" class="rememberme">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label>
					</p>

					<p class="lost_password">
						<a href="#" >Lost Your Password?</a>
					</p>
					
				</form>
			</div>

			<!-- Register -->
			<div class="tab-content" id="tab2" style="display: none;">

				<form method="post" class="register">
					
				<p class="form-row form-row-wide">
					<label for="username2">Username:
						<i class="ln ln-icon-Male"></i>
						<input type="text" class="input-text" name="username" id="username2" value="" />
					</label>
				</p>
					
				<p class="form-row form-row-wide">
					<label for="email2">Email Address:
						<i class="ln ln-icon-Mail"></i>
						<input type="text" class="input-text" name="email" id="email2" value="" />
					</label>
				</p>

				<p class="form-row form-row-wide">
					<label for="password1">Password:
						<i class="ln ln-icon-Lock-2"></i>
						<input class="input-text" type="password" name="password1" id="password1"/>
					</label>
				</p>

				<p class="form-row form-row-wide">
					<label for="password2">Repeat Password:
						<i class="ln ln-icon-Lock-2"></i>
						<input class="input-text" type="password" name="password2" id="password2"/>
					</label>
				</p>

				<p class="form-row">
					<input type="submit" class="button border fw margin-top-10" name="register" value="Register" />
				</p>

				</form>
			</div>
		</div>
	</div>
</div>

@stop

@section('script_plugins')
	<script type="text/javascript">
		$.post('',{},function(data){

		});

		@if(Session::has('message'))
			swal('{{Session::get('message')}}'); 
		@endif
	</script>
@stop