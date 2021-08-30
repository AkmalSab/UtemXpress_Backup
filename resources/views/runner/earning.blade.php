<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style>
        .highcharts-figure, .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h1 class="text-center">Statistic Summary</h1>
    <div class="container">
        <div class="row g-2">
            <div class="col-md-6 col-sm-12">
                <div class="p-3 border bg-light">📦 Total Order: <b>{{$totalOrders}}</b></div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="p-3 border bg-light">💵 Total Earning: <b>RM{{$sumOrdersFee}}</b></div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="p-3 border bg-light">⭐ Rating: <b>{{round($runnerRating, 2)}}</b></div>
            </div>
            <div class="col-md-6 col-sm-12 ">
                <div class="p-3 border bg-light">❤ Fleet: <b>{{$favoured}}</b></div>
            </div>
        </div>
    </div>
</div>
<figure class="highcharts-figure">
    <div id="container"></div>
</figure>
<script>
    var element = document.getElementsByClassName("nav-link myearnings");
    element[0].classList.add("active");

    var stat = @json($statisticOrders);
    console.log(stat)
    var month = [];
    var datas = [];
    var orders = [];
    for (const item of Object.entries(stat)) {
        month.push(item[1]['Month']);
        datas.push(parseFloat(item[1]['TotalFee']));
        orders.push(parseFloat(item[1]['TotalOrder']));
    }
    Highcharts.chart('container', {

        title: {
            text: 'My Earnings'
        },

        subtitle: {
            text: '{{ Auth::user()->email}}'
        },

        yAxis: {
            title: {
                text: 'Number of Earnings'
            }
        },

        xAxis: {
            categories: month
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            line: {
                dataLabels: {
                    enabled: false
                },
                enableMouseTracking: true
            }
        },

        series: [
            {
                name: 'Earnings',
                data: datas
            },
            {
                name: 'Orders',
                data: orders
            },
        ],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>
</body>
</html>
