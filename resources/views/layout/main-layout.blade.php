<div id="navigation-panel" class="col-sm-1 hidden-sm-up">
		<ul id="main-navigation" class="nav col-sm-12" style="margin-top:15px;padding:40px 10px;">
			
		<a href="{{route('student-profile',$id)}}" style="text-decoration: none;color:white;"><li class="other-list-item">
						<i class="material-icons">perm_identity</i>
						<p>	Profile </p>		
				</li></a>
			<li class="other-list-item" onClick="goTo('{{URL::to('/')}}');"><i class="fa fa-search fa-5" aria-hidden="true"></i><p>Search Tool</p></li>
			<a href="{{route('resume-builder',$id)}}" style="text-decoration: none;color:white;" target="_blank"><li class="other-list-item" ><i class="material-icons">view_agenda</i><p>Resume Builder</p></li></a>
		</ul>
	</div>
	
      		<nav class="col-sm-11">
      			<ul class="nav navbar-nav col-md-4 col-md-push-7 col-xs-12 " style="margin:0 auto;text-align: center;">
				<li class="notifications" style="width:20%;">
					<div>
						<i class="fa fa-envelope notification-icon" aria-hidden="true"></i>
						<div class="notification-number">
							1
						</div>
					</div>
					
					<div onClick="notifications()">
						
							<i class="fa fa-bell-o notification-icon" aria-hidden="true" onClick="notifications();" ></i>
						
						<div class="notification-alert">
							@if(isset($notifications))
								{{$notificationsSize}}
							@endif
						</div>
						@if(isset($notifications))
							<div id="notifies" class="dropdown-content">
							    <ul>
							    	@foreach($notifications as $notification)
							    		@if($notification->type == 1)
							    			@include('friend-request')
						    			@elseif($notification->type == 2)
					    					@include('accepted-request')

				    					@elseif($notification->type == 3)
					    					@include('now-friends')
							    		@endif
							    	@endforeach
							    </ul>
						  	</div>
					  	@endif
					</div>
				</li>
					<li id="user-list-item">
						<img src="{{URL::asset('/images/me.jpg')}}" alt="user-list-item">
						@if(Session::has('student_name'))
							<p>{{Session::get('student_name')}}</p>
						@endif()
					</li>
				</ul>
      		</nav>
	
			<script>
			$(document).ready(function(){
				$('.notification-icon').on('click',function(){
					// notifications();
				});
			});
		function show(div){
			$("#" + div).show("slow");
		}
		function goTo(loc){
			window.location = loc;
		}

		function notifications() {
			var listItems = $('#notification-list').find('li');
			listItems.each(function(){
				var $input = $(this).find('input');
				var notificationId = $input.val();
				$.post('{{route('seen-notification')}}',{id:notificationId,_token:"{{csrf_token()}}"},function(data){
					console.log('seen it');
				});
			});	
			$('.notification-alert').css('opacity','0');
    		document.getElementById("notifies").classList.toggle("show");
		}

			// Close the dropdown menu if the user clicks outside of it
			window.onclick = function(event) {
			  if (!event.target.matches('.notifications div')) {

			    var dropdowns = document.getElementsByClassName("dropdown-content");
			    var i;
			    for (i = 0; i < dropdowns.length; i++) {
			      var openDropdown = dropdowns[i];
			      if (openDropdown.classList.contains('show')) {
			        openDropdown.classList.remove('show');
			      }
			    }
			  }
			}


		function acceptRequest(button){
			var parentDiv = $(button).parent();
			var from = parentDiv.find('input');
			$.post('{{route('accept-request')}}',{id:from.val(),_token:"{{csrf_token()}}"},function(data){
				alert('You are now friends');
			});
		}
	</script>