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
                    <th scope="col">Trở về trang giỏ hàng</th>
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
                    <td><a href="{{route('list_cart')}}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
                      </svg></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
