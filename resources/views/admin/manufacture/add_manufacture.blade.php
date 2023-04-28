@extends('admin.dashboard')
@section('add_manufacture')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">Thêm Nhà Sản Xuất</h1>
    </div>

    <div class="add-bottom">
        <div class="add-bottom-input">
            <form action="" method="post" enctype="multipart/form-data">
                    <a style="margin-left: 10px" href="{{route('list_manufacture')}}" class="btn btn-primary">Danh Sách</a>
                    @csrf
                <div class="form-group row">

                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="" style="display: flex; margin-left:10px; flex-direction:column; margin-top:30px">
                            <div class="">
                                <p>Nhập Mã Nhà Sản Xuất</p>
                            </div>
                            <input style="height:50px" type="text" name="code" value="{{old('code')}}" class="form-control"
                            placeholder="Nhập Mã Nhà Sản Xuất" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                        <div class="">
                            @if ($errors->all())
                            <span style="color: red; margin-left: 10px">{{$errors->first('code')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="" style="display: flex; margin-left:10px; flex-direction:column; margin-top:30px">
                            <div class="">
                                <p>Nhập Tên Nhà Sản Xuất</p>
                            </div>
                            <input style="height:50px" type="text" name="name" value="{{old('name')}}" class="form-control"
                            placeholder="Nhập Tên Nhà Sản Xuất" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                        <div class="" style="margin-left:10px">
                            @if ($errors->all())
                            <span style="color: red">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-sm-6">
                        <div class="" style="display: flex; margin-left:10px; flex-direction:column; margin-top:30px">
                            <div class="">
                                <p>Nhập Mô Tả</p>
                            </div>
                            <div class="form-outline">
                                <textarea class="form-control" name="description" id="textAreaExample1" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="">
                            @if ($errors->all())
                            <span style="color: red; margin-left:10px">{{$errors->first('description')}}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="justify" style="margin: 10px; display:flex; justify-content: center; flex-direction: column; margin-top: 40px;">
                    @if (isset($msg))
                    <span style="color: red">{{$msg}}</span>
                    @endif
                    <input class="btn btn-primary btn-user btn-block" value="Thêm Mới" type="submit">
                </div>
            </form>

        </div>

    </div>

</div>
@endsection
