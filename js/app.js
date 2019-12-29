var PDMApp = (function(){

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

    function showNotification(message){
        $.notify(message, "info",
            { position:"top center" });;
    }

    function monthLabels(){
        return ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
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
        monthLabels : monthLabels
    }

})();
