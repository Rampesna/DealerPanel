"use strict";
$('#calendar').fullCalendar({
    defaultView: 'month',

    header: {
        left: 'title', // you can add today btn
        center: '',
        right: 'month, agendaWeek, listWeek, prev, next', // you can add agendaDay btn
    },
    contentHeight: 'auto',
    defaultDate: '2020-09-10',
    editable: true,
    droppable: false, // this allows things to be dropped onto the calendar
    eventLimit: false, // allow "more" link when too many events

    events: [
        {
            title: 'I-Uyum Eğitimi',
            start: '2020-09-10',
            className: 'bg-info',
        },
        {
            title: 'Portal Eğitimi',
            start: '2020-09-13T12:30:00',
            end: '2020-09-13T14:30:00',
            className: 'bg-danger'
        }
    ]
});
