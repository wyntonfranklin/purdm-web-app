var PDMCharts = (function($){
// Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    var myTEPieChart = null;
    var ieBarChart = null;
    var mcPieChart = null;

    function clear_canvas(id){
        var grapharea = document.getElementById(id).getContext("2d");
        var myChart = new Chart(grapharea);
        myChart.destroy();
    }

    function load_pie_chart_labels(id, colors, labels){
        var template ='';
        for(var i=0; i<= labels.length-1; i++){
            template += '<span class="mr-2">\n' +
                '<i style="color:'+colors[i]+'" class="fas fa-circle"></i> '
                +firstLetterUpper(labels[i]) +'\n' +
                '</span>';
        }
        $('#'+id+'-labels').empty().append(template);
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    function loadChart(id, data){
        PDMApp.removeChartsLoader(id);
        var ctx = document.getElementById(id);
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: "Income",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: data.dataset,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });
    }


    function loadPieChart(id){
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
        PDMApp.removeChartsLoader(id);
        var ctx = document.getElementById(id);
        clear_canvas(id);
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Direct", "Referral", "Social"],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    }

    function loadDashboardIEChart(id, data){
        PDMApp.removeChartsLoader(id);
        var ctx = document.getElementById(id);
        if ( ieBarChart != null ) {
            ieBarChart.destroy();
        }
        if(Object.keys(data.expense).length > 0 || Object.keys(data.income).length > 0){
            ieBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: "Income",
                        lineTension: 0.3,
                        backgroundColor: 'rgb(23, 166, 115)',
                        borderColor: 'rgb(23, 166, 115)',
                        data: data.income,
                    },
                        {
                            label: "Expense",
                            lineTension: 0.3,
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: data.expense,
                        }],
                },
                options: {
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        }else{
            var context = ctx.getContext('2d');
            context.fillText("No content to display", 100,100);
        }
    }

    function loadTEPieChart(id, data){
        var colors = ['#4e73df', '#1cc88a', '#36b9cc','#ff3333','#ff748c'];
        PDMApp.removeChartsLoader(id);
        if(myTEPieChart != null){
            myTEPieChart.destroy();
        }
        var ctx = document.getElementById(id);
        if(Object.keys(data.dataset).length > 0){
            load_pie_chart_labels(id,colors,data.labels);
            myTEPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.dataset,
                        backgroundColor: colors,
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','#ff3333','#ff748c'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = data.labels[tooltipItem.index] || '';
                                return firstLetterUpper(datasetLabel)
                                    + ': $' + number_format(data.dataset[tooltipItem.index],2);
                            }
                        }
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        }else{
            var context = ctx.getContext('2d');
            context.fillText("No content to display", 50,100);
        }
    }

    function loadMultiCatPieChart(id, data ){
        renderCatListing(id, data);
        var colors = data.colors;
        PDMApp.removeChartsLoader(id);
        if(mcPieChart != null){
            mcPieChart.destroy();
        }
        var ctx = document.getElementById(id);
        if(Object.keys(data.dataset).length > 0){
            mcPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.dataset,
                        backgroundColor: colors,
                        hoverBackgroundColor: colors,
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = data.labels[tooltipItem.index] || '';
                                return firstLetterUpper(datasetLabel)
                                    + ': $' + number_format(data.dataset[tooltipItem.index],2);
                            }
                        }
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        }else{
            var context = ctx.getContext('2d');
            context.fillText("No content to display", 50,100);
        }
    }

    function renderCatListing(id, data){
        var dpSettings = PDMApp.getCdpSettings();
        var settings = PDMApp.getPageSettings();
        dpSettings['accountId'] = (settings.accountId !=null) ? settings.accountId : "";
        var baseUrl = "/category/view?id=";
        var query = createCategoryUrl(dpSettings);
        var $el = $("#" + id + '-list');
        var labels = data.labels;
        var colors = data.colors;
        var dataset = data.dataset;
        var template ="";
        if(Object.keys(data.dataset).length > 0){
            for(var i=0; i<= labels.length-1; i++){
                template +='   <li>\n' +
                    '<i style="color:'+colors[i]+'" class="fas fa-circle"></i>\n'
                    + '<a href="'+joinUrl(baseUrl,labels[i], query)+'">' + firstLetterUpper(labels[i]) + '</a>' +
                    '&nbsp;&nbsp; &nbsp; <span style="font-weight: bold">$'+number_format(dataset[i],2)
                    +' ['+number_format(data.percentages[i],2)+'%]</span></li>\n';
            }
            $el.empty().append(template);
        }else{
            $el.empty().append("<li>No content to display</li>");
        }
    }

    function joinUrl(base, id, query){
        return base + id + query;
    }

    function createCategoryUrl(settings){
        var output = "";
        for (var key in settings) {
            if (settings.hasOwnProperty(key)) {
                output += "&" + key + "=" + settings[key];
            }
        }
        return output;
    }

    function firstLetterUpper(value){
        return value.charAt(0).toUpperCase() + value.slice(1)
    }

    return {
        loadChart : loadChart,
        loadPieChart : loadPieChart,
        loadDashboardIEChart : loadDashboardIEChart,
        loadTEPieChart : loadTEPieChart,
        loadMultiCatPieChart : loadMultiCatPieChart,
        number_format : number_format
    }
})(jQuery);
