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

                {{-- @can('list_category') --}}
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Hồ sơ Shop</span>
                    </a>
                    <ul class="sub">
                        {{-- @can('add_category') --}}
                        <li><a href="{{ route('shop.index') }}">Cài đặt Shop</a></li>
                        {{-- @endcan --}}
                        {{-- <li><a href="{{ route('category.index') }}">Danh sách danh mục</a></li> --}}
                    </ul>
                </li>
                {{-- @endcan --}}

                @can('list_category')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục</span>
                    </a>
                    <ul class="sub">
                        @can('add_category')
                        <li><a href="{{ route('category.create') }}">Thêm danh mục</a></li>
                        @endcan
                        <li><a href="{{ route('category.index') }}">Danh sách danh mục</a></li>
                    </ul>
                </li>
                @endcan

                @can('list_brand')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('brand.create') }}">Thêm thương hiệu</a></li>
                        @can('add_brand')
                        <li><a href="{{ route('brand.index') }}">Danh sách thương hiệu</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('list_product')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        @can('add_product')
                        <li><a href="{{ route('product.create') }}">Thêm sản phẩm</a></li>
                        @endcan
                        <li><a href="{{ route('product.index') }}">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                @endcan

                @can('list_slider')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        @can('add_slider')
                        <li><a href="{{ route('slider.create') }}">Thêm Slider</a></li>
                        @endcan
                        <li><a href="{{ route('slider.index') }}">Danh sách Slider</a></li>
                    </ul>
                </li>
                @endcan

                @can('show_order')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('order.index') }}">Quản lý đơn hàng</a></li>
                        
                    </ul>
                </li>
                @endcan

                @can('list_coupon')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        @can('add_coupon')
                        <li><a href="{{ route('coupon.create') }}">Thêm mã giảm giá</a></li>
                        @endcan
                        <li><a href="{{ route('coupon.index') }}">Danh sách mã giảm giá</a></li>
                        
                    </ul>
                </li>
                @endcan

                @can('list_shipping')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Phí vận chuyển</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('delivery.index') }}">Quản lý phí vận chuyển</a></li>
                    </ul>
                </li>
                @endcan

                {{-- @can('list_shipping') --}}
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('categoryPost.create') }}">Thêm danh mục bài viết</a></li>
                        <li><a href="{{ route('categoryPost.index') }}">Danh sách danh mục bài viết</a></li>
                    </ul>
                </li>
                {{-- @endcan --}}

                {{-- @can('list_shipping') --}}
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('post.create') }}">Thêm bài viết</a></li>
                        <li><a href="{{ route('post.index') }}">Danh sách bài viết</a></li>
                    </ul>
                </li>
                {{-- @endcan --}}

                @can('list_user')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Phân quyền</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('adminCustomer.index') }}">Quản lý người dùng</a></li>
                    </ul>
                </li>
                @endcan

                @can('list_role')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý vai trò</span>
                    </a>
                    <ul class="sub">
                        @can('add_role')
                        <li><a href="{{ route('role.create') }}">Thêm vai trò</a></li>
                        @endcan
                        <li><a href="{{ route('role.index') }}">Danh sách vai trò</a></li>
                    </ul>
                </li>
                @endcan

            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>