<form id="applicat-form" action="{{route('update-admin-user')}}" method="POST">
{{csrf_field()}}
				    <div class="form-group col-sm-6">
						<label>Name:</label>
						<input type="text" name="name" class="form-control" required="" value="{{$applicant->student_name}}">
					</div>
					<div class="form-group col-sm-6">
						<label>Email:</label>
						<input type="text" name="email" class="form-control" required="" value="{{$applicant->email}}">
					</div>
					<div class="form-group col-sm-4">
						<label>Last Login:</label>
						<input type="text" name="last_login" class="form-control" required="" value="{{$applicant->last_login}}" disabled>
					</div>
					<div class="form-group col-sm-4">
						<label>Title:</label>
						<input type="text" name="title" class="form-control" required="" value="{{$applicant->title}}">
					</div>
					<div class="form-group col-sm-4">
						<label>LinkedIn:</label>
						<input type="text" name="linkedin" class="form-control" required="" value="{{$applicant->linkedin}}">
					</div>
					<div class="col-sm-12">
						@include('admin.applicant-history-table')
					</div>
					
			        <div style="text-align: center;">
			        	<button type="button" class="btn btn-default" onClick="resetPassword({{$applicant->student_id}});" style="margin:10px auto;">Reset Password</button>
					 	<button type="button" onClick="updateApplicant({{$applicant->student_id}});"  class="btn btn-success" style="margin:10px auto;">Update User</button>

					 	<button type="button" onClick="deleteApplicant({{$applicant->student_id}});"  class="btn btn-danger" style="margin:10px auto;">Delete User</button>


			 		</div>

					 <input type="hidden" name="id" value="{{$applicant->student_id}}">

 </form>