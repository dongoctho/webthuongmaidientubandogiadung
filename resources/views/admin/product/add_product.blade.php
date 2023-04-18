@extends('admin.dashboard')
@section('add_product')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 30px 0 0 0">
        <h1 class="">Thêm Mới Sản Phẩm</h1>
    </div>

    <div class="add-bottom">
        <div class="add-bottom-input">
            <form action="" method="post" enctype="multipart/form-data">

                @csrf

                <div class="add-bottom-1">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:50px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Mã Sản Phẩm</p>
                                </div>
                                <input required="required" style="height:50px" type="text" name="code" value="{{old('code')}}" class="form-control"
                                placeholder="Nhập Mã Sản Phẩm" aria-label="Username" aria-describedby="addon-wrapping">
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
                                    <p>Nhập Đơn Giá</p>
                                </div>
                                <input required="required" style="height:50px" type="text" name="price" value="{{old('price')}}" class="form-control"
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
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left:10px">
                                <div class="">
                                    <p>Chọn Nhà Sản Xuất</p>
                                </div>
                                <div style="width: 500px;" class="input-group flex-nowrap">
                                    <select style="height:50px" name="manufacture_id" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                        @foreach ($manufactures as $manufacture)
                                            <option value="{{$manufacture->id}}">{{$manufacture->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex;  margin-left: 70px; flex-direction:column; margin-top:30px">
                                <div class="">
                                    <p>Chọn Hình Ảnh</p>
                                </div>
                                <div style="width: 500px;" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                    <input required="required" style="height:50px" type="file" name="image" class="form-control" placeholder="Chọn Hình Ảnh" aria-label="Username" aria-describedby="addon-wrapping">
                                    <div class="">
                                        @if ($errors->all())
                                        <span style="color: red">{{$errors->first('image')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:30px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Tên Sản Phẩm</p>
                                </div>
                                <input required="required" style="height:50px" type="text" name="name" value="{{old('name')}}" class="form-control"
                                placeholder="Nhập Tên Sản Phẩm" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left: 70px">
                                <div class="">
                                    <p>Chọn Danh Mục</p>
                                </div>
                                <div style="width: 500px;" class="input-group flex-nowrap">
                                    <select style="height:50px" name="category_id" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;margin-left:10px; " class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Mô Tả</p>
                                </div>
                                <div class="form-outline">
                                    <textarea required="required" class="form-control" name="description" id="textAreaExample1" rows="4"></textarea>
                                </div>
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('description')}}</span>
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
