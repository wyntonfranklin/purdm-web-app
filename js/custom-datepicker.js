var dpWidget = $('#date-picker-widget');
var dbleft = $('#date-picker-widget .left');
var dbright = $('#date-picker-widget .right');
var dbmiddle = $('#date-picker-widget .middle');
var cdp = $('#custom-date-picker');
var cdpMenu =  $("#cdp-menu");
var cdpMonthPopup = $('#cdp-month-content');
var cdpRangePopup = $('#cdp-range-content');
var cdpDescription = $('#cdp-description');
var monthsPicker = $('#months-picker');
var cdpMonthsWidget = $('#cdp-months-listing');


cdpMonthsWidget.find('.mn-item').on('click',function() {
    $('.mn-item').removeClass('active');
    $(this).addClass('active');
    return false;
});

$('#cdp-start-date, #cdp-end-date').datepicker({
    todayHighlight: true,
    orientation: "bottom left",
    format: 'yyyy-mm-dd',
    templates : {
        leftArrow: '<i class="fa fa-arrow-left"></i>',
        rightArrow: '<i class="fa fa-arrow-right"></i>'
    }
});

$('#cdp-update-months').on('click',function(){
    var year = monthsPicker.val();
    var month = cdpMonthsWidget.find('.mn-item.active').text();
    updateCdpDescription(month + " " + year);
    closeAllSubViews();
    return false;
});

$('#cdp-update-range').on('click',function(){
    var startdate = $('#cdp-start-date').val();
    console.log(startdate);
    var sd = moment(startdate).format('D, MMM YYYY');
    var enddate = $('#cdp-end-date').val();
    var ed = moment(enddate).format('D, MMM YYYY');
    updateCdpDescription(sd + " - " + ed);
    closeAllSubViews();
    return false;
});

cdp.find('.cdp-options .btn-month').on('click',function(event){
    closeCdpMenu();
    openCpdMonthView();
    event.stopPropagation();
    console.log("show the month widget");
    return false;
});

cdp.find('.cdp-options .btn-range').on('click',function(event){
    closeCdpMenu();
    openCpdRangeView();
    event.stopPropagation();
    console.log("show the range widget");
    return false;
});

dbleft.on('click',function(){
   console.log('left click');
   return false;
});

dbright.on('click',function(){
   console.log('right click');
    return false;
});

dbmiddle.on('click',function(event){
    openCdpMenu();
    event.stopPropagation();
});

$(window).click(function(e) {

    var container = cdp;

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        closeAllSubViews();
        closeCdpMenu();
    }
});

function showMonthWidget(){

}

function openCdpMenu(){
    if(cdpMonthPopup.hasClass('active') || cdpRangePopup.hasClass('active')){
        closeAllSubViews();
        cdpMenu.addClass('active');
        var position = dpWidget.position();
        cdpMenu.css( {position:"absolute", top:position.top+40, left: position.left});
    }else if(cdpMenu.hasClass('active')){
        cdpMenu.removeClass('active')
    }else{
        cdpMenu.addClass('active');
        var position = dpWidget.position();
        cdpMenu.css( {position:"absolute", top:position.top+40, left: position.left});
    }
}

function openCpdMonthView(){
    closeCdpMenu();
    cdpMonthPopup.addClass('active');
    var position = dpWidget.position();
    cdpMonthPopup.css( {position:"absolute", top:position.top+40, left: position.left});
}

function openCpdRangeView(){
    closeCdpMenu();
    cdpRangePopup.addClass('active');
    var position = dpWidget.position();
    cdpRangePopup.css( {position:"absolute", top:position.top+40, left: position.left});
}

function closeCdpMenu(){
    cdpMenu.removeClass('active');
}

function closeAllSubViews(){
    cdpRangePopup.removeClass('active')
    cdpMonthPopup.removeClass('active');
}


function updateCdpDescription(value){
    cdpDescription.text(value);
}
