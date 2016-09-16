<html>
<head>
    <title>Chart</title>
    <script src="{{ url('/public/_style/js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ url('/public/_style/js/highcharts.js') }}"></script>
    <script src="{{ url('/public/_style/js/highcharts-more.js') }}"></script>
    <script src="{{ url('/public/_style/js/exporting.js') }}"></script>

</head>
<body>

<div id="container" style="width: 800px; height: 550px; margin: 0 auto"></div>
</body>
</html>

<script>

    $(function () {
        var a='nikkoz';
        if (a=='nikko'){
            a ='hello'
        }else{
            a='hi'
        }
        Highcharts.setOptions({
            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
        });

        $('#container').highcharts({

            chart: {
                type: 'columnrange',
                inverted: true,
            },

            title: {
                text: 'Daily Domestic Counter Schedule'
            },

            subtitle: {
                text: 'Observed in Vik i Sogn, Norway, 2009'
            },

            xAxis: {
                categories: ['CTR 1', 'CTR 2', 'CTR 3', 'CTR 4','CTR 5','CTR 6','CTR 7','CTR 8','CTR 9','CTR 10','CTR 11'
                    ,'CTR 12','CTR 13','CTR 14','CTR 15','CTR 16','CTR 17','CTR 18','CTR 19','CTR 20']
            },

            yAxis: {
                title: {
                    text: 'Time'
                }
            },

            tooltip: {


                valueSuffix: a
            },

            plotOptions: {
                columnrange: {
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return this.y + 'AM' + ' NZ';
                        }
                    }
                }
            },

            legend: {
                enabled: true
            },

            series: [{
                name: 'Nikko',
                data: [
                    [0, 2,5],
                    [1,10, 24],
                    [19,8, 17.5]
                ]
            },{
                name: 'Jhen',
                data: [
                    [0,3,6],
                    [2, 6.7, 8.5],
                ]
            },{
                name: 'Nicole',
                data: [
                    [0, 9, 10],
                    [3, 9, 10],

                ]
            }]

        });

    });
</script>
