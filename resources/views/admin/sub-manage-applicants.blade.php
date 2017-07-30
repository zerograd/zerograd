

@if($maximize == 'maximize')
<div class="panel-content">
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#applicants-tab">Add New Admin User</a></li>
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
				<div id="applicant-editor" class="col-sm-12" style="height:400px;border:1px solid #c6c6c6;border-radius: 3px;padding: 10px;overflow-y: scroll;">
					
				</div>
				<div style="text-align: center;">
			        	<button type="button" class="btn btn-default" style="margin:10px auto;">Reset Password</button>
					 	<button type="button" onClick="updateAdminUser();"  class="btn btn-success" style="margin:10px auto;">Update User</button>
			 	</div>
			</div>

	  	</div>
		
	  
	  


	</div>
</div>

@else
	<h3>Manage Applicants</h3>
	<p>Click here to manage an applicant's file.</p>
@endif