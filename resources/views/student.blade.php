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
            <div  style="margin:50px 0;height:100%;border:1px solid #354886;border-radius: 10px;padding:10px;">
                <div class="row" style="margin-top: 15px;text-align: center;">
                    <div style="display:inline-block;text-align: center;position: relative;"> 
                    	<img class="center-block img-responsive" style="width:400px;height:315px;" src="{{URL::asset('images/me.jpg')}}" alt="Profile Photo">
                    	<i class="fa fa-star fa-5x star" style="position: absolute;top:-20px;right:-30px;" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="row" style="text-align: center;">
                    <h2 class="text-center" style="display:block;margin:0 auto;font-weight: bold;"></h2>
                </div>
                <div class="row" style="text-align: center;">
                    <h4 class="text-center" style="display:block;margin:0 auto;font-weight: bold;">
                    	{{$user->student_name}}
                    </h4>
                </div>
                <div class="row" style="text-align: center;">
                    <h3 style="font-weight: bold;">Summary</h3>
                    <div class="col-sm-8 col-sm-offset-2">
                        <p style="font-weight: bold;">{{$user->summary}}<p>
                    </div>
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
@stop