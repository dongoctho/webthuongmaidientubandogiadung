@extends('admin.dashboard')
@section('add_product')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 30px 0 0 0">
        <h1 class="">Sửa Thông Tin Sản Phẩm</h1>
    </div>

    <div class="add-bottom">
        <div class="add-bottom-input">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <a style="margin-left: 10px" href="{{route('list_product')}}" class="btn btn-primary">Danh Sách</a>
                <div class="add-bottom-1">

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:50px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Mã Sản Phẩm</p>
                                </div>
                                <input
                                style="height:50px"
                                type="text"
                                name="code"
                                value="{{$errors->all() ? old('code') : $products->code}}"
                                class="form-control"
                                placeholder="Nhập Mã Sản Phẩm"
                                aria-label="Username"
                                aria-describedby="addon-wrapping">
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
                                <input style="height:50px" type="text" name="price" value="{{$errors->all() ? old('price') : $products->price}}" class="form-control"
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
                                        <?php
                                            if ($products->manufacture_id == $manufacture->id) {
                                                ?>
                                                <option selected value="{{$manufacture->id}}">{{$manufacture->name}}</option>
                                            <?php
                                            }else{
                                                ?>
                                                <option value="{{$manufacture->id}}">{{$manufacture->name}}</option>
                                                <?php
                                            }
                                            ?>
                                        @endphp
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; margin-left:70px; flex-direction:column; margin-top:30px">
                                <div class="">
                                    <p>Chọn Hình Ảnh</p>
                                </div>
                                <div style="width: 500px;" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                    <div style="width: 500px;" class="input-group flex-nowrap">
                                        <input style="height:50px" type="file" name="image" value="{{$products->image}}" class="form-control"
                                        accept=".jpg, .png" aria-label="Username" aria-describedby="addon-wrapping">
                                        <img src="{{asset('uploads/'.$products->image)}}" width="50px" height="50px" alt="error">
                                        <span>{{$products->image}}</span>
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
                                <input style="height:50px" type="text" value="{{$errors->all() ? old('name') : $products->name}}" name="name" class="form-control" placeholder="Nhập Tên Sản Phẩm" aria-label="Username" aria-describedby="addon-wrapping">
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
                                        <?php
                                            if ($products->category_id == $category->id) {
                                                ?>
                                                <option selected value="{{$category->id}}">{{$category->name}}</option>
                                            <?php
                                            }
                                            else{
                                                ?>
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                <?php
                                            }
                                            ?>
                                        @endphp
                                        @endforeach
                                    </select>
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
                                <select style="height:50px; width: 500px;" name="product_type" value="{{$errors->all() ? old('product_type') : $products->product_type}}" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                    <option
                                        @if ($products->product_type == 0)
                                            selected
                                        @endif
                                    value="0">Phần Trăm</option>
                                    <option
                                        @if ($products->product_type == 1)
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
                                <input style="height:50px" type="text" name="discount" value="{{$errors->all() ? old('discount') : $products->discount}}" class="form-control" placeholder="Nhập Giá Trị Giảm Giá" aria-label="Username" aria-describedby="addon-wrapping">
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
                                    <p>Nhập Mô Tả</p>
                                </div>
                                <div class="form-outline">
                                    <textarea class="form-control" name="description" id="textAreaExample1" rows="4">{{$errors->all() ? old('description') : $products->description}}</textarea>
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
                    <input class="btn btn-primary btn-user btn-block" value="Sửa" type="submit">
                </div>
            </form>

        </div>

    </div>

</div>
@endsection
