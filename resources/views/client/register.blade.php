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
            <h3>Đăng ký để vào <strong style="color: rgb(255, 0, 98);">Shop đồ gia dụng</strong></h3>
            <p class="mb-4">Xin hãy tạo tài khoản.</p>
            <form action="" method="post">
                @csrf
              <div class="form-group first">
                <label for="username">Tên người dùng</label>
                <input type="text" class="form-control form-control-user name" value="{{old('name')}}" name="name" id="exampleFirstName"
                    placeholder="Nhập tên">
                    @if ($errors->all())
                <span style="color: red">{{$errors->first('name')}}</span>
                @endif
              </div>

              <div class="form-group last mb-3">
                <label for="password">Số điện thoại</label>
                <input type="text" class="form-control form-control-user phone" name="phone" value="{{old('phone')}}" id="exampleLastName"
                placeholder="Nhập số điện thoại">
                @if ($errors->all())
                <span style="color: red">{{$errors->first('phone')}}</span>
                @endif
              </div>

              <div class="form-group last mb-3">
                <label for="password">Ngày sinh</label>
                <input type="date" class="form-control form-control-user name" value="{{old('birthday')}}" name="birthday" id="exampleFirstName"
                    placeholder="Nhập ngày sinh">
                    @if ($errors->all())
                <span style="color: red">{{$errors->first('birthday')}}</span>
                @endif
              </div>

              <div class="form-group last mb-3">
                <label for="password">Nhập email</label>
                <input name="email" class="form-control form-control-user email" value="{{old('email')}}" id="exampleInputEmail"
                    placeholder="Nhập địa chỉ email">
                    @if ($errors->all())
                <span style="color: red">{{$errors->first('email')}}</span>
                @endif
              </div>

              <div class="form-group last mb-3">
                <label for="password">Nhập mật khẩu</label>
                <input type="password" name="password" class="form-control form-control-user password"
                    id="exampleInputPassword" placeholder="Nhập mật khẩu">
                @if ($errors->all())
                <span style="color: red">{{$errors->first('password')}}</span>
                @endif
              </div>

              <div class="form-group last mb-3">
                <label for="password">Nhập lại mật khẩu</label>
                <input type="password" name="repassword" class="form-control form-control-user repassword"
                    id="exampleRepeatPassword" placeholder="Nhập lại mật khẩu">
                @if ($errors->all())
                <span style="color: red">{{$errors->first('repassword')}}</span>
                @endif
              </div>
              <input type="submit" value="Đăng ký" class="btn btn-block btn-primary">
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
