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

    $(document).on('pdm.account.changed',function(){
        loadPageData();
    });

    $(document).on('wf.transaction.created',function(){
        loadPageData();
    });

    $(document).on('pdm.update.transtable',function(){
        var settings = PDMApp.getCdpSettings();
        $.get('/ajax/GetTransactionsTableWithFilters', settings,function(data){
            transLay.empty().append(data);
        });
    });

    function overwriteCDPSettings(){
        var pageSettings = PDMApp.getPageSettings();
        if(pageSettings.type != null && pageSettings.type != ""){
            console.log('overwriting cdp setings');
            PDMApp.overwriteCDPSettings(pageSettings);
        }
    }


    function loadTiles(response){
        PDMApp.setElContent(inTile,response.income);
        PDMApp.setElContent(exTile,response.expenses);
        PDMApp.setElContent(svTile,response.savings);
        PDMApp.setElContent(avTile,response.average);
    }

    function loadPageData(){
        PDMApp.addLoaders();
        var settings = PDMApp.getCdpSettings();
        console.log(PDMApp.getPageSettings());
        settings = $.extend({},PDMApp.getPageSettings(), settings);
        console.log(settings);
        PDMApp.setSubtitles(settings);
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


    return {
        loadPageData : loadPageData,
        overwriteCDPSettings : overwriteCDPSettings
    }

})();

InsightsPage.overwriteCDPSettings();
InsightsPage.loadPageData();
