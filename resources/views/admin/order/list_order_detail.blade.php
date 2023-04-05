@extends('admin.dashboard')
@section('list_order_detail')

    <div class="card1">

        <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 20px 0">
            <h1 class="">LIST ORDER DETAILS</h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="POST" action="#">
                  <input type="text" style="width: 350px; height: 40px; padding-left: 10px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;border-top: solid 1px gray; border-left: solid 1px gray; border-bottom: solid 1px gray;border-right: 0;" name="query" placeholder="Search" title="Enter search keyword">
                  <button type="submit" style="height: 40px; background-color:white; padding-right: 15px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-top: solid 1px gray;border-right: solid 1px gray;border-bottom: solid 1px gray;border-left: 0;" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
          <table  style="text-align: center" id="example1" class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Imagae</th>
                    <th scope="col">Price Sum</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Back Order</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order_details as $order_detail)
                <tr>
                    <td>{{$order_detail->id}}</td>
                    <td>{{$order_detail->product->name}}</td>
                    <td>{{number_format($order_detail->price)}} Đ</td>
                    <td>{{$order_detail->quantity}}</td>
                    <td><img src="{{asset('uploads/'.$order_detail->image)}}" width="50px" height="35px" alt="error"></td>
                    <td>{{number_format($order_detail->quantity * $order_detail->price)}}</td>
                    <td>{{$order_detail->created_at}}</td>
                    <td><a href="{{route('list_order')}}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
                      </svg></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
