<nav>
	<ul id="myUL" class="list-group" style="margin-top: 10px;">

		@if(isset($applicants))
			@foreach($applicants as $applicant)
				<li class="list-group-item"><a href="javascript:getApplicant({{$applicant->student_id}});">{{$applicant->student_name}}</a></li>
			@endforeach
		@elseif(isset($companies))
			@foreach($companies as $company)
				<li class="list-group-item"><a href="javascript:getCompany({{$company->id}});">{{$company->company_name}}</a></li>
			@endforeach
		@endif

	</ul>
</nav>