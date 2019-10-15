
var modal = {}; // namespace

$ = jQuery.noConflict();

modal = (function () {
    return {
        instance: null,
        id: null,
        loadingOverlayId: '#main-loading-overlay',
        init: function (config) {
            modal.id = config.modalId;

            modal.instance = $('#' + modal.id);
            modal.instance.on('hidden.bs.modal', function () {
                modal.instance.find('.modal-content').empty();
            });

            $(document)
                .on('click', '.btn-modal-control-close', this.modalClose)
                .on('click', '.btn-modal-control', this.modalControl)
                .on('click', '.btn-modal-control-expand', this.modalControlSize)
                .on('click', '.btn-modal-control-minimise', this.modalControlSize)
                .on('click', '.btn-modal-control-submit', this.modalControlSubmit);
        },
        /**
         * displays a modal with url
         */
        modalControl: function (e) {
            e.preventDefault();
            var self = $(this);


            if (self.hasClass('disabled')) {
                return false;
            }
            var url = self.attr('data-href') || self.attr('href');
            var data = self.data('params') || '';
            var options = {backdrop: 'static'};
            if (self.attr('data-height')) {
                options.height = self.attr('data-height');
                if (modal.instance.data('modal')) {
                    modal.instance.data('modal').options.height = self.attr('data-height');
                }
            }
            if (self.attr('data-width')) {
                options.width = self.attr('data-width');
                if (modal.instance.data('modal')) {
                    modal.instance.data('modal').options.width = self.attr('data-width');
                }
            }
            if (self.attr('data-size')) {
                modal.instance.find('.modal-dialog').removeClass('modal-xlg modal-lg modal-md modal-sm modal-xs').addClass(self.attr('data-size'));
            }

            modal.instance.find('.modal-content').attr('class', 'modal-content');
            if (self.attr('data-content-class')) {
                modal.instance.find('.modal-content').addClass(self.attr('data-content-class'));
            }

            modal.loading(true);

            setTimeout(function () {
                var modalContent = modal.instance.find('.modal-content');
                modalContent.load(url, data, function () {
                    modal.loading(false);
                    modal.instance.modal(options);
                });
            }, 200);
            return false;
        },
        modalControlSize: function () {
            var modalClass = $(this).data('size');
            modal.instance.find('.modal-dialog').attr('class', 'modal-dialog');
            modal.instance.find('.modal-dialog').addClass(modalClass);

            return true;
        },
        openModal: function(url) {
            this.modalControl.call($('<a href="' + url + '">'), {preventDefault: $.noop});
        },
        /**
         * closes a modal
         */
        modalClose: function () {
            modal.instance.modal('hide');
        },
        /**
         * submits a form within a modal
         * @return {Boolean}
         */
        modalControlSubmit: function (e) {
            e.preventDefault();
            var self = $(this);

            if (self.hasClass('disabled')) {
                return false;
            }
            var frm = this.form ? $(this.form) : self.data('form-id') ? $('#' + self.data('form-id')) : self.closest('.modal-content').find('form');

            var hide = self.data('hide') !== undefined? self.data('hide') : true;

            modal.loading(true);

            $.ajax({
                url: frm.attr('action'),
                type: 'post',
                data: new FormData(frm[0]),
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (data) {
                    if (!data.success) {
                        main.yiiactiveform.updateInputs(frm, data.errors || []);
                        hide = false;
                    }

                    modal.loading(false);
                    if (hide) {
                        modal.instance.modal('hide');
                    }

                    // modal.notify(data.message, data.success ? 'success' : 'error');

                    $(document).trigger('modal-submitted', [data, self, frm]);
                },
                error: function (XHR) {
                    modal.instance.find('.modal-content').html(XHR.responseText);
                    modal.loading(false);
                    console.error('cao');
                }
            });
            return false;
        },
        notify: function (title, type, message, position) {

            type = type || 'error';
            position = position || 'top right';

            // $.Notification.notify(type, position, title, message);

            return this;
        },
        loading: function(state) {
            if(state) {
                $(modal.loadingOverlayId).show();
            } else {
                $(modal.loadingOverlayId).hide();
            }
        }
    };
})();