@extends('layout.homepage-layout')

@section('title')
	Profile
@stop

@section('styles')
	<style>
		#profile{
			height:auto;
			background-color: white;
			margin:0 50px;
			padding:5px;
		}
		.panel-name{
			display:inline-block;
			background-color: white;
			border-top:5px solid #13B662;
			margin:0 50px;
			margin-top: 10px;
			padding:5px 25px;
		}
		.panel-name h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}

		.active {
			display:block;
		}
		 h2 {
		 	color:black;
		 }
		 .label-color{
		 	color:black;
		 }
 
 		.scroll::-webkit-scrollbar {
            width: 10px;
        }
         
        .scroll::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 1px rgba(0,0,0,0.3);
        }
         
        .scroll::-webkit-scrollbar-thumb {
          background: rgba(224,224,224,0.8);
          outline: 1px solid slategrey;
        }

        label {
        	color:black;
        	margin-top:10px;
        }
        input,textarea {
        	color:black;
        	font-weight: bold;
        }

        textarea {
        	height:200px;
        }
	</style>
@stop

@section('style_plugins')
	<script type="text/javascript">
		function changeActive(id){
			var currentActive = $('.active');
			currentActive.removeClass('active');
			currentActive.hide();
			$('#' + id).addClass('active');
			if(id == 'education'){
				$('#add-school-div').addClass('active');
				$('#add-school-div').show();
			}
			$('#' + id).show();
		}
	</script>
@stop

@section('content')
	@include('layout.main-layout')
		<div id="container" class="scroll" style="height:90%;overflow-y: scroll;">
			<div class="col-sm-12 scroll">	
				<div class="panel-name">
					<h2>Profile</h2>
				</div>	
				<div id="profile" class="col-sm-11">
					<div class="row" style="padding:5px;text-align: center;" id="profile-buttons">
						<button class="btn btn-primary" onClick="changeActive('summary');">Summary</button>
						<button class="btn btn-success" onClick="changeActive('education');">Education</button>
						<button class="btn btn-info" onClick="changeActive('resume');">Resume</button>
						<button class="btn btn-warning" onClick="changeActive('skills');">Skills</button>
						<button class="btn btn-danger" onClick="changeActive('projects');">Projects</button>
					</div>
					<!-- SUMMARY -->
					<div class="row">
						<div id="summary" class="active" style="width:95%;margin:0 2.5%;height:100%;border-radius: 5px;padding:10px;">
							<h2>Summary</h2>
							<div class="form-group">
								<label class="label-color">A summary should always provide always answer the following: Who you are ? What have you done?In addition, it should show a bit of what makes you different from others.</label>
								<textarea col="50" class="form-control" style="height:200px;">{!!$profileSummary->summary!!}</textarea>
							</div>
						</div>
					</div>
					<!-- EDUCATION -->
					<div class="row">
						<div id="education" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border-radius: 5px;padding:10px;">
							<h2>Education</h2>
							<div class="form-group" id="school-div">
								<label class="label-color">Education is important! Tell others where you went and what you took. Maybe even mention that you are an alnumi.</label>
								@include('profiles.education');
								
							</div>
							<div id="add-school-div" class="col-sm-12 label-color" style="display:none;font-weight: bold;margin-top: 10px;">
									Add a School...
									<i class="fa fa-plus label-color" aria-hidden="true" style="cursor: pointer" onClick="addSchool();"></i>
									&nbsp<i class="fa fa-minus label-color" aria-hidden="true" style="cursor: pointer" onClick="removeSchool();"></i>
								</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
@stop

