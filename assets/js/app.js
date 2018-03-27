/**
 * Funciones globales jQuery
 */
$(document)
    .ready(function () {
        $('.btn-borrar')
            .on('click', function (event) {
                event.preventDefault();
                $('#btnBorrarOK').attr('href', $(this).data('url'));
            });

        $('#modalView').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var data_send = {
                'type': 'ajax'
            };
            if (button.data('params') !== undefined) {
                var params = button.data('params');
                var v_params = params.split(',');
                for (var n = 0; n < v_params.length; n++) {
                    var par = v_params[n].split(':');
                    data_send[par[0]] = par[1];
                }
            }
            var title = button.data('title');
            var btn = button.data('btn');
            var btnTitle = (button.data('btn-title') === undefined)
                ? 'Aceptar'
                : button.data('btn-title');
            var sizeWindow = button.data('size-window');
            var modal = $(this);
            modal
                .find('#modalViewTitle')
                .text(title);
            modal
                .find('#modalViewBtnAccept')
                .data('url', url);
            modal
                .find('#modalViewBtnAccept')
                .text(btnTitle);
            modal
                .find('#modalViewBtnAccept')
                .data('params', params);
            modal
                .find('#modalViewBody')
                .html('Cargando...');
            modal
                .find('#modalViewBtn')
                .hide();
            if (sizeWindow !== undefined) {
                modal
                    .find('div.modal-dialog')
                    .addClass(sizeWindow);
            }
            $
                .get(url, data_send, function (data) {
                    if (data.match(/ng-app/i)) {
                        window.location.href = base_url;
                    } else {
                        modal
                            .find('#modalViewBody')
                            .html(data);
                        if (btn === true) {
                            modal
                                .find('#modalViewBtn')
                                .show();
                        }
                    }
                })
                .fail(function (e) {
                    var newHTML = parseXHR(e, 'Ocurrió un error al cargar la URL.');
                    modal
                        .find('#modalViewBody')
                        .prepend(newHTML);
                });
        });

        $('#modalView').on('hidden.bs.modal', function (event) {
            var modal = $(this);
            modal
                .find('div.modal-dialog')
                .removeClass('modal-lg');
            modal
                .find('div.modal-dialog')
                .removeClass('modal-sm');
            modal
                .find('#modalViewBtnAccept')
                .removeAttr('disabled');
        });

        $('#modalViewBtnAccept').on('click', function (event) {
            event.preventDefault();
            var modal = $('#modalView');
            var form = modal.find('form');
            var url = $(this).data('url');
            if ($(this).data('params') !== undefined) {
                var params = $(this).data('params');
                if (params.indexOf('ajax') < 0) {
                    params = 'type:ajax,' + params;
                }
                params = params.replace(/:/g, '=');
                params = params.replace(/,/g, '&');
                url = url + '?' + params;
            } else {
                url = url + '?type=ajax';
            }
            if (form.valid()) {
                var tempHTML = modal
                    .find('#modalViewBody')
                    .html();
                modal
                    .find('#modalViewBody')
                    .html('Validando...');
                $(this).attr('disabled', 'disabled');
                $.post(url, form.serialize(), function (data) {
                    modal
                        .find('#modalViewBtnAccept')
                        .removeAttr('disabled');
                    if (data === 'RELOAD') {
                        modal
                            .find('#modalViewBody')
                            .html('Validado satisfactoriamente. Recargando página...');
                        location.reload();
                    } else {
                        modal
                            .find('#modalViewBody')
                            .html(data);
                        }
                    })
                    .fail(function (e) {
                        modal
                            .find('#modalViewBody')
                            .html(tempHTML);
                        var fields = form[0].elements;
                        for (var n = 0; n < fields.length; n++) {
                            if (fields[n].id !== undefined) {
                                $('#' + fields[n].id).val(fields[n].value);
                            } else if (fields[n].name !== undefined) {
                                $(fields[n].tagName + '[name="' + fields[n].name + '"]').val(fields[n].value);
                            }
                        }
                        modal
                            .find('#modalViewBtnAccept')
                            .removeAttr('disabled');
                        var newHTML = parseXHR(e, 'Ocurrió un error al realizar la validación.');
                        modal
                            .find('#modalViewBody')
                            .prepend(newHTML);
                    });
            }
        });

        if ($.validator !== undefined) {
            $
                .validator
                .addMethod("spanishDate", function (value, element) {
                    return value.match(/^\d\d\/\d\d\/\d\d\d\d$/);
                }, "Please enter a date in the format dd/mm/yyyy.");
        }

        $('.alert-dismissible')
            .delay(5000)
            .fadeOut("slow");

        if ($.fn.datepicker !== undefined) {
            $.fn.datepicker.defaults.format = "dd/mm/yyyy";
            $.fn.datepicker.defaults.language = "es";
            $.fn.datepicker.defaults.autoclose = true;
            $.fn.datepicker.defaults.forceParse = true;
            $.fn.datepicker.defaults.keyboardNavigation = false;
        }
    });

/**
 * Fondo tipo modal para bloquear la pantalla
 */
var myApp;
myApp = myApp || (function () {
    var pleaseWaitDiv = $('<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">' +
            '<div class="modal-body">' +
            '<div class="sk-spinner sk-spinner-wave">' +
            '<div class="sk-rect1" style="margin:1px"></div>' +
            '<div class="sk-rect2" style="margin:1px"></div>' +
            '<div class="sk-rect3" style="margin:1px"></div>' +
            '<div class="sk-rect4" style="margin:1px"></div>' +
            '<div class="sk-rect5" style="margin:1px"></div>' +
            '</div></div></div>');
    return {
        showPleaseWait: function () {
            pleaseWaitDiv.modal();
        },
        hidePleaseWait: function () {
            pleaseWaitDiv.modal('hide');
        }
    };
})();

/**
 * <h3>parseXHR</h3>
 * <p>
 * Transform the ajax XHR response to a nice HTML
 * </p>
 * @param {Object} e	Response object
 * @param {String} msg	Message to show in the error
 * @returns {String}	HTML response to return
 */
function parseXHR(e, msg) {
    var resp = $.parseHTML(e.responseText);
    var newHTML = '';
    newHTML += '<div class="alert alert-danger" role="alert">';
    newHTML += msg + ' <a data-toggle="collapse" data-target="#error-detail">Detalles</a>';
    newHTML += '<div id="error-detail" class="collapse">';
    $.each(resp, function (i, el) {
        if (el.tagName !== 'STYLE') {
            newHTML += el.outerHTML;
        }
    });
    newHTML += '</div>';
    newHTML += '</div>';
    return newHTML;
}

/**
 * <h3>checkReadOnly</h3>
 * <p>
 * Set the readonly attribute to the target element if the source<br/>
 * element have the same value to valCompare. In addition, when set<br/>
 * the readonly attribute also sets the new value to target element<br/>
 * with valSet.
 * </p>
 * @param {Object} source		DOM object source
 * @param {String} target		Selector for the ID of the target element
 * @param {String} valCompare	Value to compare for set the readonly attribute
 * @param {String} valSet		New value to object source when the readonly attribute is added
 */
function checkReadOnly(source, target, valCompare, valSet) {
    var newVal = (valSet === undefined)
        ? ''
        : valSet;
    if ($(source).attr('type') === 'radio' && $(target).length > 0) {
        if ($(source).val() === valCompare) {
            $(target).attr('readonly', 'readonly');
            $(target).val(newVal);
        } else {
            $(target).removeAttr('readonly');
        }
    }
}