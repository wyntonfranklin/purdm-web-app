var DashboardPage = (function(){

    var nwTile = $('#nw-tile');
    var exTile = $('#ex-tile');
    var inTile = $('#in-tile');
    var svTile = $('#sv-tile');
    var transLay = $('#trans-layout');


    function loadTiles(response){
        console.log(response.income);
        PDMApp.setElContent(nwTile,response.worth);
        PDMApp.setElContent(exTile,response.expenses);
        PDMApp.setElContent(inTile,response.income);
        PDMApp.setElContent(svTile,response.savings);
    }


    function loadPageData(){
        PDMApp.addLoaders();
        $.getJSON('/ajax/gettotals',function(response){
            loadTiles(response.data);
        });
        $.getJSON('/ajax/chart?name=income_expenditure',function(response){

        });

        $.getJSON('/ajax/GetIncomeExpenditureChartData',function(response){
            PDMCharts.loadDashboardIEChart('bar-chart', response.data);
        });

        $.getJSON('/ajax/GetTopExpenses',function(response){
            PDMCharts.loadTEPieChart('myPieChart',response.data);
        });

        $.get('/ajax/GetTransactionsTable',function(data){
           transLay.empty().append(data);
        });
    }

    function reloadPage(){
        loadPageData();
    }

    function load_income_expenditure_chart(){

    }

    function init(){
        loadPageData();
    }

    return {
        init : init
    }
})();

DashboardPage.init();

