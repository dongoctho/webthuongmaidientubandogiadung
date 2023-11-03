<!DOCTYPE html>
<html>

<head>
    <title>Danh sách sản phẩm</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{asset('scss/style_pdf.css')}}">
</head>

<body>
    <div class="table-users">
        <div class="header">Danh Sách Sản Phẩm</div>

        <table cellspacing="0">
           <tr>
              <th>Hình sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Đơn giá</th>
              <th>Tổng giá</th>
           </tr>

           @foreach ($data as $key => $datas)
           <tr>
               <td align="center">
                   <img style="object-fit: cover" class="hinhSanPham" src="{{asset('uploads/'.$datas->image)}}" />
               </td>
               <td align="left">{{ $datas->name }}</td>
               <td align="left">{{ $datas->quantity }}</td>
               <td align="right">{{number_format($datas->price)}} VND</td>
               <td align="right">{{number_format($datas->price * $datas->quantity)}} VND</td>
           </tr>
           @endforeach
        </table>
     </div>
</body>

</html>
