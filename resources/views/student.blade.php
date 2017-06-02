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
	<div class="container">
            <div  style="margin:50px 0;height:100%;border:1px solid #354886;border-radius: 10px;padding:30px;">
                <div class="row-fluid" style="margin-top: 15px;">
                 @if(!Session::has('user_id'))
                    <div class="col-sm-6" style="display:inline-block;position: relative;"> 
                    	<img class="center-block img-responsive" style="float:left;width:400px;height:315px;" src="{{URL::asset('images/me.jpg')}}" alt="Profile Photo">
                    	<!-- <i class="fa fa-star fa-5x star" style="position: absolute;top:-20px;right:-30px;" aria-hidden="true"></i> -->
                    </div>
                    <div class="col-sm-6" style="display:inline-block;position: relative;"> 
                        <h4 class="text-center" style="float:left; margin:0;font-weight: bold;font-size:24px;clear:both;">
                            {{$user->student_name}}
                        </h4>
                    </div>
                    <h3 style="margin:10px 0;float:left;font-weight: bold;width:100%;">Please login to view the rest of this content.</h3>
                     </div>
                </div>
                </div>
                @else
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
                            @else
                                <button class="btn btn-info" type="button" onClick="sendRequest();">Send Request</button>
                            @endif
                                <button class="btn btn-info"><i class="fa fa-envelope" aria-hidden="true"></i>&nbspMessage</button>
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
        @endif
@stop

@section('script_plugins')
    <script type="text/javascript">
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
    </script>
@stop