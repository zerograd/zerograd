<li>
	<img src="{{URL::asset('/images/me.jpg')}}"></img>
	<p>{{$notification->student_name}} Sent a Request</p>
	<div class="container-fluid">
		<div class="col-xs-12">
			<button class="btn btn-success" type="button" onClick="acceptRequest(this);">Accept</button>
			<button class="btn btn-secondary">Decline</button>
			<button class="btn btn-danger">Block</button>
			<input type="text" value="{{$notification->student_id}}" hidden>
		</div>
	</div>
</li>