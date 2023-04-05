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
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        @if ($errors->all())
                                        <p style="color: red">{{$errors->first('name')}}</p>
                                        @endif
                                        <input type="text" class="form-control form-control-user name" value="{{old('name')}}" name="name" id="exampleFirstName"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="col-sm-6">
                                        @if ($errors->all())
                                        <p style="color: red">{{$errors->first('phone')}}</p>
                                        @endif
                                        <input type="text" class="form-control form-control-user phone" name="phone" value="{{old('phone')}}" id="exampleLastName"
                                            placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('email')}}</p>
                                    @endif
                                    <input type="text" name="email" class="form-control form-control-user email" value="{{old('email')}}" id="exampleInputEmail"
                                        placeholder="Enter Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user password"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="repassword" class="form-control form-control-user repassword"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                    <div class="" style="display: flex; justify-content:center;">
                                        <p style="color: red"></p>
                                    </div>
                                    @if ($errors->all())
                                        <script>
                                            swal({
                                                title: "Lỗi đăng ký !",
                                                text: "Hãy thực hiện lại",
                                                icon: "warning",
                                                buttons: true,
                                                dangerMode: true,
                                                })
                                        </script>
                                    @endif
                                <input
                                    class="btn btn-primary btn-user btn-block" type="submit" value="Register">
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{route('login_page')}}">Already have an account? Login!</a>
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
