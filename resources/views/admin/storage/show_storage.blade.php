@extends('admin.dashboard')
@section('show_storage')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">SHOW STORAGE</h1>
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
                                    <p>Enter Storage Quantity</p>
                                </div>
                                <input style="height:50px" type="text" name="quantity" value="{{$storages->quantity}}" class="form-control" placeholder="Enter product quantity ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('quantity')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:50px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Enter Storage Description</p>
                                </div>
                                <input style="height:50px" type="text" name="description" value="{{$storages->description}}" class="form-control" placeholder="Enter storage des ..." aria-label="Username" aria-describedby="addon-wrapping">
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
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left: 10px">
                                <div class="">
                                    <p>Select product</p>
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
                    <p style="color: red">{{$msg}}</p>
                    @endif
                    <input class="btn btn-primary btn-user btn-block" value="SUBMIT" type="submit">
                </div>
            </form>

        </div>

    </div>

</div>
@endsection
