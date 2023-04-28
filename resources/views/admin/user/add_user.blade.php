@extends('admin.dashboard')
@section('add_user')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 30px 0 0 0">
        <h1 class="">Thêm Mới Tài Khoản</h1>
    </div>

    <div class="add-bottom">
        <div class="add-bottom-input">
            <form action="" method="post" enctype="multipart/form-data">
                <a style="margin-left: 10px" href="{{route('list_user')}}" class="btn btn-primary">Danh Sách</a>

                @csrf

                <div class="add-bottom-1">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:50px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Tên Tài Khoản</p>
                                </div>
                                <input style="height:50px" type="text" name="name" value="{{old('name')}}" class="form-control"
                                placeholder="Nhập Tên Khách Hàng" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:50px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Số Điện Thoại</p>
                                </div>
                                <input  style="height:50px" type="text" name="phone" value="{{old('phone')}}" class="form-control"
                                placeholder="Nhập Số Điện Thoại" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('phone')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:30px;  margin-left: 10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Quốc Gia</p>
                                </div>
                                <input  style="height:50px" type="text" name="country" value="{{old('country')}}" class="form-control"
                                placeholder="Nhập Quốc Gia" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('country')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Tỉnh/Thành Phố </p>
                                </div>
                                <input  style="height:50px" type="text" name="city" value="{{old('city')}}" class="form-control"
                                placeholder="Nhập Tỉnh/Thành Phố" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('city')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:30px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Xã/Phường</p>
                                </div>
                                <input style="height:50px" type="text" name="ward" value="{{old('ward')}}" class="form-control"
                                placeholder="Nhập Xã/Phường" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('ward')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Số Nhà</p>
                                </div>
                                <input  style="height:50px" type="text" name="homenumber" value="{{old('homenumber')}}" class="form-control"
                                placeholder="Nhập Số Nhà" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('homenumber')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:30px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Địa Chỉ Email</p>
                                </div>
                                <input style="height:50px" type="text" name="email" value="{{old('email')}}" class="form-control"
                                placeholder="Nhập Địa Chỉ Email" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Ngày Sinh</p>
                                </div>
                                <input  style="height:50px" type="date" name="birthday" value="{{old('birthday')}}" class="form-control"
                                placeholder="Nhập Ngày Sinh" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('birthday')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:30px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Mật Khẩu</p>
                                </div>
                                <input style="height:50px" type="password" name="password" value="{{old('password')}}" class="form-control"
                                placeholder="Nhập Mật Khẩu" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('password')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left:70px">
                                <div class="">
                                    <p>Phân Quyền</p>
                                </div>
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('role')}}</span>
                                    @endif
                                <select style="height:50px; width: 500px" name="role" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                        <option
                                        @if (old('role') == 1)
                                            selected
                                        @endif
                                        value="1">Người dùng</option>
                                        <option
                                        @if (old('role') == 2)
                                            selected
                                        @endif
                                        value="2">Nhân Viên</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex;  margin-left: 10px; flex-direction:column; margin-top:30px">

                                <div class="">
                                    <p>Chọn Hình Ảnh</p>
                                </div>
                                <div style="width: 500px;" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                    <input
                                    value="{{old('avatar')}}"
                                    style="height:50px"
                                    type="file"
                                    name="avatar"
                                    class="form-control"
                                    placeholder="Chọn Hình Ảnh"
                                    aria-label="Username"
                                    aria-describedby="addon-wrapping">
                                    <div class="">
                                        @if ($errors->all())
                                        <span style="color: red">{{$errors->first('avatar')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="justify" style="margin: 50px 0 0 10px; display:flex; justify-content: center; flex-direction: column;">
                    @if (isset($msg))
                    <span style="color: red">{{$msg}}</span>
                    @endif
                    <input class="btn btn-primary btn-user btn-block" value="Thêm Mới" type="submit">
                </div>
            </form>
        </div>

    </div>

</div>
@endsection
