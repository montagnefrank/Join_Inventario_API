<script class='controller'>
    setTimeout(function() {

        /*           ACTUALIZAR CONTADORES               */
        $(document).off('click', "#updateCharts");
        $(document).on('click', '#updateCharts', function(e) {
            $('.waitPls').velocity("transition.slideUpOut");
        buidlEchart();

        });


    }, 1000);

    // CREAR ARREGLO DE FECHAS DIA POR DIA
    function getDateArray(type = 'normal') {
        // CREAMOS EL RANGO DE FECHAS QUE SE MOSTRARA EN EL GRAFICO
        var startDate = new Date("2019-11-11");
        var today = new Date(),
            dd = today.getDate() + 1,
            mm = today.getMonth() + 1,
            yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        today = yyyy + '-' + mm + '-' + dd;
        var endDate = new Date(today);

        var arr = new Array();
        var dt = new Date(startDate);
        while (dt <= endDate) {
            var thisday = new Date(dt),
                d = thisday.getDate() + 1,
                m = thisday.getMonth() + 1,
                y = thisday.getFullYear();
            if (d < 10) {
                d = '0' + d;
            }
            if (m < 10) {
                m = '0' + m;
            }
            if (m == 11) {
                if (d == 31) {
                    d = '01';
                    m = '12';
                }
            }
            if (m == 12) {
                if (d == 32) {
                    d = '01';
                    m = '01';
                }
            }
            if (type == 'normal') {
                thisday = m + '-' + d;
            } else {
                thisday = y + '-' + m + '-' + d;
            }
            arr.push(thisday);
            dt.setDate(dt.getDate() + 1);
        }

        return arr;
    }


    function buidlEchart() {

        var chart = document.getElementById('leyendaChart');
        var barChart = echarts.init(chart);
        var chartdata = [{
                name: 'Noviembre',
                type: 'bar',
                smooth: true,
                data: [50, 41, 35, 69, 71, 84, 41, 35, 69, 71, 84],
                lineStyle: {
                    normal: {
                        width: 1
                    }
                },
                symbolSize: 10,
                lineStyle: {
                    normal: {
                        width: 3
                    }
                },
            },
            {
                name: 'Diciembre',
                type: 'bar',
                smooth: true,
                data: [75, 21, 55, 17, 51, 7, 21, 55, 17, 51, 7],
                lineStyle: {
                    normal: {}
                },
                itemStyle: {
                    normal: {
                        width: 1,
                        barBorderRadius: [3, 3, 0, 0],
                        color: new echarts.graphic.LinearGradient(
                            0, 0, 0, 1, [{
                                offset: 0,
                                color: '#4d83ff'
                            }, {
                                offset: 1,
                                color: '#4d83ff'
                            }]
                        )
                    }
                },
            },
            {
                name: 'Enero',
                type: 'bar',
                smooth: true,
                data: [10, 24, 74, 42, 21, 98, 15, 43, 65, 23, 21],
                lineStyle: {
                    normal: {}
                },
                itemStyle: {
                    normal: {
                        width: 1,
                        barBorderRadius: [3, 3, 0, 0],
                        color: new echarts.graphic.LinearGradient(
                            0, 0, 0, 1, [{
                                offset: 0,
                                color: '#ed8e2a'
                            }, {
                                offset: 1,
                                color: '#ed8e2a'
                            }]
                        )
                    }
                },
            }
        ];
        var option = {
            grid: {
                top: '6',
                right: '0',
                bottom: '17',
                left: '25',
            },
            legend: {
                data: ['Noviembre', 'Diciembre', 'Enero']
            },
            
            xAxis: {
                data: ['15','16','17','18','19','20','21','22','23','24','25'],
                axisLine: {
                    lineStyle: {
                        color: 'rgba(167, 180, 201,.1)'
                    }
                },
                axisLabel: {
                    fontSize: 10,
                    color: '#a7b4c9'
                }
            },
            tooltip: {
                show: true,
                showContent: true,
                alwaysShowContent: true,
                triggerOn: 'mousemove',
                trigger: 'axis',
                axisPointer: {
                    label: {
                        show: false,
                    }
                }
            },
            yAxis: {
                splitLine: {
                    lineStyle: {
                        color: 'rgba(167, 180, 201,.1)'
                    }
                },
                axisLine: {
                    lineStyle: {
                        color: 'rgba(167, 180, 201,.1)'
                    }
                },
                axisLabel: {
                    fontSize: 10,
                    color: '#a7b4c9'
                }
            },
            series: chartdata,
            color: ['#ffc94d', '#4d83ff']
        };
        barChart.setOption(option);
    }
</script>