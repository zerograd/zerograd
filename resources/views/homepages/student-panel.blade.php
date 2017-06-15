<div id="navigation-panel" class="col-sm-3">
		<ul id="main-navigation" class="nav col-sm-12" style="margin-top:15px;padding:40px 10px;">
		<div  id="slide" style="height:50px;padding:10px 0;">
			       		 <i id="hide-div-icon" class="fa fa-arrow-circle-left notification-icon" style="font-size:24px;" aria-hidden="true"></i>

       </div> 
		<a href="{{URL::to('/student/home')}}" style="text-decoration: none;color:white;"><li class="other-list-item">
					<i class="fa fa-tachometer" aria-hidden="true"></i>
					<p>	Dashboard </p>		
			</li></a>
		<a href="{{route('student-profile',$id)}}" style="text-decoration: none;color:white;"><li class="other-list-item">
						<i class="material-icons">perm_identity</i>
						<p>	Profile </p>		
				</li></a>
			<li class="other-list-item" onClick="goTo('{{URL::to('/')}}');"><i class="fa fa-search fa-5" aria-hidden="true"></i><p>Search Tool</p></li>
			<a href="{{route('resume-builder',$id)}}" style="text-decoration: none;color:white;" target="_blank"><li class="other-list-item" ><i class="material-icons">view_agenda</i><p>Resume Builder</p></li></a>
		</ul>
</div>