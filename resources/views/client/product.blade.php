<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shop Đồ Gia Dụng</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="https://cdn-icons-png.flaticon.com/512/3771/3771009.png" rel="icon">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
    <form action="{{route('show_product_index')}}" method="GET">
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
            <a onclick="alertCart()" class="btn border" >
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">
                    {{$count}}
                </span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->
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
            window.location.href = "{{route('show_cart')}}";
        } else {
            swal("Thao tác thất bại!");
        }
        });
    }
</script>


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Danh Mục</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                            <button style="background-color:white; border-top: 0; border-right:0; border-left:0; border-bottom: 1px rgb(193, 122, 122) solid " type="submit" name="seachByCategory" value="" class="nav-item nav-link">Tất Cả Danh Mục</button>
                            @foreach ($categories as $category)
                            <button style="border: 0; background-color:white" type="submit" name="seachByCategory" value="{{$category->id}}" class="nav-item nav-link">{{$category->name}}</button>
                            @endforeach
                    </div>
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
                        <a href="{{route('client_index')}}" class="nav-item nav-link">Trang Chủ</a>
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
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Mua Sắm</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('client_index')}}">---Trang Chủ---</a></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Tìm Kiếm Theo Giá Sản Phẩm</h5>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox"
                            class="custom-control-input"
                            id="price-1"
                            {{ (isset($condition['seachByPrice']) && $condition['seachByPrice'] == 1) ? 'checked' : ''  }}
                            name="seachByPrice"
                            value="1">
                            <label class="custom-control-label" for="price-1">0 Đ - 50,000 Đ</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input  {{ (isset($condition['seachByPrice']) && $condition['seachByPrice'] == 2) ? 'checked' : ''  }}
                            type="checkbox"
                            class="custom-control-input"
                            id="price-2"
                            name="seachByPrice"
                            value="2">
                            <label class="custom-control-label" for="price-2">50,000 Đ - 200,000 Đ</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input  {{ (isset($condition['seachByPrice']) && $condition['seachByPrice'] == 3) ? 'checked' : ''  }}
                            type="checkbox"
                            class="custom-control-input"
                            id="price-3"
                            name="seachByPrice"
                            value="3">
                            <label class="custom-control-label" for="price-3">200,000 Đ - 500,000 Đ</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input  {{ (isset($condition['seachByPrice']) && $condition['seachByPrice'] == 4) ? 'checked' : ''  }}
                            type="checkbox"
                            class="custom-control-input"
                            id="price-4"
                            name="seachByPrice"
                            value="4">
                            <label class="custom-control-label" for="price-4">500,000 Đ - 2,000,000 Đ</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input  {{ (isset($condition['seachByPrice']) && $condition['seachByPrice'] == 5) ? 'checked' : ''  }}
                            type="checkbox"
                            class="custom-control-input"
                            id="price-5"
                            name="seachByPrice"
                            value="5">
                            <label class="custom-control-label" for="price-5">Từ 2,000,000 Đ trở lên</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <button style="margin-top: 20px" type="submit" class="btn btn-primary btn-lg">Tìm Kiếm Sản Phẩm</button>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->
            <script>
                $("input:checkbox").on('click', function() {
                var $box = $(this);
                if ($box.is(":checked")) {
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                } else {
                    $box.prop("checked", false);
                }
                });
            </script>

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <a href="{{route('product_detail', ['id'=>$product->product_id])}}"><img class="img-fluid w-100" src="{{asset('uploads/'.$product->image)}}" alt=""></a>
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <a href="{{route('product_detail', ['id'=>$product->product_id])}}"><h6 class="text-truncate mb-3">{{$product->name}}</h6></a>
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('product_detail', ['id'=>$product->product_id])}}">
                                        @if ($product->discount == 0)
                                        <h6 class="text-muted ml-2">{{number_format($product->price)}} VND</h6>
                                        @elseif ($product->product_type == 0)
                                        <h6 class="text-muted ml-2">{{number_format($product->price)}} VND</h6>
                                        <h6 class="text-muted ml-2">{{number_format($product->price * (1 - ($product->discount / 100)))}} VND</h6>
                                        @elseif ($product->product_type == 1)
                                        <div class="" style="display: flex; justify-content:center">
                                            <h6 style="text-decoration: line-through;" class="text-muted ml-2">{{number_format($product->price)}} VND</h6>
                                            <h6 class="text-muted ml-2"> -> {{number_format($product->price - $product->discount)}} VND</h6>
                                        </div>
                                        @endif
                                        </a>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center bg-light border">
                                <a href="{{route('product_detail', ['id'=>$product->product_id])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Thông Tin Sản Phẩm</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


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
</body>

</html>
