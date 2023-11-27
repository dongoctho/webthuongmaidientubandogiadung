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
            <h3>Quên đăng nhập để vào <strong style="color: rgb(255, 0, 98);">Shop đồ gia dụng</strong></h3>
            <p class="mb-4">Xin hãy nhập email.</p>
            <form action="" method="post">
                @csrf
              <div class="form-group first">
                <label for="username">Nhập email</label>
                <input name="email"
                class="form-control form-control-user"
                id="exampleInputEmail" aria-describedby="emailHelp"
                placeholder="Nhập địa chỉ email"
                >
                @if ($errors->all())
                <p style="color: red">{{$errors->first('email')}}</p>
                @endif
            </div>
              <input type="submit" value="Gửi yêu cầu" class="btn btn-block btn-primary">
              <hr>
            </form>
            <div class="text-center">
                <a class="small" href="{{route('login_page')}}">Bạn đã có tài khoản? Đăng nhập!</a>
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
