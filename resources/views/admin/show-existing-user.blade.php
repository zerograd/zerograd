<form id="existing-users-form" action="{{route('update-admin-user')}}" method="POST">
{{csrf_field()}}
				    <div class="form-group col-sm-6">
						<label>Name:</label>
						<input type="text" name="name" class="form-control" required="" value="{{$adminUser->name}}">
					</div>
					<div class="form-group col-sm-6">
						<label>Role:</label>
						<select class="form-control" name="role_id">
							@foreach($roles as $role)
								@if($adminUser->role_id == $role->admin_perm_id)
								<option value="{{$role->admin_perm_id}}" selected>{{$role->role}}</option>
								@endif
								<option value="{{$role->admin_perm_id}}">{{$role->role}}</option>
							@endforeach
						</select>
						
					</div>
					<div class="form-group col-sm-6">
							<label>Email:
								@if(isset($emailExist))
										<span style="color:#da5656;">&nbsp This email already exist.</span>
								@endif
							</label>
							<input type="email" name="email" class="form-control" value="{{$adminUser->email}}" required>
					 </div>
					 <div class="col-lg-6"> 
						<label>Password</label>
						<input type="text" name="password" id="update-password" class="form-control" placeholder="New Password">
						<input type="text" name="password" id="confirm-password" class="form-control" placeholder="Confirm Password">
			        </div><!-- /.col-lg-6 --> 

			        <div style="text-align: center;">
					 	<button type="button" onClick="updateAdminUser();"  class="btn btn-success" style="margin:10px auto;">Update User</button>
					 </div>

					 <input type="hidden" name="id" value="{{$adminUser->id}}">

 </form>