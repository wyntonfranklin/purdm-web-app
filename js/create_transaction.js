var PDMCreateAccountModal = (function(){

    var modalId = "transaction-modal";
    var transModal = $('#transaction-modal');
    var addNewButton = $('#pdm-add-transaction');
    var saveButton =  $('#pdm-transaction-save');
    var transForm = $('#transaction-form');
    var modalTitle = $('#modalTitle');
    var addCatBtn = $('#add-trans-cat');
    var transCatContainer = $('#trans-cat-container');
    var transDatePicker = $('#transDate');

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

    $('#content').on('click','.open-trans-modal',function(){
        openEditTransactionModal($(this));
        return false;
    });

    addNewButton.on('click',function(){
        openNewTransactionModal();
        return false;
    });

    saveButton.on('click',function(){
        if(getFormAction() == 'save'){
            saveTransForm();
        }else if(getFormAction() == 'edit'){
            updateTransForm();
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
        transModal.modal('show');
        jQuery(document).off('focusin.modal')
    }

    function openEditTransactionModal(el){
        updateFormAction('edit');
        clearFormData();
        modalTitle.text('Edit Transaction');
        saveButton.text('Save changes');
        var transId = el.parent().attr('data-id');
        console.log(transId);
        loadTransactionModal(transId,function(){
            transModal.modal('show');
            jQuery(document).off('focusin.modal')
        });
    }

    function loadTransactionModal(id, callback){
        $.getJSON('/ajax/TransactionDetails',{id:id},function(results){
            var transObject= results.data;
            transForm.find('#amount').val(transObject.amount);
            transForm.find('#description').val(transObject.description);
            transDatePicker.datepicker("setDate",transObject.transDate);
            transForm.find('#category').val(transObject.category).trigger('change');
            transForm.find('#transType').val(transObject.type);
            transForm.find('#transId').val(id);
            if(callback){
                callback();
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
    }

    function saveTransaction(data){
        $.post('/ajax/SaveTransaction', data,function(){
            closeTransactionModal();
            PDMApp.showNotification("Transaction successfully saved");
            clearFormData();
            saveButton.trigger('wf.transaction.created');
        })
    }

    function updateTransaction(data){
        $.post('/ajax/UpdateTransaction', data,function(){
            closeTransactionModal();
            PDMApp.showNotification("Transaction successfully updated");
            clearFormData();
            saveButton.trigger('wf.transaction.created');
        })
    }

    function saveCategory(cat){
        $.post('/ajax/SaveUserCategory',{usercategory:cat},function(){
            updateCategoryListing();
            PDMApp.showNotification("Category saved");
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
                            $.alert('provide a valid name');
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

})();

