@extends('layout.newthemelayout')

@section('title')
	<title>ZeroGrad: Editing Mode</title>
@stop


@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container remodal-bg">
        <div class="ten columns">
            <h2 editable-text="user.company_name"><% user.company_name || "Enter Company Name" %>&nbsp</h2>
        </div>

        <div class="six columns">
            
        </div>

    </div>
</div>


<!-- Content
================================================== -->
<div class="container remodal-bg">
    
    <!-- Recent Jobs -->
    <div class="eleven columns">
    <div class="padding-right">
        
        <!-- Company Info -->
        <div class="company-info">
            <img src="{$path}" alt="">
            <div class="content">
                <h4 editable-text="user.company_name"><% user.company_name || "Enter Company Name" %></h4>
                
                <span><a href="{{$company->website}}" target="_blank" editable-text="user.website"><i class="fa fa-at" aria-hidden="true"></i><%user.website || "Specify a company website"%></a></span>
                
            </div>
            <div class="clearfix"></div>
        </div>

        

        <br>
        <h3>Summary:</h3>

        <p editable-textarea="user.company_overview" e-rows="7" e-cols="40" ><% user.company_overview || "Add a Summary"%></p>
        
        <br>

        

        <ul class="list-1">
            
        </ul>

    </div>
    </div>


    <!-- Widgets -->
    <div class="four columns">

        <!-- Sort by -->
        <div class="widget">
            <h4>Overview</h4>

            <div class="job-overview">
                
                <ul>
                    <li>
                        <i class="fa fa-building"></i>
                        <div>
                            <strong>Headquaters:</strong>
                            <span editable-text="user.company_location"><% user.company_location || "Specify Location"%></span>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <div>
                            <strong>Company Size:</strong>    
                            <span editable-text="user.employees"><% user.employees || "Specify company size"%></span>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div>
                            <strong>Telephone:</strong>    
                            <span></span>
                        </div>
                    </li>
                </ul>


                

                
                

            </div>

        </div>

    </div>
    <!-- Widgets / End -->


</div>



@stop

@section('script_plugins')

<!-- Angular code for this page -->
	<script type="text/javascript">

		app.controller('Ctrl', function($scope) {
		  $scope.user = {
		    company_name: '{{$company->company_name}}',
		    company_overview: '{{$company->company_overview}}',
		    employees: '{{$company->employees}}',
		    company_location: '{{$company->company_location}}',
		    website: '{{$company->website}}'
		  };  

		  $scope.updateProfile = function(){

		  	 var data = this.user;

		  	 data['_token'] = "{csrf_token()}";

		  	 $.post("{route('profile-update')}",data,function(data){
		  	 	if(data == 'Success'){
		  	 		swal(
					  'Good job!',
					  "Profile Saved.",
					  'success'
					);
		  	 	}
		  	 });
		  };

		});
		
		
	</script>
@stop