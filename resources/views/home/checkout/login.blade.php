<!DOCTYPE html>

<head>
    <base href="{{ asset('AdminPage') }}/">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

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
        .fa {
            padding: 5px;
            /* font-size: 8px; */
            width: 26px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            border-radius: 50%;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .fa-facebook {
            background: #3B5998;
            color: white;
        }

        .fa-google {
            background: #dd4b39;
            color: white;
        }
    </style>
</head>
<body>
    @include('admin.toast')
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Đăng nhập</h2>
            <form action="{{ route('customer.loginCustomer') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="email" class="ggg" name="email" placeholder="E-MAIL" value="{{ old('email') }}">
                <input type="password" class="ggg" name="password" placeholder="MẬT KHẨU">
                <span><input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />Lưu
                    mật khẩu</span>
                <h6>
                    <a class="btn btn-link" href="{{ route('Customer.forgetPassword') }}">
                        Quên mật khẩu ?
                    </a>
                </h6>
                <div class="clearfix"></div>
                <input type="submit" value="Sign In" name="login">
            </form>
            <a href="{{ route('loginFacebook') }}" class="fa fa-facebook"></a>
            <a href="{{ route('loginGoogle') }}" class="fa fa-google"></a>
            <p>Bạn chưa có tài khoản ?<a href="{{ route('customer.register') }}">Đăng ký</a></p>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
</body>

</html>