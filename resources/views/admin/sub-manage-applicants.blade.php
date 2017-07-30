

@if($maximize == 'maximize')
<div class="panel-content">
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#applicants-tab">Manage Applicants</a></li>
	</ul>

	<div class="tab-content">
	
		<!-- Add new User Panel -->
	  	<div id="applicants-tab" class="tab-pane fade in active">
		     <div class="form-group col-sm-4">
	     		<label>Search Applicants:</label>
	     		<input type="text" name="search" id="applicant-search" placeholder="Search" onkeyup="search();" class="form-control">
     			@include('admin.search-list')
		     </div>
		     <div class="form-group col-sm-8">
				<label>Applicant:</label>
				<div id="applicant-editor" class="col-sm-12 scroll" style="height:400px;border:1px solid #c6c6c6;border-radius: 3px;padding: 10px;overflow-y: scroll;">
					
				</div>
				
			</div>

	  	</div>
		
	  
	  


	</div>
</div>

@else
	<h3>Manage Applicants</h3>
	<p><i class="fa fa-address-book" aria-hidden="true"></i></p>
	<p>Click here to manage an applicant's file.</p>
@endif