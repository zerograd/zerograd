<form id="login-form" class="col-sm-12" >
			{{ csrf_field() }}
			<h2 style="color:#29C9C8;;">Please login in below</h2>
			<input type="text" id="email" name="email" placeholder="Email" value=""/>
			<input type="password" id="password" name="password" placeholder="Password" value=""/>
			<button type="button" class="white-btn" style="margin:0 auto;padding:15px;" onClick="verifyLogin();">Login</button>
			<div class="links col-sm-12" style="margin-top: 5px;">
				<a href="#">Forgot Password?</a>
				<a href="#">Need to Contact Us?</a>
			</div>
		</form>