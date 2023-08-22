<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đổi Mật Khẩu</title>

    <!-- Custom fonts for this template-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary" style="background-image: linear-gradient(to right, rgb(53, 211, 211) , rgb(235, 194, 14)); font-family: Helvetica, Sans-Serif;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6" style="display: flex;
                                justify-content: center;
                                margin-top: 70px;">
                                        <form action="" method="post" style="display: flex;
                                        flex-direction: column;
                                        width: 350px;
                                        padding: 50px;
                                        box-shadow: 0px 0px 21px rgb(0 0 0 / 20%);
                                        background: white;
                                        border-radius: 25px;">
                                            @csrf
                                            <div class="text-center" style="text-align: center;">
                                                <h1 class="h4 text-gray-900 mb-4" style="color:rgb(87, 87, 87)">Đổi Mật Khẩu</h1>
                                            </div>
                                                @if ($errors->all())
                                                <span style="color: red">{{$errors->first('password')}}</span>
                                                @endif
                                                <input name="password"
                                                    class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Nhập mật khẩu mới"
                                                    style="border-top: 0px;
                                                    border-left: 0px;
                                                    border-right: 0px;
                                                    font-size: 20px;
                                                    margin-bottom: 40px;
                                                    padding: 5px 0 5px 0"
                                                    type="password"
                                                    >
                                                @if ($errors->all())
                                                <span style="color: red">{{$errors->first('repassword')}}</span>
                                                @endif
                                                <input name="repassword"
                                                    class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Nhập lại mật khẩu mới"
                                                    style="border-top: 0px;
                                                    border-left: 0px;
                                                    border-right: 0px;
                                                    font-size: 20px;
                                                    margin-bottom: 40px;
                                                    padding: 5px 0 5px 0"
                                                    type="password"
                                                    >

                                            <input class="btn btn-primary btn-user btn-block" type="submit" value="Xác nhận"
                                            style="
                                                color:white;
                                                margin-top: 30px;
                                                font-weight: bold;
                                                border: 0px;
                                                font-size: 23px;
                                                padding: 5px 0 5px 0;
                                                border-radius: 16px;
                                                background-image: linear-gradient(to right, rgb(26, 161, 161) , rgb(168, 140, 12));">
                                            <hr>
                                        </form>
                                        @if (Session::has('msg'))
                                                <script>
                                                    swal({
                                                        title: "{{Session::get('msg')}}",
                                                        buttons: true,
                                                        })
                                                </script>
                                        @endif
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
