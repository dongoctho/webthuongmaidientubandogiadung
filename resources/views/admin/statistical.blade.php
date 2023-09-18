@extends('admin.dashboard')
@section('statistical')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">Thống Kê</h1>
    </div>

    <div class="add-bottom">
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
                        label: 'My First Dataset',
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
                                text: 'Biểu đồ sản phẩm đã bán trong năm',
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
