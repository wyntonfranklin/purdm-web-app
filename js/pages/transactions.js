var TransactionPage = (function() {

    var transLay = $('#trans-layout');

    function loadPageData(){
        var settings = PDMApp.getPageSettings();
        updateTransTable(settings);
    }


    function updateTransTable(settings){
        $.get('/ajax/GetTransactionsTableByAccount', settings,function(data){
            transLay.empty().append(data);
        });
    }

    return {
        loadPageData : loadPageData
    }

})();

TransactionPage.loadPageData();
