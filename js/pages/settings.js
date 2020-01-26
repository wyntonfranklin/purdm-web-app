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
    var apiKeyEl = $('#api-key-input');
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

    $('#manage-api').on('click',function(){
       openApiModal();
        return false;
    });

    $('#download-transactions').on('click',function(){
       $('#download-transactions-modal').modal('show');
        return false;
    });

    $('#upload-transactions').on('click',function(){
        $("#upload-transactions-modal").modal("show");
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
        }else{
            PDMApp.setAlert('info','Enter a valid name');
        }
        return false;
    });

    $('#generate-api-key').on('click',function(){
       $.get('/ajax/generateapikey',function(results){
          var res = PDMApp.getJsonResponseObject(results);
          if(res.status == 'good'){
              apiKeyEl.val(res.data.apiKey);
          }
       });
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

    $('#download-excel-action').on('click',function(){
        var options = "";
        var filename = $('#file-name-input').val();
        options += "f=" + filename;
        var fullUrl = "/settings/DownloadTransactions?" + options;
        console.log(fullUrl);
        window.location.href = fullUrl;
    });

    $('#choose-file').on("click",function(){
        $("#uploader").trigger('click');
        return false;
    });

    $('#uploader').on('change',function(){
        var fileInput = document.getElementById('uploader');
        var filename = fileInput.files[0].name;
        $('#uploader-placeholder').val(filename);
    });

    $('#upload-import-btn').on('click',function(){
        var form = document.getElementById('uploader');
        var formData = new FormData();
        var fileInput = document.getElementById('uploader');
        formData.append("file", fileInput.files[0]);
        formData.append("accounts", $('#bu-accounts').val());
        if(document.getElementById("bu-create").checked){
            formData.append("create", "true");
        }
        PDMApp.setAlert('info',"Uploading File...");
        $.ajax({
            url : "/ajax/bulkupload",
            type: "POST",
            data : formData,
            processData: false,
            contentType: false,
            success:function(data, textStatus, jqXHR){
                console.log(data);
                try{
                    var res = PDMApp.getJsonResponseObject(data);
                    if(res.status == "good"){
                        $('#upload-transactions-modal').modal('hide');
                        $('#upload-transactions-errors-modal').modal("show");
                        $('#upload-log').val(res.data.log);
                        PDMApp.setAlert('success',"Transactions successfully uploaded...");
                    }else{
                        $('#upload-transactions-modal').modal('hide');
                        PDMApp.setAlert('error',res.message);
                    }
                }catch (e) {
                    $('#upload-transactions-modal').modal('hide');
                    PDMApp.setAlert('error',e.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                PDMApp.setAlert('error', errorThrown.message);
            }
        });
        return false;
    });

    function openCategoriesModal(){
        PDMApp.addLoaders();
        loadCategoriesDiv();
        $('#category-modal').modal('show');
    }

    function openApiModal(){
        $.get('/ajax/GetApiKey',function(results){
            var res = PDMApp.getJsonResponseObject(results);
            if(res.status == 'good'){
                apiKeyEl.val(res.data.apiKey);
                $('#api-modal').modal('show');
            }
        });
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


