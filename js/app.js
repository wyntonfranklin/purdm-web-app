var PDMApp = (function($){



    function showAlerts(){
        var successMsg = $('#alert-success').val();
        var infoMsg = $('#alert-info').val();
        var errorMsg = $('#alert-error').val();
        if(successMsg){
            setAlert('success', successMsg)
        }
        if(infoMsg){
            setAlert('info', infoMsg)
        }
        if(errorMsg){
            setAlert('error', errorMsg)
        }
    }

    function addLoaders(){
        $('.aj').empty().append('<div class="dot-pulse"></div>');
    }

    function setElContent(el, content){
        if(content == "" || content == null || content == undefined){
            el.empty().html('<span style="font-size: 12px;">Error loading content</span>');
        }else{
            el.empty().html(content);
        }
    }

    function removeChartsLoader(id){
        $('#'+id).parent().find('.charts-loader').hide();
    }

    function getCdpSettings(){
        var settings = JSON.parse($('#cdp-settings').attr('data-settings'));
        return settings;
    }

    function getPageSettings(){
        var el = $('#page-settings');
        if(el.length){
            return JSON.parse(el.attr('data-settings'))
        }
        return { };
    }

    function updatePageSettings(name,value){
        var settings = getPageSettings();
        settings[name] = value;
        $('#page-settings').attr('data-settings',JSON.stringify(settings));
    }

    function overwriteCDPSettings(settings){
        $('#cdp-settings').attr('data-settings',JSON.stringify(settings));
    }

    function cdpOnChangeEventName(){
        return "wf.datetimepicker.onchange";
    }

    function updateAccountSelector(id){
        $('#pdm-accounts-selector').val(id);
    }

    function showNotification(message,type){
        if(type== null){
            $.notify(message, "info",
                { position:"top center" });
        }else{
            $.notify(message, type,
                { position:"top center" });
        }
    }

    function monthLabels(){
        return ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    }

    function getJsonResponseObject(response){
        try{
            var object = JSON.parse(response);
            return object.response;
        }catch (e) {
            return {'status': 'bad','message':'invalid response','data':''};
        }

        return false;
    }

    function setAlert(type, message){
        $.notify(message,type);
    }

    function setSubtitles(settings){
        var labels = monthLabels();
        if(settings.type == 'month'){
            var sub = labels[settings.month-1] + ' ' + settings.year;
            $('.card-header-subtitle').text(sub);
        }else if(settings.type =='range'){
            var csDate = moment(settings.startdate).format('D, MMM YYYY');
            var ceDate = moment(settings.enddate).format('D, MMM YYYY');
            var sub = csDate + ' - ' + ceDate;
            $('.card-header-subtitle').text(sub);
        }
    }

    return {
        addLoaders : addLoaders,
        setElContent : setElContent,
        removeChartsLoader : removeChartsLoader,
        getCdpSettings : getCdpSettings,
        cdpOnChangeEventName : cdpOnChangeEventName,
        showNotification : showNotification,
        getPageSettings : getPageSettings,
        updatePageSettings : updatePageSettings,
        overwriteCDPSettings : overwriteCDPSettings,
        updateAccountSelector : updateAccountSelector,
        monthLabels : monthLabels,
        getJsonResponseObject : getJsonResponseObject,
        setAlert : setAlert,
        showAlerts : showAlerts,
        setSubtitles : setSubtitles
    }

})(jQuery);

PDMApp.showAlerts();
