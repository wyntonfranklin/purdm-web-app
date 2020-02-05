var UpdatesPage = (function() {


    var status= $('#update-status');
    var pgBar = $('#pb-bar');

    function setStatus(message){
        status.append(message + "<br>");
    }


    $('#start-update-btn').on("click",function(){
        $(this).text("Update Started...");
        pgBar.show();
        PDMApp.setAlert('info',"Updating application. Please do not close the browser...");
        setStatus("Updating application. Please do not close the browser...");
        setStatus("Validating URL...")
        callUpdaterSteps('validate',function(res){
            setStatus(res.message);
            setStatus("Downloading update...");
            callUpdaterSteps('download', function(res){
                setStatus(res.message);
                setStatus("Extracting Update..........")
                callUpdaterSteps('extract', function(res){
                    setStatus(res.message);
                })
            })
        })
        return false;
    });

    $('.up-btn').on('click',function(){
       $('#update-modal').modal("show");
        return false;
    });

    function callUpdaterSteps(step, callback){
        $.post('/ajax/DownloadUpdate?steps='+step,function(results){
            var res = PDMApp.getJsonResponseObject(results);
            if(res.status == "good"){
                if(callback){
                    callback(res);
                }
            }else{

            }
        });
    }

    function loadPageData(){
        var settings = PDMApp.getPageSettings();

    }


    return {
        loadPageData : loadPageData
    }

})();

UpdatesPage.loadPageData();
