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
    return {
        addLoaders : addLoaders,
        setElContent : setElContent,
        removeChartsLoader : removeChartsLoader
    }

})();
