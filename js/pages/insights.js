var InsightsPage = (function() {

    var inTile = $('#in-tile');
    var exTile = $('#ex-tile');
    var svTile = $('#sv-tile');
    var avTile = $('#av-tile');
    var lsExpensesLay = $('#list-expenses');
    var transLay = $('#trans-layout');

    $(document).on('wf.datetimepicker.onchange',function(){
        loadPageData();
    });


    function loadTiles(response){
        PDMApp.setElContent(inTile,response.income);
        PDMApp.setElContent(exTile,response.expenses);
        PDMApp.setElContent(svTile,response.savings);
        PDMApp.setElContent(avTile,response.average);
    }

    function loadPageData(){
        PDMApp.addLoaders();
        var settings = PDMApp.getCdpSettings();
        setSubtitles(settings);
        $.getJSON('/ajax/GetInsightsTotals', settings, function(response){
            loadTiles(response.data);
        });
        $.getJSON('/ajax/GetReportIEChartData',settings,function(response){
            PDMCharts.loadDashboardIEChart('incomevsexpense', response.data);
        });
        $.getJSON('/ajax/GetAllExpenses', settings, function(response){
            PDMCharts.loadMultiCatPieChart('pie-cats',response.data);
        });
        $.get('/ajax/GetTransactionsTableWithFilters', settings,function(data){
            transLay.empty().append(data);
        });
    }

    function setSubtitles(settings){
        if(settings.type == 'month'){
            var sub = settings.month + ' ' + settings.year;
            $('.card-header-subtitle').text(sub);
        }else if(settings.type =='range'){
            var sub = settings.startdate + ' - ' + settings.enddate;
            $('.card-header-subtitle').text(sub);
        }
    }


    return {
        loadPageData : loadPageData
    }

})();

InsightsPage.loadPageData();
