@foreach($volunteering as $volunteer)
<form>
	<div class="form-group" style="margin:10px 0;" class="entered-school">
		<div class="col-sm-4"><label class="label-color">Volunteer Name</label><input type="text" class="form-control" style="font-weight: bold;" value="{{$volunteer->volunteer_name}}" name="volunteer_name" readonly></div>
		<div class="col-sm-3"><label class="label-color">Job Title</label><input type="text" class="form-control" style="font-weight: bold;" value="{{$volunteer->job_title}}" name="job_title" readonly></div>
		<div class="col-sm-2"><label class="label-color">Start</label>
			<select class="form-control label-color" style="font-weight:bold;" name="start" disabled>
				<option style="font-weight:bold;" value="2013">2013</option>
			    <option style="font-weight:bold;" value="{{$volunteer->start}}" selected>{{$volunteer->start}}</option>
			    <option style="font-weight:bold;" value="2011">2011</option>
			</select>
		</div>
		<div class="col-sm-2"><label class="label-color">Completed</label>
		<select class="form-control label-color" style="font-weight:bold;" name="completed" disabled>
				<option style="font-weight:bold;" value="2013">2013</option>
			    <option style="font-weight:bold;" value="{{$volunteer->completed}}" selected>{{$volunteer->completed}}</option>
			    <option style="font-weight:bold;" value="2011">2011</option>
			</select>
		</div>
		<div class="col-sm-11"><label class="label-color">Duties</label>
			<textarea class="form-control" style="height:150px;" col="50" placeholder="" name="duties" readonly>{{$volunteer->duties}}</textarea>
		</div>
		<button type="button" class="edit-button btn btn-warning" style="float:left;margin-top: 20px" onClick="editVolunteer(this);"><i class="fa fa-pencil" aria-hidden="true"></i></button>
		<button type="button" class="delete-volunteer-button btn btn-danger" style="float:left;margin-top:20px;margin-left:2px;" onClick=""><i class="fa fa-window-close" aria-hidden="true"></i></button>
		</div>

		<input type="text" name="id" value="{{$volunteer->id}}" hidden/>


</form>
@endforeach