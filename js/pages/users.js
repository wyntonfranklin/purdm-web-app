var UsersPage = (function() {

    var usersLay = $('#users-layout');
    var usernameEl = $("input[name=username]");
    var emailEl = $("input[name=email]");
    var userTypeEl = $("input[name=usertype]");
    var passwordEl = $("input[name=usrpassword]");
    var currentUser = null;


    $(document).on('pdm.update.transtable',function(){
        loadPageData();
    });


    $('#usr-save-user').on('click',function(){
        var data = $('#usr-user-form').serialize();
       // console.log(data);
        return false;
    });

    $("#usr-change-password").on('click',function(){
        var data = {
            "id" : currentUser,
            "password" : passwordEl.val()
        };
        $.post('/ajax/AdminChangeUserPassword',data,function(results){
            var res = PDMApp.getJsonResponseObject(results);
            if(res.status == "good"){
                PDMApp.setAlert('success',res.message)
            }else{
                PDMApp.setAlert('error', res.message);
            }
        });
        return false;
    });

    function loadPageData(){
        var settings = PDMApp.getPageSettings();
        updateTransTable(settings);
    }

    function clearPasswordForm(){
        passwordEl.val("");
    }

    function clearUserInfoForm(){
        usernameEl.val("");
        emailEl.val("");
        userTypeEl.val("0");
    }


    function updateTransTable(settings){
        $.get('/ajax/GetAllUsers', settings,function(data){
            usersLay.empty().append(data);
            registerEvents();
        });
    }

    function registerEvents(){
        $('#dataTable').on('click','.users-delete',function(){
            var el = $(this);
            var userId = $(this).parent().attr('data-id');
            currentUser = userId;
            var c = confirm('Remove this user');
            if(c){

            }
            return false;
        });

        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": []
            });

        });

        $('#dataTable').on('click','.users-edit',function(){
            var el = $(this);
            var userId = $(this).parent().attr('data-id');
            currentUser = userId;
            loadUsersData(userId);
            clearUserInfoForm();
            $('#users-edit-modal').modal("show");
            return false;
        });

        $('#dataTable').on('click','.users-password',function(){
            var el = $(this);
            var Id = $(this).parent().attr('data-id');
            currentUser = Id;
            getUserData(Id, function(results){
                if(results){
                    $('.usr-active-user').text(results.data.username);
                }
            });
            clearPasswordForm();
            $('#users-change-password-modal').modal("show");
            return false;
        });
    }

    function loadUsersData(id){
        getUserData(id, function(res){
            if(res.status == "good"){
                usernameEl.val(res.data.username);
                emailEl.val(res.data.email);
                userTypeEl.val(res.data.usertype);
            }
        })
    }

    function getUserData(id, callback){
        $.get('/ajax/GetAllUsersData',{id:id},function(results){
            var res = PDMApp.getJsonResponseObject(results);
            if(res.status == "good"){
                if(callback){
                    callback(res);
                }
            }else{
                if(callback){
                    callback();
                }
            }
        });
    }

    return {
        loadPageData : loadPageData
    }

})();

UsersPage.loadPageData();
