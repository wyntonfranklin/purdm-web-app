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
            window.location.href = '/reports/?' + backUrl;
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
        settings['category'] = pageSettings.category;
        settings['accountId'] = (pageSettings.accountId) != null ? pageSettings.accountId : "";
        console.log(settings);
        setSubtitles(settings);

        $.getJSON('/ajax/GetCategoryTotals', settings, function(response){
            loadTiles(response.data);
        });
        $.getJSON('/ajax/GetCategoryIEChartData',settings,function(response){
            PDMCharts.loadDashboardIEChart('incomevsexpense', response.data);
        });
        $.get('/ajax/GetCategoryTransactionsTableWithFilters', settings,function(data){
            transLay.empty().append(data);
        });
    }

    function setSubtitles(settings){
        var labels = PDMApp.monthLabels();
        if(settings.type == 'month'){
            var sub = labels[settings.month-1] + ' ' + settings.year;
            $('.card-header-subtitle').text(sub);
        }else if(settings.type =='range'){
            var sub = settings.startdate + ' - ' + settings.enddate;
            $('.card-header-subtitle').text(sub);
        }
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
