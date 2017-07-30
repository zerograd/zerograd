<nav>
	<ul id="myUL" class="list-group scroll" style="margin-top: 10px;">

		@if(isset($applicants))
			@foreach($applicants as $applicant)
				<li class="list-group-item"><a href="javascript:getApplicant({{$applicant->student_id}});">{{$applicant->student_name}}</a></li>
			@endforeach
		@elseif(isset($companies))
			@foreach($companies as $company)
				<li class="list-group-item"><a href="javascript:getCompany({{$company->id}});">{{$company->company_name}}</a></li>
			@endforeach

		@elseif(isset($resources))
			@foreach($resources as $resource)
				<li class="list-group-item"><a href="javascript:getResource({{$resource->res_id}});">{{$resource->res_title}}</a></li>
			@endforeach
		@endif
			
	</ul>
</nav>