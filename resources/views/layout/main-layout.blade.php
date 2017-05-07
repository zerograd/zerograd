<div id="navigation-panel" class="col-sm-2 hidden-sm-up">
		<div id="navigation-header" class="col-sm-12" onClick="goTo('{{URL::to('/student/home')}}');">
       		 <h1 id="logo" style="margin:0; color:white;">Zer<span class="zeroLogo">0</span>Grad
       		 </h1>
		</div>
		<div id="navigation-status-div" class="col-sm-12">
			<div class="col-sm-12" style="text-align: center;margin-bottom: 5px;">
				<img src="{{URL::asset('/images/me.jpg')}}" alt="navigation-status-div-image" style="margin:0 auto;">
			</div>
			@if(Session::has('student_name'))
				<p class="col-xs-12">{{Session::get('student_name')}}</p>
			@endif()
			
			<div class="col-xs-12">
				<p style="display:inline-block;">Online</p>
				<div class="status-color" style="display:inline-block;width:10px;height:10px;background-color: green;border-radius: 50%;"></div>
			</div>

			
				
			    
		</div>
		<ul id="main-navigation" class="nav col-sm-12" style="margin-top:15px;">
			<li class="first">MAIN NAVIGATION</li>
			<li class="other-list-item" onClick="goTo('{{URL::to('/student/profile/1')}}');">
					<i class="material-icons">perm_identity</i>
					<p>	Profile </p>	
			</li>
			<li class="other-list-item" onClick="goTo('{{URL::to('/')}}');"><i class="fa fa-search fa-5" aria-hidden="true"></i><p>Search Tool</p></li>
			<li class="other-list-item"><i class="material-icons">view_agenda</i><p>Resume Builder</p></li>
		</ul>
	</div>
	<div id="main-area" class="col-sm-10">
		<div class="container-fluid" style="background-color: #354886">
			<ul class="nav navbar-nav col-md-4 col-md-push-8 col-xs-12 " style="margin:0 auto;text-align: center;">
				<li>
					<i class="material-icons " style="color:white;margin:5px;">textsms</i>
					<i class="material-icons" style="color:white;margin:5px;">new_releases</i>
				
					<i class="material-icons" style="color:white;margin:5px;">chat</i>
				</li>
				<li id="user-list-item">
					<img src="{{URL::asset('/images/me.jpg')}}" alt="user-list-item">
					@if(Session::has('student_name'))
						<p>{{Session::get('student_name')}}</p>
					@endif()
				</li>
			</ul>
		</div>       

			<script>
		function show(div){
			$("#" + div).show("slow");
		}
		function goTo(loc){
			window.location = loc;
		}
	</script>