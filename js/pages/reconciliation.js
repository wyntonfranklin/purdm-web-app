var ReconciliationPage = (function() {

    var rLayout = $('#reconcile-layout');
    var saveBtn = $('#reconcile-save-button');

    saveBtn.on('click',function(){
        var data = $('#reconcile-form').serialize();
        console.log(data);
        addReconciliation(data);
        return false;
    });

    $('#reconcile-layout').on('click','.reconcile-delete',function(){
       var transId = $(this).parent().attr('data-id');
       console.log(transId);
       removeReconciliation(transId);
    });

    function addReconciliation(data){
        $.post('/ajax/AddReconciliation',data, function(){
            clearForm();
            loadPage(); // reload pages
        });
    }

    function removeReconciliation(id){
        $.post('/ajax/RemoveReconciliation',{id:id}, function(){
            loadPage(); // reload pages
        });
    }

    function clearForm(){
        $('#reconcile-form')
            .find("input[type=text], textarea").val("");
    }


    function loadPage(){
        var settings = PDMApp.getPageSettings();
        $.get('/ajax/GetReconciliations', settings,function(data){
            rLayout.empty().append(data);
        });

        $.get('/ajax/GetAccountBalance', settings,function(data){
            $('#reconcile-account-balance').empty().append(data);
        });
    }



    return {
        loadPage : loadPage
    }

})();

ReconciliationPage.loadPage();
