<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SHOP BÁN ĐỒ GIA DỤNG</title>
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
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">

        <form action="{{route('client_index')}}" method="GET">
            <div class="row align-items-center py-3 px-xl-5">
                <div class="col-lg-4.5 d-none d-lg-block">
                    <a href="{{route('client_index')}}" class="text-decoration-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Shop</span>Đồ Gia Dụng</h1>
                    </a>
                </div>
                <div class="col-lg-4 text-left">
                        <div class="input-group">
                            <input type="text" name="findProductByName" class="form-control" placeholder="Tìm Kiếm Sản Phẩm">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent text-primary">
                                    <button style="border:0; background-color:white;height:24px" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                </div>
            <div class="col-lg-1.5 text-left" >
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
                <a @if (Auth::check())
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
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Danh Mục</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <button style="background-color:white; border-top: 0; border-right:0; border-left:0; border-bottom: 1px rgb(193, 122, 122) solid " type="submit" name="seachByCategory" value="" class="nav-item nav-link">Tất Cả Danh Mục</button>
                        @foreach ($categories as $category)
                        <button style="border: 0; background-color:white" type="submit" name="seachByCategory" value="{{$category->id}}" class="nav-item nav-link">{{$category->name}}</button>
                        @endforeach
                </div>
            </form>
                </nav>
            </div>
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
                            <a href="{{route('client_index')}}" class="nav-item nav-link active">Trang Chủ</a>
                            <a href="{{route('show_product_index')}}" class="nav-item nav-link">Mua Sắm</a>
                            <a href="{{route('client_contact')}}" class="nav-item nav-link">Liên Hệ</a>
                            <a
                                @if (Auth::check())
                                    href="{{route('infor_order')}}"
                                @else
                                    onclick="alertCart()"
                                    class="nav-item nav-link">Lịch Sử Mua Hàng</a>
                                @endif
                        </div>
                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="https://cdn.tgdd.vn/2021/11/CookDish/cac-loai-do-gia-dung-hien-dai-cho-can-bep-nha-ban-them-tien-avt-1200x676.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">Giảm Giá 10% Cho Đơn Hàng Đầu Tiên</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Đồ Gia Dụng Cao Cấp</h3>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="https://toplisthanoi.com/wp-content/uploads/2022/03/do-gia-dung-ha-noi-7-min.png" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">đa dạng mẫu mã</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Giá Cả Hợp Lý</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Sản Phẩm Thân Thiện</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Miễn Phí Vận Chuyển</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Chính Sách Đổi Trả</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hỗ Trợ 24/24</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->



    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <a href="{{route('show_product_index')}}"><img src="https://khaisanfood.vn/wp-content/uploads/2022/10/5.jpeg" alt=""></a>
                    <div class="position-relative" style="z-index: 1;">
                        <a href="{{route('show_product_index')}}"><h5 class="text-uppercase text-primary mb-3">Giảm 20% tất cả các mặt hàng</h5></a>
                        <a href="{{route('show_product_index')}}"><h1 class="mb-4 font-weight-semi-bold">Mẫu mã đa dạng</h1></a>
                        <a href="{{route('show_product_index')}}" class="btn btn-outline-primary py-md-2 px-md-3">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <a href="{{route('show_product_index')}}"><img src="https://bucket.nhanh.vn/14f951-12134/art/artCT/20200810_25gc13HzjnCgLblb6Uwifk3n.jpg" alt=""></a>
                    <div class="position-relative" style="z-index: 1;">
                        <a href="{{route('show_product_index')}}"><h5 class="text-uppercase text-primary mb-3">Hoàn tiền 5% tất cả các mặt hàng</h5></a>
                        <a href="{{route('show_product_index')}}"><h1 class="mb-4 font-weight-semi-bold">Mẫu mã đa dạng</h1></a>
                        <a href="{{route('show_product_index')}}" class="btn btn-outline-primary py-md-2 px-md-3">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Bán Chạy</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <form action="" method="GET">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <a href="{{route('product_detail', ['id'=>$product->id])}}"><img class="img-fluid w-100" src="{{asset('uploads/'.$product->image)}}" alt=""></a>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <a href="{{route('product_detail', ['id'=>$product->id])}}"><h6 class="text-truncate mb-3">{{$product->name}}</h6></a>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('product_detail', ['id'=>$product->id])}}"><h6>{{number_format($product->price)}} Đ</h6></a>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('product_detail', ['id'=>$product->id])}}"><h6>Số sản phẩm đã bán: {{$product->sale}}</h6></a>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center bg-light border">
                            <a href="{{route('product_detail', ['id'=>$product->id])}}" style="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Thông Tin Sản Phẩm</a>
                        </div>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-1.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-2.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-3.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-4.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-5.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-6.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-7.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


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

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
    <script>
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
</body>

</html>
