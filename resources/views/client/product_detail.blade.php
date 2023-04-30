<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shop Bán Đồ Gia Dụng</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="https://cdn-icons-png.flaticon.com/512/3771/3771009.png" rel="icon">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css_1/style.css')}}" rel="stylesheet">
    @routes()
</head>

<body>
   <!-- Topbar Start -->
   <div class="container-fluid" style="position: fixed; z-index: 1000; background-color:rgb(255, 250, 250);">
    <form action="{{route('show_product_index')}}" method="GET">
    <div class="row align-items-center py-3 px-xl-5" style="display: flex; justify-content:space-between">
        <div class="col-lg-4.5 d-none d-lg-block">
            <a href="{{route('client_index')}}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span style=" background-color:rgb(255, 255, 255);"  class="text-primary font-weight-bold border px-3 mr-1">Shop</span>Đồ Gia Dụng</h1>
            </a>
        </div>
        <div class="col-lg-4 text-left">
                <div class="input-group">
                    <input type="text" name="findProductByName" class="form-control" placeholder="Tìm Kiếm Sản Phẩm">
                        <div class="input-group-append" style="background-color:rgb(255, 255, 255);">
                            <span class="input-group-text bg-transparent text-primary">
                                <button style="border:0; height:24px; background-color:rgb(255, 255, 255);" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                </div>
        </div>
        <div class="col-lg-1.5 text-left">
            <?php
                if (Auth::check())
                {
            ?>
            <a href="{{route('infor_index')}}" class="nav-item nav-link">{{Auth::user()->name}}</a>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-1.5 text-left">
            <?php
                if (auth()->user())
                {
            ?>
                <a href="{{route('logout')}}" class="nav-item nav-link">Đăng Xuất</a>
            <?php
                } else {
            ?>
                <a href="{{route('login_page')}}" class="nav-item nav-link">Đăng Nhập</a>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-1 text-right">
            <a  style=" background-color:rgb(255, 255, 255);" @if (Auth::check())
                    href={{route('show_cart')}}
                @else
                    onclick="alertCart()"
                @endif
            class="btn border" >
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">
                    {{$count}}
                </span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid" style="padding-top: 80px">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Danh Mục</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @foreach ($categories as $category)
                            <a href="" class="nav-item nav-link">{{$category->name}}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            </form>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">T</span>Shop Bán Đồ Gia Dụng</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{route('client_index')}}" class="nav-item nav-link">Trang Chủ</a>
                            <a href="{{route('show_product_index')}}" class="nav-item nav-link active">Mua Sắm</a>
                            <a href="{{route('client_contact')}}" class="nav-item nav-link">Liên Hệ</a>
                            <a
                                @if (Auth::check())
                                    href="{{route('infor_order')}}"
                                    class="nav-item nav-link">Lịch Sử Mua Hàng</a>
                                @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Thông Tin Sản Phẩm</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('client_index')}}">---Trang Chủ---</a></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{asset('uploads/'.$product_detail->image)}}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <form action="" method="post">
                    @csrf
                    <h1 class="font-weight-semi-bold">{{$product_detail->name}}</h1>
                    <div class="" style="display: flex;">
                            @if ($product_detail->discount == 0)
                            <h5 style="color: rgb(78, 78, 78)">Giá:</h5><h5 class="font-weight-semi-bold" style="margin-left: 10px; color: red;">₫{{number_format($product_detail->price, 0, ",", ".")}}</h5>
                            @elseif ($product_detail->product_type == 0)
                            <h5 style="color: rgb(78, 78, 78)">Giá:</h5><h5 style=" color:gray; font-size:15px; margin-left: 10px"><i style="text-decoration: line-through;" >₫{{number_format($product_detail->price, 0, ",", ".")}}</i></h5>
                                <h5 style="color: red; margin-left: 10px" class="font-weight-semi-bold"> ₫{{number_format($product_detail->price * (1 - ($product_detail->discount / 100)), 0, ",", ".")}}</h5>
                            @elseif ($product_detail->product_type == 1)
                                <h5 style="color: rgb(78, 78, 78)">Giá:</h5><h5 style=" color:gray; font-size:15px; margin-left: 10px"><i style="text-decoration: line-through;" > ₫{{number_format($product_detail->price, 0, ",", ".")}}</i></h5>
                                <div class="">
                                    <h5 style="color: red; margin-left: 10px" class="font-weight-semi-bold"> ₫{{number_format($product_detail->price - $product_detail->discount, 0, ",", ".")}}</h5>
                                </div>
                            @endif
                    </div>
                    <h5  style="color: rgb(78, 78, 78)" class="font-weight-semi mb-4">Số lượng trong kho: {{$storages->quantity}}</h5>
                    <p class="mb-4">Nhà sản xuất:
                        @if (isset($product_detail->manufacture_id))
                            {{$product_detail->manufacture->name}}
                        @endif
                        </p>
                    <p class="mb-4">Mô tả: {{$product_detail->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3 group-quantity" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus" >
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" name="quantity" class="form-control bg-secondary text-center" value="1" />
                            <div class="input-group-btn group-plus">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button @if (Auth::check())
                                    type="submit"
                                    href={{route('cart_detail', ['id'=>$product_detail->id])}}
                                @else
                                    type="button"
                                    onclick="alertCart()"
                                @endif
                         class="btn btn-primary px-3"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1h5a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg></button>
                        <a  @if (Auth::check())
                                    href={{route('checkout_index') . '?productId=' . $product_detail->id}}
                                @else
                                    onclick="alertCart()"
                                @endif
                                id='btn_buy'
                             style="margin-left: 15px" class="btn btn-primary px-3"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                            <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                        </svg> Mua Ngay</a>
                    </div>
                    <div class="">
                        @if ($errors->all())
                        <span style="color: red">{{$errors->first('quantity')}}</span>
                        @endif
                    </div>
                    @if (Session::has('msg'))
                    <div class="">
                        <span style="color: red">{{Session::get('msg')}}</span>
                    </div>
                    @endif
                </form>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h5 class="mb-3">Mô Tả Sản Phẩm</h5>
                        <p>{{$product_detail->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Liên Quan</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($products as $product)
                        <div class="card product-item border-0">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <a href="{{route('product_detail', ['id'=>$product->id])}}"><img class="img-fluid w-100" src="{{asset('uploads/'.$product->image)}}" alt=""></a>
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <a href="{{route('product_detail', ['id'=>$product->id])}}"><h6 class="text-truncate mb-3">{{$product->name}}</h6></a>
                                <div class="d-flex justify-content-center">
                                    @if ($product->discount == 0)
                                    <h5 class="font-weight-semi-bold" style=" color: red;">₫{{number_format($product->price, 0, ",", ".")}}</h5>
                                    @elseif ($product->product_type == 0)
                                        <h5 style=" color:gray; font-size: 15px; margin-left: 10px"><i style="text-decoration: line-through;" >₫{{number_format($product->price, 0, ",", ".")}}</i></h5>
                                        <h5 style=" color:red; margin-left: 10px" class="font-weight-semi-bold">₫{{number_format($product->price * (1 - ($product->discount / 100)), 0, ",", ".")}}</h5>
                                    @else
                                        <h5 style=" color:gray; font-size: 15px; margin-left: 10px"><i style="text-decoration: line-through;" > ₫{{number_format($product->price, 0, ",", ".")}}</i></h5>
                                        <div class="">
                                        <h5 style="color: red; margin-left: 10px" class="font-weight-semi-bold">₫{{number_format($product->price - $product->discount, 0, ",", ".")}}</h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center bg-light border">
                                <a href="{{route('product_detail', ['id'=>$product->id])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Thông Tin Sản Phẩm</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="{{route('client_index')}}" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">Shop</span>Đồ Gia Dụng</h1>
            </a>
            <p>Sau hơn 10 năm hoạt động, bằng những nỗ lực không mệt mỏi, trung thành với chính sách “tận tâm phục vụ khách hàng”,
                Shop đồ gia dụng đã trở thành chuỗi bán lẻ hàng công nghệ hàng đầu, Shop đồ gia dụng trở thành chuỗi nhà thuốc số 1 về thuốc kê toa tại Việt Nam,
                Shop đồ gia dụng cũng ghi dấu ấn là nhà bán lẻ chính hãng hàng đầu với đầy đủ các chuẩn cửa hàng từ cấp độ cao cấp nhất. Shop đồ gia dụng đã,
                đang và sẽ tiếp tục chuyển đổi số một cách mạnh mẽ để nâng cao trải nghiệm khách hàng.</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Truy Cập Nhanh</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark" href="{{route('client_index')}}"><i class="fa fa-angle-right mr-2"></i>Trang Chủ</a>
                        <a class="text-dark" href="{{route('client_contact')}}"><i class="fa fa-angle-right mr-2"></i>Liên Hệ</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Truy Cập Nhanh</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark" href="{{route('show_product_index')}}"><i class="fa fa-angle-right mr-2"></i>Mua Sắm</a>
                        <a class="text-dark"
                            @if (Auth::check())
                            href={{route('show_cart')}}
                            @else
                                onclick="alertCart()"
                            @endif><i class="fa fa-angle-right mr-2"></i>Giỏ Hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('mail/contact.js')}}"></script>
    <script>
        $(document).ready(function () {
            var quantity = @json($storages->quantity);
            var url = $('#btn_buy').attr('href');
            $('#btn_buy').attr('href', url + '&&quantity=' + 1);
            $('.quantity button').on('click', function () {
                var button = $(this);
                var oldValue = button.parent().parent().find('input').val();
                if (button.hasClass('btn-plus')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    if (oldValue > 1) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 1;
                    }
                }
                $('#btn_buy').attr('href', url + '&&quantity=' + newVal);
                button.parent().parent().find('input').val(newVal);
                if (newVal >= quantity) {
                    $('.btn-plus').attr("disabled", true);
                } else {
                    $('.btn-plus').attr("disabled", false);
                }
                console.log(newVal);
            });

        })
        function alertCart(){
            swal({
            title: "Bạn muốn thực hiện hành động này?",
            text: "Hãy đăng nhập để thực hiện!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location.href = "{{route('login_page')}}";
            } else {
                swal("Thao tác thất bại!");
            }
            });
        }
    </script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>
