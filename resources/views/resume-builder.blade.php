@extends('layout.header-layout')

@section('title')
	Resume Builder
@stop

@section('styles')
	<style type="text/css">
		body{
			background-color: #3C9865;
			color:black;
		}
		.scroll::-webkit-scrollbar {
    		width: 12px;
		}

		.scroll::-webkit-scrollbar-track {
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
		    border-radius: 10px;
		}

		.scroll::-webkit-scrollbar-thumb {
		    border-radius: 10px;
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
		}

		.scroll::-webkit-scrollbar-corner {
			background:none;
		}

		#template-section{
			background:rgba(0,0,0,0.5);
			height:100%;
			overflow-y: hidden;
		}

		#resume-section{
			padding: 20px;
			height:100%;
		}

		#inner-resume-section-1{
			background-color: #fff;
			height:100%;
			max-height: 700px;
			overflow-y: scroll;
			box-shadow: 5px 5px 5px #000;
			padding: 0;
		}

		#logo-header{
			text-align: center;
			padding: 10px;
		}

		#logo-header img{
			margin: 0 auto;
		}

		#filter {
			text-align: center;
			color:white;
		}
		#filter > select {
			color:black;
			font-weight: bold;
		}
		#filter > select > option {
			color:black;
			font-weight: bold;
		}
		
		#inner-template-section{
			overflow-y: scroll;
			height:600px;
		}

		.template-div {
			margin:5px 0;
		}
		.template-div img {
			width:170px;
			height:153px;
		}

		.template-div:hover {
			cursor: pointer;
		}

		#resume-buttons {
			text-align: center;
			padding: 20px;
		}

		#resume-buttons button{
			margin: 0 auto;
			padding: 20px 35px;
		}

		#return {
			position: absolute;
			top:10px;
			left:10px;
			z-index: 1;
			color:white;
		}

		#return i {
			color:white;
			font-size: 48px;
		}

		#return i:hover {
			color:#c6c6c6;
		}

		/*Editing CSS*/

		.form-control {
			font-weight:bold;
		}
	</style>
@stop

@section('content')
	<div class="col-sm-3 scroll" id="template-section">
		<div id="return">
			<a href="{{URL::to('/')}}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
			<p>Return</p>
		</div>
		<div id="logo-header" class="col-sm-12">
			<img src="{{URL::asset('theme/images/logo2.png')}}" alt="Work Scout" />
		</div>
		<div class="col-sm-12 form-group" id="filter">
			<label>Choose your resume template</label>
			<select class="form-control">
				<option value="all">All</option>
				<option value="general">General</option>
				<option value="professional">Professional</option>
				<option value="artsy">Artsy</option>
			</select>
		</div>
		<div class="col-sm-12 scroll" id="inner-template-section">
			@foreach($templates as $template)
				<div class="col-sm-6 template-div {{$template->template_category}}" ng-click="postResumeTemplate({{$template->template_number}},{{$id}})">
					<img src='{{URL::asset("images/templates/$template->template_number.png")}}' class="img-responsive">
				</div>
			@endforeach

		</div>
		<div id="resume-buttons" class="col-sm-12">
			<button type="button" class="btn btn-warning"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbspHelp</button>
			<button type="button" class="btn btn-danger" ng-click="deleteResume();"><i class="fa fa-trash" aria-hidden="true"></i>&nbspDelete</button>
			<button type="button" class="btn btn-primary" ng-click="postData();"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbspSave</button>
			<a href="{{route('builder-preview',$id)}}" target="_blank"><button type="button" class="btn btn-default" ><i class="fa fa-eye" aria-hidden="true"></i>&nbspPreview</button></a>
		</div>
	</div>
	<div class="col-sm-9 scroll" id="resume-section">

		<div class="col-sm-8 col-sm-offset-2 scroll" id="inner-resume-section-1" >
			@include('templates.resume-template-' . $templateNumber)
		</div>
	</div>
