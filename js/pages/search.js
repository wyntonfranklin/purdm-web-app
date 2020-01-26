var SearchPage = (function() {

    var transLay = $('#trans-layout');

    function loadPageData(){
        var settings = PDMApp.getPageSettings();
        updateTransTable(settings);
    }


    function updateTransTable(settings){
        $.get('/ajax/GetTransactionsTableByQuery', settings,function(data){
            transLay.empty().append(data);
        });
    }

    return {
        loadPageData : loadPageData
    }

})();

SearchPage.loadPageData();
