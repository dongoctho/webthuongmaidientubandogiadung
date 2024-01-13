<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hóa đơn mua hàng</title>
  <style>
    /* CSS styles for the invoice */
    body {
      font-family: Arial, sans-serif;
      background-image: linear-gradient(to right, rgb(211, 255, 208), rgb(255, 220, 188));
    }
    .invoice {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      border-radius: 15px;
      background-color: white;
    }
    .invoice-header,
    .invoice-body,
    .invoice-footer {
      margin-bottom: 20px;
    }
    .invoice-header h2 {
      text-align: center;
      color: #df3c67;
    }
    .invoice-body table {
      width: 100%;
      border-collapse: collapse;
    }
    .invoice-body th {
        color: #df3c67;
    }
    .invoice-body th,
    .invoice-body td {
      border: 1px solid rgb(229, 229, 229);
      padding: 8px;
    }
    .invoice-footer {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="invoice">
    <div class="invoice-header">
      <h2>HÓA ĐƠN MUA HÀNG</h2>
      <p><b style="color: #df3c67;">Ngày xuất hóa đơn: </b> {{$time}}</p>
      <p><b style="color: #df3c67;">Người xuất hóa đơn: </b> {{$user->name}}</p>
    </div>
    <div class="invoice-body">
      <table>
        <thead>
          <tr>
            <th>Sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $datas)
            <tr>
                <td align="left">{{ $datas->name }}</td>
                <td align="right">{{number_format($datas->price)}} VND</td>
                <td align="right">{{ $datas->quantity }}</td>
                <td align="right">{{number_format($datas->price * $datas->quantity)}} VND</td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <div class="invoice-footer">
      @if (isset($order->voucher_id))
      <h3><span style="color: #df3c67;">Phiếu giảm giá:</span> {{$order->voucher->name}}</h3>
      @endif
      <h3><span style="color: #df3c67;">Tổng tiền:</span> {{ number_format($order->price )}} VND</h3>
    </div>
  </div>

  <script>
    // JavaScript code to generate PDF from HTML
    function generatePDF() {
      var invoice = document.querySelector('.invoice');
      var opt = {
        margin: 10,
        filename: 'hoa-don-mua-hang.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
      };
      html2pdf().from(invoice).set(opt).save();
    }
  </script>

  <!-- Include html2pdf library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</body>
</html>

