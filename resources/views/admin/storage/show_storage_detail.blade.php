@extends('admin.dashboard')
@section('show_storage')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">Sửa Thông Tin Nhập Kho</h1>
    </div>

    <div class="add-bottom">

        <div class="add-bottom-input">

            <form action="" method="post" enctype="multipart/form-data">
                <a style="margin-left: 10px" href="{{route('list_storage_detail')}}" class="btn btn-primary">Danh Sách Nhập Kho</a>

                @csrf

                <div class="add-bottom-1">

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:50px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Số Lượng</p>
                                </div>
                                <input style="height:50px" type="text" name="quantity" value="{{$errors->all() ? old('quantity') : $storageDetails->quantity}}" class="form-control"
                                placeholder="Nhập Số Lượng" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('quantity')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:50px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Đơn Giá</p>
                                </div>
                                <input style="height:50px" type="text" name="price" value="{{$errors->all() ? old('price') : $storageDetails->price}}" class="form-control"
                                placeholder="Nhập Đơn Giá" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('price')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left: 10px">
                                <div class="">
                                    <p>Lần Nhập Thứ</p>
                                </div>
                                <div style="width: 500px;" class="input-group flex-nowrap">
                                    <input style="height:50px" type="text" name="number" value="{{$errors->all() ? old('number') : $storageDetails->number}}" class="form-control"
                                    placeholder="Nhập Mô Tả" aria-label="Username" aria-describedby="addon-wrapping">
                                    <div class="">
                                        @if ($errors->all())
                                        <span style="color: red">{{$errors->first('number')}}</span>
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
                    <input class="btn btn-primary btn-user btn-block" value="Sửa" type="submit">
                </div>
            </form>

        </div>

    </div>

</div>
@endsection
