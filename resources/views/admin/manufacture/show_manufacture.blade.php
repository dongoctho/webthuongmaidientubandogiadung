@extends('admin.dashboard')
@section('show_category')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">SHOW MANUFACTURE</h1>
    </div>

    <div class="add-bottom">

        <div class="add-bottom-input">

            <form action="" method="post" enctype="multipart/form-data">

                @csrf

                <div class="add-bottom-1">

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; margin-left:10px; flex-direction:column; margin-top:30px">
                                <div class="">
                                    <p>Enter Manufacture Code</p>
                                </div>
                                <input style="height:50px" type="text" name="code" value="{{$manufactures->code}}" class="form-control" placeholder="Enter manufacture code ..." aria-label="Username" aria-describedby="addon-wrapping">
                            </div>
                            <div class="">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('code')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="" style="display: flex; margin-left:10px; flex-direction:column; margin-top:30px">
                                <div class="">
                                    <p>Enter Manufacture Description</p>
                                </div>
                                <input style="height:50px" type="text" name="description" value="{{$manufactures->description}}" class="form-control" placeholder="Enter manufacture des ..." aria-label="Username" aria-describedby="addon-wrapping">
                            </div>
                            <div class="">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('description')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="" style="display: flex; margin-left:10px; flex-direction:column; margin-top:30px">
                                <div class="">
                                    <p>Enter Manufacture Name</p>
                                </div>
                                <input style="height:50px" type="text" name="name" value="{{$manufactures->name}}" class="form-control" placeholder="Enter manufacture name ..." aria-label="Username" aria-describedby="addon-wrapping">
                            </div>
                            <div class="" style="margin-left:20px">
                                @if ($errors->all())
                                <p style="color: red">{{$errors->first('name')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="justify" style="margin: 10px; display:flex; justify-content: center; flex-direction: column; margin-top: 40px;">
                    @if (isset($msg))
                    <p style="color: red">{{$msg}}</p>
                    @endif
                    <input class="btn btn-primary btn-user btn-block" value="SUBMIT" type="submit">
                </div>

            </form>

        </div>

    </div>

</div>
@endsection
