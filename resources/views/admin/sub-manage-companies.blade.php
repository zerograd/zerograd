

@if($maximize == 'maximize')
<div class="panel-content">
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#">Manage Companies</a></li>
	</ul>

	<div class="tab-content">
	
		<!-- Manage Companies -->
	  	<div id="applicants-tab" class="tab-pane fade in active">
		     <div class="form-group col-sm-4">
	     		<label>Search Companies:</label>
	     		<input type="text" name="search" id="applicant-search" placeholder="Search" onkeyup="search();" class="form-control">
     			@include('admin.search-list')
		     </div>
		     <div class="form-group col-sm-8">
				<label>Company:</label>
				<div id="company-editor" class="col-sm-12 scroll" style="height:400px;border:1px solid #c6c6c6;border-radius: 3px;padding: 10px;overflow-y: scroll;">
						@include('admin.sub-company-editor')
				</div>
				
			</div>

	  	</div>
	  	<!-- Choose pricing plan for companies-->
	</div>
</div>

@else
	<h3>Manage Companies</h3>
	<p><i class="fa fa-building" aria-hidden="true"></i></p>
	<p>Click here to manage a company account.</p>
@endif