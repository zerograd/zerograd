<div id="admin-header" class="col-sm-12">
	<h1 style="float:left;">Dashboard&nbsp<i class="fa fa-bar-chart" aria-hidden="true"></i></h1>
	@if(Session::has('admin_name'))
		<h6 style="float:right;margin-right:10px;line-height: 5;"><a href="{{route('admin-logout')}}" style="color:white;text-decoration: none;">Logout&nbsp<i class="fa fa-sign-out" aria-hidden="true"></i></a></h6>
		<h4 style="float:right;margin-right:40px;line-height: 3;"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp{{Session::get('admin_name')}}</h4>
	@endif
</div>