@extends('admin.dashboard')
@section('list_cart_detail')

    <div class="card1">

        <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 20px 0">
            <h1 class="">Thông Tin Chi Tiết</h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table  style="text-align: center" id="example1" class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tổng giá</th>
                    <th scope="col">Thêm lúc</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cart_details as $key => $cart_detail)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$cart_detail->name}}</td>
                    <td>{{number_format($cart_detail->price)}} VND</td>
                    <td>{{$cart_detail->quantity}}</td>
                    <td><img src="{{asset('uploads/'.$cart_detail->image)}}" width="50px" height="35px" alt="error"></td>
                    <td>{{number_format($cart_detail->quantity * $cart_detail->price)}} VND</td>
                    <td>{{$cart_detail->created_at}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="justify" style="margin: 10px; display:flex; justify-content: center; flex-direction: column; margin-top: 40px;">
                <a class="btn btn-primary btn-user btn-block" href="{{route('list_cart')}}">Trở Về</a>
            </div>
        </div>
    </div>


@endsection
