@extends('layout.admin-layout')

@section('title')
	Admin-Home
@stop

@section('content')

	@if(Session::get('admin_role') == 'Administrator')
	<div id="add-new-user-panel" class="panel" style="background-color:#16a085;" onClick="maximize(this,'manage-users','0 65% 0 0');">
			<h3>Add New Admin Users</h3>
			<p><i class="fa fa-users" aria-hidden="true"></i></p>
			<p>Click here to add a new user. They will have access to this dashboard.</p>

	</div>
	@endif

	@if(Session::get('admin_role') == 'Customer Service Representative' or Session::get('admin_role') == 'Administrator')
	<div id="manage-applicants-panel" class="panel" style="background-color:#27ae60;" onClick="maximize(this,'manage-applicants','0 65% 0 31.33%');">

			<h3>Manage Applicants</h3>
			<p><i class="fa fa-address-book" aria-hidden="true"></i></p>
			<p>Click here to manage an applicant's file.</p>

	</div>
	@endif

	@if(Session::get('admin_role') == 'Customer Service Representative' or Session::get('admin_role') == 'Administrator')
	<div id="manage-companies-panel" class="panel" style="background-color:#2980b9;" onClick="maximize(this,'manage-companies','0 31.33% 0 65%');">
	
			<h3>Manage Companies</h3>
			<p><i class="fa fa-building" aria-hidden="true"></i></p>
			<p>Click here to manage a company account.</p>

	</div>
	@endif

	@if(Session::get('admin_role') == 'Administrator' or Session::get('admin_role') == 'Editor' )
	<div id="manage-companies-panel" class="panel" style="background-color:#8e44ad;" onClick="maximize(this,'manage-resources','0 65% 0 0');">
	
			<h3>Manage Resources</h3>
			<p><i class="fa fa-book" aria-hidden="true"></i></p>
			<p>Click here to manage resources.</p>

	</div>
	@endif
	@if(Session::get('admin_role') == 'Administrator' or Session::get('admin_role') == 'Editor' )
	<div id="manage-our-info" class="panel" style="background-color:#2c3e50;" onClick="maximize(this,'manage-our-info','0 65% 0 0');">
	
			<h3>Manage Our Info</h3>
			<p><i class="fa fa-book" aria-hidden="true"></i></p>
			<p>Click here to manage information related to our Company.</p>

	</div>
	@endif
@stop


