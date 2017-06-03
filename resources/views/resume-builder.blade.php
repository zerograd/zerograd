@extends('layout.header-layout')

@section('title')
	Resume Builder
@stop

@section('styles')
	<style type="text/css">
		body{
			background-color: #656D8A;
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
		input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: #000000;
		  font-weight: bold;
		}
		input,textarea {
			color:black;
			font-weight: bold;
		}

		.selectedResume {
			border:5px solid #F4B825;
		}
	</style>
@stop

@section('content')
	<div class="container-fluid" style="height:100%;">
			<div class="row-fluid" style="height:100%;padding: 30px;">
				<div id="resume-info" class="scroll col-sm-6" style="border:1px solid white;border-radius:3px;height:90%;overflow-y: scroll;background-color: white;padding: 2%">
					<div id="resume" class="" style="width:95%;height:100%;border-radius: 5px;padding:10px;">
							<form id="resume-form">
									<h2>Resume</h2>
									<label class="label-color">A resume is the best tool for sharing your skills and knowledge with future employers. Please upload your own or click 'Resume Builder' to use our Resume building tool.</label>
									<div class="form-group">
										
										<div class="col-sm-4">
											<label>Street Address</label>
											<input name="address" type="text" placeholder="Street Address" class="form-control" value="{{$resume->address}}">
										</div>
										<div class="col-sm-4">
											<label>City</label>
											<input name="city" type="text" placeholder="City" class="form-control" value="{{$resume->city}}">
										</div>
										<div class="col-sm-4">
											<label>Province/State</label>
											<input name="state" type="text" placeholder="Province/State" class="form-control" value="{{$resume->state}}">
										</div>
										<div class="col-sm-4">
											<label>Postal Code</label>
											<input name="zipcode" type="text" placeholder="Postal Code/Zip Code" class="form-control" value="{{$resume->zipcode}}">
										</div>
										<div class="col-sm-4">
											<label>Telephone</label>
											<input name="telephone_number" type="text" placeholder="Telephone Number" class="form-control" value="{{$resume->telephone_number}}" >
										</div>
										<div class="col-sm-4"></div>
										<div class="col-sm-6">
											<label>Objective</label>
											<textarea col="50" style="height:150px;"  name="objective" class="form-control" placeholder="Talk about the type of job you are looking for.">{{$resume->objective}}</textarea>
										</div>
										<div class="col-sm-6">
											<label>Summary</label>
											<textarea col="50" style="height:150px;" name="summary" class="form-control" placeholder="A brief description of who you are and your skills">{{$resume->summary}}</textarea>
										</div>

									</div>
							</form>
										<div class="col-sm-12">
											<label>Work Experience</label>
											<div class="form-group" id="work-div">
												@include('profiles.work-experience');
												<div class="col-sm-12 label-color" style="font-weight: bold;margin-top: 10px;">
													Add a Job...
													<i class="fa fa-plus label-color" aria-hidden="true" style="cursor: pointer" onClick="addExperience();"></i>
													&nbsp<i class="fa fa-minus label-color" aria-hidden="true" style="cursor: pointer" onClick="removeExperience();"></i>
												</div>
											</div>
										</div>

										<div class="col-sm-12">
												<label>Volunteer Work</label>
												<div class="form-group" id="volunteer-div">
													@include('profiles.volunteer');
													<div class="col-sm-12 label-color" style="font-weight: bold;margin-top: 10px;">
														Add a Volunteer...
														<i class="fa fa-plus label-color" aria-hidden="true" style="cursor: pointer" onClick="addVolunteer();"></i>
														&nbsp<i class="fa fa-minus label-color" aria-hidden="true" style="cursor: pointer" onClick="removeVolunteer();"></i>
													</div>
												</div>
												<div class="col-sm-12" style="">
													<button type="button" style="margin: 10px;float:right;color:black;font-weight: bold;" class="btn btn-secondary" onClick="saveResume();">Save</button>
													<a href="{{route('preview-resume',$id)}}" target="_blank"><button style="margin: 10px;float:right;color:black;font-weight: bold;" class="btn btn-secondary">Download as PDF</button></a>
												</div>
										</div>
											
										
					</div>
				</div>
				<div id="resume-view"  class="col-sm-6" style="border:1px solid white;border-radius:3px;height:90%;">
				<iframe id="resume-iframe" class="scroll" style="background-color:white;width: 100%;height:100%;">
					
				</iframe>
				</div>
			</div>

			<!-- Resume div Selector -->
			<div id="resume-selector" class="col-sm-12 scroll" style="position:absolute; z-index: 1;bottom:0;background: rgba(0,0,0,0.8);height:300px;overflow-x: scroll;padding:5px;">
				<div id="close-div" class="col-sm-12">
					<button class="hideselector btn btn-danger" style="float:right;" type="button" onClick="shrink(this);">Close</button>
					<button class="showselector btn btn-success" style="display:none;float:right;" type="button" onClick="show(this);">Show</button>

				</div>
				<div class="col-sm-12" style="margin:5px;">
					
					<h3 style="margin:0;color:white;font-weight: bold;">Choose a Resume</h3>
					
				</div>
				<?php $counter = 1;?>
				@foreach($snaps as $snap)
				<div class="col-sm-1" style="padding:0;margin:10px;" onClick="processResume(this);">
					<img src="{{$snap}}" class="snapimg img-responsive">
					<input type="text" value="{{$counter}}" hidden>
				</div>
					<?php $counter++;?>
				@endforeach
			</div>
	</div>
	<input type="text" id="profile-id" name="id" value="{{$id}}" hidden />
