@extends('admin.dashboard')
@section('add_category')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">Thêm Danh Mục</h1>
    </div>

    <div class="add-bottom">

        <div class="add-bottom-input">

            <form id="form" action="" method="POST">
                @csrf

                <div class="add-bottom-1">
                    <a style="margin-left: 10px" href="{{route('list_category')}}" class="btn btn-primary">Danh Sách</a>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; margin-left:10px; flex-direction:column; margin-top:30px">
                                <div class="">
                                    <p>Nhập Mã Danh Mục</p>
                                </div>
                                <input style="height:50px" type="text" id="code" name="code" value="{{old('code')}}" class="form-control"
                                placeholder="Nhập mã danh mục" aria-label="Username" aria-describedby="addon-wrapping">
                            </div>
                            <div class="" style="margin-left:10px">
                                @if ($errors->all())
                                <span style="color: red">{{$errors->first('code')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="" style="display: flex; margin-right:10px; flex-direction:column; margin-top:30px">
                                <div class="">
                                    <p>Nhập Tên Danh Mục</p>
                                </div>
                                <input style="height:50px" type="text" id="name" name="name" class="form-control" value="{{old('name')}}"
                                placeholder="Nhập tên danh mục" aria-label="Username" aria-describedby="addon-wrapping">
                            </div>
                            <div class="">
                                @if ($errors->all())
                                <span style="color: red">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="justify" style="margin: 10px; display:flex; justify-content: center; flex-direction: column; margin-top: 40px;">
                    <input class="btn btn-primary btn-user btn-block" value="Thêm Mới" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