@stop

 @section('script_plugins')
 	<script type="text/javascript">
 		$(document).ready(function(){
 			$('#filter select').on('change', function() {
			      var value = this.value;
			       var templateDivs = $('.template-div');
			      if(value == 'all'){

			      	templateDivs.each(function(){
			      	 var currentTemplate = $(this);
				      	 	currentTemplate.show();

				      });
			      	return;
			      }


			      //Loop through and hide all templates that don't match
			      templateDivs.each(function(){
			      	 var currentTemplate = $(this);

			      	 if(!currentTemplate.hasClass(value)){
			      	 	currentTemplate.hide();
			      	 }else{
			      	 	currentTemplate.show();
			      	 }
			      });
			})
 		});
 		

 		

 		//This will add another project line <p>
 		// function addProject(){
 		// 	var last = $('#projects p').last();
 		// 	var newProject = $("<p editable-textarea='user.project' e-cols='40' e-rows='7'><%user.project || 'Enter a project...'%></p>");

 		// 	//Insert the project after the last one
 		// 	newProject.insertAfter(last);
 		// }

 	</script>
 	<script type="text/javascript">

 		

 		app.service('templateService',function($http){
 			var template;


 		});
		app.controller('Ctrl', function($scope,$http,$compile) {
		  $scope.user = {
		  	user_id: {{$id}},
		    name: '{{$user->student_name}}',
		    title: '{{$user->title}}',
		    summary: '{{$user->summary}}',
		    projects: {!! $projects !!},
		    works:{!! $works !!},
		    skills: {!! $skills !!},
		    education:{!! $education !!},
		    phone:'{{$user->telephone_number}}',
		    email:'{{$user->email}}',
		    city: '{{$user->city}}',
		    work_delete:[]
		  };  

		  $scope.projectSize = $scope.user.projects.length;
		  $scope.workSize = $scope.user.works.length;

		  $scope.postResumeTemplate = function(number,id){

		  	$http.post('{{route('post-resume-template')}}',{number:number,id:id,_token:"{{csrf_token()}}"},{})
            .success(function (data, status, headers, config) {
                // $('#inner-resume-section-1').html(data);

                //Append Data to an element then load element to #
                // re compile using $compile
                // CAUTION : use $compile carefully
                var elem = angular.element(data);
                angular.element(document.getElementById('inner-resume-section-1')).html(elem);
                $scope.Data = data;
                $compile(elem)($scope);
            })

 			// $.post('{{route('post-resume-template')}}',{number:number,id:id,_token:"{{csrf_token()}}"},function(data){
 			// 	$('#inner-resume-section-1').html(data);
 				
 			// });
		};

		// Send user data to be updated

		$scope.postData = function(){
			var user = this.user;
			$http.post('{{route('post-data')}}',{user:user,_token:"{{csrf_token()}}"},{})
            .success(function (data, status, headers, config) {
                alert('Saved');
            });
		}

		$scope.deleteResume = function(){

			var deleted = confirm('Are you sure you want to delete this resume. (Cannot be undone)');

			if(deleted == true){
				var user = this.user.user_id;
				$http.post('{{route('delete-builder')}}',{user_id:user,_token:"{{csrf_token()}}"},{})
	            .success(function (data, status, headers, config) {
	                window.location = '{{route('resume-builder',$id)}}';
	            });
			}

			
		}

		  $scope.addProject = function(){
		  	 $scope.newProject = {
		    	name:'',
		    	id:'',
		    	role:'',
		    	info:'',
		    	start:'',
		    	completed:'',
		    	list: [''],
		    };
		    $scope.projectSize++;
		  	 $scope.user.projects.push($scope.newProject);
		  };

		  $scope.removeProject = function(){
		  	
		  	var deleteProject = confirm("Are you sure you want to delete this project?");

		  	if(deleteProject == true){
		  	 	var project =  $scope.user.projects.pop();;
		  	 	$http.post('{{route('delete-data')}}',{data:project,type:'project',_token:"{{csrf_token()}}"},{})
		            .success(function (data, status, headers, config) {
		                alert('Deleted');
		            });
		  	}else{
		  		//do nothing
		  	}
		  };

		  $scope.addWork = function(){
		  	 $scope.work = {
		    	title:'',
		    	id:'',
		    	company:'',
		    	info:'',
		    	start:'',
		    	completed:'',
		    	list:['']
		    };
		    $scope.workSize++;
		  	 $scope.user.works.push($scope.work);
		  };

		  $scope.removeWork = function(){
		  	var deleteWork = confirm("Are you sure you want to delete this work experience?");

		  	if(deleteWork == true){
		  	 	var work = $scope.user.works.pop();
		  	 	$http.post('{{route('delete-data')}}',{data:work,type:'work',_token:"{{csrf_token()}}"},{})
		            .success(function (data, status, headers, config) {
		                alert('Deleted');
		            });
		  	}else{
		  		//do nothing
		  	}
		  };

		  // If the resume has <li> for specific sections e.g. work experience
		  $scope.addListItem = function(type,index){
		  	$scope.listItem = '';

		  	if(type == 'work'){
				$scope.user.works[index].list.push($scope.listItem);
		  	}else if(type == 'project'){
		  		$scope.user.projects[index].list.push($scope.listItem);
		  	}
		  };

		  $scope.removeListItem = function(type,index){
		  	if(type == 'work'){
				$scope.user.works[index].list.pop();
		  	}else if(type == 'project'){
		  		$scope.user.projects[index].list.pop();
		  	}
		  };

		  $scope.opened = {};

	$scope.open = function($event, elementOpened) {
		$event.preventDefault();
		$event.stopPropagation();

		$scope.opened[elementOpened] = !$scope.opened[elementOpened];
	};

		  $scope.addSkill = function(){
		  	 $scope.skill = 'New Skill...';

		  	 $scope.user.skills.push($scope.skill);
		  };

		  $scope.removeSkill = function(){
		  	var deleteSkill = confirm("Are you sure you want to delete this skill?");

		  	if(deleteSkill == true){
		  		$scope.user.skills.pop();
		  	 	$http.post('{{route('delete-data')}}',{data:$scope.user.skills,type:'skills',user_id:$scope.user.user_id,_token:"{{csrf_token()}}"},{})
		            .success(function (data, status, headers, config) {
		                alert('Deleted');
		            });
		  	}else{
		  		//do nothing
		  	}
		  };
		  

		  $scope.addSchool = function(){
		  	 $scope.school = {
		  	 	id:'',
		    	degree: '',
		    	start:'',
		    	complete:'',
		    	school:''
		    };

		  	 $scope.user.education.push($scope.school);
		  };

		  $scope.removeSchool = function(){
		  	

		  	var deleteSchool = confirm("Are you sure you want to delete this school?");

		  	if(deleteSchool == true){
		  	 	var school = $scope.user.education.pop();
		  	 	$http.post('{{route('delete-data')}}',{data:school,type:'school',_token:"{{csrf_token()}}"},{})
		            .success(function (data, status, headers, config) {
		                alert('Deleted');
		            });
		  	}else{
		  		//do nothing
		  	}
		  };



		}); //end of controller

		// Datepicker UI


		</script>
 @stop

