var PDMCreateAccountModal = (function(){

    var modalId = "transaction-modal";
    var transModal = $('#transaction-modal');
    var addNewButton = $('#pdm-add-transaction');
    var saveButton =  $('#pdm-transaction-save');
    var transForm = $('#transaction-form');
    var modalTitle = $('#modalTitle');
    var addCatBtn = $('#add-trans-cat');


    $("#amount").maskMoney({thousands: ''});

    $('#transDate').datepicker({
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
        openEditTransactionModal();
        return false;
    });

    addNewButton.on('click',function(){
        openNewTransactionModal();
        return false;
    });

    saveButton.on('click',function(){
        getFormData();
        return false;
    });

    addCatBtn.on('click',function(){
        addCategory();
        return false;
    });

    function openNewTransactionModal(){
        modalTitle.text("Add new Transaction");
        transModal.modal('show');
        jQuery(document).off('focusin.modal')
    }

    function openEditTransactionModal(){
        modalTitle.text('Edit Transaction');
        transModal.modal('show');
        jQuery(document).off('focusin.modal')
    }

    function closeTransactionModal(){
        transModal.modal('hide');
    }

    function getFormData(){
        var data = transForm.serialize();
        console.log(data);
        saveTransaction(data);
        clearFormData();
    }

    function clearFormData(){
        transForm
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .prop('checked', false)
            .prop('selected', false);
    }

    function saveTransaction(data){
        $.post('/ajax/SaveTransaction', data,function(){
            closeTransactionModal();
            PDMApp.showNotification("Transaction successfully saved");
        })
    }

    function saveCategory(cat){
        $.post('/ajax/SaveUserCategory',{usercategory:cat},function(){

        });
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

