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
                <!-- <div class="input-group">
                    <input type="text" name="findProductByName" class="form-control" placeholder="Tìm Kiếm Sản Phẩm">
                        <div class="input-group-append" style="background-color:rgb(255, 255, 255);">
                            <span class="input-group-text bg-transparent text-primary">
                                <button style="border:0; height:24px; background-color:rgb(255, 255, 255);" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                </div> -->
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
                            <a href="{{route('infor_order')}}" class="nav-item nav-link active">Lịch Sử Mua Hàng</a>
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Lịch Sử Mua Hàng</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('client_index')}}">---Trang Chủ---</a></p>
            </div>
        </div>
        @if (Session::has('msg'))
        <div class="" style="display: flex; justify-content:center;">
            <h1 style="color:#d19c97">{{Session::get('msg')}}</h1>
        </div>
        @endif
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table  style="text-align: center" id="example1" class="table">
                    <thead>
                    <tr>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Tổng giá</th>
                        <th scope="col">Giảm giá</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thanh toán lúc</th>
                        <th scope="col">Xem chi tiết</th>
                        <th scope="col">Hủy đơn hàng</th>
                        <th scope="col">Xuất hóa đơn</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{number_format($order->price)}} VND</td>
                        <td>
                            @if (isset($order->voucher->name))
                                {{$order->voucher->name}}
                            @else
                                Không có phiếu giảm giá
                            @endif
                        </td>
                        <td>
                            @if ($order->status == 0)
                            Đang Chờ Xác Nhận
                            @elseif ($order->status == 1)
                            Đơn Hàng Đã Đặt
                            @elseif ($order->status == 2)
                            Đã Giao Cho ĐVVC
                            @elseif ($order->status == 3)
                            Đã Nhận Được Hàng
                            @elseif ($order->status == 4)
                            Đơn Hàng Đặt Không Thành Công
                            @endif
                        </td>
                        <td>{{$order->created_at}}</td>
                        <td><a href="{{route('infor_order_detail', ['id_user' => $order->user_id, 'id'=>$order->id])}}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg></a></td>
                        <td>
                            @if ($order->status == 0)
                                <a class="btn btn-sm btn-primary" style="border-radius: 100%; background-color:rgb(255, 80, 80)" onclick="deleteCategory({{$order->id}})"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="26" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                </svg></a>
                            @endif
                        </td>
                        <td><a href="{{route('export_pdf', ['id'=>$order->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                              </svg>
                        </a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 pb-1" style="display: flex;  justify-content: center">
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
    <!-- Cart End -->


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
        function deleteCategory(id) {
            swal({
            title: "Bạn muốn hủy?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = 'infor/deleted/' + id;
                    window.location = url;
                    swal("Hủy thành công!", {
                    icon: "success",
                    });
                } else {
                    swal("Hủy Thất bại!");
                }
            });
        }

        function createOrder(id) {
            swal({
            title: "Bạn muốn đặt lại đơn hàng?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = 'infor/reorder/' + id;
                    window.location = url;
                } else {
                    swal("Đặt lại Thất bại!");
                }
            });
        }
    </script>
</body>

</html>
