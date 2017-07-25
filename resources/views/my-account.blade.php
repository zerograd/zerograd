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
	       	 					alert(data);
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
						<a data-remodal-target="modal" href="#">Lost Your Password?</a>
					</p>
					
				</form>
			</div>

			<!-- Register -->
			<div class="tab-content" id="tab2" style="display: none;">
				<form id="register-form" action="{{URL::to('/student-register/register')}}" method="post" class="register">
					{{csrf_field()}}

				<p class="form-row form-row-wide">
					<label for="student_name">Name:
						<i class="ln ln-icon-Add-User"></i>					
				<input type="text" id="student_name" name="student_name"  value=""/>
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
					<input type="button" class="button border fw margin-top-10"  onClick="verifyRegister();" value="Register" />
				</p>

				</form>
			</div>
		</div>
	</div>
</div>

<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false">
  <button data-remodal-action="close" class="remodal-close"></button>
    <div id="password-panel">
        <form id="password-form">
            {{ csrf_field() }}
            <h2 style="color:#29C9C8;;">Enter your email below to receive a password reset key</h2>
            <input type="email" placeholder="Email" name="email">
            <button type="button" onClick="sendPasswordReset();">Send Key</button>
        </form>
        <form id="new-password-form">
        	{{csrf_field()}}
        	<input type="text" placeholder="Enter Password Reset Key" name="passwordReset" id="passwordReset">
        	<input type="text" placeholder="New Password" name="password" id="password">
        	<button type="button" onClick="resetPassword();">Change Password</button>
        </form>

        <div class="notification notice closeable margin-bottom-40" id="password-change-notify" style="display:none;">
			Password Changed
		</div>
    </div>
</div>

@stop

@section('script_plugins')
	<script type="text/javascript">
		function verifyRegister(){
       	 	var email = document.getElementById('email2');
       	 	var password = document.getElementById('password1');
       	 	var password2 = document.getElementById('password2');
       	 	var name = document.getElementById('student_name');
       	 	if(email.value.length == 0){
       	 		alert("Please enter your email.");
       	 		}else if(name.value.length == 0){
       	 		alert("Please enter your name.");
       	 	}else if(password.value.length == 0){
       	 		alert("Please enter your password.");
       	 	}else if(password == password2){
       	 		alert("Passwords do not match.");
       	 	}else{
       	 		$("#register-form").submit();
       	 		
       	 	}
       }

       function sendPasswordReset(){
       		var data = $('#password-form').serialize();
       		data += '&_token=' + "{{csrf_token()}}";
       		$.post('{{route('password-reset')}}',data,function(data){

       		});
       }

       function resetPassword(){
       		var data = $('#new-password-form').serialize();
       		data += '&_token=' + "{{csrf_token()}}";
       		data += '&student=' + "student";
       		$.post('{{route('new-password')}}',data,function(data){
       			$('#password-change-notify').show();
       			$('#password-change-notify').text(data);
       		});
       }

       @if(Session::has('password_match'))
			swal('{{Session::get('password_match')}}'); 
		@endif
       @if(Session::has('user_exists'))
			swal('{{Session::get('user_exists')}}'); 
		@endif
		@if(Session::has('message'))
			swal('{{Session::get('message')}}'); 
		@endif
		@if(Session::has('verified'))
			swal('{{Session::get('verified')}}'); 
		@endif
	</script>
@stop