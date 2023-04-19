<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng Nhập</title>

    <!-- Custom fonts for this template-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn-icons-png.flaticon.com/512/6681/6681204.png" rel="icon">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>


<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Đăng Nhập!</h1>
                                        </div>
                                        <form action="" method="post">
                                            @csrf
                                            <div class="form-group">
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
                                            <div class="form-group">
                                                <input type="password" name="password"
                                                    class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Nhập mật khẩu"
                                                    >
                                                    @if ($errors->all())
                                                    <p style="color: red">{{$errors->first('password')}}</p>
                                                    @endif
                                            </div>

                                            <input class="btn btn-primary btn-user btn-block" type="submit" value="Đăng nhập">
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
                                            <hr>
                                            <a href="{{route('login_google')}}" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Đăng nhập bằng google
                                            </a>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="{{route('register_page')}}">Bạn chưa có tài khoản? Tạo tài khoản!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
