@extends('admin.dashboard')
@section('add_product')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 30px 0 0 0">
        <h1 class="">SHOW PRODUCT</h1>
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
                                    <p>Enter Product Code</p>
                                </div>
                                <input style="height:50px" type="text" name="code" value="{{$products->code}}" class="form-control" placeholder="Enter product code ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('code')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:50px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Enter Product Price</p>
                                </div>
                                <input style="height:50px" type="text" name="price" value="{{$products->price}}" class="form-control" placeholder="Enter product price ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('price')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left:10px">
                                <div class="">
                                    <p>Select manufacture</p>
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
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Enter Product Description</p>
                                </div>
                                <input style="height:50px" type="text" name="description" value="{{$products->description}}" class="form-control" placeholder="Enter product description ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('description')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div style="width: 500px; margin-top:30px; margin-left:10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Enter Product Name</p>
                                </div>
                                <input style="height:50px" type="text" value="{{$products->name}}" name="name" class="form-control" placeholder="Enter product name ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('name')}}</p>
                                    @endif
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left: 70px">
                                <div class="">
                                    <p>Select category</p>
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
                                    <p>Select Product Type</p>
                                </div>
                                <select style="height:50px; width: 500px;" name="product_type" value="{{$products->product_type}}" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                    <option value="0">Pecent</option>
                                    <option value="1">Vnd</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Enter Product Discount</p>
                                </div>
                                <input style="height:50px" type="text" name="discount" value="{{$products->discount}}" class="form-control" placeholder="Enter product discount ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('discount')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; margin-left:10px; flex-direction:column; margin-top:30px">
                                <div class="">
                                    <p>Select image</p>
                                </div>
                                <div style="width: 500px;" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                    <div style="width: 500px;" class="input-group flex-nowrap">
                                        <input style="height:50px" type="file" name="image" value="{{$products->image}}" class="form-control" placeholder="Enter product image ..." aria-label="Username" aria-describedby="addon-wrapping">
                                        <img src="{{asset('uploads/'.$products->image)}}" width="50px" height="50px" alt="error">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="justify" style="margin: 50px 0 0 10px; display:flex; justify-content: center; flex-direction: column;">
                    @if (isset($msg))
                    <p style="color: red">{{$msg}}</p>
                    @endif
                    <input class="btn btn-primary btn-user btn-block" value="SUBMIT" type="submit">
                </div>
            </form>

        </div>

    </div>

</div>
@endsection