@section('script_plugins')


	<script type="text/javascript">
		$(document).ready(function(){
			$('#current-skill').keypress(function(event){
				if(event.keyCode == 32 || event.keyCode == 13){
					var currentSkill = $(this).val();
					if(currentSkill.length > 0){
						var skillContainer = $('#resume-skill-container');
						var button = $('<button class="btn btn-info" style="margin: 5px 0;" onClick="removeSkill(this);">'+ currentSkill +'&nbsp<i class="fa fa-times-circle" aria-hidden="true"></i></button>"');
						skillContainer.append(button);
						$('#current-skill').val('');
					}
					
				}
			});
			

			$('#skill').keypress(function(event){
				if(event.keyCode == 32 || event.keyCode == 13){
					var currentSkill = $(this).val();
					if(currentSkill.length > 0){
						var skillContainer = $('#profile-skill-container');
						var button = $('<button class="btn btn-info" style="margin: 5px 0;" onClick="removeSkill(this);">'+ currentSkill +'&nbsp<i class="fa fa-times-circle" aria-hidden="true"></i></button>"');
						skillContainer.append(button);
						$('#skill').val('');
					}
					
				}
			});

		});

		function removeSkill(skill){
			$(skill).remove();
		}

		
		var startString = '<select class="form-control label-color" style="font-weight:bold;" name="birth-year">\
		<option style="font-weight:bold;" value="Present">Present</option>\
    <option style="font-weight:bold;" value="2013">2013</option>\
    <option style="font-weight:bold;" value="2012">2012</option>\
    <option style="font-weight:bold;" value="2011">2011</option>\
    <option style="font-weight:bold;" value="2010">2010</option>\
    <option style="font-weight:bold;" value="2009">2009</option>\
    <option style="font-weight:bold;" value="2008">2008</option>\
    <option style="font-weight:bold;" value="2007">2007</option>\
    <option style="font-weight:bold;" value="2006">2006</option>\
    <option style="font-weight:bold;" value="2005">2005</option>\
    <option style="font-weight:bold;" value="2004">2004</option>\
    <option style="font-weight:bold;" value="2003">2003</option>\
    <option style="font-weight:bold;" value="2002">2002</option>\
    <option style="font-weight:bold;" value="2001">2001</option>\
    <option style="font-weight:bold;" value="2000">2000</option>\
    <option style="font-weight:bold;" value="1999">1999</option>\
    <option style="font-weight:bold;" value="1998">1998</option>\
    <option style="font-weight:bold;" value="1997">1997</option>\
    <option style="font-weight:bold;" value="1996">1996</option>\
    <option style="font-weight:bold;" value="1995">1995</option>\
    <option style="font-weight:bold;" value="1994">1994</option>\
    <option style="font-weight:bold;" value="1993">1993</option>\
</select>';

	var endString  = '<select class="form-control label-color" style="font-weight:bold;" name="birth-year">\
		<option style="font-weight:bold;" value="Present">Present</option>\
    <option style="font-weight:bold;" value="2013">2013</option>\
    <option style="font-weight:bold;" value="2012">2012</option>\
    <option style="font-weight:bold;" value="2011">2011</option>\
    <option style="font-weight:bold;" value="2010">2010</option>\
    <option style="font-weight:bold;" value="2009">2009</option>\
    <option style="font-weight:bold;" value="2008">2008</option>\
    <option style="font-weight:bold;" value="2007">2007</option>\
    <option style="font-weight:bold;" value="2006">2006</option>\
    <option style="font-weight:bold;" value="2005">2005</option>\
    <option style="font-weight:bold;" value="2004">2004</option>\
    <option style="font-weight:bold;" value="2003">2003</option>\
    <option style="font-weight:bold;" value="2002">2002</option>\
    <option style="font-weight:bold;" value="2001">2001</option>\
    <option style="font-weight:bold;" value="2000">2000</option>\
    <option style="font-weight:bold;" value="1999">1999</option>\
    <option style="font-weight:bold;" value="1998">1998</option>\
    <option style="font-weight:bold;" value="1997">1997</option>\
    <option style="font-weight:bold;" value="1996">1996</option>\
    <option style="font-weight:bold;" value="1995">1995</option>\
    <option style="font-weight:bold;" value="1994">1994</option>\
    <option style="font-weight:bold;" value="1993">1993</option>\
</select>';
		

		function addSchool(){
			var schoolDiv = $('#school-div');
			var lastSchoolDiv = $('.entered-school').last();
			var formGroup = $('<div class="form-group new-school entered-school" style="margin:10px 0;"></div>');
			var schoolInput = $('<div class="col-sm-4"><label class="label-color">School</label><input type="text" class="form-control"></div>');
			var startSelect = $('<div class="col-sm-2"><label class="label-color">Start Year</label>'+ startString + '</div>');
			var endSelect = $('<div class="col-sm-2"><label class="label-color">Graduation Year</label>'+ endString + '</div>');
			var programInput = $('<div class="col-sm-3"><label class="label-color">Program</label><input type="text" class="form-control"></div>');
			var saveButton = $('<button class="save-button btn btn-success" style="float:left;margin-top: 20px"><i class="fa fa-check" aria-hidden="true"></i></button>');
			formGroup.append(schoolInput);
			formGroup.append(programInput);
			formGroup.append(startSelect);
			formGroup.append(endSelect);
			formGroup.append(saveButton);
			formGroup.insertAfter(lastSchoolDiv);
		}
		function updateSchool(updateButton){
			var button = $(updateButton);
			var divGroup = button.parent();
			var inputs = divGroup.find('input');

			var selects =divGroup.find('select');
			inputs.each(function(){
				$(this).attr( 'readonly','readonly'  );
			});
			selects.each(function(){
				$(this).attr( 'disabled' , 'disabled' );
			});
			button.replaceWith('<button class="edit-button btn btn-warning" style="float:left;margin-top: 20px" onClick="editSchool(this);"><i class="fa fa-pencil" aria-hidden="true"></i></button>');
		}
		function editSchool(editButton){
			var button = $(editButton);
			var divGroup = button.parent();
			var inputs = divGroup.find('input');

			var selects =divGroup.find('select');
			inputs.each(function(){
				$(this).removeAttr( 'readonly' );
			});
			selects.each(function(){
				$(this).removeAttr( 'disabled' );
			});
			button.replaceWith('<button class="save-button btn btn-success" style="float:left;margin-top: 20px" onClick="updateSchool(this);"><i class="fa fa-check" aria-hidden="true"></i></button>');
		}
		
		function removeSchool(){
			var div = $('.new-school').last().remove();
		}

		function addProject(){
			var schoolDiv = $('#projects-div');
			var formGroup = $('<div class="form-group new-project" style="margin:10px 0;"></div>');
			var schoolInput = $('<div class="col-sm-4"><label class="label-color">Project Name</label><input type="text" class="form-control"></div>');
			var startSelect = $('<div class="col-sm-2"><label class="label-color">Start</label>'+ startString + '</div>');
			var endSelect = $('<div class="col-sm-2"><label class="label-color">Completed</label>'+ endString + '</div>');
			var programInput = $('<div class="col-sm-3"><label class="label-color">Project Skills</label><input type="text" class="form-control"></div>');
			var textArea = $('<div class="col-sm-11"><label class="label-color">Overview</label><textarea class="form-control" style="height:150px;" col="50" placeholder="" readonly></textarea></div>')
			var saveButton = $('<button class="save-button btn btn-success" style="float:left;margin-top: 20px"><i class="fa fa-check" aria-hidden="true"></i></button>');
			formGroup.append(schoolInput);
			formGroup.append(programInput);
			formGroup.append(startSelect);
			formGroup.append(endSelect);
			formGroup.append(textArea);
			formGroup.append(saveButton);
			schoolDiv.append(formGroup);
		}
		function updateProject(updateButton){
			var button = $(updateButton);
			var divGroup = button.parent();
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
			button.replaceWith('<button class="edit-button btn btn-warning" style="float:left;margin-top: 20px" onClick="editProject(this);"><i class="fa fa-pencil" aria-hidden="true"></i></button>');
		}
		function editProject(editButton){
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

			button.replaceWith('<button class="save-button btn btn-success" style="float:left;margin-top: 20px" onClick="updateProject(this);"><i class="fa fa-check" aria-hidden="true"></i></button>');
		}
		
		function removeProject(){
			var div = $('#projects-div .new-project').last().remove();
		}
	</script>
@stop