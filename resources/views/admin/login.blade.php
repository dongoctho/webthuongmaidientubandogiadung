<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="{{ asset('styleLogin/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ asset('styleLogin/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('styleLogin/css/bootstrap.min.css')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('styleLogin/css/style.css')}}">

    <title>Đăng nhập</title>
  </head>
  <body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{asset("styleLogin/images/bg_1.jpg")}}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>Đăng nhập vào <strong style="color: rgb(255, 0, 98);">Shop đồ gia dụng</strong></h3>
            <p class="mb-4">Xin hãy đăng nhập.</p>
            <form action="" method="post">
                @csrf
              <div class="form-group first">
                <label for="username">Tên đăng nhập</label>
                <input name="email"
                class="form-control form-control-user"
                id="exampleInputEmail" aria-describedby="emailHelp"
                placeholder="Nhập địa chỉ email"
                value="{{old('email')}}"
                >
                @if ($errors->all())
                <p style="color: red">{{$errors->first('email')}}</p>
                @endif
            </div>
              <div class="form-group last mb-3">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password"
                class="form-control form-control-user"
                id="exampleInputPassword" placeholder="Nhập mật khẩu"
                >
                @if ($errors->all())
                <p style="color: red">{{$errors->first('password')}}</p>
                @endif
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a style="font-size: larger" href="{{route('index_forgot')}}" class="forgot-pass">Quên mật khẩu</a></span>
              </div>

              <input type="submit" value="Đăng nhập" class="btn btn-block btn-primary">
              <hr>
            </form>
            <a style="font-size: larger" href="{{route('login_google')}}" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Đăng nhập bằng google
            </a>
            <div class="text-center">
                <a style="font-size: larger" class="small" href="{{route('register_page')}}">Bạn chưa có tài khoản? Tạo tài khoản!</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if ($errors->all())
    <script>
        swal({
            title: "Lỗi đăng nhập !",
            text: "Hãy thực hiện lại",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
    </script>
@endif
@if (Session::has('msg'))
    <script>
        swal({
            title: "{{Session::get('msg')}}",
            buttons: true,
            })
    </script>
@endif
  </div>



    <script src="{{ asset('styleLogin/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('styleLogin/js/popper.min.js')}}"></script>
    <script src="{{ asset('styleLogin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('styleLogin/js/main.js')}}"></script>
  </body>
</html>
