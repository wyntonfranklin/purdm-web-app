var PDMAccountSelector = (function(){

    var widget = $('#pdm-accounts-selector');

    widget.on('change',function(){
        PDMApp.updatePageSettings('accountId', $(this).val());
        console.log($(this).val());
        $(this).trigger('pdm.account.changed');
    });

})();
