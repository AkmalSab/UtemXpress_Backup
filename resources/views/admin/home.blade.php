<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <style>
        .blue{
            background-color: skyblue;
            color: black;
        }
        .highcharts-figure, .highcharts-data-table table {
            min-width: 320px;
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

        input[type="number"] {
            min-width: 50px;
        }
    </style>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h3 class="text-center">Hi, {{$adminName}}</h3>
    <hr>
    <div class="container mt-3">
        <div class="row g-2">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="p-3 border blue"><b><i class="fa fa-users" aria-hidden="true"></i> Number of User: {{$totalUsers}}</b></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="p-3 border blue"><b><i class="fa fa-motorcycle" aria-hidden="true"></i> Number of Runner: {{$totalRunners}}</b></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="p-3 border blue"><b><i class="fa fa-book" aria-hidden="true"></i> Number of Order: {{$totalOrders}}</b></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="p-3 border blue"><b><i class="fa fa-user" aria-hidden="true"></i> Number of Admin: {{$totalAdmins}}</b></div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col text-center">
            <figure class="highcharts-figure">
                <div id="container"></div>
            </figure>
        </div>
        <div class="col text-center">
            <figure class="highcharts-figure">
                <div id="container2"></div>
            </figure>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <figure class="highcharts-figure">
                <div id="container3"></div>
            </figure>
        </div>
        <div class="col text-center">
            <figure class="highcharts-figure">
                <div id="container4"></div>
            </figure>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <figure class="highcharts-figure">
                <div id="container5"></div>
            </figure>
        </div>
    </div>
</div>

<script>

    var element = document.getElementsByClassName("nav-link adminhome");
    element[0].classList.add("active");

    var jan = @json($totalOrdersCountJan);
    var feb = @json($totalOrdersCountFeb);
    var mar = @json($totalOrdersCountMar);
    var apr = @json($totalOrdersCountApr);
    var may = @json($totalOrdersCountMay);
    var jun = @json($totalOrdersCountJun);
    var jul = @json($totalOrdersCountJul);
    var aug = @json($totalOrdersCountAug);
    var sep = @json($totalOrdersCountSep);
    var oct = @json($totalOrdersCountOct);
    var nov = @json($totalOrdersCountNov);
    var dec = @json($totalOrdersCountDec);

    var dataWalk = [];
    var dataMotor = [];
    var dataCar = [];

    if(jan.length != 0){
        if(jan.length == 1){
            dataWalk.push(jan[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(jan.length == 2){
            dataWalk.push(jan[0].total)
            dataMotor.push(jan[1].total)
            dataCar.push(0)
        }
        else if(jan.length == 3){
            dataWalk.push(jan[0].total)
            dataMotor.push(jan[1].total)
            dataCar.push(jan[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(feb.length != 0){
        if(feb.length == 1){
            dataWalk.push(feb[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(feb.length == 2){
            dataWalk.push(feb[0].total)
            dataMotor.push(feb[1].total)
            dataCar.push(0)
        }
        else if(feb.length == 3){
            dataWalk.push(feb[0].total)
            dataMotor.push(feb[1].total)
            dataCar.push(feb[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(mar.length != 0){
        if(mar.length == 1){
            dataWalk.push(mar[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(mar.length == 2){
            dataWalk.push(mar[0].total)
            dataMotor.push(mar[1].total)
            dataCar.push(0)
        }
        else if(mar.length == 3){
            dataWalk.push(mar[0].total)
            dataMotor.push(mar[1].total)
            dataCar.push(mar[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(apr.length != 0){
        if(apr.length == 1){
            dataWalk.push(apr[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(apr.length == 2){
            dataWalk.push(apr[0].total)
            dataMotor.push(apr[1].total)
            dataCar.push(0)
        }
        else if(apr.length == 3){
            dataWalk.push(apr[0].total)
            dataMotor.push(apr[1].total)
            dataCar.push(apr[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(may.length != 0){
        if(may.length == 1){
            dataWalk.push(may[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(may.length == 2){
            dataWalk.push(may[0].total)
            dataMotor.push(may[1].total)
            dataCar.push(0)
        }
        else if(may.length == 3){
            dataWalk.push(may[0].total)
            dataMotor.push(may[1].total)
            dataCar.push(may[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(jun.length != 0){
        if(jun.length == 1){
            dataWalk.push(jun[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(jun.length == 2){
            dataWalk.push(jun[0].total)
            dataMotor.push(jun[1].total)
            dataCar.push(0)
        }
        else if(jun.length == 3){
            dataWalk.push(jun[0].total)
            dataMotor.push(jun[1].total)
            dataCar.push(jun[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(jul.length != 0){
        if(jul.length == 1){
            dataWalk.push(jul[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(jul.length == 2){
            dataWalk.push(jul[0].total)
            dataMotor.push(jul[1].total)
            dataCar.push(0)
        }
        else if(jul.length == 3){
            dataWalk.push(jul[0].total)
            dataMotor.push(jul[1].total)
            dataCar.push(jul[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(aug.length != 0){
        if(aug.length == 1){
            dataWalk.push(aug[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(aug.length == 2){
            dataWalk.push(aug[0].total)
            dataMotor.push(aug[1].total)
            dataCar.push(0)
        }
        else if(aug.length == 3){
            dataWalk.push(aug[0].total)
            dataMotor.push(aug[1].total)
            dataCar.push(aug[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(sep.length != 0){
        if(sep.length == 1){
            dataWalk.push(sep[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(sep.length == 2){
            dataWalk.push(sep[0].total)
            dataMotor.push(sep[1].total)
            dataCar.push(0)
        }
        else if(sep.length == 3){
            dataWalk.push(sep[0].total)
            dataMotor.push(sep[1].total)
            dataCar.push(sep[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(oct.length != 0){
        if(oct.length == 1){
            dataWalk.push(oct[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(oct.length == 2){
            dataWalk.push(oct[0].total)
            dataMotor.push(oct[1].total)
            dataCar.push(0)
        }
        else if(oct.length == 3){
            dataWalk.push(oct[0].total)
            dataMotor.push(oct[1].total)
            dataCar.push(oct[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(nov.length != 0){
        if(nov.length == 1){
            dataWalk.push(nov[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(nov.length == 2){
            dataWalk.push(nov[0].total)
            dataMotor.push(nov[1].total)
            dataCar.push(0)
        }
        else if(nov.length == 3){
            dataWalk.push(nov[0].total)
            dataMotor.push(nov[1].total)
            dataCar.push(nov[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }
    if(dec.length != 0){
        if(dec.length == 1){
            dataWalk.push(dec[0].total)
            dataMotor.push(0)
            dataCar.push(0)
        }
        else if(dec.length == 2){
            dataWalk.push(dec[0].total)
            dataMotor.push(dec[1].total)
            dataCar.push(0)
        }
        else if(dec.length == 3){
            dataWalk.push(dec[0].total)
            dataMotor.push(dec[1].total)
            dataCar.push(dec[2].total)
        }
    }
    else{
        dataWalk.push(0)
        dataMotor.push(0)
        dataCar.push(0)
    }


    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits: false,
        title: {
            text: "Overall percentage of System's user"
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Percentage',
            colorByPoint: true,
            data: [{
                name: 'Users',
                y: {{$totalUsers}},
                sliced: true,
                selected: true
            }, {
                name: 'Runner',
                y: {{$totalRunners}}
            }, {
                name: 'Admin',
                y: {{$totalAdmins}}
            }]
        }]
    });

    Highcharts.chart('container2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits: false,
        title: {
            text: "Overall percentage of System's order"
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Percentage',
            colorByPoint: true,
            data: [{
                name: 'Completed',
                y: {{$totalOrdersCompleted}},
                sliced: true,
                selected: true
            }, {
                name: 'Waiting',
                y: {{$totalOrdersWaiting}}
            }, {
                name: 'Cancelled',
                y: {{$totalOrdersCancelled}}
            }, {
                name: 'Picked-Up',
                y: {{$totalOrdersPicked}}
            }, {
                name: 'On-Going',
                y: {{$totalOrdersOngoing}}
            },]
        }]
    });

    Highcharts.chart('container3', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'User population across faculties'
        },
        subtitle: {
            text: 'Group by Faculties'
        },
        xAxis: {
            categories: [
                'FTMK',
                'FKEKK',
                'FKE',
                'FKM',
                'FPTT',
                'FTKMP'
            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of (person)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: 'person'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Since 2021',
            data: [
                {{$Student_FTMK+$Staff_FTMK}},
                {{$Student_FKEKK+$Staff_FKEKK}},
                {{$Student_FKE+$Staff_FKE}},
                {{$Student_FKM+$Staff_FKM}},
                {{$Student_FPTT+$Staff_FPTT}},
                {{$Student_FTKMP+$Staff_FTKMP}},
            ]
        }]
    });

    Highcharts.chart('container4', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Order Fee Collected across transportation'
        },
        subtitle: {
            text: 'Group by Transportation'
        },
        xAxis: {
            categories: [
                'WALK/BICYCLE',
                'MOTORCYCLE',
                'CAR'
            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ringgit Malaysia',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Ringgit Malaysia'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Since 2021',
            data: [
                {{$walkOrderSum}},
                {{$motorOrderSum}},
                {{$carOrderSum}}
            ]
        }]
    });

    Highcharts.chart('container5', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Average order consumption during one year'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {
                text: 'Fruit units'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'Walk/Bicycle',
            // data: [3, 4, 3, 5, 4, 10, 12, 10, 10, 10, 10, 10]
            data: dataWalk
        }, {
            name: 'Motorcycle',
            data: dataMotor
        }, {
            name: 'Car',
            data: dataCar
        }]
    });
</script>
</body>
</html>
