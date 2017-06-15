<div id="navigation-panel" class="col-sm-3">
		<ul id="main-navigation" class="nav col-sm-12" style="margin-top:15px;padding:40px 10px;">
		<div  id="slide" style="height:50px;padding:10px 0;">
			       		 <i id="hide-div-icon" class="fa fa-arrow-circle-left notification-icon" style="font-size:24px;" aria-hidden="true"></i>

       </div> 
		<a href="{{URL::to('/employer/home')}}" style="text-decoration: none;color:white;"><li class="other-list-item">
					<i class="fa fa-tachometer" aria-hidden="true"></i>
					<p>	Dashboard </p>		
			</li></a>
		<a href="#" style="text-decoration: none;color:white;"><li class="other-list-item">
					<i class="material-icons">perm_identity</i>
					<p>	Employees </p>		
			</li></a>
			<a href="{{URL::to('/employer/create-posting')}}" style="text-decoration: none;color:white;"><li class="other-list-item" onClick="goTo('{{URL::to('/')}}');"><i class="fa fa-search fa-5" aria-hidden="true"></i><p>Create a Posting</p></li></a>
			<a href="{{URL::to('/employer/profile/')}}/{{Session::get('employer_id')}}" style="text-decoration: none;color:white;"><li class="other-list-item" ><i class="fa fa-search fa-5" aria-hidden="true"></i><p>Company Profile</p></li></a>

		</ul>
</div>