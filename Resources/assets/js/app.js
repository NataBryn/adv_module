$(document).ready(function () {

    setTimeout(function () {
        $('.alert').remove();
    }, 5000);

    $(document).on('click', '[data-action]', function (e) {
        $('[type=hidden][name=action]').val($(this).data('action'));
    });

    //confirm
    function dialog(message, yesCallback, noCallback) {
        var _modal = $('#confirm_modal');
        $(".modal").modal('hide');
        _modal.find(".js_message").html(message);
        _modal.modal('show');

        $('#confirmBtnYes').click(function () {
            $(".modal").modal('hide');
            if (yesCallback !== undefined) {
                yesCallback();
            }
            yesCallback = noCallback = function () {
            };
        });
        $('#confirmBtnNo').click(function () {
            $(".modal").modal('hide');
            $("[data-confirm]").removeAttr('disabled');
            if (noCallback !== undefined)
                noCallback();
            yesCallback = noCallback = function () {
            };
        });
    }

    (function () {
        var laravel = {
            initialize: function () {

                this.methodLinks = $('a[data-method]');
                this.token       = $('meta[name="csrf-token"]').attr('content');//$('a[data-token]');
                this.registerEvents();
            },

            registerEvents: function () {
                this.methodLinks.on('click', this.handleMethod);
            },

            handleMethod: function (e) {
                var link       = $(this);
                var httpMethod = link.data('method').toUpperCase();
                var form;


                // If the data-method attribute is not PUT or DELETE,
                // then we don't know what to do. Just ignore.
                if ($.inArray(httpMethod, ['PUT', 'POST', 'DELETE']) === -1) {
                    return;
                }

                // Allow user to optionally provide data-confirm="Are you sure?"
                if (link.data('confirm')) {
                    var _text = link.data('confirm');
                    // e.preventDefault();
                    // alert([Object.values(link), httpMethod, _text]);
                    dialog(_text,
                        function () {
                            form = laravel.createForm(link);
                            form.submit();
                        }
                    );
                } else {
                    form = laravel.createForm(link);
                    form.submit();
                }

                e.preventDefault();
            },

            verifyConfirm: function (link) {
                return confirm(link.data('confirm'));
            },

            createForm: function (link) {
                var form =
                        $('<form>', {
                            'method': 'POST',
                            'action': link.attr('href')
                        });

                var token =
                        $('<input>', {
                            'type' : 'hidden',
                            'name' : '_token',
                            'value': link.data('token')
                        });

                var hiddenInput =
                        $('<input>', {
                            'name' : '_method',
                            'type' : 'hidden',
                            'value': link.data('method')
                        });

                return form.append(token, hiddenInput)
                    .appendTo('body');
            }
        };

        laravel.initialize();

    })();
});
