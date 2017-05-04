@extends('layout.header-layout')

@section('title')
	Login
@stop

@section('styles')
<style>
	body {
		background-color: #354886;
	}
	#login-panel{
		height:100%;
	}
	#login-form{
		border: 1px solid white;
		margin-top:100px;
		height:350px;
		text-align:center;
		padding:30px 10px;
		border-radius:10px;
	}
	#login-form > input {
		padding:10px;
		margin:10px 0;
		width:100%;
    	color: #354886;
    	margin-top: 20px;
    	font-weight: bold;
    	font-family: 'Raleway', sans-serif;
	}
	.links > a {
		color:white;
	}
	#logo-panel {
		height:100%;
	}
	#logo {
		font-size:100px;
	}
	.zeroLogo{
		font-size:100px;
	}
</style>
@stop

@section('style_plugins')
	<script>
       function verifyLogin(){
       	 	var email = document.getElementById('email');
       	 	var password = document.getElementById('password');
       	 	if(email.value.length == 0){
       	 		alert("Please enter your email.");
       	 	}else if(password.value.length == 0){
       	 		alert("Please enter your password.");
       	 	}else{
       	 		var data = $("#login-form").serialize();
       	 		$.post('{{URL::to('/student-login/login')}}'
       	 			,data,function(data){
       	 				if(data == "success"){
       	 					window.location = "{{URL::to('/student/home')}}";
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
	<div id="login-panel" class="col-sm-4">
		<form id="login-form" class="col-sm-12" >
			{{ csrf_field() }}
			<h2 style="color:#29C9C8;;">Please login in below</h2>
			<input type="text" id="email" name="email" placeholder="Email" value=""/>
			<input type="password" id="password" name="password" placeholder="Password" value=""/>
			<button type="button" class="white-btn" style="margin:0 auto;padding:15px;" onClick="verifyLogin();">Login</button>
			<div class="links col-sm-12" style="margin-top: 5px;">
				<a href="#">Forgot Password?</a>
				<a href="#">Need to Contact Us?</a>
			</div>
		</form>
	</div>
	<div id="logo-panel" class="col-sm-8">
		<div id="logo-div" class="col-sm-offset-3 col-sm-4" style="margin-top:180px;">
			<h1 id="logo" class="text-xs-center" style="margin:0;">
                Zer<span class="zeroLogo">0</span>Grad
            </h1>
		</div>
	</div>
@stop

@section('script_plugins')
	<script type="text/javascript">
		$(document).ready(function(){
			$(this).keypress(function(event){
				if(event.keyCode == 13 ){
					verifyLogin();
				}
			});
		});
	</script>
@stop