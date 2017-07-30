
	<style type="text/css">
		body{
			background-color: #656D8A;
			color:black;
		}
		
	</style>

	<div style="width:100%;text-align: center;">
		<h1>Below is your new password.Please use this to login and change your password</h1>
		<h2>Please use this password within 24 hours</h2>
		<h3>Cheers,</h3>
		<h4>ZeroGrad</h4>
		<p>Your temporary Password:{{$key}}</p>
		<a href="{{URL::to('/my-account')}}"style="text-decoration: none;color:white"><button class="btn btn-info" style="padding:20px;" >Login Page</button></a>
	</div>
