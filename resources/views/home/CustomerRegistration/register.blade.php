<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
	<base href="{{ asset('AdminPage') }}/">
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
	</script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/style-responsive.css" rel="stylesheet" />
	<!-- font CSS -->
	<link
		href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
		rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<script src="js/jquery2.0.3.min.js"></script>
	<style>
		p.alert-success{
			color: rgb(7, 80, 7)
		}
	</style>
</head>

<body>
	<div class="reg-w3">
		<div class="w3layouts-main">
			<div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>
			<h2>Register Now</h2>
			<form action="{{ route('customer.add') }}" method="post" enctype="multipart/form-data">
				@csrf
				<input type="text" class="ggg" name="name" placeholder="NAME" required="">
				<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
				<input type="text" class="ggg" name="phone" placeholder="PHONE" required="">
				<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
				<div class="clearfix"></div>
				{{-- <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
				@if($errors->has('g-recaptcha-response'))
				<span class="invalid-feedback" style="display:block">
					<strong>{{$errors->first('g-recaptcha-response')}}</strong>
				</span>
				@endif --}}
				<h4><input type="checkbox" />I agree to the Terms of Service and Privacy Policy</h4>
				<input type="submit" value="Đăng ký">
			</form>


			<p>Already Registered.<a href="login.html">Login</a></p>
		</div>
	</div>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="js/scripts.js"></script>
	<script src="js/jquery.slimscroll.js"></script>
	<script src="js/jquery.nicescroll.js"></script>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
	<script src="js/jquery.scrollTo.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	
</body>

</html>