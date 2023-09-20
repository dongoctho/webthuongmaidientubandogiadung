@extends('admin.dashboard')
@section('statistical')
<div class="card1">

    <div class="category_top" style="margin: 50px 0 0 0;">
        <div class="statistical" style="display:flex; justify-content:space-around;">
            <div class="statis-left" style="border-radius: 15px;display:flex; justify-content: space-around;color:white; background-image: linear-gradient(to right, rgb(212, 117, 173) , rgb(71, 93, 221)); width:300px;">
                <div class="icon" style="padding-top: 30px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                        <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                        <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>
                      </svg>
                </div>
                <div class="title" style="text-align:center; font-weight: bold; padding-top:15px">
                    <p style="font-size: 30px">{{ $countproduct[0]['countProduct'] }}</p>
                    <p style="">Tổng số sản phẩm hiện có</p>
                </div>
            </div>
            <div class="statis-center1" style="border-radius: 15px;display:flex; justify-content: space-around;color:white; background-image: linear-gradient(to right, rgb(71, 93, 221) , rgb(32, 196, 168)); width:300px;">
                <div class="icon" style="padding-top: 30px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                      </svg>
                </div>
                <div class="title" style="text-align:center; font-weight: bold; padding-top:15px">
                    <p style="font-size: 30px">{{number_format($sumPrice[0]['sumPrice'])}} ₫</p>
                    <p style="">Tổng số doanh thu</p>
                </div>
            </div>
            <div class="statis-center2" style="border-radius: 15px;display:flex; justify-content: space-around;color:white; background-image: linear-gradient(to right, rgb(32, 196, 168) , rgb(192, 110, 218)); width:300px;">
                <div class="icon" style="padding-top: 30px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                      </svg>
                </div>
                <div class="title" style="text-align:center; font-weight: bold; padding-top:15px">
                    <p style="font-size: 30px">{{ $status0[0]['countStatus'] }}</p>
                    <p style="">Tổng số đơn hàng mới</p>
                </div>
            </div>
            <div class="statis-right" style="border-radius: 15px;display:flex; justify-content: space-around;color:white; background-image: linear-gradient(to right, rgb(192, 110, 218) , rgb(212, 182, 46)); width:300px;">
                <div class="icon" style="padding-top: 30px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                        <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                      </svg>
                </div>
                <div class="title" style="text-align:center; font-weight: bold; padding-top:15px">
                    <p style="font-size: 30px">{{ $newUser[0]['newUser'] }}</p>
                    <p style="">Tổng số tài khoản khách hàng</p>
                </div>
            </div>
        </div>
    </div>

    <div class="add-bottom" style="display: flex; justify-content:center">
        <div class="add-bottom-input" style="display: flex; margin-top: 50px;">
            <div style="width: 1000px; background-color:white;">
                <canvas id="myChart1"></canvas>
            </div>
            <div style="width: 500px; margin-left:50px; background-color:white;">
                <canvas id="myChart2"></canvas>
            </div>

              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

              <script>
                const ctx1 = document.getElementById('myChart1');
                const ctx2 = document.getElementById('myChart2');

                new Chart(ctx2, {
                  type: 'pie',
                  data: {
                    labels: [
                        'Đang chờ xác nhận',
                        'Đơn hàng đã đặt',
                        'Đã giao cho ĐVVC',
                        'Đã nhận được hàng',
                        'Đơn hàng đặt không thành công'
                    ],
                    datasets: [{
                        label: 'Số lượng',
                        data: [
                            {{ $status0[0]['countStatus'] }},
                            {{ $status1[0]['countStatus'] }},
                            {{ $status2[0]['countStatus'] }},
                            {{ $status3[0]['countStatus'] }},
                            {{ $status4[0]['countStatus'] }},
                        ],
                        backgroundColor: [
                            'rgb(54, 162, 235)',
                            'rgb(135, 162, 235)',
                            'rgb(123, 12, 100)',
                            'rgb(255, 110, 132)',
                            'rgb(255, 230, 86)'
                        ],
                        hoverOffset: 4
                    }]
                  },
                  options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Thống kê trạng thái đơn hàng',
                            font: {
                                size: 20
                            },
                        },
                    },
                  },
                });


                const labels = ['01', '02', '03', '04', '05', '06', '07','08', '09', '10', '11', '12'];
                const data = {
                    labels: labels,
                    datasets: [{
                        type: 'line',
                        label: 'Biểu đồ đường',
                        data: [
                            {{ $sumSale1[0]['sumSale'] }},
                            {{ $sumSale2[0]['sumSale'] }},
                            {{ $sumSale3[0]['sumSale'] }},
                            {{ $sumSale4[0]['sumSale'] }},
                            {{ $sumSale5[0]['sumSale'] }},
                            {{ $sumSale6[0]['sumSale'] }},
                            {{ $sumSale7[0]['sumSale'] }},
                            {{ $sumSale8[0]['sumSale'] }},
                            {{ $sumSale9[0]['sumSale'] }},
                            {{ $sumSale10[0]['sumSale'] }},
                            {{ $sumSale11[0]['sumSale'] }},
                            {{ $sumSale12[0]['sumSale'] }}
                        ],
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 99, 132)'
                        ],
                        borderWidth: 1
                    }, {
                        type: 'bar',
                        label: 'Biểu đồ cột',
                        data: [
                            {{ $sumSale1[0]['sumSale'] }},
                            {{ $sumSale2[0]['sumSale'] }},
                            {{ $sumSale3[0]['sumSale'] }},
                            {{ $sumSale4[0]['sumSale'] }},
                            {{ $sumSale5[0]['sumSale'] }},
                            {{ $sumSale6[0]['sumSale'] }},
                            {{ $sumSale7[0]['sumSale'] }},
                            {{ $sumSale8[0]['sumSale'] }},
                            {{ $sumSale9[0]['sumSale'] }},
                            {{ $sumSale10[0]['sumSale'] }},
                            {{ $sumSale11[0]['sumSale'] }},
                            {{ $sumSale12[0]['sumSale'] }}
                        ],
                        backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)',
                        'rgb(153, 102, 255)'
                        ],
                        borderWidth: 1
                    }]
                };
                new Chart(ctx1, {
                    data: data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            title: {
                                font: {
                                    size: 20
                                },
                                display: true,
                                text: 'Biểu đồ số sản phẩm đã bán trong năm',
                            },
                            legend: {
                                labels: {
                                    font: {
                                        size: 14
                                    }
                                }
                            }
                        },
                    },
                });
              </script>
        </div>
    </div>
</div>
@endsection
