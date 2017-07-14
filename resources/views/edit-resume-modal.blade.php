<div id="edit-resume-modal-{{$resume->resume_id}}" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Edit Resume</h4>
					      </div>
					      <div class="modal-body">
         <form  id="edit-resume-form{{$resume->resume_id}}" method="POST" enctype="multipart/form-data">
			<div class="form">
				<h5>Your Name</h5>
				<input class="search-field" type="text"  placeholder="Your full name" value="{{Session::get('student_name')}}"/>
			</div>

			<!-- Email -->
			<div class="form">
				<h5>Your Email</h5>
				<input class="search-field" type="text" placeholder="mail@example.com" value="{{Session::get('email')}}"/>
			</div>

			<!-- Title -->
			<div class="form">
				<h5>Professional Title</h5>
				<input class="search-field" type="text" name="title" placeholder="e.g. Web Developer" value="{{$resume->title}}"/>
			</div>

			<!-- Location -->
			<div class="form">
				<h5>Location</h5>
				<input class="search-field" type="text" name="city" placeholder="e.g. London, UK" value="{{$resume->city}}"/>
			</div>

			

			

			<!-- Description -->
			<div class="form">
				<h5>Resume Content</h5>
				<div id="editor" style="height:150px;overflow-y: scroll;">
					{{$resume->summary}}
				</div>
			</div>


			<!-- Add URLs -->
			<!-- <div class="form with-line">
				<h5>URL(s) <span>(optional)</span></h5>
				<div class="form-inside">
					
					
					<div class="form boxed box-to-clone url-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" placeholder="Name" value=""/>
						<input class="search-field" type="text" placeholder="http://" value=""/>
					</div>

					<a href="#" class="button gray add-url add-box"><i class="fa fa-plus-circle"></i> Add URL</a>
					<p class="note">Optionally provide links to any of your websites or social network profiles.</p>
				</div>
			</div> -->


			<!-- Education -->
			<div class="form with-line">
				<h5>Education <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Add Education -->
					<div class="form boxed box-to-clone education-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" name="school_name" placeholder="School Name" value=""/>
						<input class="search-field" type="text" name="program" placeholder="Program" value=""/>
						<input class="search-field" type="text" name="completion" placeholder="Start / end date" value=""/>
					</div>

					<a href="#" class="button gray add-education add-box"><i class="fa fa-plus-circle"></i> Add Education</a>
				</div>
			</div>


			<!-- Experience  -->
			<div class="form with-line">
				<h5>Experience <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Add Experience -->
					<div class="form boxed box-to-clone experience-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" name="employer" placeholder="Employer" value=""/>
						<input class="search-field" type="text" name="job_title" placeholder="Job Title" value=""/>
						<input class="search-field" type="text" name="completion" placeholder="Start / end date" value=""/>
					</div>

					<a href="#" class="button gray add-experience add-box"><i class="fa fa-plus-circle"></i> Add Experience</a>
				</div>
			</div>

		</form>
			<div class="divider margin-top-0 padding-reset"></div>
			<a href="javascript:previewResume('edit-resume-form{{$resume->resume_id}}');" class="button big margin-top-5" target="_blank">Create Resume <i class="fa fa-arrow-circle-right"></i></a>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					  </div>
</div>