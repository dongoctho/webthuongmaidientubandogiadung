@extends('admin.dashboard')
@section('show_storage')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">Sửa Thông Tin Kho Hàng</h1>
    </div>

    <div class="add-bottom">

        <div class="add-bottom-input">

            <form action="" method="post" enctype="multipart/form-data">
                <a style="margin-left: 10px" href="{{route('list_storage')}}" class="btn btn-primary">Danh Sách</a>

                @csrf

                <div class="add-bottom-1">

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:50px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Nhập Số Lượng</p>
                                </div>
                                <input style="height:50px" type="text" name="quantity" value="{{$errors->all() ? old('quantity') : $storages->quantity}}" class="form-control"
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
                                    <p>Nhập Mô Tả</p>
                                </div>
                                <input style="height:50px" type="text" name="description" value="{{$errors->all() ? old('description') : $storages->description}}" class="form-control"
                                placeholder="Nhập Mô Tả" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <span style="color: red">{{$errors->first('description')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left: 10px">
                                <div class="">
                                    <p>Chọn Sản Phẩm</p>
                                </div>
                                <div style="width: 500px;" class="input-group flex-nowrap">
                                    <select style="height:50px" name="product_id" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                        @foreach ($products as $product)
                                        <?php
                                            if ($storages->product_id == $product->id) {
                                                ?>
                                                <option selected value="{{$product->id}}">{{$product->name}}</option>
                                            <?php
                                            }else{
                                                ?>
                                                <option value="{{$product->id}}">{{$product->name}}</option>
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
