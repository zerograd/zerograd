<li>
	<img src="{{URL::asset('/images/me.jpg')}}"></img>
	<p><a href="{{route('public-profile',$notification->student_id)}}">{{$notification->student_name}}</a> accepted your request</p>
</li>