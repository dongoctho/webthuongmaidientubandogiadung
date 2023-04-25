@extends('admin.dashboard')
@section('list_cart')

    <div class="card1">

        <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 20px 0">
            <h1 class="">Danh Sách Giỏ Hàng</h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="GET" action="">
                  <input
                  type="text"
                  name="key"
                  style="width: 350px; height: 40px; padding-left: 10px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;border-top: solid 1px gray; border-left: solid 1px gray; border-bottom: solid 1px gray;border-right: 0;"
                  placeholder="Tìm kiếm"
                  value="{{$key}}">
                  <button type="submit" style="height: 40px; background-color:white; padding-right: 15px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-top: solid 1px gray;border-right: solid 1px gray;border-bottom: solid 1px gray;border-left: 0;" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
          <table  style="text-align: center" id="example1" class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Thêm lúc</th>
                    <th scope="col">Xem chi tiết</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($carts as $key => $cart)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$cart->name}}</td>
                    <td>{{$cart->created_at}}</td>
                    <td><a href="{{route('list_cart_detail', ['id_user' => $cart->user_id])}}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="col-12 pb-1" style="display: flex;  justify-content: center">
            {!! $carts->appends($data)->links() !!}
        </div>
    </div>


@endsection
