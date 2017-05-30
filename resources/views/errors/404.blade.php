
@extends('layout.header-layout')


@section('content')
<div class="col-sm-12" style="text-align: center;">
	<h2 style="margin:0;font-weight: 600;text-align: center;">Page does not exist</h2>

<a href="{{URL::to('/')}}" style="text-decoration:none;"><button class="btn btn-primary" style="margin:0 auto;" type="button">Return to Main Page</button></a>
</div>
@stop