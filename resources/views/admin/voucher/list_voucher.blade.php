@extends('admin.dashboard')
@section('list_voucher')

    <div class="card1">

        <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 20px 0">
            <h1 class="">Danh Sách Phiếu Giảm Giá</h1>
        </div>

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
                <a href="{{route('add_voucher')}}" class="btn btn-primary">Thêm Mới</a>
            </div>
          <table id="example1" class="table" style="text-align: center">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã phiếu giảm giá</th>
                    <th scope="col">Tên phiếu giảm giá</th>
                    <th scope="col">Giá trị giảm giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Kiểu giảm giá</th>
                    <th scope="col">Thêm lúc</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($vouchers as $key => $voucher)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$voucher->code}}</td>
                    <td>{{$voucher->name}}</td>
                    <td>{{$voucher->discount}}</td>
                    <td>{{$voucher->quantity}}</td>
                    <td>
                        @if ($voucher->voucher_type == 0)
                            Phần Trăm
                        @else
                            Giá Tiền
                        @endif
                    </td>
                    <td>{{$voucher->created_at}}</td>
                    <td><a href="{{route('show_voucher', ['id'=>$voucher->id])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg></a></td>
                    <td><a style="color:red" onclick="return confirm('Delete selected data?')"
                        href="{{route('delete_voucher', ['id'=>$voucher->id])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                          </svg></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 pb-1" style="display: flex;  justify-content: center">
            {!! $vouchers->appends($data)->links() !!}
        </div>
    </div>


@endsection
