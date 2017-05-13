
@foreach($profileProjects as $project)
<form method="post">

	<div class="form-group" style="margin:10px 0;" class="entered-school">
	 
		<div class="col-sm-4"><label class="label-color">Project Name</label><input name="project_name" type="text" class="form-control" style="font-weight: bold;" value="{{$project->project_name}}"readonly></div>
		<div class="col-sm-3"><label class="label-color">Project Skills</label><input name="project_skills" type="text" class="form-control" style="font-weight: bold;" value="{{$project->project_skills}}" readonly></div>
		<div class="col-sm-2"><label class="label-color">Start</label>
			<select class="form-control label-color" style="font-weight:bold;" name="start" disabled>
				<option style="font-weight:bold;" value="2013">2013</option>
			    <option style="font-weight:bold;" value="{{$project->project_start}}" selected>{{$project->project_start}}</option>
			    <option style="font-weight:bold;" value="2011">2011</option>
			</select>
		</div>
		<div class="col-sm-2"><label class="label-color">Completed</label>
		<select class="form-control label-color" style="font-weight:bold;" name="completed" disabled>
				<option style="font-weight:bold;" value="2013">2013</option>
			    <option style="font-weight:bold;" value="{{$project->project_completed}}" selected>{{$project->project_completed}}</option>
			    <option style="font-weight:bold;" value="2011">2011</option>
			</select>
		</div>
		<div class="col-sm-11"><label class="label-color">Overview</label>
			<textarea name="project_overview" class="form-control" style="height:150px;" col="50" placeholder="" readonly>{{$project->project_overview}}</textarea>
		</div>
		<button class="edit-button btn btn-warning" style="float:left;margin-top: 20px" onClick="editProject(this);"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			<input type="text" name="project_id" value="{{$project->id}}" hidden>
			
		</div>
	</form>	
@endforeach