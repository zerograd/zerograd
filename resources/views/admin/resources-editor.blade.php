<form id="edit-resource-form" action="{{route('update-resource')}}" method="POST" enctype="multipart/form-data">
	  		{{csrf_field()}}
	  			<div class="form-group col-sm-6">
	  				<label>Title:</label>
	  				<input type="text" name="res_title" class="form-control" required value="{{$resource->res_title}}">
	  			</div>
	  			<div class="form-group col-sm-6">
	  				<label>Sub Title:</label>
	  				<input type="text" name="sub_title" class="form-control" required value="{{$resource->sub_title}}">
	  			</div>
	  			<div class="form-group col-sm-6">
	  				<label>Quote:</label>
	  				<input type="text" name="quote" class="form-control" required value="{{$resource->quote}}">
	  			</div>

	  			<div class="form-group col-sm-12">
	  				<label>Content:</label>
	  				<textarea name="res_content" class="resource-content form-control" style="height:150px;" required>{{$resource->res_content_first . $resource->res_content_second}}</textarea>
	  			</div>

	  			<div class="form-group col-sm-6">
	  				<label>Resource Image</label>
				    <div class="input-group"> 
		               <input type="file" multiple name="res_file" class="form-control" id="res_file" style="display:none;"/>
		               <span class="input-group-btn"> 
		                  <button class="btn btn-default" type="button" onClick="uploadResImage('res_file');"> 
		                     Upload Image
		                  </button> 
		              	</span> 
		              	<span class="fake-input" id="file-name" style="margin-top: 10px;">&nbspNo file selected</span>
		            </div><!-- /input-group --> 
	  			</div>

	  			<input type="hidden" name="res_id" id="res_id" value="{{$resource->res_id}}">

	  			<div style="text-align: center;">
					 	<button type="submit"  class="btn btn-success" style="float:right;">Update Resource</button>
					 	<button type="button"  class="btn btn-danger" onClick="deleteResource({{$resource->res_id}});" style="float:right;">Delete Resource</button>
				 </div>
</form>