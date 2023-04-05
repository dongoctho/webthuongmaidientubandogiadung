@extends('admin.dashboard')
@section('add_voucher')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">SHOW VOUCHER</h1>
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
                                    <p>Enter Voucher Code</p>
                                </div>
                                <input style="height:50px" type="text" name="code" value="{{$vouchers->code}}" class="form-control" placeholder="Enter product code ..." aria-label="Username" aria-describedby="addon-wrapping">
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
                                    <p>Enter Voucher Name</p>
                                </div>
                                <input style="height:50px" type="text" name="name" value="{{$vouchers->name}}" class="form-control" placeholder="Enter product name ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('name')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left:10px">
                                <div class="">
                                    <p>Select Voucher Type</p>
                                </div>
                                <select style="height:50px; width: 500px;" name="voucher_type" value="{{$vouchers->voucher_type}}" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                    <option value="0">Pecent</option>
                                    <option value="1">Vnd</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 70px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Enter Voucher Discount</p>
                                </div>
                                <input style="height:50px" type="text" name="discount" value="{{$vouchers->discount}}" class="form-control" placeholder="Enter product discount ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('discount')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <div style="width: 500px; margin-top:30px;  margin-left: 10px" class="flex-nowrap" style="display: flex; flex-direction:column;">
                                <div class="">
                                    <p>Enter Voucher Quantity</p>
                                </div>
                                <input style="height:50px" type="text" name="quantity" value="{{$vouchers->quantity}}" class="form-control" placeholder="Enter product quantity ..." aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="">
                                    @if ($errors->all())
                                    <p style="color: red">{{$errors->first('quantity')}}</p>
                                    @endif
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
