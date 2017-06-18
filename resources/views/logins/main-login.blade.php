@extends('layout.header-layout')

@section('title')
	Login
@stop

@section('styles')
<style>
	body {
		background-color: #354886;
	}
	.login-panel{
		height:auto;
	}
	#login-form{
		border: 1px solid white;
		margin-top:5px;
		height:auto;
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
	#logo {
		font-size:60px;
	}
	.zeroLogo{
		font-size:60px;
	}

	

	
</style>
@stop

@section('style_plugins')

{{ HTML::style('css/login-responsive.css') }}
	<script>
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
       	 					window.location = "{{URL::to('/student/home')}}";
       	 				}else{
       	 					alert('Login is invalid.Please try again.');
       	 				}
       	 			}
   	 			);
       	 	}
       }
       function verifyEmployerLogin(){
       	 	var email = document.getElementById('company_email');
       	 	if(email == undefined){
       	 		return false;
       	 	}
       	 	if(email.value.length == 0){
       	 		alert("Please enter your email.");
       	 	
       	 	}else if(ValidateEmail(email) == true){
       	 		var data = $("#login-form").serialize();
       	 		$.post('{{URL::to('/employer-login/login')}}'
       	 			,data,function(data){
       	 				if(data == "success"){
       	 					window.location = "{{URL::to('/employer/home')}}";
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
		<div id="buttons" class="col-xs-12">
			<div class="button-div"   onCLick="showSchoolForm();">
				<span>
					<i class="fa fa-graduation-cap" aria-hidden="true"></i>
					<h1>Student/Graduate</h1>
				</span>
			</div>
			<div class="button-div"  onCLick="showEmployerForm();">
				<span>
					<i class="fa fa-building" aria-hidden="true"></i>
					<h1>Employers</h1>
				</span>
			</div>
			<div class="button-div" onCLick="showEmployeeForm();">
				<span>
					<i class="fa fa-briefcase" aria-hidden="true"></i>
					<h1>Employees</h1>
				</span>
			</div>
		</div>
		<div class="login-panel col-xs-12 col-sm-8 col-sm-push-4" style="display:none;">
			<div id="logo-div" class=" col-lg-offset-2 col-sm-offset-1  col-sm-4" style="text-align: center;">
				<h1 id="logo" class="text-xs-center" style="margin:0;">
	                Zer<span class="zeroLogo">0</span>Grad
	            </h1>
			</div>
		</div>
		<div class="login-panel col-xs-12 col-sm-4 col-sm-pull-8" style="display: none;">
			
		</div>
	
	
@stop

@section('script_plugins')
	<script type="text/javascript">
		$(document).ready(function(){
			$(this).keypress(function(event){
				if(event.keyCode == 13 ){
					verifyLogin();
					verifyEmployerLogin();
				}
			});
		});

		function showSchoolForm(){

			$.get('{{URL::to('/student-form')}}',function(data){
				$('#buttons').fadeOut(300,function(){
					$('.login-panel').eq(1).html(data);
					$('.login-panel').css('display','block');
				});
				
			});
		}
		function showEmployerForm(){

			$.get('{{URL::to('/employer-form')}}',function(data){
				$('#buttons').fadeOut(300,function(){
					$('.login-panel').eq(1).html(data);
					$('.login-panel').css('display','block');
				});
				
			});
			
		}
		function showEmployeeForm(){
			
		}
	</script>
@stop