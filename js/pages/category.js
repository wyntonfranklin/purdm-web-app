var CategoryPage = (function() {

    var exTile = $('#ex-tile');
    var avTile = $('#av-tile');
    var lsExpensesLay = $('#list-expenses');
    var transLay = $('#trans-layout');

    $(document).on('wf.datetimepicker.onchange',function(){
        loadPageData();
    });


    function loadTiles(response){
        PDMApp.setElContent(exTile,response.expenses);
        PDMApp.setElContent(avTile,response.average);
    }

    function loadPageData(){
        PDMApp.addLoaders();
        var settings = PDMApp.getCdpSettings();
        var pageSettings = PDMApp.getPageSettings();
        settings['category'] = pageSettings.category
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

CategoryPage.loadPageData();
