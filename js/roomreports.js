$(document).ready(function(){
	console.log("Jquery wrking !!!");
    $('#loading').hide();
    $("#datepicker").datepicker({
        inline: true,
        onSelect: function (dateText, obj) {
            var date = obj.selectedYear + "-" + obj.selectedMonth + '-' + obj.selectedDay;
            processdate(date, "00:00:00");
        }
    });
    
    Highcharts.theme = {
    colors: ['#cc99ff', '#6699ff', '#ED561B', '#aaDF00', '#7519ff', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4'],
    chart: {
        backgroundColor: {
            linearGradient: [0, 0, 500, 500],
            stops: [
                [0, 'rgb(255, 255, 255)'],
                [1, 'rgb(240, 240, 255)']
            ]
        },
    },
    title: {
        style: {
            color: '#000',
            font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    subtitle: {
        style: {
            color: '#666666',
            font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
        }
    },

    legend: {
        itemStyle: {
            font: '9pt Trebuchet MS, Verdana, sans-serif',
            color: 'black'
        },
        itemHoverStyle:{
            color: 'gray'
        }   
    }
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);

	 // Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });

    // Build the chart
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Status of Rooms'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'share',
            data: [
                ['Check In',   45.0],
                ['Reserved',   22.8],
                ['Check Out',  8.5],
                ['Blocked',    6.2],
                ['Invisible',  1.7]
            ]
        }]
    });
});

function processdate(date,time) {
    date = date +" "+ time;
    console.log(date);
    firequery(date);
}

function firequery(date) {
    $.ajax({
        type: "post",
        url: "roomdata.php",
        data: { date: date },
        success: function (data) {
            console.log(data)
        },
        error: function () {
            console.log("failed roomdata");
        }
    });
}