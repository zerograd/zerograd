<a href="{{route('public-profile',$notification->student_id)}}">
@if($notification->seen == 'no')
	<li style="background-color: #C6C6C6">
	<img src="{{URL::asset('/images/me.jpg')}}"></img>
	<p>{{$notification->student_name}}accepted your request</p>
	<input type="text" value="{{$notification->notification_id}}" hidden>
</li>
@else

@endif
</a> 