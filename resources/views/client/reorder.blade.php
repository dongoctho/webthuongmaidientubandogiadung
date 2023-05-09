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
                        <button style="background-color:rgb(255, 219, 219); border-top: 0; border-right:0; border-left:0; border-bottom: 1px rgb(193, 122, 122) solid " type="submit" name="seachByCategory" value="" class="nav-item nav-link">Tất Cả Danh Mục</button>
                        @foreach ($categories as $category)
                        <button style="border: 0; background-color:rgb(254, 223, 223)" type="submit" name="seachByCategory" value="{{$category->id}}" class="nav-item nav-link">{{$category->name}}</button>
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
                            <a href="{{route('show_product_index')}}" class="nav-item nav-link">Mua Sắm</a>
                            <a href="{{route('client_contact')}}" class="nav-item nav-link">Liên Hệ</a>
                            <a href="{{route('infor_order')}}" class="nav-item nav-link">Lịch Sử Mua Hàng</a>
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Thanh Toán</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('client_index')}}">---Trang Chủ---</a></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->



    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông Tin Khách Hàng</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Họ Và Tên</label>
                            <input class="form-control" name="name" value="{{$order->name}}" type="text">
                            <div class="" style="">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('name')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số Điện Thoại</label>
                            <input class="form-control" value="{{$order->phone}}" type="text" name="phone" placeholder="Số Điện Thoại...">
                            <div class="" style="">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('phone')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Quốc Gia</label>
                            <input class="form-control" value="{{$address[3]}}" type="text" name="country" placeholder="Quốc Gia...">
                            <div class="" style="">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('country')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tỉnh/Thành Phố</label>
                            <input class="form-control" value="{{$address[2]}}" type="text" name="city" placeholder="Tỉnh/Thành Phố...">
                            <div class="" style="">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('city')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Xã/Phường</label>
                            <input class="form-control" value="{{$address[1]}}" type="text" name="ward" placeholder="Xã/Phường...">
                            <div class="" style="">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('ward')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số Nhà</label>
                            <input class="form-control" value="{{$address[0]}}" type="text" name="homenumber" placeholder="Số Nhà...">
                            <div class="" style="">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('homenumber')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Thông Tin Đơn Hàng</h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered text-center mb-0">
                            <thead class="bg-secondary text-dark">
                                <tr>
                                    <th>Sản Phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn Giá</th>
                                    <th>Tổng Giá</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach ($cartDetails as $cartDetail)
                                <tr>
                                    <td class="align-middle">{{$cartDetail->product_name}}</td>
                                    <td class="align-middle">{{$cartDetail->quantity}}</td>
                                    <td class="align-middle">
                                        @if ( $cartDetail->product_type == 0 )
                                            {{number_format($cartDetail->price * (1 - ($cartDetail->discount / 100)))}} VND
                                        @elseif ( $cartDetail->product_type == 1 )
                                            {{number_format($cartDetail->price - $cartDetail->discount)}} VND
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if ( $cartDetail->product_type == 0 )
                                            {{number_format($cartDetail->quantity * ($cartDetail->price * (1 - ($cartDetail->discount / 100))))}} VND
                                        @elseif ( $cartDetail->product_type == 1 )
                                            {{number_format($cartDetail->quantity * ($cartDetail->price - $cartDetail->discount))}} VND
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="mt-0">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0" style="border-bottom: 1px gray solid; padding-bottom: 20px">Phiếu Giảm Giá</h4>
                        </div>
                        <table class="table table-bordered text-center mb-0">
                            <select style="height:50px" id="selectBox" name="voucher_id" class="form-control voucher-select" aria-label="Username" aria-describedby="addon-wrapping">
                                    <option selected>---</option>
                                    @foreach ($vouchers as $voucher)
                                        <option value="{{$voucher->voucher_type}}-{{$voucher->discount}}-{{$voucher->id}}">{{$voucher->name}}</option>
                                    @endforeach
                            </select>
                        </table>
                    </div>
                    <input value="{{$product_id}}" name="product_id" type="text" hidden>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng tiền</h5>
                            <span style="font-weight:bold; font-size: 20px" id="sumPrice">{{number_format($sumPrice, 0, ",", ".")}} VND</span>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Thanh Toán</h4>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Thanh Toán</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Checkout End -->


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
        $(document).ready(function () {

            $('#selectBox').on('change', function () {
                var sum = @json($sumPrice);
                var voucher = $(this).val();
                var voucherDetail = voucher.split('-');
                var priceHandle = 0;

                if (voucherDetail[0] == 0) {
                    priceHandle = sum * (1 - (voucherDetail[1] / 100));
                }
                if (voucherDetail[0] == 1) {
                    priceHandle = sum - voucherDetail[1];
                    if (priceHandle < 0) {
                        priceHandle = 0;
                    }
                }
                $('#price').attr('value', priceHandle);
                var priceFormat = priceHandle.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                $('#sumPrice').text(priceFormat);
            })
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
</body>

</html>
