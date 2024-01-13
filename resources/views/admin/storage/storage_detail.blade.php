@extends('admin.dashboard')
@section('list_storage')

    <div class="card1">

        <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 20px 0">
            <h1 class="">Thông Tin Nhập Kho</h1>
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
                <a href="{{route('list_storage')}}" class="btn btn-primary">Danh Sách Kho Hàng</a>
            </div>
            @if (Session::has('msg'))
            <div class="" style="display: flex; justify-content:center;">
                <h5 style="color:#ff1500">{{Session::get('msg')}}</h5>
            </div>
            @endif
          <table id="example1" class="table" style="text-align: center">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Lần nhập thứ</th>
                    <th scope="col">Tổng giá</th>
                    <th scope="col">Thêm lúc</th>
                    <th scope="col">Sửa</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($storageDetails as $key => $storageDetail)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$storageDetail->storage->product->name}}</td>
                    <td>{{$storageDetail->quantity}}</td>
                    <td>{{number_format($storageDetail->price)}} VND</td>
                    <td>{{$storageDetail->number}}</td>
                    <td>{{number_format($storageDetail->price * $storageDetail->quantity)}} VND</td>
                    <td>{{$storageDetail->created_at}}</td>
                    <td><a href="{{route('show_storage_detail', ['id'=>$storageDetail->id])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 pb-1" style="display: flex;  justify-content: center">
            {!! $storageDetails->appends($data)->links() !!}
        </div>
    </div>


@endsection
