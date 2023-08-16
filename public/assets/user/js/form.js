"use strict"

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let $savingLoader = '<div class="spinner-border spinner-border-sm" role="status">' +
    '<span class="visually-hidden">Loading...</span>' +
    '</div>';


let $ajaxform = $('.ajaxform');
$ajaxform.initFormValidation();

$(document).on('submit', '.ajaxform', function (e) {
    e.preventDefault();

    let $this = $(this);
    let $submitBtn = $this.find('.submit-button');
    let $oldSubmitBtn = $submitBtn.html();

    if ($ajaxform.valid()) {
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html($savingLoader).attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($oldSubmitBtn).attr('disabled', false);

                Notify('success', res);
            },
            error: function (xhr) {
                $submitBtn.html($oldSubmitBtn).attr('disabled', false);
                showInputErrors(xhr.responseJSON);
                Notify('error', xhr);
            }
        });
    }
});

// Reset The form after success response
let $ajaxform_reset_form = $('.ajaxform_reset_form');
$ajaxform_reset_form.initFormValidation();

$(document).on('submit', '.ajaxform_reset_form', function (e) {
    e.preventDefault();

    let $this = $(this);
    let $submitBtn = $this.find('.submit-button');
    let $oldSubmitBtn = $submitBtn.html();

    if ($ajaxform_reset_form.valid()) {
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html($savingLoader).attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($oldSubmitBtn).attr('disabled', false);

                $this.trigger('reset');
                Notify('success', res);
            },
            error: function (xhr) {
                $submitBtn.html($oldSubmitBtn).attr('disabled', false);
                showInputErrors(xhr.responseJSON);
                Notify('error', xhr);
            }
        });
    }
});

$('.init_form_validation').initFormValidation();