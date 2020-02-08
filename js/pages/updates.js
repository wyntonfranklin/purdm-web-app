var UpdatesPage = (function() {


    var status= $('#update-status');
    var pgBar = $('#pb-bar');
    var startUpdateBtn = $('#start-update-btn');
    var downloadUrl = "";
    var steps = ["validate","download","extract","transfer","tables","cleanup"];
    var preMessage = ["Validating Url...","Downloading update..",
        "Extracting update...","Copy new files","Updating tables...","Cleaning up..."];
    var currentStep = 0;

    function setStatus(message){
        status.append(message + "<br>");
    }

    function loadPageData(){
        $.get('/ajax/GetUpdates',function(data){
            $("#updates-lay").empty().append(data);
        });
    }

    function runUpdate(){
        var stepcount = 0;
        var steps = ["validate","download","extract","cleanup"];
        var preMessage = ["Validating Url...","Downloading update..","Extracting update...","Cleaning up..."]
        for(var i=0; i <= steps.length -1; i++){
            setStatus(preMessage[i]);
            callUpdaterSteps(steps[i],updateResponse);
        }
    }

    function updateResponse(res, nextstep){
        rcallUpdaterSteps(nextstep, updateResponse);
    }

    startUpdateBtn.on("click",function(){
        PDMApp.setAlert('info',"Updating application. Please do not close the browser...");
        pgBar.show();
        confirmUpdateModal();
        startUpdateBtn.prop('disabled', true);
        rcallUpdaterSteps(0, updateResponse);
        return false;
    });


    $('#updates-lay').on('click','.up-btn',function(){
        downloadUrl = $(this).attr("data-link");
        var filename = downloadUrl.substring(downloadUrl.lastIndexOf('/')+1);
        $('#download-version').text(filename.replace('.tar',''));
        confirmUpdateModal();
        return false;
    });

    function confirmUpdateModal(){
        $("#start-update-btn").text("Start Update");
        status.empty();
        pgBar.hide();
        $('#update-modal').modal("show");
    }

    function callUpdaterSteps(step, callback){
        $.post('/ajax/DownloadUpdate?steps='+step,{url:downloadUrl},function(results){
            var res = PDMApp.getJsonResponseObject(results);
            if(callback){
                callback(res);
            }
        });
    }

    function rcallUpdaterSteps(step, callback){
        var currentStep = steps[step];
        setStatus(preMessage[step]);
        $.post('/ajax/DownloadUpdate?steps='+currentStep,{url:downloadUrl},function(results){
            var res = PDMApp.getJsonResponseObject(results);
            if(res.status == "good"){
                setStatus(res.message);
                var nextStep = step+1;
                console.log(nextStep);
                if(steps[nextStep] == null){
                    setStatus("Updating complete...");
                    closeUpdate();

                }else{
                    if(callback){
                        callback(res, nextStep);
                    }
                }
            }else{
                setStatus(res.message);
                setStatus("Stopping update...");
                closeUpdate();
            }
        })
        .fail(function(response) {
            setStatus("Stopping update because of error...");
            setStatus("ERROR: " + response.responseText);
            closeUpdate();
        });
    }

    function closeUpdate(){
        setStatus("You can close this modal now....");
        startUpdateBtn.prop('disabled', false);
        pgBar.hide();
    }


    return {
        loadPageData : loadPageData
    }

})();

UpdatesPage.loadPageData();
