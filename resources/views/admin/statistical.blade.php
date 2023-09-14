@extends('admin.dashboard')
@section('statistical')
<div class="card1">

    <div class="category_top" style="display:flex; justify-content: center; margin: 50px 0 0 0">
        <h1 class="">Thống Kê</h1>
    </div>

    <div class="add-bottom">
        <div class="add-bottom-input">

            <div id="chart" style="height: 250px;"></div>

        </div>
    </div>
</div>
<script>
    Morris.Bar({
      element: 'chart',
      data: [
        { date: '04-02-2014', value: 3 },
        { date: '04-03-2014', value: 10 },
        { date: '04-04-2014', value: 5 },
        { date: '04-05-2014', value: 17 },
        { date: '04-06-2014', value: 6 }
      ],
      xkey: 'date',
      ykeys: ['value'],
      labels: ['Orders']
    });
</script>
@endsection
