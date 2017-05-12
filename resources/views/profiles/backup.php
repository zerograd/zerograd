<div id="education" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border-radius: 5px;padding:10px;">
							<h2>Education</h2>
							<div class="form-group" id="school-div">
								<label class="label-color">Education is important! Tell others where you went and what you took. Maybe even mention that you are an alnumi.</label>
								@include('profiles.education');
								<div class="col-sm-12 label-color" style="font-weight: bold;margin-top: 10px;">
									Add a School...
									<i class="fa fa-plus label-color" aria-hidden="true" style="cursor: pointer" onClick="addSchool();"></i>
									&nbsp<i class="fa fa-minus label-color" aria-hidden="true" style="cursor: pointer" onClick="removeSchool();"></i>
								</div>
							</div>
						</div>
						<div id="resume" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border-radius: 5px;padding:10px;">
								<h2>Resume</h2>
								<label class="label-color">A resume is the best tool for sharing your skills and knowledge with future employers. Please upload your own or click 'Resume Builder' to use our Resume building tool.</label>
								<div class="form-group">
									
									<div class="col-sm-4">
										<label>Street Address</label>
										<input name="address" type="text" placeholder="Street Address" class="form-control" value="{{$resume->address}}">
									</div>
									<div class="col-sm-4">
										<label>City</label>
										<input name="city" type="text" placeholder="City" class="form-control" value="{{$resume->city}}">
									</div>
									<div class="col-sm-4">
										<label>Province/State</label>
										<input name="state" type="text" placeholder="Province/State" class="form-control" value="{{$resume->state}}">
									</div>
									<div class="col-sm-4">
										<label>Postal Code</label>
										<input name="zipcode" type="text" placeholder="Postal Code/Zip Code" class="form-control" value="{{$resume->zipcode}}">
									</div>
									<div class="col-sm-4">
										<label>Telephone</label>
										<input name="telephone_number" type="text" placeholder="Telephone Number" class="form-control" value="{{$resume->telephone_number}}" >
									</div>
									<div class="col-sm-4"></div>
									<div class="col-sm-6">
										<label>Objective</label>
										<textarea col="50" style="height:150px;"  name="objective" class="form-control" placeholder="Talk about the type of job you are looking for.">{{$resume->objective}}</textarea>
									</div>
									<div class="col-sm-6">
										<label>Summary</label>
										<textarea col="50" style="height:150px;" name="summary" class="form-control" placeholder="A brief description of who you are and your skills">{{$resume->summary}}</textarea>
									</div>
									<div class="col-sm-12">
										<label>Skills</label>
										<div class="input-group col-sm-12" id="skills-group">
											<input class="form-control" name="current-skill" id="current-skill" type="text" placeholder="Enter skills here...(Press space key after each skill)" />
											<div id="resume-skill-container" class="container-fluid">
											@foreach($resumeSkills as $skill)
												<button class="btn btn-info" style="margin: 5px 0;" onClick="removeSkill(this);"">{{$skill}}&nbsp<i class="fa fa-times-circle" aria-hidden="true"></i></button>
											@endforeach
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<label>Work Experience</label>
										<div class="form-group" id="work-div">
											@include('profiles.work-experience');
											<div class="col-sm-12 label-color" style="font-weight: bold;margin-top: 10px;">
												Add a Job...
												<i class="fa fa-plus label-color" aria-hidden="true" style="cursor: pointer" onClick="addProject();"></i>
												&nbsp<i class="fa fa-minus label-color" aria-hidden="true" style="cursor: pointer" onClick="removeProject();"></i>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<label>Volunteer Work</label>
										<div class="form-group" id="volunteer-div">
											@include('profiles.volunteer');
											<div class="col-sm-12 label-color" style="font-weight: bold;margin-top: 10px;">
												Add a Volunteer...
												<i class="fa fa-plus label-color" aria-hidden="true" style="cursor: pointer" onClick="addProject();"></i>
												&nbsp<i class="fa fa-minus label-color" aria-hidden="true" style="cursor: pointer" onClick="removeProject();"></i>
											</div>
										</div>
										<div class="col-sm-12" style="">
										<button style="margin: 10px;float:right;color:black;font-weight: bold;" class="btn btn-secondary">Save</button>
										<a href="{{route('preview-resume',$id)}}" target="_blank"><button style="margin: 10px;float:right;color:black;font-weight: bold;" class="btn btn-secondary">Preview Resume</button></a>
										</div>
									</div>
									<div id="skills" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border-radius: 5px;padding:10px;">
							<h2>Skills</h2>
							<div class="form-group">
								<label class="label-color">List all those wonderful skills that you have accquired over the years.(Press Enter after each skill)</label>
								<div class="input-group col-sm-12" id="skills-group-div">
									<input class="form-control" name="skill" id="skill" type="text" placeholder="Enter skills here...(Press space key after each skill)" />
									<div id="profile-skill-container" class="container-fluid">
										@foreach($skills as $skill)
												<button class="btn btn-info" style="margin: 5px 0;" onClick="removeSkill(this);"">{{$skill}}&nbsp<i class="fa fa-times-circle" aria-hidden="true"></i></button>
										@endforeach
									</div>
								</div>
							</div>
						</div>
						<div id="projects" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border-radius: 5px;padding:10px;">
							<h2>Projects</h2>
							<div class="form-group">
								<label class="label-color">Project Descriptions are great for providing more detail on what you have done to get where you are in your profession.</label>
								<div class="form-group" id="projects-div">
									<label class="label-color">Education is important! Tell others where you went and what you took. Maybe even mention that you are an alnumi.</label>
									@include('profiles.projects');
									<div class="col-sm-12 label-color" style="font-weight: bold;margin-top: 10px;">
										Add a Project...
										<i class="fa fa-plus label-color" aria-hidden="true" style="cursor: pointer" onClick="addProject();"></i>
										&nbsp<i class="fa fa-minus label-color" aria-hidden="true" style="cursor: pointer" onClick="removeProject();"></i>
									</div>
								</div>
							</div>
						</div>
								</div>

						</div>