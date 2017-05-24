@extends('layout.header-layout')

@section('title')
	Register
@stop

@section('styles')
<style>
	body {
		background-color: #354886;
	}
	#login-panel{
		height:auto;
	}
	#register-form{
		border: 1px solid white;
		margin-top:5px;
		height:auto;
		text-align:center;
		padding:30px 10px;
		border-radius:10px;
	}
	#register-form > input {
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
		height:auto;
	}
	#logo {
		font-size:60px;
	}
	.zeroLogo{
		font-size:60px;
	}

	@media (min-width: 768px) {


	  #logo,.zeroLogo {
	    font-size:100px;
	  } 

	  #logo-panel,#register-form{
	  	margin-top:100px;
	  }
	}
</style>
@stop

@section('style_plugins')
	<script>
       function verifyLogin(){
       	 	var email = document.getElementById('company_email');
       	 	var name = document.getElementById('company_name');
       	 	if(email.value.length == 0){
       	 		alert("Please enter your email.");
       	 		}else if(name.value.length == 0){
       	 		alert("Please enter your name.");
       	 	}else{
       	 		var data = $("#register-form").serialize();
       	 		$.post('{{URL::to('/employer-register/register')}}'
       	 			,data,function(data){
       	 				if(data == "success"){
       	 					window.location = "{{URL::to('/employer-confirmation')}}";
       	 				}else if(data == "User Already Exist"){
       	 					alert('User Already Exist');
       	 				}
       	 			}
   	 			);
       	 	}
       }
	</script>
@stop

@section('content')
	<div id="logo-panel" class="col-xs-12 col-sm-8 col-sm-push-4">
		<div id="logo-div" class=" col-lg-offset-2 col-sm-offset-1  col-sm-4" style="text-align: center;">
			<h1 id="logo" class="text-xs-center" style="margin:0;">
                Zer<span class="zeroLogo">0</span>Grad
            </h1>
		</div>
	</div>
	<div id="login-panel" class="col-xs-12 col-sm-4 col-sm-pull-8">
		<form id="register-form" class="col-sm-12" >
			{{ csrf_field() }}
			<h2 style="color:#29C9C8;;">Please complete form below</h2>
			<input type="text" id="company_name" name="company_name" placeholder="Company Name" value=""/>
			<input type="text" id="company_email" name="company_email" placeholder="Email" value=""/>
			
			<button type="button" class="white-btn" style="margin:0 auto;padding:15px;" onClick="verifyLogin();">Register</button>
			<div class="links col-sm-12" style="margin-top: 5px;">
				<a href="#">Need to Contact Us?</a>
			</div>
		</form>
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