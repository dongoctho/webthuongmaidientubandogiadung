@extends('admin.dashboard')
@section('list_user')

    <div class="card1">

        <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 20px 0">
            <h1 class="">Danh Sách Tài Khoản</h1>
        </div>
        <div class="card-body">
            <div class="search-bar" style="display: flex; justify-content:space-between">
                <form class="search-form d-flex align-items-center" method="GET" action="">
                  <input
                  type="text"
                  name="key"
                  style="width: 350px; height: 40px; padding-left: 10px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;border-top: solid 1px gray; border-left: solid 1px gray; border-bottom: solid 1px gray;border-right: 0;"
                  placeholder="Tìm Kiếm"
                  value="{{$key}}">
                  <button type="submit" style="height: 40px; background-color:white; padding-right: 15px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-top: solid 1px gray;border-right: solid 1px gray;border-bottom: solid 1px gray;border-left: 0;" title="Search"><i class="bi bi-search"></i></button>
                </form>
                <a href="{{route('add_user')}}" class="btn btn-primary">Thêm Mới</a>
            </div>
          <table class="table" style="text-align: center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên tài khoản</th>
                        <th scope="col">Địa chỉ email</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Phân quyền</th>
                        <th scope="col">Hình đại diện</th>
                        <th scope="col">Thêm lúc</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->birthday}}</td>
                            <td><select style="height:40px" onchange="changeStatus({{$user->id}},{{$user->role}})" id="optionSelect-{{$user->id}}" name="status" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                                <option
                                @if ($user->role == 0)
                                    selected
                                @endif
                                value="0">Quản lý</option>
                                <option
                                @if ($user->role == 1)
                                    selected
                                @endif
                                value="1">Khách hàng</option>
                                <option
                                @if ($user->role == 2)
                                    selected
                                @endif
                                value="2">Nhân viên</option>
                            </select></td>
                            <td><img src="{{asset('uploads/'.$user->avatar)}}" width="50px" height="35px" alt="not avatar"></td>
                            <td>{{$user->created_at}}</td>
                            <td><a style="color: red" style="cursor: pointer;" class="deleted" onclick="deleteCategory({{$user->id}})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 pb-1" style="display: flex;  justify-content: center">
            {!! $users->appends($data)->links() !!}
        </div>
    </div>
    <script>
        function changeStatus (id, oldRole) {
            var role = $('#optionSelect-'+id).val();
            $.ajax({
                url: '{{route('updateRole')}}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                    'role':role,
                    'oldRole':oldRole,
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

        function deleteCategory(id) {
            swal({
            title: "Bạn có chắc chắn xóa?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var url = 'delete/' + id;
                window.location = url;
                swal("Thành Công!", {
                icon: "success",
                });
            } else {
                swal("Thao Tác Thất Bại!");
            }
            });
        }
    </script>

@endsection
