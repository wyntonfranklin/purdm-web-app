var CategoryPage = (function() {

    var exTile = $('#ex-tile');
    var avTile = $('#av-tile');
    var lsExpensesLay = $('#list-expenses');
    var transLay = $('#trans-layout');

    $(document).on('wf.datetimepicker.onchange',function(){
        loadPageData();
    });

    $(document).on('pdm.account.changed',function(){
        loadPageData();
    });

    $('#cat-back-btn').on('click',function(){
        var pageSettings = PDMApp.getPageSettings();
        var backUrl = createBackUrl(pageSettings);
        if(pageSettings.accountId){
            window.location.href = '/account/' + pageSettings.accountId + "?" + backUrl;
        }else{
            window.location.href = '/insights/?' + backUrl;
        }
        return false;
    });


    function onFirstLoad(){
        overwriteCDPSettings();
        var pageSettings = PDMApp.getPageSettings();
        if(pageSettings.accountId){
            PDMApp.updateAccountSelector(pageSettings.accountId);
        }
    }

    function overwriteCDPSettings(){
        var pageSettings = PDMApp.getPageSettings();
        PDMApp.overwriteCDPSettings(pageSettings);
    }

    function loadTiles(response){
        PDMApp.setElContent(exTile,response.expenses);
        PDMApp.setElContent(avTile,response.average);
    }

    function loadPageData(){
        PDMApp.addLoaders();
        var settings = PDMApp.getCdpSettings();
        var pageSettings = PDMApp.getPageSettings();
        settings = $.extend({},PDMApp.getPageSettings(), settings);
       // settings['category'] = pageSettings.category;
      //  settings['accountId'] = (pageSettings.accountId) != null ? pageSettings.accountId : "";
        console.log(settings);
        PDMApp.setSubtitles(settings);

        $.getJSON('/ajax/GetCategoryTotals', settings, function(response){
            loadTiles(response.data);
        });
        $.getJSON('/ajax/GetCategoryIEChartData',settings,function(response){
            PDMCharts.loadDashboardIELineChart('incomevsexpense', response.data);
        });
        $.get('/ajax/GetCategoryTransactionsTableWithFilters', settings,function(data){
            transLay.empty().append(data);
        });
    }

    function createBackUrl(settings){
        var output = "";
        for (var key in settings) {
            if (settings.hasOwnProperty(key)) {
                output += "&" + key + "=" + settings[key];
            }
        }
        return output;
    }


    return {
        loadPageData : loadPageData,
        overwriteCDPSettings : overwriteCDPSettings,
        onFirstLoad : onFirstLoad
    }

})();

CategoryPage.onFirstLoad();
CategoryPage.loadPageData();
