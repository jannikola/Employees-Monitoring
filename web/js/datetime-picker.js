/********************************************************************************
 *
 * jQuery plugin constructor and defaults object
 *
 ********************************************************************************/

$.fn.datetimepicker = function (options) {
    return this.each(function () {
        var $this = $(this);
        if (!$this.data('DateTimePicker')) {
            // create a private copy of the defaults object
            options = $.extend(true, {}, $.fn.datetimepicker.defaults, options);
            $this.data('DateTimePicker', dateTimePicker($this, options));
        }
    });
};

$.fn.datetimepicker.defaults = {
    format: false,
    dayViewHeaderFormat: 'MMMM YYYY',
    extraFormats: false,
    stepping: 1,
    minDate: false,
    maxDate: false,
    useCurrent: true,
    collapse: true,
    locale: moment.locale(),
    defaultDate: false,
    disabledDates: false,
    enabledDates: false,
    icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-crosshairs',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    },
    tooltips: {
        today: 'Go to today',
        clear: 'Clear selection',
        close: 'Close the picker',
        selectMonth: 'Select Month',
        prevMonth: 'Previous Month',
        nextMonth: 'Next Month',
        selectYear: 'Select Year',
        prevYear: 'Previous Year',
        nextYear: 'Next Year',
        selectDecade: 'Select Decade',
        prevDecade: 'Previous Decade',
        nextDecade: 'Next Decade',
        prevCentury: 'Previous Century',
        nextCentury: 'Next Century'
    },
    useStrict: false,
    sideBySide: false,
    daysOfWeekDisabled: false,
    calendarWeeks: false,
    viewMode: 'days',
    toolbarPlacement: 'default',
    showTodayButton: false,
    showClear: false,
    showClose: false,
    widgetPositioning: {
        horizontal: 'auto',
        vertical: 'auto'
    },
    widgetParent: null,
    ignoreReadonly: false,
    keepOpen: false,
    focusOnShow: true,
    inline: false,
    keepInvalid: false,
    datepickerInput: '.datepickerinput',
    keyBinds: {
        up: function (widget) {
            if (!widget) {
                return;
            }
            var d = this.date() || moment();
            if (widget.find('.datepicker').is(':visible')) {
                this.date(d.clone().subtract(7, 'd'));
            } else {
                this.date(d.clone().add(this.stepping(), 'm'));
            }
        },
        down: function (widget) {
            if (!widget) {
                this.show();
                return;
            }
            var d = this.date() || moment();
            if (widget.find('.datepicker').is(':visible')) {
                this.date(d.clone().add(7, 'd'));
            } else {
                this.date(d.clone().subtract(this.stepping(), 'm'));
            }
        },
        'control up': function (widget) {
            if (!widget) {
                return;
            }
            var d = this.date() || moment();
            if (widget.find('.datepicker').is(':visible')) {
                this.date(d.clone().subtract(1, 'y'));
            } else {
                this.date(d.clone().add(1, 'h'));
            }
        },
        'control down': function (widget) {
            if (!widget) {
                return;
            }
            var d = this.date() || moment();
            if (widget.find('.datepicker').is(':visible')) {
                this.date(d.clone().add(1, 'y'));
            } else {
                this.date(d.clone().subtract(1, 'h'));
            }
        },
        left: function (widget) {
            if (!widget) {
                return;
            }
            var d = this.date() || moment();
            if (widget.find('.datepicker').is(':visible')) {
                this.date(d.clone().subtract(1, 'd'));
            }
        },
        right: function (widget) {
            if (!widget) {
                return;
            }
            var d = this.date() || moment();
            if (widget.find('.datepicker').is(':visible')) {
                this.date(d.clone().add(1, 'd'));
            }
        },
        pageUp: function (widget) {
            if (!widget) {
                return;
            }
            var d = this.date() || moment();
            if (widget.find('.datepicker').is(':visible')) {
                this.date(d.clone().subtract(1, 'M'));
            }
        },
        pageDown: function (widget) {
            if (!widget) {
                return;
            }
            var d = this.date() || moment();
            if (widget.find('.datepicker').is(':visible')) {
                this.date(d.clone().add(1, 'M'));
            }
        },
        enter: function () {
            this.hide();
        },
        escape: function () {
            this.hide();
        },
        //tab: function (widget) { //this break the flow of the form. disabling for now
        //    var toggle = widget.find('.picker-switch a[data-action="togglePicker"]');
        //    if(toggle.length > 0) toggle.click();
        //},
        'control space': function (widget) {
            if (widget.find('.timepicker').is(':visible')) {
                widget.find('.btn[data-action="togglePeriod"]').click();
            }
        },
        t: function () {
            this.date(moment());
        },
        'delete': function () {
            this.clear();
        }
    },
    debug: false,
    allowInputToggle: false,
    disabledTimeIntervals: false,
    disabledHours: false,
    enabledHours: false,
    viewDate: false
};
}));