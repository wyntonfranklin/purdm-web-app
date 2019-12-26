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
        var settings = JSON.parse($('#page-settings').attr('data-settings'));
        return settings;
    }

    function cdpOnChangeEventName(){
        return "wf.datetimepicker.onchange";
    }

    function showNotification(message){
        $.notify(message, "info",
            { position:"top center" });;
    }

    return {
        addLoaders : addLoaders,
        setElContent : setElContent,
        removeChartsLoader : removeChartsLoader,
        getCdpSettings : getCdpSettings,
        cdpOnChangeEventName : cdpOnChangeEventName,
        showNotification : showNotification,
        getPageSettings : getPageSettings
    }

})();
