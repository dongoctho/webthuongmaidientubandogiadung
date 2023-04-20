<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Quản Lý</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0VN5j6WlcXGAbSQ7KBsfevUmdd9q35w4bsw&usqp=CAU" rel="icon">
  <link href="{{asset('assetss/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com'" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assetss/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assetss/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assetss/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assetss/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assetss/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assetss/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assetss/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assetss/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0VN5j6WlcXGAbSQ7KBsfevUmdd9q35w4bsw&usqp=CAU" alt="">
        <span class="d-none d-lg-block">{{Auth::user()->name }}</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <div class="" style="display: flex; justify-content: flex-end; width:1100px">
        <a href="{{route('logout')}}">
            <span style="font-size: 16px; padding-right: 10px">Đăng Xuất</span><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
        </a>
    </div>
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="{{route('list_category')}}">
          <i class="bi bi-menu-button-wide"></i><span>Danh Mục</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('add_category')}}">
              <i class="bi bi-circle"></i><span>Thêm Mới Danh Mục</span>
            </a>
          </li>
          <li>
            <a href="{{route('list_category')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Danh Mục</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="{{route('list_manufacture')}}">
          <i class="bi bi-journal-text"></i><span>Nhà Sản Xuất</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('add_manufacture')}}">
              <i class="bi bi-circle"></i><span>Thêm Mới Nhà Sản Xuất</span>
            </a>
          </li>
          <li>
            <a href="{{route('list_manufacture')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Nhà Sản Xuất</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="{{route('list_product')}}">
          <i class="bi bi-layout-text-window-reverse"></i><span>Sản Phẩm</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('add_product')}}">
              <i class="bi bi-circle"></i><span>Thêm Mới Sản Phẩm</span>
            </a>
          </li>
          <li>
            <a href="{{route('list_product')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Sản phẩm</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="{{route('list_storage')}}">
          <i class="bi bi-bar-chart"></i><span>Kho Hàng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('add_storage')}}">
              <i class="bi bi-circle"></i><span>Thêm Mới Kho Hàng</span>
            </a>
          </li>
          <li>
            <a href="{{route('list_storage')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Kho Hàng</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="{{route('list_voucher')}}">
          <i class="bi bi-gem"></i><span>Phiếu Giảm Giá</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('add_voucher')}}">
              <i class="bi bi-circle"></i><span>Thêm Mới Phiếu Giảm Giá</span>
            </a>
          </li>
          <li>
            <a href="{{route('list_voucher')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Phiếu Giảm Giá</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#order" data-bs-toggle="collapse" href="{{route('list_order')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
              </svg><span style="margin-left: 10px">Đơn Hàng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="order" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('list_order')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Đơn Hàng</span>
            </a>
          </li>
          <li>
            <a href="{{route('add_order_admin')}}">
              <i class="bi bi-circle"></i><span>Thêm Đơn Hàng</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#cart" data-bs-toggle="collapse" href="{{route('list_cart')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg><span style="margin-left: 10px">Giỏ Hàng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="cart" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('list_cart')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Giỏ Hàng</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#user" data-bs-toggle="collapse" href="{{route('list_user')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
              </svg><span style="margin-left: 10px">Tài Khoản</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('add_user')}}">
              <i class="bi bi-circle"></i><span>Thêm Tài Khoản</span>
            </a>
          </li>
          <li>
            <a href="{{route('list_user')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Tài Khoản</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

  <!-- start yield -->
  @yield('add_category')
  @yield('show_category')
  @yield('list_category')
  @yield('add_manufacture')
  @yield('show_manufacture')
  @yield('list_manufacture')
  @yield('add_product')
  @yield('show_product')
  @yield('list_product')
  @yield('add_storage')
  @yield('show_storage')
  @yield('list_storage')
  @yield('add_voucher')
  @yield('show_voucher')
  @yield('list_voucher')
  @yield('list_order')
  @yield('list_order_detail')
  @yield('show_order')
  @yield('list_cart')
  @yield('add_order_admin')
  @yield('list_cart_detail')
  @yield('list_user')
  @yield('add_user')
  <!-- end yield -->

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assetss/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assetss/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assetss/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assetss/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assetss/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assetss/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assetss/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assetss/vendor/php-email-form/validate.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assetss/js/main.js')}}"></script>

</body>

</html>