@stop

 @section('script_plugins')
 	<script type="text/javascript">
 		function shrink(button){
            var parent = $(button).parent();
            var showButton = parent.find('.showselector');
            $( "#resume-selector" ).animate({
			    height: 80
			  }, 100);

            $(button).hide();
            showButton.show();
 		}
 		function show(button){
            var parent = $(button).parent();
            var hideButton = parent.find('.hideselector');
            $( "#resume-selector" ).animate({
			    height: 300
			  }, 100);
            $(button).hide();
            hideButton.show();
 		}
 		function processResume(div){
 			if(div === undefined){
 				$.post('{{route('process-resume')}}',{id:$('#profile-id').val(),_token:"{{csrf_token()}}",template:1},function(data){
		 			var doc = document.getElementById('resume-iframe').contentWindow.document;
		 			$('.snapimg').eq(0).addClass('selectedResume');
		 			$('.snapimg').eq(0).siblings().removeClass('selectedResume');
					doc.open();
					doc.write(data);
					doc.close();
	 			});
	 			return false;
 			}
 			var inputValue = $(div).find('input').val();
 			if(inputValue == 1){
 				$.post('{{route('process-resume')}}',{id:$('#profile-id').val(),_token:"{{csrf_token()}}",template:1},function(data){
		 			var doc = document.getElementById('resume-iframe').contentWindow.document;
		 			$('.snapimg').removeClass('selectedResume');
		 			$('.snapimg').eq(0).addClass('selectedResume');
		 			
					doc.open();
					doc.write(data);
					doc.close();
	 			});
 			}else if (inputValue == 2){
 				$.post('{{route('process-resume')}}',{id:$('#profile-id').val(),_token:"{{csrf_token()}}",template:2},function(data){
	 			var doc = document.getElementById('resume-iframe').contentWindow.document;
	 			$('.snapimg').removeClass('selectedResume');
	 			$('.snapimg').eq(1).addClass('selectedResume');
	 			doc.open();
				doc.write(data);
				doc.close();
 			});
 			}
 		}
 	$(document).ready(function(){
 		processResume();

 		$('input').keyup(function(){
 			saveResume();
 			processResume();
 		})
 	});

 		function saveResume(){
			var form = $('#resume-form').serialize() + "&user_id=" + $('#profile-id').val() + "&_token=" + "{{csrf_token()}}";
			$.post('{{route('save-top-resume')}}',form,function(data){
				processResume();
			});

		}

		// setInterval(saveResume,3000);

		function addExperience(){
			var schoolDiv = $('#work-div');
			var form = $('<form method="post">{{csrf_token()}}</form>');
			var formGroup = $('<div class="form-group new-experience" style="margin:10px 0;"></div>');
			var schoolInput = $('<div class="col-sm-4"><label class="label-color">Company Name</label><input type="text" class="form-control" name="company_name"></div>');
			var startSelect = $('<div class="col-sm-2"><label class="label-color">Started</label>'+ 
				'<select class="form-control" name="start"><option style="font-weight:bold;"  value="2013">2013</option></select>'
			 + '</div>');
			var endSelect = $('<div class="col-sm-2"><label class="label-color">Completed</label>'+ '<select name="completed" class="form-control label-color"><option style="font-weight:bold;" value="2013">2013</option></select>'+ '</div>');
			var programInput = $('<div class="col-sm-3"><label class="label-color">Job Title</label><input type="text" class="form-control label-color" name="job_title"></div>');
			var textArea = $('<div class="col-sm-11"><label class="label-color">Duties</label><textarea class="form-control" style="height:150px;" col="50" placeholder="" name="duties"></textarea></div>')
			@if(Session::has('user_id'))
				var user_id = $('<input type="text" class="form-control label-color" name="user_id" value="{{Session::get('user_id')}}" style="visibility:hidden;">');
			@endif
			var saveButton = $('<button class="save-button btn btn-success" style="float:left;margin-top: 20px" onClick="updateExperience(this);"><i class="fa fa-check" aria-hidden="true"></i></button>');
			formGroup.append(schoolInput);
			formGroup.append(programInput);
			formGroup.append(startSelect);
			formGroup.append(endSelect);
			formGroup.append(textArea);
			
			formGroup.append(saveButton);
			formGroup.append(user_id);
			form.append(formGroup);
			schoolDiv.append(form);
		}
		function removeExperience(){
			var div = $('.new-experience').last().remove();
		}

		function editExperience(editButton){
			var button = $(editButton);
			var divGroup = button.parent();
			var inputs = divGroup.find('input');

			var selects =divGroup.find('select');
			var textareas = divGroup.find('textarea');

			inputs.each(function(){
				$(this).removeAttr( 'readonly' );
			});
			selects.each(function(){
				$(this).removeAttr( 'disabled' );
			});
			textareas.each(function(){
				$(this).removeAttr( 'readonly' );
			});

			button.replaceWith('<button class="save-button btn btn-success" style="float:left;margin-top: 20px" onClick="updateExperience(this);"><i class="fa fa-check" aria-hidden="true"></i></button>');
		}

		function updateExperience(updateButton){
			var button = $(updateButton);
			var divGroup = button.parent();
			var formSerialized = divGroup.parent().serialize() + '&_token=' + "{{csrf_token()}}";
			$.post('{{route('update-work')}}',formSerialized,function(data){
				alert('Refresh Page to see latest changes');
			});
			var inputs = divGroup.find('input');
			var textareas = divGroup.find('textarea');

			var selects =divGroup.find('select');
			inputs.each(function(){
				$(this).attr( 'readonly','readonly'  );
			});
			selects.each(function(){
				$(this).attr( 'disabled' , 'disabled' );
			});
			textareas.each(function(){
				$(this).attr( 'readonly' , 'readonly' );
			});
			button.replaceWith('<button class="edit-button btn btn-warning" style="float:left;margin-top: 20px" onClick="editExperience(this);"><i class="fa fa-pencil" aria-hidden="true"></i></button>');
		}

		function addVolunteer(){
			var schoolDiv = $('#volunteer-div');
			var form = $('<form method="post">{{csrf_token()}}</form>');
			var formGroup = $('<div class="form-group new-volunteer" style="margin:10px 0;"></div>');
			var schoolInput = $('<div class="col-sm-4"><label class="label-color">Volunteer Name</label><input type="text" class="form-control" name="volunteer_name"></div>');
			var startSelect = $('<div class="col-sm-2"><label class="label-color">Started</label>'+ 
				'<select class="form-control" name="start"><option style="font-weight:bold;"  value="2013">2013</option></select>'
			 + '</div>');
			var endSelect = $('<div class="col-sm-2"><label class="label-color">Completed</label>'+ '<select name="completed" class="form-control label-color"><option style="font-weight:bold;" value="2013">2013</option></select>'+ '</div>');
			var programInput = $('<div class="col-sm-3"><label class="label-color">Job Title</label><input type="text" class="form-control label-color" name="job_title"></div>');
			var textArea = $('<div class="col-sm-11"><label class="label-color">Duties</label><textarea class="form-control" style="height:150px;" col="50" placeholder="" name="duties"></textarea></div>')
			@if(Session::has('user_id'))
				var user_id = $('<input type="text" class="form-control label-color" name="user_id" value="{{Session::get('user_id')}}" style="visibility:hidden;">');
			@endif
			var saveButton = $('<button class="save-button btn btn-success" style="float:left;margin-top: 20px" onClick="updateVolunteer(this);"><i class="fa fa-check" aria-hidden="true"></i></button>');
			formGroup.append(schoolInput);
			formGroup.append(programInput);
			formGroup.append(startSelect);
			formGroup.append(endSelect);
			formGroup.append(textArea);
			
			formGroup.append(saveButton);
			formGroup.append(user_id);
			form.append(formGroup);
			schoolDiv.append(form);
		}
		function removeVolunteer(){
			var div = $('.new-volunteer').last().remove();
		}
		function editVolunteer(editButton){
			var button = $(editButton);
			var divGroup = button.parent();
			var inputs = divGroup.find('input');

			var selects =divGroup.find('select');
			var textareas = divGroup.find('textarea');

			inputs.each(function(){
				$(this).removeAttr( 'readonly' );
			});
			selects.each(function(){
				$(this).removeAttr( 'disabled' );
			});
			textareas.each(function(){
				$(this).removeAttr( 'readonly' );
			});

			button.replaceWith('<button class="save-button btn btn-success" style="float:left;margin-top: 20px" onClick="updateVolunteer(this);"><i class="fa fa-check" aria-hidden="true"></i></button>');
		}

		function updateVolunteer(updateButton){
			var button = $(updateButton);
			var divGroup = button.parent();
			var formSerialized = divGroup.parent().serialize() + '&_token=' + "{{csrf_token()}}";
			$.post('{{route('update-volunteer')}}',formSerialized,function(data){
				alert('Refresh Page to see latest changes');
			});
			var inputs = divGroup.find('input');
			var textareas = divGroup.find('textarea');

			var selects =divGroup.find('select');
			inputs.each(function(){
				$(this).attr( 'readonly','readonly'  );
			});
			selects.each(function(){
				$(this).attr( 'disabled' , 'disabled' );
			});
			textareas.each(function(){
				$(this).attr( 'readonly' , 'readonly' );
			});
			button.replaceWith('<button class="edit-button btn btn-warning" style="float:left;margin-top: 20px" onClick="editVolunteer(this);"><i class="fa fa-pencil" aria-hidden="true"></i></button>');
		}

		$('.delete-experience-button').click(function(event){
			if(confirm('Are you sure you want to delete this Work Experience?')){
				event.preventDefault();
				var div = $(this).parent();
				var form = $(this).parent().parent().serialize() + '&_token=' + "{{csrf_token()}}";
				$.post('{{route('experience-delete')}}',form,function(data){
					console.log('Deleted');
					div.remove();
					div.parent().remove();
				});
			}
		});
		$('.delete-volunteer-button').click(function(event){
			if(confirm('Are you sure you want to delete this Volunteer Experience?')){
				event.preventDefault();
				var div = $(this).parent();
				var form = $(this).parent().parent().serialize() + '&_token=' + "{{csrf_token()}}";
				$.post('{{route('volunteer-delete')}}',form,function(data){
					console.log('Deleted');
					div.remove();
					div.parent().remove();
				});
			}
		});
 	</script>
 @stop