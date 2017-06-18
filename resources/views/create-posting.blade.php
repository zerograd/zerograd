@extends('layout.homepage-layout')

@section('title')
	Home
@stop

@section('styles')
	<style>

		#recent-search-panel{
			height:auto;
			background-color: white;
			border-top:5px solid #133BB6;
			margin:10px 0;
			padding:5px;
		}
		#recent-search-panel h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}
		#recent-search-panel h4{
			margin:10px 0;
			color:black;
			font-weight:500;
			text-align: center;
		}

		
		
		#profile-completion{
			height:auto;
			background-color: #16a085;
			border-top:5px solid #13B662;
			margin:10px 0;
			padding: 5px;

		}

		#searches {
			height:auto;
			background-color: white;
			border-top:5px solid #108EE3;
			margin:10px 0;
			padding: 5px;
			min-height: 200px;
		}

		#searches h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}

		#opportunities {
			height:auto;
			background-color: white;
			border-top:5px solid #E34010;
			margin:10px 0;
			padding: 5px;
			min-height: 200px;
		}

		#opportunities h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}
		#opportunities p {
			color:black;
			font-weight: bold;
		}

		#profile-completion h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}

		#profile-completion > div{
			margin:10px;
		}


		@media (max-width: 768px) {
			h2{
				font-size:24px;
			}
		}

		#searches p {
			color:black;
			font-weight: bold;
		}

		label,input,textarea {
			color:black;
			font-weight: bold;
		}

		input,select,textarea,.input-group {
			margin-bottom: 40px;
		}

		select,option {
			color:black;
			font-weight: bold;
		}
	</style>
@stop

@section('style_plugins')
	{{ HTML::style('css/employer-home-responsive.css') }}
@stop

@section('content')
	
		@include('homepages.employer-panel')
		<div class="col-lg-9 col-xs-12" id="main-area">
			@include('layout.employer-main-layout')
			<div class="container-fluid">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12">
					<div id="posting" class="col-sm-12 col-xs-12">
					<form id="create-post" action="{{route('create-posting')}}" method="POST">
					{{csrf_field()}}
						<h2>Create a Posting</h2>
						<div class="form-group">
							<label>Job Title&nbsp(*)</label>
							<input type="text" name="title" id="title" class="form-control"/>
							<label>Description&nbsp(*)</label>
							<textarea name="description" id="description" col="50" class="form-control"></textarea>
							<label>Location <span style="color:grey;">(Optional)</span></label>
							<input type="text" name="location" id="location" class="form-control"/>
							<label>Category</label>
							<select name="cat_id" class="form-control">
								@foreach($categories as $category)
								<option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
								@endforeach
							</select>
							<label>Status&nbsp(*)</label>
							<select name="status" class="form-control">
								<option value="Full-time">Full-Time</option>
								<option value="Part-time">Part-Time</option>
								<option value="Contract">Full-Time</option>
								<option value="Not Specified">Not Specified</option>
							</select>
							
							<div class="form-group">
									<label>Keywords</label>
									<div class="input-group col-sm-12" id="skills-group-div">
										<input class="form-control" name="skill" id="skill" type="text" placeholder="Enter keywords here...(Press space key after each keyword)" />
										<div id="posting-skill-container" class="container-fluid">
									
										</div>
									</div>
								</div>
							<label>Required Experience&nbsp(*)</label>
							<select name="required_experience" class="form-control">
								<option value="1">1 year</option>
								<option value="2">2 years</option>
								<option value="3">3 years</option>
							</select>
							<label>Salary</label>
							<input type="text" name="salary" id="salary" class="form-control"/>
							<label>Show Salary</label>
							<label class="custom-control custom-radio">
							  <input id="radio1" name="showSalary" type="radio" class="custom-control-input" value="yes">
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description">Yes</span>
							</label>
							<label class="custom-control custom-radio">
							  <input id="radio2" name="showSalary" type="radio" class="custom-control-input" value="no">
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description">No</span>
							</label>
						</div>
						<div class="col-sm-12" style="padding:10px;">
							<button class="btn btn-info" style="float:right;" type="button" onClick="createPost();">Create Posting</button>
						</div>
	                    <input type="text" name="keywords" id="skills" value="" hidden>
						@if(Session::has('employer_id'))
						<input type="text" name="company_id" value="{{Session::get('employer_id')}}" hidden>
						@endif
					</form>
					</div>
				</div>
			</div>
		</div>
		<input id="employer-id" type="text" value="{{$id}}" hidden>
@stop

@section('script_plugins')

	<script>
	$(document).ready(function(){
			
			$('#skill').keypress(function(event){
				if(event.keyCode == 32){
					var currentSkill = $(this).val();
					if(currentSkill.length > 0){
						var skillContainer = $('#posting-skill-container');
						$('#skills').val($('#skills').val() + ',' + currentSkill);
						var button = $('<button class="btn btn-info" style="margin: 5px 0;" onClick="removeSkill(this);">'+ currentSkill +'&nbsp<i class="fa fa-times-circle" aria-hidden="true"></i></button>"');
						skillContainer.append(button);
						$('#skill').val('');
					}
					
				}else{

				}
			});

		});

		function removeSkill(skill){
			$(skill).remove();
		}
	 function saveSkills(){
			var id = $('#profile-id').val();
			var buttons = $('#posting-skill-container button');
			var skills = [];
			buttons.each(function(){
				skills.push($(this).text().trim());
			});

			var data = {
				_token: $('{{ csrf_field()}}').val(),
				id:id,
				skills:skills
			};
			$.post('{{route('skills-save')}}',data,function(data){
				console.log(data);
			});
		}

		function createPost(){
			var formData = $('#create-post').serialize();
			$.post('{{route('create-posting')}}',formData,function(data){

			});
		}
	
	</script>
@stop