@section('script_plugins')
	<script type="text/javascript">


			  var quill = new Quill('#resource-content', {
			    theme: 'snow'
			  });

			function showAdminUser(element){
				var id = "";
				if(element){
					id = $(element).val();
				}else{
					id = 1;
				}
				$.post('{{route('show-admin-user')}}',{id:id,_token:"{{csrf_token()}}"},function(data){
					$('#manage-editor').html(data);
				});
			}

			function updateAdminUser(){
				var password = $('#update-password').val();
				var confirmPassword = $('#confirm-password').val();

				if(password == confirmPassword){
					$('#existing-users-form').submit();
				}else{
					swal('Passwords must match');
				}
			}

		$(document).ready(function(){
			@if(Session::get('user_created'))
				swal(
				  'Good job!',
				  "{{Session::get('user_created')}}",
				  'success'
				);
			@endif
			@if(Session::get('user_updated'))
				swal(
				  'Good job!',
				  "{{Session::get('user_updated')}}",
				  'success'
				);
			@endif
			@if(Session::get('applicant_delete'))
				swal(
				  'Good job!',
				  "{{Session::get('applicant_delete')}}",
				  'success'
				);
			@endif
			@if(Session::get('applicant_updated'))
				swal(
				  'Good job!',
				  "{{Session::get('applicant_updated')}}",
				  'success'
				);
			@endif
			@if(Session::get('email_exist'))
				var panel = $('#add-new-user-panel')[0];
				maximize(panel,'manage-users','email_exist');
			@endif

			@if(Session::get('company_delete'))
				swal(
				  'Good job!',
				  "{{Session::get('company_delete')}}",
				  'success'
				);
			@endif

			@if(Session::get('company_updated'))
				swal(
				  'Good job!',
				  "{{Session::get('company_updated')}}",
				  'success'
				);
			@endif

			@if(Session::get('res_created'))
				swal(
				  'Good job!',
				  "{{Session::get('res_created')}}",
				  'success'
				);
			@endif

			@if(Session::get('res_updated'))
				swal(
				  'Good job!',
				  "{{Session::get('res_updated')}}",
				  'success'
				);
			@endif

			@if(Session::get('res_deleted'))
				swal(
				  'Good job!',
				  "{{Session::get('res_deleted')}}",
				  'success'
				);
			@endif

			

			showAdminUser();

			$("#user_file").change(function(e) {
				var fileName = e.target.files[0].name;
	        	$('#file-name').text(fileName);
	    	});

			// Initial Manage Company functions

			$('.pricing-panel').each(function(){
				var element = $(this);
				element.toggleClass('addBorder');
			});


		});

		//Maximize the panel
		function maximize(panel,content,margin,email_exist){



			//Maximize current panel
			$(panel).animate({
				margin:margin,
				"z-index": "10"
			},100,function(){
				$(panel).animate({
					"margin-right": 0,
					"margin-left":0,
					"margin-bottom": "20px",
					width: "99%",
					height:"90%",
					padding:"10px"
				})

				//Manage Users Panel
			if(content == 'manage-users'){

				//Maximize and display content
				$.post('{{route('manage-users')}}',{maximize:'maximize',_token:"{{csrf_token()}}",email_exist:email_exist},function(data){
					$(panel).html(data);
					//add exit button to panel

					var exitButton = $('<button class="btn btn-danger exitbutton">X</button>');

					exitButton.on('click',function(){
						minimize(panel,content);
					});

					//Minimize all other panels
					$(panel).siblings().hide();

					$(panel).attr('onClick','');
					$(panel).append(exitButton);
				});
			}else if(content == 'manage-applicants'){
				$.post('{{route('manage-applicants')}}',{maximize:'maximize',_token:"{{csrf_token()}}",email_exist:email_exist},function(data){
					$(panel).html(data);
					//add exit button to panel

					var exitButton = $('<button class="btn btn-danger exitbutton">X</button>');

					exitButton.on('click',function(){
						minimize(panel,content);
					});

					//Minimize all other panels
					$(panel).siblings().hide();

					$(panel).attr('onClick','');
					$(panel).append(exitButton);
				});
			}else if(content == 'manage-companies'){
				$.post('{{route('manage-companies')}}',{maximize:'maximize',_token:"{{csrf_token()}}",email_exist:email_exist},function(data){
					$(panel).html(data);
					//add exit button to panel

					var exitButton = $('<button class="btn btn-danger exitbutton">X</button>');

					exitButton.on('click',function(){
						minimize(panel,content);
					});

					//Minimize all other panels
					$(panel).siblings().hide();

					$(panel).attr('onClick','');
					$(panel).append(exitButton);
				});
			}else if(content == 'manage-resources'){
				$.post('{{route('manage-resources')}}',{maximize:'maximize',_token:"{{csrf_token()}}",email_exist:email_exist},function(data){
					$(panel).html(data);
					//add exit button to panel

					var exitButton = $('<button class="btn btn-danger exitbutton">X</button>');

					exitButton.on('click',function(){
						minimize(panel,content);
					});

					//Minimize all other panels
					$(panel).siblings().hide();

					$(panel).attr('onClick','');
					$(panel).append(exitButton);
				});
			}

			});


			

			

			
			

		}

		function minimize(panel,content){
			$(panel).animate({
				"margin-right": "1%",
				"margin-left": "1%",
				width: "31.33%",
				height:"300px"
			});

			if(content == 'manage-users'){

				//Minimize and return to original state
				$.post('{{route('manage-users')}}',{_token:"{{csrf_token()}}"},function(data){
					$(panel).html(data);
				});
			}else if(content == 'manage-applicants'){
				$.post('{{route('manage-applicants')}}',{_token:"{{csrf_token()}}"},function(data){
					$(panel).html(data);
				});
			}
			else if(content == 'manage-companies'){
				$.post('{{route('manage-companies')}}',{_token:"{{csrf_token()}}"},function(data){
					$(panel).html(data);
				});
			}else if(content == 'manage-resources'){
				$.post('{{route('manage-resources')}}',{_token:"{{csrf_token()}}"},function(data){
					$(panel).html(data);
				});
			}

			//Show all other panels
			$(panel).siblings().show();

			//Remove exit button
			$(panel).find('.exitbutton').remove();

			setTimeout(function(){
				$(panel).attr('onClick',"maximize(this,'" + content + "')");
			},800);

			

		}

		function generatePassword(){
			$.post("{{route('generate-password')}}",{_token:"{{csrf_token()}}"},function(data){
				$('#new-user-password').val(data);
			});
		}
	</script>

	<!-- Manage Applicants Scripts -->
	<script>
	function search(){
	    // Declare variables
	    var input, filter, ul, li, a, i;
	    input = document.getElementById('applicant-search');
	    filter = input.value.toUpperCase();
	    ul = document.getElementById("myUL");
	    li = ul.getElementsByTagName('li');

	    // Loop through all list items, and hide those who don't match the search query
	    for (i = 0; i < li.length; i++) {
	        a = li[i].getElementsByTagName("a")[0];
	        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
	            li[i].style.display = "";
	        } else {
	            li[i].style.display = "none";
	        }
	    }
	}

	 function getApplicant(id){
 		$.post("{{route('show-applicant-user')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
				$('#applicant-editor').html(data);
		});
	 }

	 function resetPassword(id){
	 	$.post("{{route('reset-applicant-password')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
				swal('Email with new password sent to user.');
		});
	 }

	 function deleteApplicant(id){
	 	swal({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then(function () {
			$.post("{{route('delete-applicant')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
				window.location = '{{URL::to('/admin/home')}}';
			});
		});
	 	
	 }

	 //Manage Company functions

	 function getCompany(id){
	 	if($('#chosen-company-id').val() == id){
	 		alert('You have already selected this company.');
	 		return false;
	 	}
	 	setMatch('',id);

 		$.post("{{route('show-company')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
			$('#company-profile').html(data);
		});
	 } 

	 function sendPassword(id){
	 	var email = $('#company-email').val();
	 	var password = $('#new-user-password').val();

	 	$.post("{{route('send-company-password')}}",{_token:"{{csrf_token()}}",email:email,password:password,id:id},function(data){
	 		swal(
				  'Good job!',
				  "Company Password sent!",
				  'success'
			);
	 	});
	 }

	 function deleteCompany(id){
	 	swal({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then(function () {
			$.post("{{route('delete-company')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
				window.location = '{{URL::to('/admin/home')}}';
			});
		});
	 }

	 function setMatch(name,id){
	 	$('#chosen-company-match').val(name);
	 	$('#chosen-company-id').val(id);
	 }

	 function addBorder(element){
	 	$(".plan").removeClass('addBorder');
	 	$(element).addClass('addBorder');
	 	$(element).attr('onClick','removeBorder(this);');

	 }
	 function removeBorder(element){
	 	$(element).removeClass('addBorder');
	 	$(element).attr('onClick','addBorder(this);');
	 }

	 function confirmPricing(title){
	 	var title = title
	 	var id  = $('#chosen-company-id').val();
	 	if(id == ''){
	 		alert('Please select a company.');
	 		return false;
	 	}
	 	$.post('{{route('selected-pricing')}}',{id:id,title:title,_token:"{{csrf_token()}}"},function(data){
	 			swal(
				  'Good job!',
				  data,
				  'success'
			);
	 	});
	 }



	 // Resource Functions

	 function getResource(id){
	 	if($('#res-id').val() == id){
	 		alert('You have already selected this resource.');
	 		return false;
	 	}
	 	setResource('',id);

 		$.post("{{route('edit-resource')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
			$('#resource-editor').html(data);
		});
	 }  

	 function setResource(name,id){
	 	$('#res-id').val(id);
	 }

	 function uploadResImage(id){
	 	$('#' + id).click();
	 }

	 function deleteResource(id){
	 	swal({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then(function () {
			$.post("{{route('delete-resource')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
				window.location = '{{URL::to('/admin/home')}}';
			});
		});
	 }

	</script>
@stop