

@if($maximize == 'maximize')
<div class="panel-content">
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#add-new">Add New Admin User</a></li>
	  <li><a data-toggle="tab" href="#existing-users">Manage Existing Admin Users</a></li>
	</ul>

	<div class="tab-content">
	
		<!-- Add new User Panel -->
	  	<div id="add-new" class="tab-pane fade in active">
		  <form id="add-new-user-form" action="{{route('add-new-admin-user')}}" method="POST">
		  	{{csrf_field()}}
	    	<!-- Role -->
			<div class="form-group col-sm-6">
				<label>Role:</label>
				<select class="form-control" name="role_id">
					<option value="1">Administrator</option>
					<option value="2">Editor</option>
					<option value="3">Customer Service Representative</option>
				</select>
			</div>
			<div class="form-group col-sm-6">
				<label>Name:</label>
				<input type="text" name="name" class="form-control" required="">
			</div>

			<div class="col-lg-6"> 
				<label>Password</label>
	            <div class="input-group"> 
	               <input type="text" class="form-control" id="new-user-password" name="password" required> 
	               <span class="input-group-btn"> 
	                  <button class="btn btn-default" type="button" onClick="generatePassword();"> 
	                     Generate Password
	                  </button> 
	              	</span> 
	            </div><!-- /input-group --> 
	        </div><!-- /.col-lg-6 --> 


	         <div class="form-group col-sm-6">
	         	
				<label>Email:
					@if($emailExist)
							<span style="color:#da5656;">&nbsp This email already exist.</span>
					@endif
				</label>
				<input type="email" name="email" class="form-control" required>
			 </div>

			 <div style="text-align: center;">
			 	<button type="submit" class="btn btn-success" style="margin:0 auto;">Create User</button>
			 </div>
			 </form>
	   </div>
		
	  
	  <div id="existing-users" class="tab-pane fade">
	    	<div class="form-group col-sm-4">
				<label>Users:</label>
				<select class="form-control" name="id" id="select-admin-users" onchange="showAdminUser(this);">
				@if($adminUsers)
					@foreach($adminUsers as $user)
						<option value="{{$user->id}}">{{$user->name}}&nbsp({{$user->role}})</option>
					@endforeach
				@endif
				</select>
			</div>
			<div class="form-group col-sm-8">
				<label>Editor:</label>
				<div id="manage-editor" class="col-sm-12" style="border:1px solid #c6c6c6;border-radius: 3px;padding: 10px;">
					
				</div>
			</div>
	  </div>


	</div>
</div>

@else
	<h3>Add New Admin Users</h3>
	<p>Click here to add a new user. They will have access to this dashboard.</p>
@endif