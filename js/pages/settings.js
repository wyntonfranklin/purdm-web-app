var SettingsPage = (function() {


    var usernameEl = $('#userName');
    var emailEl = $('#userEmail');
    var defaultAccountEl = $('#default-account');
    var updateUserBtn = $('#update-user-btn');

    var oldPasswordEl = $('#oldPassword');
    var newPasswordEl = $('#newPassword');
    var confirmPasswordEl = $('#confirmPassword');
    var updatePasswordBtn = $('#update-user-password-btn');
    var defaultAccountBtn = $('#save-default-account-btn');
    var currentCatId = null;


    $('#update-default-account').on('click',function(){
        $('#default-account-modal').modal('show');
        return false;
    });

    $('#update-account-password').on('click',function(){
        $('#update-account-password-modal').modal('show');
        return false;
    });

    $('#update-account-info').on('click',function(){
        $('#update-account-info-modal').modal('show');
        return false;
    });

    $('#manage-account-categories').on('click',function(){
        openCategoriesModal();
        return false;
    });

    $("#settings-cat-input").on("input", function(){

        if($(this).val() == ""){
            currentCatId = null;
            console.log('set to null');
        }
    });

    $('#setting-save-category').on('click',function(){
        var newCat = $('#settings-cat-input').val();
        if(newCat != null && newCat != ""){
            $.post('/ajax/SaveUserCategory',{usercategory: newCat,id:currentCatId},function(response){
                var res = PDMApp.getJsonResponseObject(response);
                if(res.status == 'good'){
                    loadCategoriesDiv();
                    $('#settings-cat-input').val("");
                    currentCatId = null;
                    PDMApp.setAlert('success',res.message);
                }else if(res.status == 'bad'){
                    PDMApp.setAlert('error',res.message);
                }
            })
        }
        return false;
    });

    defaultAccountBtn.on('click',function(){
        var dId = $('#default-account').val();
        updateDefaultAccount(dId);
        return false;
    });

    updateUserBtn.on('click',function(){
        updateUserInfo();
        return false;
    });

    updatePasswordBtn.on('click',function(){
        updateUserPassword();
        return false;
    });

    function openCategoriesModal(){
        PDMApp.addLoaders();
        $('#category-modal').modal('show');
        loadCategoriesDiv();
    }

    function loadCategoriesDiv(){
        $.get('/ajax/getusercategories',function(html){
            $('#settings-cat-list').empty().append(html);
            loadCatItemsEvent();
        });
    }

    function loadCatItemsEvent(){
        $('.cat-item').on('click',function(){
            currentCatId = $(this).parent().attr('data-id');
            var name = $(this).parent().attr('data-name');
            $('#settings-cat-input').val(name);
        })
    }


    function updateDefaultAccount(id){
        $.post('/ajax/UpdateDefaultAccount',{id:id},function(response){
           var res = PDMApp.getJsonResponseObject(response);
           if(res.status == 'good'){
                PDMApp.setAlert('success', res.message);
           }else if(res.status == 'bad'){
                PDMApp.setAlert('error',res.message);
           }
        });
    }

    function loadPageData(){
        $.get('/ajax/GetSettingsPageData',function(response){
           var res = PDMApp.getJsonResponseObject(response);
           usernameEl.val(res.data.username);
           emailEl.val(res.data.email);
           defaultAccountEl.val(res.data.default);
           console.log(res.data.username);
        });
    }

    function updateUserPassword(){
        var oldPassword = oldPasswordEl.val();
        var newPassword = newPasswordEl.val();
        var confirmPassword = confirmPasswordEl.val();
        if(oldPassword && newPassword && confirmPassword){
            console.log(oldPassword,newPassword,confirmPassword);
            $.post('/ajax/UpdateUserPassword',{oldpassword: oldPassword,
                newpassword: newPassword, confirmpassword:confirmPassword},function(response){
                var res = PDMApp.getJsonResponseObject(response);
                if(res.status == "good"){
                    PDMApp.setAlert('success', res.message);
                }else if(res.status == 'bad'){
                    PDMApp.setAlert('error', res.message);
                }
            });
        }else{
            PDMApp.setAlert('info', "Missing form values");
        }
    }

    function updateUserInfo(){
        var username = usernameEl.val();
        var email = emailEl.val();
        $.post('/ajax/UpdateUserInfo', {username:username,email:email}, function(response){
            var res = PDMApp.getJsonResponseObject(response);
            if(res.status == "good"){
                PDMApp.setAlert('success',res.message);
            }else if(res.status == 'bad'){
                PDMApp.setAlert('error',res.message);
            }
        });
    }


    return {
        loadPageData : loadPageData
    }

})();

SettingsPage.loadPageData();


