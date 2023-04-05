@extends('admin.dashboard')
@section('show_order')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 30px 0 0 0">
        <h1 class="">EDIT STATUS ORDER</h1>
    </div>

    <div class="add-bottom">
        <div class="add-bottom-input">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="add-bottom-1">

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; flex-direction:column; margin-top:30px; margin-left:10px">
                                <div class="">
                                    <p>Edit Status</p>
                                </div>
                                <div style="width: 500px;" class="input-group flex-nowrap">
                                    <select style="height:50px" name="status" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                            <option
                                            @if ($order->status == 0)
                                                selected
                                            @endif
                                            value="0">Đang Chờ Xác Nhận</option>
                                            <option
                                            @if ($order->status == 1)
                                                selected
                                            @endif
                                            value="1">Đơn Hàng Đặt Không Thành Công</option>
                                            <option
                                            @if ($order->status == 2)
                                                selected
                                            @endif
                                            value="2">Đơn Hàng Đã Đặt</option>
                                            <option
                                            @if ($order->status == 3)
                                                selected
                                            @endif
                                            value="3">Đã Giao Cho ĐVVC</option>
                                            <option
                                            @if ($order->status == 4)
                                                selected
                                            @endif
                                            value="4">Đã Nhận Được Hàng</option>
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
