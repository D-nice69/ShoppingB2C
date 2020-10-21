<header id="header">
    <!--header-->
    <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ route('home.index') }}"><img src="images/home/logo.png" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li>
                            <li><a href="#"><i class="fa fa-star"></i>Đánh dấu</a></li>
                            <?php
                                $customerId = Session::get('customerId');
                                $shippingId = Session::get('shippingId');
                                if($customerId!=Null && $shippingId!=Null){                                
                            ?>
                            <li><a href="{{ route('customer.payment') }}"><i class="fa fa-crosshairs"></i>Thanh
                                    toán</a>
                            </li>
                            <?php 
                                }elseif ($customerId!=Null && $shippingId==Null) {                                   
                            ?>
                            <li><a href="{{ route('customer.checkout') }}"><i class="fa fa-crosshairs"></i>Thanh
                                toán</a>
                            </li>
                            <?php 
                            }else {                                    
                            ?>
                            <li><a href="{{ route('customer.login') }}"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                            </li>

                            <?php 
                            }
                            ?>

                            <li><a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                            <?php
                                $customerId = Session::get('customerId');
                                if($customerId!=Null){                                
                            ?>
                            <li><a href="{{ route('customer.logout') }}"><i></i>Đăng xuất</a></li>

                            <?php 
                            }else {                                    
                            ?>
                            <li><a href="{{ route('customer.login') }}"><i></i>Đăng nhập</a></li>
                            <?php 
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ route('home.index') }}" class="active">Trang chủ</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="login.html">Login</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="pull-right">
                        <form action="{{ route('home.search') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" placeholder="Tìm kiếm sản phẩm" name="keywords_submit" />
                            <button type="submit" name="search_items" class="fabutton">
                                <i class="search-box fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
<style>
    .fabutton {
        background: none;
        padding: 0px;
        border: none;
    }

    .search-box {
        color: rgb(214, 89, 6)
    }

    :hover.search-box {
        color: orange;
    }
</style>