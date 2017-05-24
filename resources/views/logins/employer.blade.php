<form id="login-form" class="col-sm-12" >
			{{ csrf_field() }}
			<h2 style="color:#29C9C8;;">Please complete form below</h2>
			<input type="text" id="company_email" name="company_email" placeholder="Company Email" value=""/>
			<input id="password" name="password" type="password" placeholder="Password" />
			<button type="button" class="white-btn" style="margin:0 auto;padding:15px;" onClick="verifyEmployerLogin();">Login</button>
			<div class="links col-sm-12" style="margin-top: 5px;">
				<a href="#">Need to Contact Us?</a>
			</div>
</form>