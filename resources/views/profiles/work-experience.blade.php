@foreach($educations as $education)
	<div class="form-group" style="margin:10px 0;" class="entered-school">
		<div class="col-sm-4"><label class="label-color">Company Name</label><input type="text" class="form-control" style="font-weight: bold;" value="{{$education->school}}"readonly></div>
		<div class="col-sm-3"><label class="label-color">Job Title</label><input type="text" class="form-control" style="font-weight: bold;" value="{{$education->program}}" readonly></div>
		<div class="col-sm-2"><label class="label-color">Start</label>
			<select class="form-control label-color" style="font-weight:bold;" name="start" disabled>
				<option style="font-weight:bold;" value="2013">2013</option>
			    <option style="font-weight:bold;" value="{{$education->start}}" selected>{{$education->start}}</option>
			    <option style="font-weight:bold;" value="2011">2011</option>
			</select>
		</div>
		<div class="col-sm-2"><label class="label-color">Completed</label>
		<select class="form-control label-color" style="font-weight:bold;" name="completed" disabled>
				<option style="font-weight:bold;" value="2013">2013</option>
			    <option style="font-weight:bold;" value="{{$education->completed}}" selected>{{$education->completed}}</option>
			    <option style="font-weight:bold;" value="2011">2011</option>
			</select>
		</div>
		<div class="col-sm-11"><label class="label-color">Duties</label>
			<textarea class="form-control" style="height:150px;" col="50" placeholder="" readonly></textarea>
		</div>
		<button class="edit-button btn btn-warning" style="float:left;margin-top: 20px" onClick="editProject(this);"><i class="fa fa-pencil" aria-hidden="true"></i></button></div>
	</div>
@endforeach