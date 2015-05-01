$(function () {
  
  var stackedChart=$('#stacked');
  if(stackedChart.length>0){
    $('#stacked').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: statsLocalization.stacked_per_mappertype
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
  }

  var donatChart=$('#donut');
  if(donatChart.length>0){
    $('#donut').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: statsLocalization.donut_per_answer
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b> [{point.y} '+statsLocalization.votes+']'
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
  }

   var timeChart=$('#time');
   if (timeChart.length>0) {
     timeChart.highcharts({
          chart: {
              type: 'spline'
          },
          title: {
              text: statsLocalization.time_per_period
          },
          xAxis: {
              type: 'datetime',
              dateTimeLabelFormats: { // don't display the dummy year
                  month: '%e. %b',
                  year: '%b'
              },
              title: {
                  text: statsLocalization.time_date
              }
          },
          yAxis: {
              title: {
                  text: statsLocalization.time_count
              },
              min: 0
          },
          tooltip: {
              headerFormat: '<b>{series.name}</b><br>',
              pointFormat: '{point.x:%e. %b}: {point.y}'
          },

          plotOptions: {
              spline: {
                  marker: {
                      enabled: true
                  }
              }
          },

          series: [{
              name: statsLocalization.votes,
              data: timeseries
          }]
      });
    }
});
