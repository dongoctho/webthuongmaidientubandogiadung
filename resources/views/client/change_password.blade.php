<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                            </div>
                            <form action="" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        @if ($errors->all())
                                        <p style="color: red">{{$errors->first('oldpassword')}}</p>
                                        @endif
                                        <input style="text-align: center" type="text" class="form-control form-control-user name" value="{{old('oldpassword')}}" name="oldpassword" id="exampleFirstName"
                                            placeholder="Enter Old Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input style="text-align: center" type="password" name="password" class="form-control form-control-user password"
                                            id="exampleInputPassword" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input style="text-align: center" type="password" name="repassword" class="form-control form-control-user repassword"
                                            id="exampleRepeatPassword" placeholder="Repeat New Password">
                                    </div>
                                </div>
                                    <div class="" style="display: flex; justify-content:center;">
                                        <p style="color: red"></p>
                                    </div>
                                    @if ($errors->all())
                                        <script>
                                            swal({
                                                title: "Lỗi thay đổi mật khẩu !",
                                                text: "Hãy thực hiện lại",
                                                icon: "warning",
                                                buttons: true,
                                                dangerMode: true,
                                                })
                                        </script>
                                    @endif
                                <input
                                    class="btn btn-primary btn-user btn-block" type="submit" value="Change Password">
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="{{route('login_page')}}">Login</a>
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
