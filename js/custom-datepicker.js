var dpWidget = $('#date-picker-widget');
var dpleft = $('#date-picker-widget .left');
var dpright = $('#date-picker-widget .right');
var dpmiddle = $('#date-picker-widget .middle');
var cdp = $('#custom-date-picker');
var cdpMenu =  $("#cdp-menu");
var cdpMonthPopup = $('#cdp-month-content');
var cdpRangePopup = $('#cdp-range-content');
var cdpDescription = $('#cdp-description');
var monthsPicker = $('#months-picker');
var cdpMonthsWidget = $('#cdp-months-listing');
var cdpSettings = $('#cdp-settings');
var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
var startDateEl = $('#cdp-start-date');
var endDateEl = $('#cdp-end-date');

$(document).ready(function(){
    loadDefaultSettings();
});


cdpMonthsWidget.find('.mn-item').on('click',function() {
    $('.mn-item').removeClass('active');
    $(this).addClass('active');
    return false;
});

startDateEl.datepicker({
    todayHighlight: true,
    orientation: "bottom left",
    format: 'yyyy-mm-dd',
    templates : {
        leftArrow: '<i class="fa fa-arrow-left"></i>',
        rightArrow: '<i class="fa fa-arrow-right"></i>'
    }
});

endDateEl.datepicker({
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
    setCdpSettings('month',month);
    setCdpSettings('year',year);
    setCdpSettings('type',"month");
    updateCdpDescription(month, year);
    closeAllSubViews();
    triggerOnDateTimePickerChange($(this));
    return false;
});

$('#cdp-update-range').on('click',function(){
    var startdate = startDateEl.val();
    console.log(startdate);
    setCdpSettings('startdate',startdate);
    var sd = moment(startdate).format('D, MMM YYYY');
    var enddate = $('#cdp-end-date').val();
    setCdpSettings('enddate',enddate);
    setCdpSettings('type',"range");
    var ed = moment(enddate).format('D, MMM YYYY');
    updateCdpDescription(sd,ed);
    closeAllSubViews();
    triggerOnDateTimePickerChange($(this));
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

dpleft.on('click',function(){
   if(getCdpSettings().type == "month"){
       monthBackward();
   }else{
       rangeBackward();
   }
   return false;
});

dpright.on('click',function(){
    if(getCdpSettings().type == "month"){
        monthForward();
    }else{
        rangeForward();
    }
    return false;
});

dpmiddle.on('click',function(event){
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

function monthForward(){
    var currentMonth = getCdpSettings().month;
    var currentYear = parseInt(getCdpSettings().year);
    var newMonth = null;
    for(var i=0; i<= months.length; i++){
        if(months[i] == currentMonth){
            if(i == months.length-1){
                newMonth = months[0];
                setCdpSettings('month',newMonth);
                setCdpSettings('year',currentYear+1);
                updateCdpDescription(newMonth, currentYear+1);
            }else{
                newMonth = months[i+1];
                setCdpSettings('month',newMonth);
                updateCdpDescription(newMonth, null);
            }
        }
    }
    loadDefaultMonths(getCdpSettings());
}

function monthBackward(){
    var currentMonth = getCdpSettings().month;
    var currentYear = parseInt(getCdpSettings().year);
    var newMonth = null;
    for(var i=0; i<= months.length; i++){
        if(months[i] == currentMonth){
            if(i == 0){
                newMonth = months[months.length-1]
                setCdpSettings('month',newMonth);
                setCdpSettings('year',currentYear-1);
                updateCdpDescription(newMonth, currentYear-1);
            }else{
                newMonth = months[i-1];
                setCdpSettings('month',newMonth);
                updateCdpDescription(newMonth, null);
            }
        }
    }
    loadDefaultMonths(getCdpSettings());
}

function rangeForward(){
    var settings = getCdpSettings();
    var currentStart = settings.startdate;
    var csDate = moment(currentStart);
    var currentEnd = settings.enddate;
    var ceDate = moment(currentEnd);
    var duration = moment.duration(ceDate.diff(csDate)).asDays();
    var fcsDate = csDate.add(duration,'days');
    var fceDate = ceDate.add(duration,'days');
    setCdpSettings('startdate',fcsDate.format('YYYY-M-DD'));
    setCdpSettings('enddate',fceDate.format('YYYY-M-DD'));
    updateCdpDescription(fcsDate.format('D, MMM YYYY'), fceDate.format('D, MMM YYYY'));
    loadDefaultRange(getCdpSettings());
}

function rangeBackward(){
    var settings = getCdpSettings();
    var currentStart = settings.startdate;
    var csDate = moment(currentStart);
    var currentEnd = settings.enddate;
    var ceDate = moment(currentEnd);
    var duration = moment.duration(ceDate.diff(csDate)).asDays();
    var fcsDate = csDate.subtract(duration,'days');
    var fceDate = ceDate.subtract(duration,'days');
    setCdpSettings('startdate',fcsDate.format('YYYY-M-DD'));
    setCdpSettings('enddate',fceDate.format('YYYY-M-DD'));
    updateCdpDescription(fcsDate.format('D, MMM YYYY'), fceDate.format('D, MMM YYYY'));
    loadDefaultRange(getCdpSettings());
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


function updateCdpDescription(first, second){
    var settings = getCdpSettings();
    if(settings.type =='month'){
        if(second){
            cdpDescription.text(first + " " + second);
        }else{
            cdpDescription.text(first + " " + settings.year);
        }
    }else if(settings.type == 'range'){
        cdpDescription.text(first + " - " + second);
    }

}

function getCdpSettings(){
    var settings = JSON.parse(cdpSettings.attr('data-settings'));
    return settings;
}

function setCdpSettings(key, value){
    var settings = getCdpSettings();
    settings[key] = value;
    cdpSettings.attr('data-settings',JSON.stringify(settings));
}

function triggerOnDateTimePickerChange(el){
    el.trigger('wf.datetimepicker.onchange');
}

function loadDefaultSettings(){
    var settings = getCdpSettings();
    loadDefaultMonths(settings);
    loadDefaultRange(settings);

}

function loadDefaultMonths(settings){
    monthsPicker.val(settings.year);
    $('.mn-item').removeClass('active');
    $(".months-listing .mn-item").each(function(){
        var val = $(this).text();
        if(val == settings.month){
            $(this).addClass('active');
        }
    });
    if(settings.type =='month'){
        updateCdpDescription(settings.month, settings.year);
    }
}

function loadDefaultRange(settings){
    var sd = moment(settings.startdate).format('D, MMM YYYY');
    var ed = moment(settings.enddate).format('D, MMM YYYY');
    startDateEl.val(settings.startdate);
    endDateEl.val(settings.enddate);
    if(settings.type == "range"){
        updateCdpDescription(sd, ed);
    }
}
