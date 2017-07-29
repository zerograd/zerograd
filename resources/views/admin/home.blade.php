@extends('layout.admin-layout')

@section('title')
	Admin-Home
@stop

@section('content')
	<div id="add-new-user-panel" class="panel" style="background-color:#16a085;" onClick="maximize(this,'manage-users');">
			<h3>Add New Admin Users</h3>
			<p>Click here to add a new user. They will have access to this dashboard.</p>

	</div>

	<div id="manage-applicants-panel" class="panel" style="background-color:#27ae60" onClick="maximize(this);">

			<h3>Manage Applicants</h3>
			<p>Click here to manage an applicant's.</p>

	</div>

	<div id="manage-companies-panel" class="panel" style="background-color:#2980b9" onClick="maximize(this);">
	
			<h3>Add New Admin Users</h3>
			<p>Click here to manage a company account.</p>

	</div>

	<div id="manage-companies-panel" class="panel" style="background-color:#8e44ad" onClick="maximize(this);">
	
			<h3>Edit Resources</h3>
			<p>Click here to manage resources.</p>

	</div>
@stop


@section('script_plugins')
	<script type="text/javascript">

		//Maximize the panel
		function maximize(panel,content){


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
				$.post('{{route('manage-users')}}',{maximize:'maximize',_token:"{{csrf_token()}}"},function(data){
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
			}

			//Show all other panels
			$(panel).siblings().show();

			//Remove exit button
			$(panel).find('.exitbutton').remove();

			setTimeout(function(){
				$(panel).attr('onClick',"maximize(this,'" + content + "')");
			},800);

			

		}
	</script>
@stop