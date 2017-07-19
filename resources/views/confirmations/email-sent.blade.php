<html>
<head>

	<link rel="stylesheet" href="{{URL::asset('/theme/css/style.css')}}">
	<link rel="stylesheet" href="{{URL::asset('/theme/css/colors/green.css')}}" id="colors">
	<style type="text/css">
		html,body{
			width:100%;
			height: 100%;
			margin:0;
		}
		.row {
			min-height: 150px;
		}

		h2 {
			font-size:20px;
			margin:0;
			text-align: left;
		}

		h3{
			font-size:16px;
			margin:0;
			text-align: left;
		}

		span {
			margin-left: 30px;
			text-align: left;
		}
	</style>
</head>
<body style="background-color: #c6c6c6;">
    <div style="width:50%;height:100%;margin:0 25%;background-color:white;">
    	<!-- logo row -->
    	<div class="row" style="text-align: center;">
    		<h1>ZeroGrad</h1>
    	</div>
    	<div class="row" style="text-align: center;min-height:200px;background-color: #26ae61;padding: 50px 0 0 0; ">
    		<i class="fa fa-check-circle-o" aria-hidden="true" style="color:white;font-size: 72px;"></i>
    		<h1 style="margin:0;color:white;font-weight: 25px;">Verify your Account</h1>
    	</div>

    	<!-- Content -->
    	<div class="row" style="background-color:white;min-height:400px;padding:20px;text-align: center;">
    		<h2>Your Account information:</h2>
    		<h3>Your Name:<span>{{$name}}</span></h3>
    		<h3>Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span>{{$email}}</span></h3>
    		<h3 style="margin-bottom: 40px;">Verify Link:&nbsp&nbsp<a href="{{route('verify-student',$hash)}}"><span>{{route('verify-student',$hash)}}</span></a></h3>
    		<hr>
    		<a href="{{route('verify-student',$hash)}}" style="margin:0 auto;"><button type="button">VERIFY YOUR ACCOUNT</button></a>
    		<p style="color:black;margin:40px 0;text-align: left;">If you are having any issues with your account, please don't hesitate to contact us by replying to this mail. 
			Thank you!</p>
			<hr>
			<p style="font-size: 14px;">You’re receiving this email because you have an registered for ZeroGrad. If you are not sure why you’re receiving this, please contact us.</p>
    	</div>
    </div>
</body>
</html>
