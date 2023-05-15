@extends('admin.dashboard')
@section('list_order')

    <div class="card1">

        <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 20px 0">
            <h1 class="">Danh Sách Đơn Hàng</h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="search-bar" style="display: flex; justify-content:space-between">
                <form class="search-form d-flex align-items-center" method="GET" action="">
                  <input
                  type="text"
                  name="key"
                  style="width: 350px; height: 40px; padding-left: 10px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;border-top: solid 1px gray; border-left: solid 1px gray; border-bottom: solid 1px gray;border-right: 0;"
                  placeholder="Tìm kiếm"
                  value="{{$key}}">
                  <button type="submit" style="height: 40px; background-color:white; padding-right: 15px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-top: solid 1px gray;border-right: solid 1px gray;border-bottom: solid 1px gray;border-left: 0;" title="Search"><i class="bi bi-search"></i></button>
                </form>
                <a href="{{route('add_order_admin')}}" class="btn btn-primary">Thêm Mới</a>
            </div>
            @if (Session::has('msg'))
            <div class="" style="display: flex; justify-content:center;">
                <h5 style="color:#ff1500">{{Session::get('msg')}}</h5>
            </div>
            @endif
          <table  style="text-align: center" id="example1" class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Tên mã giảm giá</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thêm lúc</th>
                    <th scope="col">Xem chi tiết</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $key => $order)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{number_format($order->price)}} VND</td>
                    <td>
                        @if (isset($order->voucher_name))
                            {{$order->voucher_name}}
                        @else
                            Không có phiếu giảm giá
                        @endif
                    </td>
                    <td><select style="height:40px" onchange="changeStatus({{$order->id}},{{$order->status}})" id="optionSelect-{{$order->id}}" name="status" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                        <option
                        @if ($order->status == 0)
                            selected
                        @endif
                        value="0">Đang Chờ Xác Nhận</option>
                        <option
                        @if ($order->status == 1)
                            selected
                        @endif
                        value="1">Đơn Hàng Đã Đặt</option>
                        <option
                        @if ($order->status == 2)
                            selected
                        @endif
                        value="2">Đã Giao Cho ĐVVC</option>
                        <option
                        @if ($order->status == 3)
                            selected
                        @endif
                        value="3">Đã Nhận Được Hàng</option>
                        <option
                        @if ($order->status == 4)
                            selected
                        @endif
                        value="4">Đơn Hàng Đặt Không Thành Công</option>
                    </select></td>
                    <td>{{$order->created_at}}</td>
                    <td><a href="{{route('list_order_detail', ['id_user' => $order->user_id, 'id'=>$order->id])}}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 pb-1" style="display: flex;  justify-content: center">
            {!! $orders->appends($data)->links() !!}
        </div>
    </div>

    <script>
        function changeStatus (id, oldStatus) {
            var status = $('#optionSelect-'+id).val();
            $.ajax({
                url: '{{route('updateStatus')}}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                    'status':status,
                    'oldStatus':oldStatus,
                }
            }).done(function(data) {
                console.log(data);
                if (data.success) {
                    swal("Thành Công!", "", "success");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    swal("Thất Bại!", "", "error");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            });
        }
    </script>
@endsection
