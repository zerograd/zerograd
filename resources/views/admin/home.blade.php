@extends('layout.admin-layout')

@section('title')
	Admin-Home
@stop

@section('content')
	<div id="add-new-user-panel" class="panel" style="background-color:#16a085;" onClick="maximize(this,'manage-users');">
			<h3>Add New Admin Users</h3>
			<p>Click here to add a new user. They will have access to this dashboard.</p>

	</div>

	<div id="manage-applicants-panel" class="panel" style="background-color:#27ae60" onClick="maximize(this,'manage-applicants');">

			<h3>Manage Applicants</h3>
			<p>Click here to manage an applicant's file.</p>

	</div>

	<div id="manage-companies-panel" class="panel" style="background-color:#2980b9" onClick="maximize(this,'manage-companies');">
	
			<h3>Manage Companies</h3>
			<p>Click here to manage a company account.</p>

	</div>

	<div id="manage-companies-panel" class="panel" style="background-color:#8e44ad" onClick="maximize(this);">
	
			<h3>Edit Resources</h3>
			<p>Click here to manage resources.</p>

	</div>
@stop


@section('script_plugins')
	<script type="text/javascript">

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
			@if(Session::has('user_created'))
				swal(
				  'Good job!',
				  "{{Session::get('user_created')}}",
				  'success'
				);
			@endif
			@if(Session::has('user_updated'))
				swal(
				  'Good job!',
				  "{{Session::get('user_updated')}}",
				  'success'
				);
			@endif
			@if(Session::has('applicant_delete'))
				swal(
				  'Good job!',
				  "{{Session::get('applicant_delete')}}",
				  'success'
				);
			@endif
			@if(Session::has('applicant_updated'))
				swal(
				  'Good job!',
				  "{{Session::get('applicant_updated')}}",
				  'success'
				);
			@endif
			@if(Session::has('email_exist'))
				var panel = $('#add-new-user-panel')[0];
				maximize(panel,'manage-users','email_exist');
			@endif

			@if(Session::has('company_delete'))
				swal(
				  'Good job!',
				  "{{Session::get('company_delete')}}",
				  'success'
				);
			@endif

			showAdminUser();
		});

		//Maximize the panel
		function maximize(panel,content,email_exist){


			//Maximize current panel
			$(panel).animate({
				width: "99%",
				"z-index": 10,
				height:"90%",
				padding:"10px"
			});


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
			}

			

			
			

		}

		function minimize(panel,content){
			$(panel).animate({
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
 		$.post("{{route('show-company')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
				$('#company-editor').html(data);
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


	</script>
@stop