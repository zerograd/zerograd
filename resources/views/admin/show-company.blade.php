<form id="company-form" action="{{route('update-company')}}" method="POST">
{{csrf_field()}}
				    <div class="form-group col-sm-6">
						<label>Name:</label>
						<input type="text" name="company_name" class="form-control" value="{{$company->company_name}}">
					</div>
					<div class="form-group col-sm-6">
						<label>Email:</label>
						<input type="text" name="company_email" class="form-control"  value="{{$company->company_email}}">
					</div>
					<div class="col-sm-6" style="margin-bottom:10px;"> 
						<label>Password</label>
			            <div class="input-group"> 
			               <input type="text" class="form-control" id="new-user-password" name="password" > 
			               <span class="input-group-btn"> 
			                  <button class="btn btn-default" type="button" onClick="generatePassword();"> 
			                     Generate Password
			                  </button> 
			              	</span> 
			            </div><!-- /input-group --> 
			        </div><!-- /.col-lg-6 --> 
			        <div class="col-sm-6" style="margin-bottom:10px;"> 
						<label>Send Password</label>
			            <div class="input-group"> 
			               <input type="email" class="form-control" id="company-email" name="company_email" placeholder="Company Email" value="{{$company->company_email}}" disabled>
			               <span class="input-group-btn"> 
			                  <button class="btn btn-default" type="button" onClick="sendPassword({{$company->id}});"> 
			                     Send Password
			                  </button> 
			              	</span> 
			            </div><!-- /input-group --> 
			        </div><!-- /.col-lg-6 --> 
					<div class="form-group col-sm-3">
						<label>Contact:</label>
						<input type="text" name="contact" class="form-control" value="{{$company->contact}}">
					</div>
					<div class="form-group col-sm-3">
						<label>Phone:</label>
						<input type="text" name="company_phone" class="form-control" value="{{$company->company_phone}}">
					</div>
					<div class="form-group col-sm-3">
						<label>Location:</label>
						<input type="text" name="company_location" class="form-control" value="{{$company->company_location}}">
					</div>
					<div class="form-group col-sm-3">
						<label>Verified:</label>
						<select name="verified" class="form-control">
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>

					<div class="form-group col-sm-12">
						<label>Company Overview:</label>
						<textarea name="company_overview" class="form-control" cols="50" style="height:200px;">{{$company->company_overview}}</textarea>
					</div>

					
					
			        <div style="text-align: center;">
			        	<button type="button" class="btn btn-default" onClick="resetPassword();" style="margin:10px auto;">Reset Password</button>
					 	<button type="submit"  class="btn btn-success" style="margin:10px auto;">Update Company</button>

					 	<button type="button" onClick="deleteCompany({{$company->id}});"  class="btn btn-danger" style="margin:10px auto;">Delete Company</button>


			 		</div>

					 <input type="hidden" name="id" value="{{$company->id}}">

 </form>