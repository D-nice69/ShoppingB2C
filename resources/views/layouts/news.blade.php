<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ asset('eshopper') }}/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- SEO --}}
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="images/home/new.png" />
    <meta property="og:image" content="http://localhost:8000/uploads/products/aGKd53E6_700w_0643.jpg" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />
    {{-- END SEO --}}
    <title>@yield('title')</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
    <link href="css/category.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">


    @yield('css')
</head>
<!--/head-->

<body>
    <!--header-->
    @include('homePartials.header')

    <!--slider-->
    @yield('slider')

    <!--Content-->
    @yield('content_2')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <!--Footer-->
    @include('homePartials.footer')

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <div id="fb-root"></div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0"
        nonce="kYGdzKZT"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="js/sweetalert.min.js"></script>
    <script>

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            //select delivery
            $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city'){
                    result = 'district';
                }else{
                    result = 'town';
                }
                $.ajax({
                    url: '{{ route('delivery.select') }}',
                    method: 'POST',
                    data:{action:action, ma_id:ma_id, _token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
            });

            //add cart
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var _token = $('input[name="_token"]').val();
                if(parseInt(cart_product_qty) > parseInt(cart_product_quantity)){
                    swal({
                        title: "Không đủ hàng",
                        text: "Hiện tại shop chỉ còn "+cart_product_quantity+" sản phẩm",
                        showCancelButton: true,
                        showConfirmButton: false,
                        cancelButtonText: "Ok",
                        type: "warning",                        
                        closeOnConfirm: false
                    });
                }else{
                    $.ajax({
                        url: '{{route('cart.addCartAjax')}}',
                        method: 'POST',
                        data:{cart_product_quantity:cart_product_quantity,cart_product_id:cart_product_id,
                        cart_product_name:cart_product_name,cart_product_image:cart_product_image,
                        cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                        success:function(data){
                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{route('cart.show')}}";
                                }
                            );
                        }
                    });
                }
                
            });

            //calculate delivery fee
            $('.delivery_cal').click(function(){
                var matp = $('.city').val();
                var maqh = $('.district').val();
                var xaid = $('.town').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh == '' && xaid == '')
                {
                    alert('Vui lòng chọn để tính phí vận chuyển');
                }else{
                    $.ajax({
                    url: '{{ route('customer.deliveryCal') }}',
                    method: 'POST',
                    data:{matp:matp, maqh:maqh, xaid:xaid, _token:_token},
                    success:function(data){
                        location.reload();
                        }
                    });
                }
               
            });

             //add cart
            $('.send_order').click(function(){  
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    // closeOnCancel: false                    
                },               
                    function(isConfirm){
                        if(isConfirm){
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_note = $('.shipping_note').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var payment_select1 = [];
                            var payment_select = '';
                            $(':checkbox:checked').each(function(i){
                                payment_select1[i] = $(this).val();
                                payment_select = payment_select1[0];
                            });               
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: '{{route('order.confirm')}}',
                                method: 'POST',
                                data:{shipping_email:shipping_email,shipping_name:shipping_name
                                ,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_note:shipping_note
                                ,order_fee:order_fee,order_coupon:order_coupon,payment_select:payment_select,_token:_token},
                                success:function(data){
                                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                    window.setTimeout(function(){
                                        location.replace("{{ route('customer.thanks') }}");
                                    },1000);
                                }
                            });
                        }
                    }
                );              
                
            });
        });
    </script>
    @yield('js')
</body>

</html>