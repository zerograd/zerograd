<a href="{{route('public-profile',$notification->student_id)}}">
<li>
	<img src="{{URL::asset('/images/me.jpg')}}"></img>
	<p>You and {{$notification->student_name}} are now connected. </p>
	<input type="text" value="{{$notification->notification_id}}" hidden>
</li>
</a>