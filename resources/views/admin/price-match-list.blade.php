<nav>
	<ul id="myUL" class="list-group" style="margin-top: 10px;">

		@if(isset($applicants))
		@elseif(isset($companies))
			@foreach($companies as $company)
				<li class="list-group-item"><a href='javascript:setMatch("{{$company->company_name}}",{{$company->id}});'>{{$company->company_name}}</a></li>
			@endforeach
		@endif

	</ul>
</nav>