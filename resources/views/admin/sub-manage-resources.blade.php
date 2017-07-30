

@if($maximize == 'maximize')
<div class="panel-content">
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#create-resource-tab">Create Resource</a></li>
	  <li><a data-toggle="tab" href="#edit-resource-tab">Edit Resource</a></li>
	</ul>

	<div class="tab-content">
	
		<!-- Manage Resources -->
	  	<div id="create-resource-tab" class="tab-pane fade in active">
	  		<form id="create-resource-form" action="{{route('create-resource')}}" method="POST" enctype="multipart/form-data">
	  		{{csrf_field()}}
	  			<div class="form-group col-sm-6">
	  				<label>Title:</label>
	  				<input type="text" name="res_title" class="form-control" required>
	  			</div>
	  			<div class="form-group col-sm-6">
	  				<label>Sub Title:</label>
	  				<input type="text" name="sub_title" class="form-control" required>
	  			</div>
	  			<div class="form-group col-sm-6">
	  				<label>Quote:</label>
	  				<input type="text" name="quote" class="form-control" required>
	  			</div>

	  			<div class="form-group col-sm-12">
	  				<label>Content:</label>
	  				<textarea name="res_content" class="form-control" style="height:150px;" required></textarea>
	  			</div>

	  			<div class="form-group col-sm-6">
	  				<label>Resource Image</label>
				    <div class="input-group"> 
		               <input type="file" multiple name="user_file" class="form-control" id="user_file" style="display:none;"/>
		               <span class="input-group-btn"> 
		                  <button class="btn btn-default" type="button" onClick="uploadResImage('user_file');"> 
		                     Upload Image
		                  </button> 
		              	</span> 
		              	<span class="fake-input" id="file-name" style="margin-top: 10px;">&nbspNo file selected</span>
		            </div><!-- /input-group --> 
	  			</div>

	  			<div style="text-align: center;">
					 	<button type="submit"  class="btn btn-success" style="float:right;">Create</button>
				 </div>
	  		</form>
	  	</div>
	  	<div id="edit-resource-tab" class="tab-pane fade">
	  		<div class="form-group col-sm-4">
	     		<label>Search Resources:</label>
	     		<input type="text" name="search" id="applicant-search" placeholder="Search" onkeyup="search();" class="form-control">
     			@include('admin.search-list')
		     </div>
		     <div class="form-group col-sm-8">
				<label>Resource:</label>
				<div id="resource-editor" class="col-sm-12 scroll" style="height:400px;border:1px solid #c6c6c6;border-radius: 3px;padding: 10px;overflow-y: scroll;">
					
				</div>

				<input type="hidden" name="res-id" id="res-id">
				
			</div>
	  	</div>
	</div>
</div>

@else
	<h3>Edit Resources</h3>
	<p><i class="fa fa-book" aria-hidden="true"></i></p>
	<p>Click here to manage resources.</p>
@endif