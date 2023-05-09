@extends('admin.dashboard')
@section('list_order_detail')

    <div class="card1">

        <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 20px 0">
            <h1 class="">Chi Tiết Đơn Hàng</h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table  style="text-align: center" id="example1" class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Số Lượng</th>
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Tổng giá</th>
                    <th scope="col">Thêm lúc</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order_details as $key => $order_detail)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$order_detail->name}}</td>
                    <td><?php
                        $priceHandle = 0;
                        if ( $order_detail->product_type == 0 ) {
                            $priceHandle = $order_detail->price * (1 - ($order_detail->discount / 100));
                        } else if ( $order_detail->product_type == 1 ) {
                            $priceHandle = $order_detail->price - $order_detail->discount;
                        }
                        ?>
                        {{number_format($priceHandle)}} VND</td>

                        <td>{{$order_detail->quantity}}</td>
                    <td><img src="{{asset('uploads/'.$order_detail->image)}}" width="50px" height="35px" alt="error"></td>
                    <td>{{number_format($order_detail->quantity * $priceHandle)}} VND</td>
                    <td>{{$order_detail->created_at}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <div class="justify" style="margin: 10px; text-align: center; margin-top: 40px;">
                @if (isset($order->voucher_id))
                    <p style="color: rgb(255, 54, 54); font-size:20px">Phiếu giảm giá: {{$order->voucher->name}}</p>
                    @endif
                <h3>Tổng Tiền: {{number_format($order->price)}} VND</h3>
            </div>
            <div class="justify" style="margin: 10px; display:flex; justify-content: center; flex-direction: column; margin-top: 40px;">
                <a class="btn btn-primary btn-user btn-block" href="{{route('list_order')}}">Trở Về</a>
            </div>
        </div>
    </div>


@endsection
