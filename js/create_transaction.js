var PDMCreateAccountModal = (function($){

    var modalId = "transaction-modal";
    var transModal = $('#transaction-modal');
    var addNewButton = $('#pdm-add-transaction');
    var saveButton =  $('#pdm-transaction-save');
    var transForm = $('#transaction-form');
    var modalTitle = $('#modalTitle');
    var addCatBtn = $('#add-trans-cat');
    var transCatContainer = $('#trans-cat-container');
    var transDatePicker = $('#transDate');
    var transType = $('#transType');

    //$("#amount").maskMoney({thousands: ','});

    transDatePicker.datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        format: 'yyyy-mm-dd',
        templates : {
            leftArrow: '<i class="fa fa-arrow-left"></i>',
            rightArrow: '<i class="fa fa-arrow-right"></i>'
        }
    });


    $('#category').select2({
        placeholder: 'Select an option',
    });

    transType.on('change', function(){
        if( this.value == "transfer"){
            $('#show-account-to').show();
            $('#repeat-layout').hide();
        }else{
            $('#show-account-to').hide();
            $('#repeat-layout').show();
        }
    });


    $('#content').on('click','.open-trans-modal',function(){
        openEditTransactionModal($(this));
        return false;
    });


    addNewButton.on('click',function(){
        openNewTransactionModal();
        return false;
    });

    $('.pdm-open-trans-modal').on('click',function(){
        openNewTransactionModal();
        return false;
    });

    saveButton.on('click',function(){
       if(transForm.valid()){
            if(getFormAction() == 'save'){
                saveTransForm();
            }else if(getFormAction() == 'edit'){
                updateTransForm();
            }
        }
        return false;
    });

    addCatBtn.on('click',function(){
        addCategory();
        return false;
    });

    function openNewTransactionModal(){
        clearFormData();
        updateFormAction('save');
        modalTitle.text("Add new Transaction");
        saveButton.text('Save Transaction');
        updateAccountDropdownbyLocation();
        transModal.modal('show');
        jQuery(document).off('focusin.modal')
    }

    function updateAccountDropdownbyLocation(){
        var ps = PDMApp.getPageSettings();
        if(ps.accountId){
            transForm.find('#account').val(ps.accountId);
        }
    }

    function openEditTransactionModal(el){
        updateFormAction('edit');
        clearFormData();
        modalTitle.text('Edit Transaction');
        saveButton.text('Save changes');
        var transId = el.parent().attr('data-id');
        loadTransactionModal(transId,function(){
            transModal.modal('show');
            jQuery(document).off('focusin.modal')
        });
    }

    function loadTransactionModal(id, callback){
        $.get('/ajax/TransactionDetails',{id:id},function(response){
            var res = PDMApp.getJsonResponseObject(response);
            if(res.status == 'good'){
                transForm.find('#amount').val(res.data.amount);
                transForm.find('#description').val(res.data.description);
                transDatePicker.datepicker("setDate",res.data.transDate);
                transForm.find('#category').val(res.data.category).trigger('change');
                transForm.find('#transType').val(res.data.type);
                transForm.find('#transId').val(id);
                transForm.find('#account').val(res.data.account);
                transForm.find('#frequency').val(res.data.frequency);
                transForm.find('#memo').val(res.data.memo);
                if(callback){
                    callback();
                }
            }
        })
    }

    function closeTransactionModal(){
        transModal.modal('hide');
    }

    function saveTransForm(){
        var data = transForm.serialize();
        console.log(data);
        saveTransaction(data);
    }

    function updateTransForm(){
        var data = transForm.serialize();
        console.log('update the form');
        console.log(data);
        updateTransaction(data);
    }

    function clearFormData(){
        transForm
            .find("input[type=text], textarea").val("");

        transForm.find('#frequency').val('');
        transForm.find('#category').val('').trigger('change');
    }

    function saveTransaction(data){
        $.post('/ajax/SaveTransaction', data,function(response){
            var rep = PDMApp.getJsonResponseObject(response);
            console.log(rep);
            if(rep.status == 'good'){
                closeTransactionModal();
                PDMApp.showNotification(rep.message);
                clearFormData();
                saveButton.trigger('wf.transaction.created');
            }else if(rep.status == 'bad'){
                PDMApp.showNotification(rep.message,'error');
            }
        })
    }

    function updateTransaction(data){
        $.post('/ajax/UpdateTransaction', data,function(response){
            var rep = PDMApp.getJsonResponseObject(response);
            if(rep.status =='good'){
                closeTransactionModal();
                PDMApp.showNotification(rep.message);
                clearFormData();
                saveButton.trigger('wf.transaction.created');
            }else if(rep.status =='bad'){
                PDMApp.showNotification(rep.message,'error');
            }
        })
    }

    function saveCategory(cat){
        $.post('/ajax/SaveUserCategory',{usercategory:cat},function(response){
            var rep = PDMApp.getJsonResponseObject(response);
            if(rep.status == 'good'){
                updateCategoryListing();
                PDMApp.showNotification(rep.message);
            }else if(rep.status == 'bad'){
                PDMApp.showNotification(rep.message,'error');
            }
        });
    }

    function updateCategoryListing(){
        $.get('/ajax/GetUpdateCategoriesList',function(data){
            transCatContainer.empty().append(data);
            $('#category').select2({
                placeholder: 'Select an option',
            });
        })
    }

    function updateFormAction(state){
        saveButton.attr('data-action',state);
    }

    function getFormAction(){
        return saveButton.attr('data-action');
    }

    function addCategory(){
        $("#new-cat-input").focus();
        $.confirm({
            title: 'Add new Category',
            content: '' +
                '<form action="" class="">' +
                '<div class="form-group">' +
                '<label>Enter your new category here</label>' +
                '<input id="new-cat-input" value="" type="text" placeholder="Category" class="name form-control"/>' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var name = this.$content.find('.name').val();
                        if(!name){
                            $.alert('Provide a valid name');
                            return false;
                        }else{
                            saveCategory(name);
                        }
                    }
                },
                cancel: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
            }
        });
    }

})(jQuery);

