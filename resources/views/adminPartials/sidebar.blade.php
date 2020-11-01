<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{ route('Admin.showDashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('category.create') }}">Thêm danh mục</a></li>
                        <li><a href="{{ route('category.index') }}">Danh sách danh mục</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('brand.create') }}">Thêm thương hiệu</a></li>
                        <li><a href="{{ route('brand.index') }}">Danh sách thương hiệu</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('product.create') }}">Thêm sản phẩm</a></li>
                        <li><a href="{{ route('product.index') }}">Danh sách sản phẩm</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('slider.create') }}">Thêm Slider</a></li>
                        <li><a href="{{ route('slider.index') }}">Liệt kê Slider</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('order.index') }}">Quản lý đơn hàng</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('coupon.index') }}">Quản lý mã giảm giá</a></li>
                        <li><a href="{{ route('coupon.create') }}">Thêm mã giảm giá</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Vận chuyển</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('delivery.index') }}">Quản lý vận chuyển</a></li>
                        {{-- <li><a href="{{ route('delivery.create') }}">Thêm mã giảm giá</a></li> --}}

                    </ul>
                </li>

            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>