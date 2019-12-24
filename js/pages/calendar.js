var PDMCalendarBasic = function() {

    return {
        //main function to initiate the module
        init: function(data) {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY + 'T09:25:00', // just for demo

                views: {
                    dayGridMonth: { buttonText: 'month' },
                    timeGridWeek: { buttonText: 'week' },
                    timeGridDay: { buttonText: 'day' }
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,

                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                events: data,

                eventRender: function(info) {
                    var element = $(info.el);

                    var initPopover = function(el) {
                        var skin = el.data('skin') ? 'popover-' + el.data('skin') : '';
                        var triggerValue = el.data('trigger') ? el.data('trigger') : 'hover';

                        el.popover({
                            trigger: triggerValue,
                            template: '\
                            <div class="popover ' + skin + '" role="tooltip">\
                                <div class="arrow"></div>\
                                <h3 class="popover-header"></h3>\
                                <div class="popover-body"></div>\
                            </div>'
                        });
                    };

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });

            calendar.render();
        },
    };
}();


jQuery(document).ready(function() {
    $.getJSON('/ajax/GetCalendarTransactions',function(response){
        PDMCalendarBasic.init(response.data)
    });
});
