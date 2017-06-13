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
	
      		<nav class="col-sm-12">
			       <div  id="slide" style="height:50px;padding:10px 0;">
			       		 <i id="show-div-icon" class="fa fa-arrow-circle-right notification-icon" style="font-size:24px;" aria-hidden="true"></i> 
			       		 <p style="float:left;color:black;margin-right:10px;">Show Panel</p>      
			       </div>               
      			<ul class="nav navbar-nav col-md-12 col-xs-12 " style="margin:0 auto;text-align: center;">
      			
				<!-- <li class="notifications">
					<div>
						<i class="fa fa-envelope notification-icon" aria-hidden="true"></i>
						<div class="notification-number">
							1
						</div>
					</div>
					
					<div onClick="notifications()">
						
							<i class="fa fa-bell-o notification-icon" aria-hidden="true" onClick="notifications();" ></i>
						
						
					</div>
				</li> -->
					<li id="user-list-item">
					<img src="{{URL::asset('/images/google.png')}}" alt="user-list-item">
					@if(Session::has('company_name'))
					<p>{{Session::get('company_name')}}</p>
					@endif()
				</li>

				</ul>
      		</nav>
	
			<script>
			var currentNavigationPanelWidth = 0;
			$(document).ready(function(){
				currentNavigationPanelWidth = $('#navigation-panel').width();
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

		// Slide the div out

		$('#show-div-icon').click(function(){
				
			$("#navigation-panel").css("display","block");		
			$( "#navigation-panel" ).animate({
			    width: currentNavigationPanelWidth
			  }, 200, function() {
			    // Animation complete.
			  });
		});

		$('#hide-div-icon').click(function(){	
				
			$( "#navigation-panel" ).animate({
			    width: "0"
			  }, 200, function() {
			    // Animation complete.
			    
			    $("#navigation-panel").css("display","none");	
			  });
		});

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