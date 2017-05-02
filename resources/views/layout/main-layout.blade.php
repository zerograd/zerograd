<div id="navigation-panel" class="col-sm-2">
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
			<li class="other-list-item" onClick="show('text-list');"><i class="material-icons">subject</i><p>Text</p>
				<ul id="text-list" class="hidden-list" style="display:none;">
					<li><p> Text 1</p></li>
					<li><p>Text 2</p></li>
					<li><p>Text 3</p></li>
				</ul>
			</li>
		</ul>
	</div>
	<div id="main-area" class="col-sm-10">
		<div id="header" class="col-sm-12">
			<div class="col-xl-8 col-lg-6 col-md-4 col-xs-4" style="height:50px;">

			</div>
			<ul class="nav navbar-nav col-lg-6 col-md-6 col-xs-8" style="margin:0 auto;">
				<li id="messages" class="icons">
					<i class="material-icons " style="color:white;">textsms</i>
				</li>
				<li id="notifications-feed" class="icons">
					<i class="material-icons" style="color:white;">new_releases</i>
				</li>
				<li id="notifications-jobs" class="icons">
					<i class="material-icons" style="color:white;">chat</i>
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