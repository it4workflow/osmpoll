$(function () {
    $('#stacked').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Absolute Zahl pro Mappertyp'
        },
        xAxis: {
            categories: stackeddata.categories
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: stackeddata.series
    });

    $('#donut').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Auswertung pro Antwort'
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b> [{point.y} Stimme(n)]'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                /*
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.percentage:.1f}%'
                },
                */
                cursor: 'pointer',
                innerSize: '10%' 
            }
        },
        series: [{
            type: 'pie',
            data: donutdata
        }]
    });
});



