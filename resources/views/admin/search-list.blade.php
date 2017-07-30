<nav>
	<ul id="myUL" class="list-group" style="margin-top: 10px;">
			@foreach($applicants as $applicant)
				<li class="list-group-item"><a href="javascript:getApplicant({{$applicant->student_id}});">{{$applicant->student_name}}</a></li>
			@endforeach
	</ul>
</nav>