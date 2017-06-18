@extends('layout.header-layout')

@section('title')
 Student Profile
@stop

@section('styles')
	<style>
		.star {
			color:green;
			text-shadow: 3px 3px #000000;
		}
	</style>
@stop

@section('content')
	@include('nav')
	<div class="container remodal-bg">
            <div  style="margin:50px 0;height:100%;border:1px solid #354886;border-radius: 10px;padding:30px;">
                <div class="row-fluid" style="margin-top: 15px;">
                     <div class="col-sm-6" style="display:inline-block;position: relative;"> 
                        <img class="center-block img-responsive" style="float:left;width:400px;height:315px;" src="{{URL::asset('images/me.jpg')}}" alt="Profile Photo">
                        <!-- <i class="fa fa-star fa-5x star" style="position: absolute;top:-20px;right:-30px;" aria-hidden="true"></i> -->
                    </div>
                    <div class="col-sm-6" style="display:inline-block;position: relative;"> 
                        <h4 class="text-center" style="float:left; margin:0;font-weight: bold;font-size:24px;clear:both;">
                            {{$user->student_name}}
                        </h4>
                              
                        <div class="col-sm-12">
                            @if($friend != 'no')
                                <button class="btn btn-info">Connected</button>
                            @elseif(!Session::has('employer_id'))
                                <button class="btn btn-info" type="button" onClick="sendRequest();">Send Request</button>
                            @endif
                                <button class="btn btn-info"><i class="fa fa-envelope" aria-hidden="true"></i>&nbspMessage</button>

                            @if (Session::has('employer_id'))
                             <a href="{{route('preview-resume',$user->student_id)}}" target="_blank"><button class="btn btn-info" type="button"><i class="fa fa-download" aria-hidden="true"></i>&nbspDownload Resume</button></a>
                            @endif
                        </div>
                        <h3 style="margin:10px 0;float:left;font-weight: bold;width:100%;">Summary</h3>
                        <div class="col-sm-12">
                                <p style="font-weight: bold;">{{$user->summary}}<p>
                        </div>

                    </div>
                </div>
                <div class="row" style="text-align: center;">
                    <h2 class="text-center" style="display:block;margin:0 auto;font-weight: bold;"></h2>
                </div>
                <div class="row" style="text-align: center;">
                    
                </div>
                
                <div class="row" style="text-align: center;">
                    <h3 style="font-weight: bold;">Education</h3>
                    @foreach ($educations as $education)
                	<div class="col-sm-8 col-sm-offset-2">
                        <p style="font-weight: bold;">{{$education->school}}<p>
                    </div>
                    @endforeach
                </div>
                <div class="row" style="text-align: center;">
                    <h3 style="font-weight: bold;">Resume</h3>
                    <div class="col-sm-8 col-sm-offset-2">
                        <p style="font-weight: bold;"><p>
                    </div>
                </div>
                <div class="row" style="text-align: center;">
                    <h3 style="font-weight: bold;">Skills</h3>
                    @foreach ($skills as $skill)
	                	<div class="col-sm-8 col-sm-offset-2">
	                        <p style="font-weight: bold;">{{$skill->skills}}<p>
	                    </div>
                    @endforeach
                </div>
                <div class="row" style="text-align: center;">
                    <h3 style="font-weight: bold;">Projects</h3>
                    @foreach ($projects as $project)
	                	<div class="col-sm-8 col-sm-offset-2">
	                        <p style="font-weight: bold;">{{$project->project_name}}<p>
	                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <input id="user-id" type="text" value="{{$user->student_id}}" hidden>
        
        <!-- Sign Up Modal -->
<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
  <a href="{{URL::to('/')}}"><button class="remodal-close"></button></a>
    <div id="login-panel">
        <form id="register-form">
            {{ csrf_field() }}
            <h2 style="color:#29C9C8;;">Sign Up Today and View this page</h2>
            <input type="text" id="student_name" name="student_name" placeholder="Name" value=""/>
            <input type="text" id="email" name="email" placeholder="Email" value=""/>
            <input type="password" id="password" name="password" placeholder="Password" value=""/>
            
            <button type="button" class="white-btn" style="margin:0 auto;padding:15px;" onClick="verifyLogin();">Register</button>
            <div class="links col-sm-12" style="margin-top: 5px;">
                <a href="{{URL::to('/')}}" style="color:black;font-weight: 600;">Return home</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('script_plugins')
    <script type="text/javascript">
        $(document).ready(function(){
            @if(!Session::has('user') and !Session::has('employer_id'))
                var inst = $('[data-remodal-id=modal]').remodal();
                inst.open();
            @endif
        });
        function sendRequest(){
            var id = $('#user-id').val();
            $.post('{{route('student-request')}}',{id:id,_token:"{{csrf_token()}}"},function(data){
                if(data == "Login"){
                    alert('Please Login to send this request');
                }else{
                    alert('Request sent.');
                }
    
            });
        }

        function verifyLogin(){
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var name = document.getElementById('student_name');
            if(email.value.length == 0){
                alert("Please enter your email.");
                }else if(name.value.length == 0){
                alert("Please enter your name.");
            }else if(password.value.length == 0){
                alert("Please enter your password.");
            }else{
                var data = $("#register-form").serialize();
                $.post('{{URL::to('/student-register/register')}}'
                    ,data,function(data){
                        if(data == "success"){
                            window.location = "{{URL::to('/')}}";
                        }else if(data == "User Already Exist"){
                            alert('User Already Exist');
                        }
                    }
                );
            }
       }
    </script>
@stop