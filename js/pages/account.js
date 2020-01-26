var AccountPage = (function() {

    var inTile = $('#in-tile');
    var exTile = $('#ex-tile');
    var svTile = $('#sv-tile');
    var avTile = $('#av-tile');
    var lsExpensesLay = $('#list-expenses');
    var transLay = $('#trans-layout');

    $(document).on('wf.datetimepicker.onchange',function(){
        loadPageData();
    });

    $(document).on('wf.transaction.created',function(){
        loadPageData();
    });

    $(document).on('pdm.update.transtable',function(){
        var settings = PDMApp.getCdpSettings();
        updateTransTable(settings);
    });

    function overwriteCDPSettings(){
        var pageSettings = PDMApp.getPageSettings();
        if(pageSettings.type != null && pageSettings.type != ""){
            PDMApp.overwriteCDPSettings(pageSettings);
        }
    }



    function loadTiles(response){
        PDMApp.setElContent(inTile,response.income);
        PDMApp.setElContent(exTile,response.expenses);
        PDMApp.setElContent(svTile,response.savings);
        PDMApp.setElContent(avTile,response.balance);
    }

    function loadPageData(){
        PDMApp.addLoaders();
        var settings = PDMApp.getCdpSettings();
        settings = $.extend({},PDMApp.getPageSettings(),settings);
        $.getJSON('/ajax/getaccounttotals', settings, function(response){
            loadTiles(response.data);
        });
        $.getJSON('/ajax/GetAllExpenses', settings, function(response){
            PDMCharts.loadMultiCatPieChart('pie-cats',response.data);
        });

        $.getJSON('/ajax/GetReportIEChartData',settings,function(response){
            PDMCharts.loadDashboardIEChart('incomevsexpense', response.data);
        });

        updateTransTable(settings);

    }

    function updateTransTable(settings){
        $.get('/ajax/GetTransactionsTableWithFilters', settings,function(data){
            transLay.empty().append(data);
        });
    }

    return {
        loadPageData : loadPageData,
        overwriteCDPSettings : overwriteCDPSettings
    }
})();
AccountPage.overwriteCDPSettings();
AccountPage.loadPageData();
