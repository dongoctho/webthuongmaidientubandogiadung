@extends('admin.dashboard')
@section('add_order_admin')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 30px 0 0 0">
        <h1 class="">Thêm Mới Đơn Hàng</h1>
    </div>

    <div class="add-bottom">
        <div class="add-bottom-input">
            <form action="" method="post" enctype="multipart/form-data">
                <a style="margin-left: 10px" href="{{route('list_order')}}" class="btn btn-primary">Danh Sách</a>
                @csrf

                <div class="add-bottom-1">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:50px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Tên Khách Hàng</p>
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
                            <div style="width: 500px; margin-top:50px;  margin-left: 10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
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
                            <div style="width: 500px; margin-top:50px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
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
                            <div style="width: 500px; margin-top:50px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
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

                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left: 10px">
                                    <div class="">
                                        <p>Chọn Sản Phẩm</p>
                                    </div>
                                    <div style="width: 500px;" class="input-group flex-nowrap">
                                        <select style="height:50px" name="product_id" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                            @foreach ($products as $product)
                                                <option value="{{$product->product_id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left: 70px">
                                    <div class="">
                                        <p>Chọn Phiếu Giảm Giá</p>
                                    </div>
                                    <div style="width: 500px;" class="input-group flex-nowrap">
                                        <select style="height:50px" name="voucher_id" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                            <option selected></option>
                                            @foreach ($vouchers as $voucher)
                                                <option value="{{$voucher->id}}">{{$voucher->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;margin-left:10px; " class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Số Lượng</p>
                                </div>
                                <input style="height:50px" type="text" name="quantity" value="{{old('quantity')}}" class="form-control"
                                placeholder="Nhập Số Lượng" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('quantity')}}</span>
                                    @endif
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
