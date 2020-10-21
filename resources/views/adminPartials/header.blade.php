<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="index.html" class="logo">
            ADMIN
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->

    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="">
                    <span class="username">
                        <?php
                            $message = Session::get('admin_name');
                            if($message){
                                echo $message;
                            }
                        ?>
                      
                    </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    {{-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li> --}}
                    {{-- <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> --}}
                    <li>
                        {{-- <a href="login.html"><i class="fa fa-key"></i> Log Out</a> --}}
                        <a class="dropdown-item" href="{{ route('Admin.logout') }}">
                            <i class="fa fa-key">
                            </i>Logout
                        </a>
                    </li>
                </ul>
            </li>
            <!-- user login dropdown end -->

        </ul>
        <!--search & user info end-->
    </div>
</header>