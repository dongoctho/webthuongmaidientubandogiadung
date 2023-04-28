@extends('admin.dashboard')
@section('add_voucher')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">Sửa Thông Tin Phiếu Giảm Giá</h1>
    </div>

    <div class="add-bottom">

        <div class="add-bottom-input">

            <form action="" method="post" enctype="multipart/form-data">
                <a style="margin-left: 10px" href="{{route('list_voucher')}}" class="btn btn-primary">Danh Sách</a>

                @csrf

                <div class="add-bottom-1">

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:50px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Mã Phiếu Giảm Giá</p>
                                </div>
                                <input style="height:50px" type="text" name="code" value="{{$errors->all() ? old('code') : $vouchers->code}}" class="form-control"
                                placeholder="Nhập Mã Giảm Giá" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('code')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:50px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Tên Phiếu Giảm Giá</p>
                                </div>
                                <input style="height:50px" type="text" name="name" value="{{$errors->all() ? old('name') : $vouchers->name}}" class="form-control"
                                placeholder="Nhập Tên Mã Giảm Giá" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left:10px">
                                <div class="">
                                    <p>Chọn Kiểu Giảm Giá</p>
                                </div>
                                <select style="height:50px; width: 500px;" name="voucher_type" value="{{$vouchers->voucher_type}}" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                    <option
                                    @if ($vouchers->voucher_type == 0)
                                        selected
                                    @endif
                                    value="0">Phần Trăm</option>
                                    <option
                                    @if ($vouchers->voucher_type == 1)
                                        selected
                                    @endif
                                    value="1">Giá Tiền</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Giá Trị Giảm Giá</p>
                                </div>
                                <input style="height:50px" type="text" name="discount" value="{{$errors->all() ? old('discount') : $vouchers->discount}}" class="form-control"
                                placeholder="Nhập Giá Trị Giảm Giá" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('discount')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Số Lượng</p>
                                </div>
                                <input style="height:50px" type="text" name="quantity" value="{{$errors->all() ? old('quantity') : $vouchers->quantity}}" class="form-control"
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
                    <input class="btn btn-primary btn-user btn-block" value="Sửa" type="submit">
                </div>
            </form>

        </div>

    </div>

</div>
@endsection
