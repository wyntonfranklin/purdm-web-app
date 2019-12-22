var AccountPage = (function() {

    var inTile = $('#in-tile');
    var exTile = $('#ex-tile');
    var svTile = $('#sv-tile');
    var avTile = $('#av-tile');
    var lsExpensesLay = $('#list-expenses');
    var transLay = $('#trans-layout');

    function loadTiles(response){
        PDMApp.setElContent(inTile,response.income);
        PDMApp.setElContent(exTile,response.expenses);
        PDMApp.setElContent(svTile,response.savings);
        PDMApp.setElContent(avTile,response.average);
    }

    function loadPageData(){
        PDMApp.addLoaders();
        $.getJSON('/ajax/getaccounttotals',function(response){
            loadTiles(response.data);
        });
        PDMCharts.loadPieChart('pie-all-cats');
       // PDMCharts.loadChart('incomevsexpense');

        $.get('/ajax/GetExpenseListing',function(data){
            lsExpensesLay.empty().append(data);
        });
        $.get('/ajax/GetTransactionsTable',function(data){
            transLay.empty().append(data);
        });
    }

    return {
        loadPageData : loadPageData
    }
})();

AccountPage.loadPageData();
