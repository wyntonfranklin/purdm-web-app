var TransactionPage = (function() {

    var transLay = $('#trans-layout');

    $(document).on('pdm.update.transtable',function(){
        loadPageData();
    });

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
