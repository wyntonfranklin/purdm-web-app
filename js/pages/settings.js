var SettingsPage = (function() {


    var usernameEl = $('#userName');
    var emailEl = $('#userEmail');
    var defaultAccountEl = $('#default-account');
    var updateUserBtn = $('#update-user-btn');

    var oldPasswordEl = $('#oldPassword');
    var newPasswordEl = $('#newPassword');
    var confirmPasswordEl = $('#confirmPassword');
    var updatePasswordBtn = $('#update-user-password-btn');

    updateUserBtn.on('click',function(){
        updateUserInfo();
        return false;
    });

    updatePasswordBtn.on('click',function(){
        updateUserPassword();
        return false;
    });

    function loadPageData(){
        $.get('/ajax/GetSettingsPageData',function(response){
           var rep = PDMApp.getJsonResponseObject(response);
           usernameEl.val(rep.data.username);
           emailEl.val(rep.data.email);
           defaultAccountEl.val(rep.data.default);
           console.log(rep.data.username);
        });
    }

    function updateUserPassword(){
        var oldPassword = oldPasswordEl.val();
        var newPassword = newPasswordEl.val();
        var confirmPassword = confirmPasswordEl.val();
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


